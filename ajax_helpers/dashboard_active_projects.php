<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    // Get all projects with the correct column list
    $projects = DB::query(
        "SELECT 
            p.id, 
            p.name, 
            p.from_company, 
            p.to_client, 
            p.type, 
            p.rate, 
            p.payment_cycle, 
            p.category,
            p.created_at,
            p.client_id,
            COUNT(t.id) as task_count,
            SUM(CASE WHEN t.status = 'completed' THEN 1 ELSE 0 END) as completed_tasks
        FROM projects p
        LEFT JOIN tasks t ON p.id = t.project_id
        GROUP BY p.id
        ORDER BY p.created_at DESC"
    );

    // Format the results
    foreach ($projects as &$project) {
        $project['progress'] = ($project['task_count'] > 0)
            ? round(($project['completed_tasks'] / $project['task_count']) * 100)
            : 0;

        // Ensure proper types
        $project['task_count'] = (int)$project['task_count'];
        $project['completed_tasks'] = (int)$project['completed_tasks'];
        $project['rate'] = (float)$project['rate'];
    }

    echo json_encode([
        'success' => true,
        'data' => $projects,
        'count' => count($projects)
    ]);
} catch (MeekroDBException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// Custom error handler for MeekroDB
function json_error_handler($params)
{
    throw new Exception($params['error']);
}
