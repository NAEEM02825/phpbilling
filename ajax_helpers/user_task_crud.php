<?php
require('../functions.php');
header('Content-Type: application/json');
$userId = $_SESSION['user_id'] ?? 0;
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$response = ['success' => false];

try {
    switch ($action) {
        case 'get_my_tasks':
            $tasks = DB::query("SELECT t.*, p.name as project_name FROM tasks t LEFT JOIN projects p ON p.id = t.project_id WHERE t.assignee_id = %i ORDER BY t.task_date DESC", $userId);
            $response = ['success' => true, 'tasks' => $tasks];
            break;

        case 'get_projects':
            $projects = DB::query("SELECT id, name FROM projects ORDER BY name");
            $response = ['success' => true, 'projects' => $projects];
            break;

        case 'create_task':
            $taskData = [
                'project_id' => $_POST['project_id'] ?? null,
                'task_date' => $_POST['task_date'] ?? date('Y-m-d'),
                'hours' => $_POST['hours'] ?? 0,
                'details' => $_POST['details'] ?? '',
                'assignee_id' => $userId, // Automatically set to current user
                'status' => 'Pending',   // Default status
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::insert('tasks', $taskData);
            $taskId = DB::insertId();

            // Handle file uploads if any
            if (!empty($_FILES['files'])) {
                $uploadDir = '../uploads/tasks/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['files']['error'][$key] === UPLOAD_ERR_OK) {
                        $originalName = $_FILES['files']['name'][$key];
                        $cleanName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
                        $pathInfo = pathinfo($cleanName);
                        
                        $counter = 1;
                        $filename = $pathInfo['filename'];
                        $extension = $pathInfo['extension'] ?? '';
                        
                        while (file_exists($uploadDir . $filename . ($extension ? '.' . $extension : ''))) {
                            $filename = $pathInfo['filename'] . '_' . $counter;
                            $counter++;
                        }
                        
                        $finalName = $filename . ($extension ? '.' . $extension : '');
                        $destination = $uploadDir . $finalName;

                        if (move_uploaded_file($tmpName, $destination)) {
                            DB::insert('task_files', [
                                'task_id' => $taskId,
                                'file_name' => $originalName,
                                'file_path' => 'uploads/tasks/' . $finalName,
                                'file_type' => $_FILES['files']['type'][$key],
                                'file_size' => $_FILES['files']['size'][$key],
                                'uploaded_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }
            }

            $response = ['success' => true, 'task_id' => $taskId];
            break;

        case 'start_task':
            // Verify task belongs to user and is pending
            $task = DB::queryFirstRow(
                "SELECT id FROM tasks WHERE id = %i AND assignee_id = %i AND status = %s",
                $_POST['task_id'],
                $userId,
                'Pending'
            );

            if (!$task) {
                $response['error'] = 'Task not found or cannot be started';
                break;
            }

            // Update status to In Progress
            DB::update('tasks', [
                'status' => 'In Progress',
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = %i', $_POST['task_id']);

            $response = ['success' => true];
            break;

        case 'complete_task':
            // Verify task belongs to user
            $task = DB::queryFirstRow(
                "SELECT id FROM tasks WHERE id = %i AND assignee_id = %i",
                $_POST['task_id'],
                $userId
            );

            if (!$task) {
                $response['error'] = 'Task not found';
                break;
            }

            // Update status to Completed
            DB::update('tasks', [
                'status' => 'Completed',
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = %i', $_POST['task_id']);

            $response = ['success' => true];
            break;

        case 'delete_task':
            DB::delete('tasks', 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);
            $response = ['success' => true];
            break;

        case 'get_task':
            $task = DB::queryFirstRow(
                "SELECT * FROM tasks WHERE id = %i AND assignee_id = %i", 
                $_POST['task_id'], 
                $userId
            );
            
            if ($task) {
                $files = DB::query(
                    "SELECT * FROM task_files WHERE task_id = %i ORDER BY uploaded_at DESC", 
                    $_POST['task_id']
                );
                
                $response = [
                    'success' => true, 
                    'task' => $task,
                    'files' => $files
                ];
            } else {
                $response['error'] = 'Task not found';
            }
            break;

        case 'update_task':
    $taskData = [
        'project_id' => $_POST['project_id'] ?? null,
        'task_date' => $_POST['task_date'] ?? date('Y-m-d'),
        'hours' => $_POST['hours'] ?? 0,
        'details' => $_POST['details'] ?? '',
        'updated_at' => date('Y-m-d H:i:s')
    ];

    DB::update('tasks', $taskData, 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);
    $response = ['success' => true];
    default:
            $response['error'] = 'Invalid action';
            break;
}
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);