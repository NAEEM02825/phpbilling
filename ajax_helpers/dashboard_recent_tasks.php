<?php
require_once('../functions.php');
header('Content-Type: application/json');

try {
    // Get the current user ID from session
    $currentUserId = $_SESSION['user_id'] ?? null;
    
    // Get limit from query parameters or use default (5)
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

    // Query to get recent tasks for the current user
    $tasks = DB::query(
        "SELECT 
            t.id,
            t.title,
            t.details,
            t.task_date,
            t.hours,
            t.status,
            t.clickup_link,
            t.created_at,
            t.project_id,
            p.name AS project_name
        FROM 
            tasks t
        LEFT JOIN 
            projects p ON t.project_id = p.id
        WHERE 
            t.assignee_id = %i
        ORDER BY 
            t.task_date DESC
        LIMIT %i",
        $currentUserId,
        $limit
    );

    // Format the results
    $formattedTasks = array_map(function($task) {
        return [
            'id' => (int)$task['id'],
            'title' => $task['title'],
            'details' => $task['details'],
            'due_date' => formatDateForDisplay($task['task_date']),
            'hours' => (float)$task['hours'],
            'status' => $task['status'],
            'project_name' => $task['project_name'] ?? 'No Project'
        ];
    }, $tasks);

    echo json_encode([
        'success' => true,
        'tasks' => $formattedTasks
    ]);

} catch (MeekroDBException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error'
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

function formatDateForDisplay($dateString) {
    if (empty($dateString)) {
        return 'No date set';
    }
    return date('M j, Y', strtotime($dateString));
}