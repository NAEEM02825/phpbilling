<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
       case 'get_users':
    $status_filter = $_POST['status_filter'] ?? '';
    $role_filter = $_POST['role_filter'] ?? '';
    $id = $_POST['id'] ?? null;

    $where = [];
    $params = [];

    if (!empty($id)) {
        $where[] = 'u.id = %i';  // Note the 'u.' prefix
        $params[] = $id;
    }

    if (!empty($status_filter)) {
        $where[] = 'u.status = %s';
        $params[] = $status_filter;
    }

    if (!empty($role_filter)) {
        $where[] = 'r.id = %i';  // Changed to filter by role id
        $params[] = $role_filter;
    }

    $query = "SELECT 
        u.id,
        u.first_name,
        u.last_name,
        u.email,
        u.username,
        u.status,
        u.last_active,
        u.avatar,
        r.name as role_name
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.id";

    if (!empty($where)) {
        $query .= " WHERE " . implode(' AND ', $where);
    }

    // Add debug output
    error_log("Executing query: " . $query);
    error_log("With params: " . print_r($params, true));

    try {
        $users = DB::query($query, ...$params);
        error_log("Found " . count($users) . " users");
        
        if (empty($users)) {
            // Check if tables exist
            $tablesExist = DB::queryFirstColumn("SHOW TABLES LIKE 'users'");
            if (empty($tablesExist)) {
                throw new Exception("Users table doesn't exist");
            }
            
            $tablesExist = DB::queryFirstColumn("SHOW TABLES LIKE 'roles'");
            if (empty($tablesExist)) {
                throw new Exception("Roles table doesn't exist");
            }
        }
        
        echo json_encode([
            'success' => true,
            'data' => $users,
            'debug' => [
                'query' => $query,
                'params' => $params,
                'num_users' => count($users)
            ]
        ]);
    } catch (Exception $e) {
        throw new Exception("Query failed: " . $e->getMessage());
    }
    break;
        case 'add_user':
            // Validate required fields
            $required = ['first_name', 'last_name', 'email', 'username', 'password', 'role_id'];  // Changed to role_id
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("Field $field is required");
                }
            }

            // Check if email or username already exists
            $existing = DB::queryFirstRow(
                "SELECT id FROM users WHERE email = %s OR username = %s",
                $_POST['email'],
                $_POST['username']
            );
            if ($existing) {
                throw new Exception("Email or username already exists");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role_id' => $_POST['role_id'],  // Changed to role_id
                'status' => $_POST['status'] ?? 'active',
                'avatar' => $_POST['avatar'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
                'last_active' => date('Y-m-d H:i:s')
            ];

            DB::insert('users', $data);
            echo json_encode(['success' => true, 'message' => 'User added successfully']);
            break;

        case 'update_user':
            if (empty($_POST['id'])) {
                throw new Exception("User ID is required");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'role_id' => $_POST['role_id'],  // Changed to role_id
                'status' => $_POST['status'] ?? 'active',
                'avatar' => $_POST['avatar'] ?? null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            DB::update('users', $data, 'id=%i', $_POST['id']);
            echo json_encode(['success' => true, 'message' => 'User updated successfully']);
            break;

        case 'delete_user':
            if (empty($_POST['id'])) {
                throw new Exception("User ID is required");
            }

            DB::delete('users', 'id=%i', $_POST['id']);
            echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
            break;

        case 'change_status':
            if (empty($_POST['id']) || empty($_POST['status'])) {
                throw new Exception("ID and status are required");
            }

            DB::update(
                'users',
                [
                    'status' => $_POST['status'],
                    'updated_at' => date('Y-m-d H:i:s')  // Added updated_at
                ],
                'id=%i',
                $_POST['id']
            );
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            break;

        case 'get_roles':
            $roles = DB::query("SELECT * FROM roles");
            echo json_encode(['success' => true, 'data' => $roles]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
