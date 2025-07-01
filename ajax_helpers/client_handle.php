<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    switch ($action) {
        case 'get_clients':
            $page = $_GET['page'] ?? 1;
            $perPage = $_GET['per_page'] ?? 10;
            $offset = ($page - 1) * $perPage;
            
            $clients = DB::query("SELECT * FROM clients ORDER BY created_at DESC LIMIT %i OFFSET %i", $perPage, $offset);
            $total = DB::queryFirstField("SELECT COUNT(*) FROM clients");
            
            echo json_encode([
                'success' => true,
                'data' => $clients,
                'total' => $total
            ]);
            break;
            
        case 'add_client':
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $company = $_POST['company'] ?? '';
            $address = $_POST['address'] ?? '';
            
            // Validation
            if (empty($firstName)) {
                throw new Exception('First name is required');
            }
            
            if (empty($lastName)) {
                throw new Exception('Last name is required');
            }
            
            if (empty($email)) {
                throw new Exception('Email is required');
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }
            
            // Check if email already exists
            $existing = DB::queryFirstRow("SELECT id FROM clients WHERE email=%s", $email);
            if ($existing) {
                throw new Exception('A client with this email already exists');
            }
            
            DB::insert('clients', [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'address' => $address,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            $clientId = DB::insertId();
            $client = DB::queryFirstRow("SELECT * FROM clients WHERE id=%i", $clientId);
            
            echo json_encode([
                'success' => true,
                'message' => 'Client added successfully',
                'data' => $client
            ]);
            break;
            
        case 'delete_client':
            $id = $_POST['id'] ?? 0;
            
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('Invalid client ID');
            }
            
            $result = DB::delete('clients', 'id=%i', $id);
            
            if (!$result) {
                throw new Exception('Client not found or could not be deleted');
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Client deleted successfully'
            ]);
            break;
            
        case 'get_client':
            $id = $_GET['id'] ?? 0;
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('Invalid client ID');
            }
            $client = DB::queryFirstRow("SELECT * FROM clients WHERE id=%i", $id);
            if (!$client) {
                throw new Exception('Client not found');
            }
            echo json_encode([
                'success' => true,
                'data' => $client
            ]);
            break;

        case 'update_client':
            $id = $_POST['id'] ?? 0;
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $company = $_POST['company'] ?? '';
            $address = $_POST['address'] ?? '';

            if (empty($id) || !is_numeric($id)) {
                throw new Exception('Invalid client ID');
            }
            if (empty($firstName)) {
                throw new Exception('First name is required');
            }
            if (empty($lastName)) {
                throw new Exception('Last name is required');
            }
            if (empty($email)) {
                throw new Exception('Email is required');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }
            // Check for duplicate email (exclude current client)
            $existing = DB::queryFirstRow("SELECT id FROM clients WHERE email=%s AND id!=%i", $email, $id);
            if ($existing) {
                throw new Exception('A client with this email already exists');
            }
            DB::update('clients', [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'address' => $address
            ], 'id=%i', $id);

            echo json_encode([
                'success' => true,
                'message' => 'Client updated successfully'
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}