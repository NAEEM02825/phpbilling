<?php
require('../functions.php');
header('Content-Type: application/json');
$userId = $_SESSION['user_id'] ?? 0;
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$response = ['success' => false];

try {
    switch ($action) {
        case 'get_my_tasks':
            $tasks = DB::query("SELECT t.*, p.name as project_name FROM tasks t LEFT JOIN projects p ON p.id = t.project_id WHERE t.assignee_id = %i ORDER BY t.task_date DESC", $_POST['user_id']);
            $response = ['success' => true, 'tasks' => $tasks];
            break;
        case 'get_projects':
            $projects = DB::query(
                "SELECT p.id, p.name 
                 FROM projects p
                 INNER JOIN user_projects up ON up.project_id = p.id
                 WHERE up.user_id = %i
                 ORDER BY p.name", 
                 $userId
            );
            $response = ['success' => true, 'projects' => $projects];
            break;
        case 'create_task':
            DB::insert('tasks', [
                'title' => $_POST['title'],
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'hours' => $_POST['hours'],
                'assignee_id' => $userId,
                'status' => $_POST['status'],
                'details' => $_POST['details'] ?? '',
                'clickup_link' => $_POST['clickup_link'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $response = ['success' => true];
            break;
        case 'get_task':
            $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i AND assignee_id = %i", $_POST['task_id'], $userId);
            $response = ['success' => !!$task, 'task' => $task];
            break;
        case 'update_task':
            DB::update('tasks', [
                'title' => $_POST['title'],
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'hours' => $_POST['hours'],
                'status' => $_POST['status'],
                'details' => $_POST['details'] ?? '',
                'clickup_link' => $_POST['clickup_link'] ?? '',
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);
            $response = ['success' => true];
            break;
        case 'delete_task':
            DB::delete('tasks', 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);
            $response = ['success' => true];
            break;
        default:
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}
echo json_encode($response);