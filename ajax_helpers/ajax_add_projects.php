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

        case 'get':
            // Fetch a single project by ID
            $projectId = intval($_GET['project_id'] ?? 0);
            if (!$projectId) {
                echo json_encode(['success' => false, 'error' => 'Project ID required']);
                exit;
            }
            $project = DB::queryFirstRow("SELECT * FROM projects WHERE id = %i", $projectId);
            if ($project) {
                echo json_encode(['success' => true, 'data' => $project]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Project not found']);
            }
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

        case 'update':
            // Update an existing project
            $projectId = intval($_GET['project_id'] ?? 0);
            if (!$projectId) {
                echo json_encode(['success' => false, 'error' => 'Project ID required']);
                exit;
            }
            $project = [
                'name' => $_POST['name'],
                'from_company' => $_POST['from_company'],
                'to_client' => $_POST['to_client'],
                'type' => $_POST['type'],
                'rate' => $_POST['rate'],
                'payment_cycle' => $_POST['payment_cycle'],
                'category' => strpos($_POST['name'], 'SF') === 0 ? 'SF' : 'Other'
            ];
            DB::update('projects', $project, "id=%i", $projectId);
            echo json_encode(['success' => true, 'message' => 'Project updated successfully']);
            break;

        case 'delete':
            $projectId = intval($_GET['project_id'] ?? 0);
            if (!$projectId) {
                echo json_encode(['success' => false, 'error' => 'Project ID required']);
                exit;
            }
            // Optionally: delete related tasks first if you want to enforce referential integrity
            DB::query("DELETE FROM tasks WHERE project_id = %i", $projectId);
            DB::query("DELETE FROM projects WHERE id = %i", $projectId);
            echo json_encode(['success' => true, 'message' => 'Project deleted successfully']);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}