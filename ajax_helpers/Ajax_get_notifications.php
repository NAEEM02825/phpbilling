<?php
require('../functions.php');
header('Content-Type: application/json');

// Basic error handling
try {
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
 

    switch ($method) {
        case 'GET':
            // Simple GET with pagination
            $page = max(1, intval($_GET['page'] ?? 1));
            $limit = min(50, max(5, intval($_GET['limit'] ?? 10)));
            $offset = ($page - 1) * $limit;
            
            // Status filter
            $statusFilter = '';
            if ($_GET['status'] === 'read') {
                $statusFilter = 'WHERE is_read = 1';
            } elseif ($_GET['status'] === 'unread') {
                $statusFilter = 'WHERE is_read = 0';
            }
            
            // Get notifications
            $stmt = $db->prepare("SELECT * FROM admin_notifications $statusFilter ORDER BY created_at DESC LIMIT ? OFFSET ?");
            $stmt->execute([$limit, $offset]);
            $notifications = $stmt->fetchAll();
            
            // Get counts
            $total = $db->query("SELECT COUNT(*) FROM admin_notifications $statusFilter")->fetchColumn();
            $unread = $db->query("SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0")->fetchColumn();
            
            echo json_encode([
                'data' => $notifications,
                'total' => $total,
                'unread' => $unread,
                'page' => $page
            ]);
            break;

        case 'PATCH':
            // Mark as read - simple version
            $id = $request[0] ?? null;
            
            if ($id === 'all') {
                // Mark all as read
                $db->exec("UPDATE admin_notifications SET is_read = 1, read_at = NOW() WHERE is_read = 0");
                $unread = 0;
            } elseif (is_numeric($id)) {
                // Mark single as read
                $stmt = $db->prepare("UPDATE admin_notifications SET is_read = 1, read_at = NOW() WHERE id = ?");
                $stmt->execute([$id]);
                $unread = $db->query("SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0")->fetchColumn();
            } else {
                throw new Exception('Invalid request');
            }
            
            echo json_encode(['success' => true, 'unread' => $unread]);
            break;

        case 'DELETE':
            // Delete notifications - simple version
            $id = $request[0] ?? null;
            
            if ($id === 'all') {
                // Delete all
                $db->exec("DELETE FROM admin_notifications");
                $total = 0;
                $unread = 0;
            } elseif (is_numeric($id)) {
                // Delete single
                $stmt = $db->prepare("DELETE FROM admin_notifications WHERE id = ?");
                $stmt->execute([$id]);
                $total = $db->query("SELECT COUNT(*) FROM admin_notifications")->fetchColumn();
                $unread = $db->query("SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0")->fetchColumn();
            } else {
                throw new Exception('Invalid request');
            }
            
            echo json_encode(['success' => true, 'total' => $total, 'unread' => $unread]);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}