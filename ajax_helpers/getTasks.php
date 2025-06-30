<?php
require('../functions.php');
header('Content-Type: application/json');

$projectId = (int)($_GET['project_id'] ?? 0);
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

try {
    // Build query and parameters
    $query = "
        SELECT t.*, 
               p.name as project_name, 
               u.name as assignee_name,
               t.details as description,
               t.hours
        FROM tasks t
        LEFT JOIN projects p ON p.id = t.project_id
        LEFT JOIN users u ON u.user_id = t.assignee_id
        WHERE 1=1
    ";
    $params = [];

    if ($projectId) {
        $query .= " AND t.project_id = %i";
        $params[] = $projectId;
    }
    if ($startDate && $endDate) {
        $query .= " AND t.task_date BETWEEN %s AND %s";
        $params[] = $startDate;
        $params[] = $endDate;
    }

    $query .= " ORDER BY t.task_date DESC";

    $tasks = DB::query($query, ...$params);

    echo json_encode([
        'success' => true,
        'data' => $tasks
    ]);
} catch (MeekroDBException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}