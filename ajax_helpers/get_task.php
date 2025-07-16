<?php
// Ensure no output before headers
ob_start();

require_once __DIR__ . '/../functions.php';

// Set proper JSON header
header('Content-Type: application/json; charset=UTF-8');

try {
    // Get task ID from URL
    $taskId = $_GET['task_id'] ?? null;
    
    if (!$taskId || !is_numeric($taskId)) {
        throw new Exception('Invalid task ID');
    }

    // Fetch task from database using MeekroDB
    $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i", $taskId);
    
    if (!$task) {
        throw new Exception('Task not found');
    }

    // Clear any accidental output
    ob_end_clean();
    
    // Return JSON response
    die(json_encode([
        'success' => true,
        'task' => $task
    ]));

} catch (Exception $e) {
    // Clear any output before error response
    ob_end_clean();
    
    http_response_code(400);
    die(json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]));
}