<?php
require_once('../functions.php');
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = ['success' => false];

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    $response['error'] = 'Unauthorized access';
    echo json_encode($response);
    exit;
}

$notificationId = $_GET['id'] ?? 0;

if ($notificationId > 0) {
    try {
        DB::update('admin_notifications', [
            'is_read' => 1,
            'read_at' => date('Y-m-d H:i:s')
        ], 'id = %i AND user_id = %i', $notificationId, $_SESSION['user_id']);
        
        $response['success'] = true;
    } catch (Exception $e) {
        $response['error'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'Invalid notification ID';
}

echo json_encode($response);
?>