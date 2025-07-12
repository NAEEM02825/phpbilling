<?php
require('../functions.php');

header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';

    // Enable error logging for debugging
    error_log("Received action: " . $action);
    
    switch ($action) {
        case 'get_users':
            $status_filter = $_GET['status_filter'] ?? '';
            $role_filter = $_GET['role_filter'] ?? '';
            $id = $_GET['user_id'] ?? null;
            $username = $_GET['user_name'] ?? null; // Added username filter

            $where = [];
            $params = [];

            if (!empty($id)) {
                $where[] = 'u.user_id = %i';
                $params[] = $id;
            }

            if (!empty($status_filter)) {
                $where[] = 'u.status = %s';
                $params[] = $status_filter;
            }

            if (!empty($role_filter)) {
                $where[] = 'r.id = %i';
                $params[] = $role_filter;
            }

            if (!empty($username)) {
                $where[] = 'u.user_name = %s';
                $params[] = $username;
            }

            $query = "SELECT 
                u.user_id,
                u.first_name,
                u.last_name,
                u.email,
                u.user_name,
                u.status,
                u.last_active,
                u.picture,
                r.name as role_name
            FROM users u
            LEFT JOIN roles r ON u.role_id = r.id";

            if (!empty($where)) {
                $query .= " WHERE " . implode(' AND ', $where);
            }

            error_log("Executing query: " . $query);
            error_log("With params: " . print_r($params, true));

            $users = DB::query($query, ...$params);
            
            error_log("Found " . count($users) . " users");
            
            echo json_encode([
                'success' => true,
                'data' => $users,
                'debug' => [
                    'query' => $query,
                    'params' => $params
                ]
            ]);
            break;

        case 'check_username':
            // New action to specifically check username availability
            if (empty($_GET['user_name'])) {
                throw new Exception("Username parameter is required");
            }

            $username = $_GET['user_name'];
            $current_user_id = $_GET['current_user_id'] ?? null; // For edit scenarios

            $query = "SELECT user_id FROM users WHERE user_name = %s";
            $params = [$username];

            if (!empty($current_user_id)) {
                $query .= " AND user_id != %i";
                $params[] = $current_user_id;
            }

            $existing = DB::queryFirstRow($query, ...$params);
            
            echo json_encode([
                'success' => true,
                'available' => empty($existing),
                'message' => empty($existing) ? 'Username available' : 'Username already taken'
            ]);
            break;

        case 'get_roles':
            $roles = DB::query("SELECT * FROM roles");
            echo json_encode(['success' => true, 'data' => $roles]);
            break;

        default:
            echo json_encode([
                'success' => false,
                'message' => 'Invalid action specified'
            ]);
    }
} catch (Exception $e) {
    error_log("Error in get_users.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'trace' => $e->getTrace() // Only in development!
    ]);
}