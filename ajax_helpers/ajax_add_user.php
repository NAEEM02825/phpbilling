<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_user':
            $required = ['first_name', 'last_name', 'email', 'user_name', 'phone', 'password', 'role_id'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("Field $field is required");
                }
            }

            $existing = DB::queryFirstRow(
                "SELECT user_id FROM users WHERE email = %s OR user_name = %s",
                $_POST['email'],
                $_POST['user_name']
            );
            if ($existing) {
                throw new Exception("Email or username already exists");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'user_name' => $_POST['user_name'],
                'phone' => $_POST['phone'] ?? null,
                'password' => $_POST['password'], // Removed password_hash()
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status'] ?? 'active',
                'picture' => $_POST['avatar'] ?? null,
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
                'user_name' => $_POST['user_name'],
                'phone' => $_POST['phone'] ?? null,
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status'] ?? 'active',
                'picture' => $_POST['avatar'] ?? null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password']; // Removed password_hash()
            }

            DB::update('users', $data, 'user_id=%i', $_POST['user_id']);
            echo json_encode(['success' => true, 'message' => 'User updated successfully']);
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