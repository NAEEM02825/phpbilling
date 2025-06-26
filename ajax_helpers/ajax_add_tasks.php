<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            $projectId = $_GET['project_id'];
            $tasks = DB::query(
                "SELECT * FROM tasks WHERE project_id = %i ORDER BY task_date DESC", 
                $projectId
            );
            echo json_encode(['success' => true, 'data' => $tasks]);
            break;

        case 'create':
            $task = [
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'details' => $_POST['details'],
                'hours' => $_POST['hours'],
                'status' => $_POST['status'],
                'clickup_link' => $_POST['clickup_link'] ?? null
            ];
            
            DB::insert('tasks', $task);
            echo json_encode(['success' => true, 'message' => 'Task added successfully']);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}