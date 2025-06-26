<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_user':
            $required = ['first_name', 'last_name', 'email', 'username', 'password', 'role_id'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("Field $field is required");
                }
            }

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
            if (empty($_POST['id'])) {
                throw new Exception("User ID is required");
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'role_id' => $_POST['role_id'],
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
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                'id=%i',
                $_POST['id']
            );
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}