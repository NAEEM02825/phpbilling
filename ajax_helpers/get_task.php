<?php
require('../functions.php');

if (isset($_GET['task_id'])) {
    $taskId = $_GET['task_id'];
    
    try {
        // Get task details
        $task = DB::queryFirstRow("
            SELECT t.*, u.user_name as assignee_name, p.name as project_name 
            FROM tasks t
            LEFT JOIN users u ON t.assignee_id = u.user_id
            LEFT JOIN projects p ON t.project_id = p.id
            WHERE t.id = %i", $taskId);
            
        if (!$task) {
            die(json_encode(['success' => false, 'error' => 'Task not found']));
        }
        
        // Get task files
        $files = DB::query("
            SELECT *, 
                   CONCAT('uploads/tasks/', SUBSTRING_INDEX(file_path, '/', -1)) as display_path
            FROM task_files 
            WHERE task_id = %i 
            ORDER BY uploaded_at DESC", $taskId);
            
        $response = [
            'success' => true,
            'task' => $task,
            'files' => $files
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
        
    } catch (Exception $e) {
        die(json_encode(['success' => false, 'error' => $e->getMessage()]));
    }
}
?>