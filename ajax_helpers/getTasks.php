<?php
require('../functions.php');
header('Content-Type: application/json');

$projectId = (int)($_GET['project_id'] ?? 0);
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

try {
    // Fetch tasks using MeekroDB's simpler syntax
    $tasks = DB::query("
        SELECT * FROM tasks 
        WHERE project_id = %i 
        AND task_date BETWEEN %s AND %s
        ORDER BY task_date DESC
    ", $projectId, $startDate, $endDate);

    echo json_encode($tasks);
} catch (MeekroDBException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}