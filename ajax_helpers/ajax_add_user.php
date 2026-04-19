<?php
require('../functions.php');
header('Content-Type: application/json');

// Logged-in user ki details session se nikalna
$logged_in_user_id = $_SESSION['user_id'] ?? 0;
$logged_in_role_id = $_SESSION['role_id'] ?? 0;

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_user':
            $required = ['first_name', 'last_name', 'email', 'name', 'password', 'role_id'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("Field $field is required");
                }
            }

            // Manager check: Agar manager login hai to wo Admin (role 1) add nahi kar sakta
            if ($logged_in_role_id == 2 && $_POST['role_id'] == 1) {
                throw new Exception("Managers cannot create Admin accounts.");
            }

            $existing = DB::queryFirstRow(
                "SELECT user_id FROM users WHERE email = %s OR name = %s",
                $_POST['email'],
                $_POST['name']
            );
            if ($existing) {
                throw new Exception("Email or name already exists");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status'] ?? 'active',
                'avatar' => $_POST['avatar'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
                'last_active' => date('Y-m-d H:i:s')
            ];

            DB::insert('users', $data);
            echo json_encode(['success' => true, 'message' => 'User added successfully']);
            break;

        case 'update_user':
        case 'delete_user':
        case 'change_status':
            $target_user_id = $_POST['user_id'] ?? 0;

            if (empty($target_user_id)) {
                throw new Exception("User ID is required");
            }

            // CHECK 1: Apna record modify nahi kar sakta
            if ($target_user_id == $logged_in_user_id) {
                throw new Exception("You cannot perform this action on your own account for security reasons.");
            }

            // Target user ka role check karna
            $target_user = DB::queryFirstRow("SELECT role_id FROM users WHERE user_id = %i", $target_user_id);
            if (!$target_user) {
                throw new Exception("User not found");
            }

            // CHECK 2: Manager Admin ko modify nahi kar sakta
            if ($logged_in_role_id == 2 && $target_user['role_id'] == 1) {
                throw new Exception("Access Denied: Managers cannot modify Admin accounts.");
            }

            // --- Logic Execution Starts ---
            if ($action == 'update_user') {
                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'name' => $_POST['name'],
                    'role_id' => $_POST['role_id'],
                    'status' => $_POST['status'] ?? 'active',
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                if (!empty($_POST['password'])) {
                    $data['password'] = $_POST['password']; 
                }
                DB::update('users', $data, 'user_id=%i', $target_user_id);
                echo json_encode(['success' => true, 'message' => 'User updated successfully']);

            } elseif ($action == 'delete_user') {
                DB::delete('users', 'user_id=%i', $target_user_id);
                echo json_encode(['success' => true, 'message' => 'User deleted successfully']);

            } elseif ($action == 'change_status') {
                DB::update('users', ['status' => $_POST['status'], 'updated_at' => date('Y-m-d H:i:s')], 'user_id=%i', $target_user_id);
                echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            }
            break;

        case 'get_roles':
            // Manager ko Admin role select karne ki ijazat nahi hai
            if ($logged_in_role_id == 2) {
                $roles = DB::query("SELECT * FROM roles WHERE id != 1 ORDER BY name ASC");
            } else {
                $roles = DB::query("SELECT * FROM roles ORDER BY name ASC");
            }
            echo json_encode(['success' => true, 'data' => $roles]);
            break;

        case 'get_user':
            if (empty($_POST['user_id'])) {
                throw new Exception("User ID is required");
            }
            
            $user = DB::queryFirstRow("SELECT * FROM users WHERE user_id = %i", $_POST['user_id']);
            
            // Security: Manager kisi Admin ka data fetch na kar sakay
            if ($logged_in_role_id == 2 && $user['role_id'] == 1) {
                throw new Exception("Unauthorized access to Admin data.");
            }

            if ($user) {
                echo json_encode(['success' => true, 'data' => $user]);
            } else {
                throw new Exception("User not found");
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}