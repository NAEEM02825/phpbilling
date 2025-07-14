<?php
require('../functions.php');


header('Content-Type: application/json');

try {
    // Get unread count
    $unreadCount = DB::queryFirstField(
        "SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0"
    );
    
    // Get latest notifications (10 most recent)
    $notifications = DB::query(
        "SELECT id, message, related_task_id, is_read, created_at 
         FROM admin_notifications 
         ORDER BY created_at DESC 
         LIMIT 10"
    );
    
    echo json_encode([
        'success' => true,
        'unread_count' => (int)$unreadCount,
        'notifications' => $notifications
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}