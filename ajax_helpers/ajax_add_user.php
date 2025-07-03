<?php
require('../functions.php');

header('Content-Type: application/json');

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
            if (empty($_POST['user_id'])) {
                throw new Exception("User ID is required");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status'] ?? 'active',
                'avatar' => $_POST['avatar'] ?? null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password']; 
            }

            DB::update('users', $data, 'user_id=%i', $_POST['user_id']);
            echo json_encode(['success' => true, 'message' => 'User updated successfully']);
            break;

        case 'delete_user':
            if (empty($_POST['user_id'])) {
                throw new Exception("User ID is required");
            }

            DB::delete('users', 'user_id=%i', $_POST['user_id']);
            echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
            break;

        case 'change_status':
            if (empty($_POST['user_id']) || empty($_POST['status'])) {
                throw new Exception("User ID and status are required");
            }
            
            DB::update(
                'users',
                [
                    'status' => $_POST['status'],
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                'user_id=%i',
                $_POST['user_id']
            );
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            break;

        case 'get_roles':
            $roles = DB::query("SELECT * FROM roles");
            echo json_encode(['success' => true, 'data' => $roles]);
            break;

        case 'get_user':
            if (empty($_POST['user_id'])) {
                throw new Exception("User ID is required");
            }
            
            $user = DB::queryFirstRow("SELECT * FROM users WHERE user_id = %i", $_POST['user_id']);
            
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