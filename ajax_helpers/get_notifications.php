<?php
require_once('../functions.php');
header('Content-Type: application/json');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = [
    'success' => false,
    'unread' => [],
    'read' => [],
    'unread_count' => 0
];

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    $response['error'] = 'Unauthorized access';
    echo json_encode($response);
    exit;
}

try {
    // Get unread notifications (last 30 days)
    $unread = DB::query(
        "SELECT id, type, message, created_at, related_id
         FROM admin_notifications
         WHERE is_read = 0
         AND user_id = %i
         AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
         ORDER BY created_at DESC
         LIMIT 10",
        $_SESSION['user_id']
    );
    
    // Get read notifications (last 30 days)
    $read = DB::query(
        "SELECT id, type, message, created_at, related_id
         FROM admin_notifications
         WHERE is_read = 1
         AND user_id = %i
         AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
         ORDER BY created_at DESC
         LIMIT 10",
        $_SESSION['user_id']
    );
    
    // Count all unread notifications
    $unreadCount = DB::queryFirstField(
        "SELECT COUNT(*) FROM admin_notifications
         WHERE is_read = 0
         AND user_id = %i
         AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)",
        $_SESSION['user_id']
    );
    
    $response = [
        'success' => true,
        'unread' => $unread,
        'read' => $read,
        'unread_count' => (int)$unreadCount
    ];
    
} catch (Exception $e) {
    $response['error'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
?>