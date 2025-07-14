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
            $projects = DB::query("SELECT id, name FROM projects ORDER BY name");
            $response = ['success' => true, 'projects' => $projects];
            break;

        case 'get_user_details':
            $user = DB::queryFirstRow("SELECT first_name, last_name FROM users WHERE id = %i", $userId);
            if ($user) {
                $response = ['success' => true, 'user' => $user];
            } else {
                $response['error'] = 'User not found';
            }
            break;

        case 'create_task':
            DB::insert('tasks', [
                'title' => $_POST['title'],
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'hours' => $_POST['hours'],
                'assignee_id' => $_POST['assignee_id'],
                'status' => $_POST['status'],
                'details' => $_POST['details'] ?? '',
                'clickup_link' => $_POST['clickup_link'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $response = ['success' => true];
            break;

        case 'start_task':
            // Get user details first
            $user = DB::queryFirstRow("SELECT first_name, last_name FROM users WHERE user_id = %i", $userId);
            if (!$user) {
                throw new Exception('User not found');
            }
            $userName = $user['first_name'] . ' ' . $user['last_name'];

            // Verify task belongs to user and is pending
            $task = DB::queryFirstRow(
                "SELECT id, title FROM tasks WHERE id = %i AND assignee_id = %i AND status = %s",
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

            try {
                // Create admin notification
                $message = "User {$userName} has started task: {$task['title']}";
                DB::insert('admin_notifications', [
                    'message' => $message,
                    'related_task_id' => $_POST['task_id'],
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_read' => 0
                ]);
            } catch (Exception $e) {
                // Log the error but don't fail the entire operation
                error_log("Failed to create notification: " . $e->getMessage());
            }

            $response = ['success' => true];
            break;

        case 'complete_task':
            // Get user details first
            $user = DB::queryFirstRow("SELECT first_name, last_name FROM users WHERE user_id = %i", $userId);
            if (!$user) {
                throw new Exception('User not found');
            }
            $userName = $user['first_name'] . ' ' . $user['last_name'];

            // Get task details
            $task = DB::queryFirstRow(
                "SELECT id, title FROM tasks WHERE id = %i AND assignee_id = %i",
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
            ], 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);

            try {
                // Create admin notification
                $message = "User {$userName} has completed task: {$task['title']}";
                DB::insert('admin_notifications', [
                    'message' => $message,
                    'related_task_id' => $_POST['task_id'],
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_read' => 0
                ]);
            } catch (Exception $e) {
                error_log("Failed to create notification: " . $e->getMessage());
            }

            $response = ['success' => true];
            break;

        case 'delete_task':
            DB::delete('tasks', 'id = %i AND assignee_id = %i', $_POST['task_id'], $userId);
            $response = ['success' => true];
            break;

        case 'get_task':
            $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i AND assignee_id = %i", $_POST['task_id'], $userId);
            if ($task) {
                $response = ['success' => true, 'task' => $task];
            } else {
                $response['error'] = 'Task not found';
            }
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

        default:
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
