<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? $_GET['action'] ?? '';
    $response = ['success' => false];

    switch ($action) {
        case 'get_projects':
            $projects = DB::query("
                SELECT p.*, 
                       COUNT(t.id) as task_count,
                       SUM(CASE WHEN t.status = 'completed' THEN 1 ELSE 0 END) as completed_tasks
                FROM projects p
                LEFT JOIN tasks t ON t.project_id = p.id
                GROUP BY p.id
            ");

            $response = [
                'success' => true,
                'data' => $projects
            ];
            break;

        case 'get_tasks':
            $assigneeId = $_POST['assignee_id'] ?? null;
            $projectId = $_POST['project_id'] ?? null; // <-- Add this line
            $query = "
                SELECT t.*, p.name as project_name, u.name as assignee_name, 
                       CONCAT(LEFT(u.name, 1), LEFT(u.last_name, 1)) as assignee_initials
                FROM tasks t
                LEFT JOIN projects p ON p.id = t.project_id
                LEFT JOIN users u ON u.user_id = t.assignee_id
            ";

            $where = [];
            $params = [];

            if ($assigneeId) {
                $where[] = "t.assignee_id = %i";
                $params[] = $assigneeId;
            }
            if ($projectId) {
                $where[] = "t.project_id = %i";
                $params[] = $projectId;
            }
            if ($where) {
                $query .= " WHERE " . implode(" AND ", $where);
                $tasks = DB::query($query, ...$params);
            } else {
                $tasks = DB::query($query);
            }

            $response = [
                'success' => true,
                'data' => $tasks
            ];
            break;
        case 'update_task_status':
            $taskId = $_POST['task_id'];
            $newStatus = strtolower($_POST['status']); // Convert to lowercase to match your DB

            // Validate and sanitize inputs
            $validStatuses = ['pending', 'in progress', 'completed'];
            if (!in_array($newStatus, $validStatuses)) {
                echo json_encode(['success' => false, 'error' => 'Invalid status']);
                exit;
            }

            // Update in database
            DB::update('tasks', [
                'status' => $newStatus,
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = %i', $taskId);

            $response = [
                'success' => true,
                'message' => 'Status updated successfully'
            ];
            break;
        case 'get_users':
            $users = DB::query("SELECT user_id, CONCAT(name, ' ', last_name) as name 
                       FROM users 
                       WHERE role_id = 3");
            $response = [
                'success' => true,
                'users' => $users
            ];
            break;

        case 'get_task_details':
            $taskId = $_POST['task_id'];
            $task = DB::queryFirstRow("
                SELECT t.*, p.name as project_name, u.name as assignee_name, 
                       CONCAT(LEFT(u.name, 1), LEFT(u.last_name, 1)) as assignee_initials
                FROM tasks t
                LEFT JOIN projects p ON p.id = t.project_id
                LEFT JOIN users u ON u.user_id = t.assignee_id
                WHERE t.id = %i
            ", $taskId);

            // Initialize time_logs as empty array
            $timeLogs = [];

            // Check if time_logs table exists before querying
            try {
                $tableExists = DB::queryFirstField("
                    SELECT COUNT(*) 
                    FROM information_schema.tables 
                    WHERE table_schema = DATABASE() 
                    AND table_name = 'time_logs'
                ");

                if ($tableExists) {
                    $timeLogs = DB::query("
                        SELECT tl.*, u.name as user_name
                        FROM time_logs tl
                        LEFT JOIN users u ON u.user_id = tl.user_id
                        WHERE tl.task_id = %i
                        ORDER BY tl.log_date DESC
                    ", $taskId);
                }
            } catch (Exception $e) {
                // Silently ignore if time_logs table doesn't exist
                $timeLogs = [];
            }

            $response = [
                'success' => true,
                'data' => [
                    'task' => $task,
                    'time_logs' => $timeLogs
                ]
            ];
            break;

        case 'create_task':
            $taskData = [
                'title' => $_POST['title'],
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'hours' => $_POST['hours'],
                'assignee_id' => $_POST['assignee_id'] ?? '',
                'status' => $_POST['status'],
                'details' => $_POST['details'] ?? '',
                'clickup_link' => $_POST['clickup_link'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::insert('tasks', $taskData);
            $response = [
                'success' => true,
                'message' => 'Task created successfully'
            ];
            break;

        case 'update_task':
            $taskId = $_POST['task_id'];
            $taskData = [
                'title' => $_POST['title'],
                'project_id' => $_POST['project_id'],
                'task_date' => $_POST['task_date'],
                'hours' => $_POST['hours'],
                'assignee_id' => $_POST['assignee_id'],
                'status' => $_POST['status'],
                'details' => $_POST['details'] ?? '',
                'clickup_link' => $_POST['clickup_link'] ?? '',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::update('tasks', $taskData, 'id = %i', $taskId);
            $response = [
                'success' => true,
                'message' => 'Task updated successfully'
            ];
            break;

        case 'delete_task':
            $taskId = $_POST['task_id'];
            DB::delete('tasks', 'id = %i', $taskId);
            $response = [
                'success' => true,
                'message' => 'Task deleted successfully'
            ];
            break;

        case 'get_user_data':
            $userId = $_POST['user_id'] ?? 3;
            $user = DB::queryFirstRow("SELECT * FROM users WHERE user_id = %i", $userId);

            $response = [
                'success' => true,
                'data' => $user
            ];
            break;

        case 'get_my_tasks':
            $userId = $_SESSION['user_id'] ?? 0;

            $tasks = DB::query("SELECT t.*, p.name as project_name FROM tasks t LEFT JOIN projects p ON p.id = t.project_id WHERE t.assignee_id = %i", $userId);

            $response = [
                'success' => true,
                'tasks' => $tasks
            ];
            break;

        default:
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
