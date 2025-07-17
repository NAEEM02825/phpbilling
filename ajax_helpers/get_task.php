<?php
require('../functions.php');

header('Content-Type: application/json');

// Check if task_id is provided
if (!isset($_GET['task_id']) || !is_numeric($_GET['task_id'])) {
    die(json_encode(['error' => 'Invalid task ID']));
}

$taskId = intval($_GET['task_id']);

try {
    // Fetch task details from database
    $stmt = $pdo->prepare("
        SELECT 
            t.*, 
            p.name AS project_name,
            u.name AS assignee_name,
            u.initials AS assignee_initials
        FROM tasks t
        LEFT JOIN projects p ON t.project_id = p.id
        LEFT JOIN users u ON t.assignee_id = u.user_id
        WHERE t.id = ?
    ");
    $stmt->execute([$taskId]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        die(json_encode(['error' => 'Task not found']));
    }

    // Return task data as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'task' => $task
    ]);
    
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
}