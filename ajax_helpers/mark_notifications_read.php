<?php
require('../functions.php');

// Include your DB connection setup

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        DB::update('admin_notifications', [
            'is_read' => 1,
            'read_at' => DB::sqleval('NOW()')
        ], 'id=%i', $_POST['id']);
        
        echo json_encode(['success' => true]);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}