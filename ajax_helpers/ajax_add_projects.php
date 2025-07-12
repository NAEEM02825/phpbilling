<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';
    $response = ['success' => false];

    switch ($action) {
        case 'list':
            $category = $_GET['category'] ?? '';
            
            // Build base query with client name concatenation
          $query = "SELECT p.*, 
         CONCAT(c.first_name, ' ', c.last_name) AS client_full_name
         FROM projects p
         LEFT JOIN clients c ON p.client_id = c.id";
            
            
            $projects = DB::query($query);
        
            // Count tasks for each project
            foreach ($projects as &$project) {
                $project['task_count'] = DB::queryFirstField(
                    "SELECT COUNT(*) FROM tasks WHERE project_id = %i", 
                    $project['id']
                );
                // Ensure client name is available in both formats
                $project['to_client'] = $project['client_full_name'] ?? $project['to_client'] ?? '';
                $project['client_name'] = $project['client_full_name'] ?? '';
            }
            
            $response = [
                'success' => true,
                'data' => $projects,
                'count' => count($projects)
            ];
            break;

        case 'get':
            $projectId = intval($_GET['project_id'] ?? 0);
            if (!$projectId) {
                throw new Exception('Project ID required');
            }
            
            $project = DB::queryFirstRow(
                "SELECT p.*, 
                 CONCAT(c.first_name, ' ', c.last_name) AS client_full_name
                 FROM projects p 
                 LEFT JOIN clients c ON p.client_id = c.id 
                 WHERE p.id = %i", 
                $projectId
            );
            
            if ($project) {
                $project['to_client'] = $project['client_full_name'] ?? $project['to_client'] ?? '';
                $response = [
                    'success' => true,
                    'data' => $project
                ];
            } else {
                throw new Exception('Project not found', 404);
            }
            break;

        case 'create':
        case 'update':
            $projectId = $action === 'update' ? intval($_GET['project_id'] ?? 0) : null;
            
            // Validate required fields
            $required = ['name', 'from_company', 'type', 'rate', 'payment_cycle'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception("Field $field is required");
                }
            }
            
            // Prepare project data
            $projectData = [
                'name' => trim($_POST['name']),
                'from_company' => trim($_POST['from_company']),
                'client_id' => !empty($_POST['client_id']) ? (int)$_POST['client_id'] : null,
                'type' => $_POST['type'],
                'rate' => (float)$_POST['rate'],
                'payment_cycle' => $_POST['payment_cycle'],
                'category' => strpos($_POST['name'], 'SF') === 0 ? 'SF' : 'Other'
            ];
            
            // For backward compatibility, store client name if available
            if (!empty($_POST['to_client'])) {
                $projectData['to_client'] = trim($_POST['to_client']);
            } elseif (!empty($_POST['client_id'])) {
                $clientName = DB::queryFirstField(
                    "SELECT CONCAT(first_name, ' ', last_name) 
                     FROM clients WHERE id = %i", 
                    (int)$_POST['client_id']
                );
                $projectData['to_client'] = $clientName ?? '';
            }
            
            if ($action === 'create') {
                $projectData['created_at'] = DB::sqleval('NOW()');
                DB::insert('projects', $projectData);
                $projectId = DB::insertId();
                $response = [
                    'success' => true,
                    'message' => 'Project created successfully',
                    'id' => $projectId
                ];
            } else {
                if (!$projectId) {
                    throw new Exception('Project ID required for update');
                }
                DB::update('projects', $projectData, "id = %i", $projectId);
                $response = [
                    'success' => true,
                    'message' => 'Project updated successfully',
                    'id' => $projectId
                ];
            }
            break;

        case 'delete':
            $projectId = intval($_GET['project_id'] ?? 0);
            if (!$projectId) {
                throw new Exception('Project ID required');
            }
            
            // Verify project exists
            $exists = DB::queryFirstField("SELECT id FROM projects WHERE id = %i", $projectId);
            if (!$exists) {
                throw new Exception('Project not found', 404);
            }
            
            // Start transaction for data integrity
            DB::startTransaction();
            try {
                // Delete related tasks
                DB::query("DELETE FROM tasks WHERE project_id = %i", $projectId);
                // Delete project
                DB::query("DELETE FROM projects WHERE id = %i", $projectId);
                DB::commit();
                $response = [
                    'success' => true,
                    'message' => 'Project deleted successfully'
                ];
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
            break;

        default:
            throw new Exception('Invalid action', 400);
    }
} catch (Exception $e) {
    $code = $e->getCode();
    // Ensure the code is a valid HTTP status code (between 100 and 599)
    if (!is_int($code) || $code < 100 || $code > 599) {
        $code = 500; // Default to 500 if code is invalid
    }
    http_response_code($code);
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
}

echo json_encode($response);