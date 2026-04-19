<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'] ?? null,
        'company_name' => $_POST['company_name'] ?? null,
        'status' => 'active',
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    DB::insert('clients', $data);
    echo json_encode(['success' => true, 'message' => 'Client added successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>