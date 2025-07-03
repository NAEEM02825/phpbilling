<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    // Get assignee_id from query parameter
    $assigneeId = isset($_GET['assignee_id']) ? intval($_GET['assignee_id']) : null;
    
    if (!$assigneeId) {
        http_response_code(400);
        echo json_encode(['error' => 'assignee_id parameter is required']);
        exit;
    }

    // Fetch tasks from database
    $tasks = DB::query(
        "SELECT 
            id,
            project_id,
            title,
            task_date,
            details,
            hours,
            status,
            clickup_link,
            created_at,
            assignee_id,
            updated_at
        FROM tasks
        WHERE assignee_id = %i
        ORDER BY task_date ASC", 
        $assigneeId
    );

    // Return tasks as JSON
    echo json_encode([
        'success' => true, 
        'tasks' => $tasks
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error',
        'message' => $e->getMessage()
    ]);
}