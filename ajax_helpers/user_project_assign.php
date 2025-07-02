<?php
require('../functions.php');
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action === 'get_user_projects') {
        $user_id = intval($_GET['user_id']);
        $projects = DB::query("SELECT p.* FROM projects p
            INNER JOIN user_projects up ON up.project_id = p.id
            WHERE up.user_id = %i", $user_id);
        echo json_encode(['success' => true, 'projects' => $projects]);
    } elseif ($action === 'get_project_users') {
        $project_id = intval($_GET['project_id']);
        $users = DB::query("SELECT u.*, u.user_id as id FROM users u
            INNER JOIN user_projects up ON up.user_id = u.user_id
            WHERE up.project_id = %i", $project_id);
        echo json_encode(['success' => true, 'users' => $users]);
    } elseif ($action === 'assign_projects_to_user') {
        $user_id = intval($_POST['user_id']);
        $project_ids = $_POST['project_ids'] ?? [];
        DB::delete('user_projects', 'user_id=%i', $user_id);
        foreach ($project_ids as $pid) {
            DB::insertIgnore('user_projects', ['user_id' => $user_id, 'project_id' => intval($pid)]);
        }
        echo json_encode(['success' => true]);
    } elseif ($action === 'assign_users_to_project') {
        $project_id = intval($_POST['project_id']);
        $user_ids = $_POST['user_ids'] ?? [];
        DB::delete('user_projects', 'project_id=%i', $project_id);
        foreach ($user_ids as $uid) {
            DB::insertIgnore('user_projects', ['user_id' => intval($uid), 'project_id' => $project_id]);
        }
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}