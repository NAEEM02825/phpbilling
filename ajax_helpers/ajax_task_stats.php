<?php
// get_tasks.php
require('../functions.php'); // This should include MeekroDB setup
header('Content-Type: application/json');

// Get the user_id from GET parameters
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if (!$user_id) {
    echo json_encode(['error' => 'Invalid user_id']);
    exit;
}

try {
    // Fetch all statuses where assignee_id matches the user
    $statuses = DB::query("SELECT status FROM tasks WHERE assignee_id = %i", $user_id);

    $total = count($statuses);
    $completed = $pending = $in_progress = $overdue = 0;

    foreach ($statuses as $row) {
        switch ($row['status']) {
            case 'Completed': $completed++; break;
            case 'Pending': $pending++; break;
            case 'In Progress': $in_progress++; break;
            // If you still want to track overdue separately
            case 'Overdue': $overdue++; break;
        }
    }

    echo json_encode([
        'total' => $total,
        'completed' => $completed,
        'pending' => $pending,
        'in_progress' => $in_progress,
        'overdue' => $overdue
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database query failed', 'details' => $e->getMessage()]);
}