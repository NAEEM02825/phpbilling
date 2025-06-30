<?php
require('../functions.php');
header('Content-Type: application/json');

$projectId = $_GET['project_id'] ?? 0;
$startDate = $_GET['start_date'] ?? date('Y-m-d');
$endDate = $_GET['end_date'] ?? date('Y-m-d');

$tasks = DB::query("
    SELECT t.* 
    FROM tasks t
    WHERE t.project_id = %i
    AND t.completed_date BETWEEN %s AND %s
    ORDER BY t.completed_date DESC
", $projectId, $startDate, $endDate);

echo json_encode($tasks);
?>