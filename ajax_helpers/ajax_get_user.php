<?php
require('../functions.php');
header('Content-Type: application/json');

$logged_in_user_id = $_SESSION['user_id'] ?? 0;
$logged_in_role_id = $_SESSION['role_id'] ?? 0;

try {
    $action = $_GET['action'] ?? '';

    // Enable error logging for debugging
    error_log("Received action: " . $action);
    
    switch ($action) {
        case 'get_users':
            $status_filter = $_GET['status_filter'] ?? '';
            $role_filter = $_GET['role_filter'] ?? '';
            $id = $_GET['user_id'] ?? null;

            $where = [];
            $params = [];

            // --- CORE REQUIREMENT: Manager (Role 2) ko Admin (Role 1) ka record nahi dikhana ---
            if ($logged_in_role_id == 2) {
                $where[] = 'u.role_id != 1';
            }

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

            $query = "SELECT 
                u.user_id,
                u.first_name,
                u.last_name,
                u.email,
                u.name,
                u.status,
                u.last_active,
                u.picture,
                u.role_id,
                r.name as role_name
            FROM users u
            LEFT JOIN roles r ON u.role_id = r.id";

            if (!empty($where)) {
                $query .= " WHERE " . implode(' AND ', $where);
            }

            $query .= " ORDER BY u.user_id DESC"; // Newest users first

            error_log("Executing query: " . $query);

            $users = DB::query($query, ...$params);
            
            error_log("Found " . count($users) . " users");
            
            echo json_encode([
                'success' => true,
                'data' => $users,
                'logged_in_user' => $logged_in_user_id, // Frontend check ke liye
                'debug' => [
                    'query' => $query,
                    'params' => $params
                ]
            ]);
            break;

        case 'get_roles':
            // Manager ko dropdown mein Admin role nazar na aaye
            if ($logged_in_role_id == 2) {
                $roles = DB::query("SELECT * FROM roles WHERE id != 1 ORDER BY name ASC");
            } else {
                $roles = DB::query("SELECT * FROM roles ORDER BY name ASC");
            }
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
        'message' => $e->getMessage()
    ]);
}