<?php
require('../functions.php');
// Set headers for JSON response
header('Content-Type: application/json');

// Get the action from the request
$action = $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'create_task':
            $result = createTask($_POST);
            break;
            
        case 'get_tasks':
            $result = getTasks($_POST);
            break;
            
        case 'get_projects':
            $result = getProjects();
            break;
            
        case 'get_users':
            $result = getUsers();
            break;
            
        case 'get_task_details':
            $result = getTaskDetails($_POST['task_id']);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
    echo json_encode(['success' => true, 'data' => $result]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

function createTask($data) {
    $required = ['title', 'project_id', 'task_date', 'estimated_hours', 'assignee_id', 'status'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            throw new Exception("Missing required field: $field");
        }
    }
    
    $taskId = DB::insert('tasks', [
        'title' => $data['title'],
        'description' => $data['description'] ?? '',
        'project_id' => $data['project_id'],
        'assignee_id' => $data['assignee_id'],
        'task_date' => $data['task_date'],
        'estimated_hours' => $data['estimated_hours'],
        'status' => $data['status'],
        'clickup_link' => $data['clickup_link'] ?? ''
    ]);
    
    return ['task_id' => $taskId];
}

function getTasks($filters = []) {
    $where = [];
    $params = [];
    
    if (!empty($filters['project_id'])) {
        $where[] = 't.project_id = %i';
        $params[] = $filters['project_id'];
    }
    
    if (!empty($filters['assignee_id'])) {
        $where[] = 't.assignee_id = %i';
        $params[] = $filters['assignee_id'];
    }
    
    if (!empty($filters['status'])) {
        $where[] = 't.status = %s';
        $params[] = $filters['status'];
    }
    
    $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
    
    $query = "SELECT t.*, p.name as project_name, u.name as assignee_name
              FROM tasks t
              JOIN projects p ON t.project_id = p.id
              JOIN users u ON t.assignee_id = u.id
              $whereClause
              ORDER BY t.task_date DESC";
    
    return DB::query($query, ...$params);
}

function getProjects() {
    return DB::query("SELECT p.*, 
                     (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id) as task_count,
                     (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id AND t.status = 'completed') as completed_tasks
                     FROM projects p
                     ORDER BY p.name");
}

function getUsers() {
    return DB::query("SELECT * FROM users ORDER BY name");
}

function getTaskDetails($taskId) {
    $task = DB::queryFirstRow("SELECT t.*, p.name as project_name, u.name as assignee_name, u.initials as assignee_initials
                              FROM tasks t
                              JOIN projects p ON t.project_id = p.id
                              JOIN users u ON t.assignee_id = u.id
                              WHERE t.id = %i", $taskId);
    
    if (!$task) {
        throw new Exception('Task not found');
    }
    
    $timeLogs = DB::query("SELECT tl.*, u.name as user_name
                          FROM time_logs tl
                          JOIN users u ON tl.user_id = u.id
                          WHERE tl.task_id = %i
                          ORDER BY tl.log_date DESC", $taskId);
    
    return [
        'task' => $task,
        'time_logs' => $timeLogs
    ];
}
?>