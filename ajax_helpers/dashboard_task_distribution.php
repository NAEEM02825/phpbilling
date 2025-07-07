<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    // Sample data - replace with your actual data fetching logic
    $data = [
        'labels' => ['Completed', 'In Progress', 'Pending' ],
        'data' => [35, 25, 20, 20],
        'backgroundColors' => ['#4e73df', '#1cc88a', '#f6c23e'],
        'borderColors' => ['#ffffff', '#ffffff', '#ffffff' ],
        'success' => true
    ];

    echo json_encode($data);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}