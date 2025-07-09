<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    // Check if MeekroDB is available (assuming it's set up in functions.php)
    if (!class_exists('DB')) {
        throw new Exception("MeekroDB not available");
    }
    
    // Query to get task counts by status using MeekroDB
    $result = DB::queryFirstRow("SELECT 
                SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'In Progress' THEN 1 ELSE 0 END) as in_progress,
                SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending
              FROM tasks");
    
    if (!$result) {
        throw new Exception("No data returned from query");
    }
    
    // Prepare response data
    $data = [
        'labels' => ['Completed', 'In Progress', 'Pending'],
        'data' => [
            $result['completed'] ?? 0,
            $result['in_progress'] ?? 0,
            $result['pending'] ?? 0
        ],
        'backgroundColors' => ['#4e73df', '#1cc88a', '#f6c23e'],
        'borderColors' => ['#ffffff', '#ffffff', '#ffffff'],
        'success' => true
    ];

    echo json_encode($data);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}