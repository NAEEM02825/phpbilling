<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            $category = $_GET['category'] ?? '';
            $query = "SELECT * FROM projects";
            if ($category === 'SF') {
                $query .= " WHERE category = 'SF'";
            } elseif ($category === 'Other') {
                $query .= " WHERE category = 'Other'";
            }
            $projects = DB::query($query);
            
            // Count tasks for each project
            foreach ($projects as &$project) {
                $project['task_count'] = DB::queryFirstField(
                    "SELECT COUNT(*) FROM tasks WHERE project_id = %i", 
                    $project['id']
                );
            }
            
            echo json_encode(['success' => true, 'data' => $projects]);
            break;

        case 'create':
            $project = [
                'name' => $_POST['name'],
                'from_company' => $_POST['from_company'],
                'to_client' => $_POST['to_client'],
                'type' => $_POST['type'],
                'rate' => $_POST['rate'],
                'payment_cycle' => $_POST['payment_cycle'],
                'category' => strpos($_POST['name'], 'SF') === 0 ? 'SF' : 'Other'
            ];
            
            DB::insert('projects', $project);
            $projectId = DB::insertId();
            
            echo json_encode([
                'success' => true, 
                'message' => 'Project created successfully',
                'id' => $projectId
            ]);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}