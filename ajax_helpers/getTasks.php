<?php
require('../functions.php');
header('Content-Type: application/json');

$projectId = (int)($_GET['project_id'] ?? 0);
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

try {
    // Build WHERE conditions
    $where = ["t.project_id = %i", "t.status = 'Completed'"];
    $params = [$projectId];

    if ($startDate && $endDate) {
        $where[] = "t.task_date BETWEEN %s AND %s";
        $params[] = $startDate;
        $params[] = $endDate;
    }

    $whereSql = implode(' AND ', $where);

    $query = "
        SELECT t.*, p.name as project_name, u.name as assignee_name
        FROM tasks t
        LEFT JOIN projects p ON t.project_id = p.id
        LEFT JOIN users u ON t.assignee_id = u.user_id
        WHERE $whereSql
        ORDER BY t.task_date DESC
    ";

    $tasks = DB::query($query, ...$params);

    // Return the data directly (without success wrapper) to match JS expectations
    echo json_encode($tasks);
    
} catch (MeekroDBException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}