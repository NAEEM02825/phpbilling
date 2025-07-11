<?php
session_start();
require('../functions.php');
header('Content-Type: application/json');

try {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        throw new Exception('Invalid CSRF token');
    }

    // Verify user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Session expired. Please login again.');
    }

    $user_id = (int)$_SESSION['user_id'];
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate inputs
    if (empty($current_password)){
        throw new Exception('Current password is required');
    }

    if (strlen($new_password) < 8) {
        throw new Exception('New password must be at least 8 characters long');
    }

    if ($new_password !== $confirm_password) {
        throw new Exception('New passwords do not match');
    }

    // Get current user data
    $user = DB::queryFirstRow("SELECT password FROM users WHERE user_id = %i", $user_id);
    if (!$user) {
        throw new Exception('User not found');
    }

    // Verify current password - adjust this according to your password hashing method
    if (!password_verify($current_password, $user['password'])) {
        throw new Exception('Current password is incorrect');
    }

    // Update password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    DB::update('users', [
        'password' => $hashed_password
    ], "user_id = %i", $user_id);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}