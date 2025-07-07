<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $stats = DB::queryFirstRow("SELECT 
    COUNT(*) as total_tasks,
    SUM(status = 'completed') as completed_tasks,
    SUM(status = 'pending') as pending_tasks,
    SUM(status = 'In Progress') as in_progress_tasks
    FROM tasks");

    echo json_encode([
        'success' => true,
        'total_tasks' => (int)$stats['total_tasks'],
        'completed_tasks' => (int)$stats['completed_tasks'],
        'pending_tasks' => (int)$stats['pending_tasks'],
        'in_progress_tasks' => (int)$stats['in_progress_tasks']
    ]);
} catch (MeekroDBException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
