<?php
require('../functions.php');


header('Content-Type: application/json');

try {
    // Handle POST actions (mark as read, delete, etc.)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_SERVER['HTTP_X_ACTION'] ?? '';
        
        switch ($action) {
            case 'mark-read':
                // Mark single notification as read
                $id = $_POST['id'] ?? 0;
                if (!$id) {
                    throw new Exception('Notification ID is required');
                }
                
                DB::update('admin_notifications', [
                    'is_read' => 1,
                    'read_at' => DB::sqleval('NOW()')
                ], 'id = %i', $id);
                
                // Get updated counts
                $totalCount = DB::queryFirstField("SELECT COUNT(*) FROM admin_notifications");
                $unreadCount = DB::queryFirstField("SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0");
                
                echo json_encode([
                    'success' => true,
                    'total_count' => (int)$totalCount,
                    'unread_count' => (int)$unreadCount
                ]);
                exit;
                
            case 'mark-all-read':
                // Mark all notifications as read
                DB::update('admin_notifications', [
                    'is_read' => 1,
                    'read_at' => DB::sqleval('NOW()')
                ], 'is_read = 0');
                
                // Get updated counts
                $totalCount = DB::queryFirstField("SELECT COUNT(*) FROM admin_notifications");
                $unreadCount = 0;
                
                echo json_encode([
                    'success' => true,
                    'total_count' => (int)$totalCount,
                    'unread_count' => (int)$unreadCount
                ]);
                exit;
                
            case 'clear-all':
                // Delete all notifications
                DB::query("DELETE FROM admin_notifications");
                
                echo json_encode([
                    'success' => true,
                    'total_count' => 0,
                    'unread_count' => 0
                ]);
                exit;
                
            default:
                throw new Exception('Invalid action');
        }
    }
    
    // Handle GET requests (fetch notifications)
    
    // Get parameters
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $perPage = isset($_GET['per_page']) ? max(1, (int)$_GET['per_page']) : 10;
    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? 'all';
    $notificationId = $_GET['id'] ?? 0;
    
    // Handle single notification request
    if ($notificationId) {
        $notification = DB::queryFirstRow(
            "SELECT id, message, related_task_id, is_read, created_at, read_at 
             FROM admin_notifications 
             WHERE id = %i", 
            $notificationId
        );
        
        if (!$notification) {
            throw new Exception('Notification not found');
        }
        
        echo json_encode([
            'success' => true,
            'notification' => $notification
        ]);
        exit;
    }
    
    // Build query for multiple notifications
    $where = [];
    $params = [];
    
    // Search filter
    if (!empty($search)) {
        $where[] = "(message LIKE %ss OR related_task_id LIKE %ss)";
        $params[] = $search;
        $params[] = $search;
    }
    
    // Status filter
    if ($status === 'read') {
        $where[] = "is_read = 1";
    } elseif ($status === 'unread') {
        $where[] = "is_read = 0";
    }
    
    // Combine where clauses
    $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
    
    // Get total count
    $total = DB::queryFirstField(
        "SELECT COUNT(*) FROM admin_notifications $whereClause", 
        ...$params
    );
    
    // Get unread count
    $unreadCount = DB::queryFirstField(
        "SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0"
    );
    
    // Get paginated results
    $offset = ($page - 1) * $perPage;
    $notifications = DB::query(
        "SELECT id, message, related_task_id, is_read, created_at 
         FROM admin_notifications 
         $whereClause 
         ORDER BY created_at DESC 
         LIMIT %i OFFSET %i", 
        ...array_merge($params, [$perPage, $offset])
    );
    
    echo json_encode([
        'success' => true,
        'notifications' => $notifications,
        'total' => (int)$total,
        'unread_count' => (int)$unreadCount,
        'per_page' => $perPage,
        'current_page' => $page
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}