<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    // Check if an ID was provided in the request
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Notification ID is required']);
        exit;
    }

    $notificationId = (int)$_GET['id'];
    
    // Get the specific notification
    $notification = DB::queryFirstRow(
        "SELECT id, message, related_task_id, is_read, created_at 
         FROM admin_notifications 
         WHERE id = %i",
        $notificationId
    );
    
    if (!$notification) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Notification not found']);
        exit;
    }
    
    // Format the notification
    $formattedNotification = [
        'id' => $notification['id'],
        'message' => $notification['message'],
        'related_task_id' => $notification['related_task_id'],
        'is_read' => $notification['is_read'],
        'created_at' => $notification['created_at']
    ];
    
    echo json_encode([
    'success' => true,
    'id' => $notification['id'],
    'message' => $notification['message'],
    'related_task_id' => $notification['related_task_id'],
    'is_read' => (bool)$notification['is_read'], // Convert to boolean
    'created_at' => $notification['created_at']
]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}