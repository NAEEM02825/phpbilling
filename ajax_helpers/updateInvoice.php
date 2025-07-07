<?php
require('../functions.php'); // Make sure this includes MeekroDB initialization
header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'error' => ''];

try {
    // Check if request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Get the raw POST data
    $input = file_get_contents('php://input');
    parse_str($input, $data);

    // Validate required fields
    $requiredFields = ['action', 'id', 'client_id', 'project_id', 'issue_date', 'due_date'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            throw new Exception("Missing required field: $field");
        }
    }

    // Verify action
    if ($data['action'] !== 'update_invoice') {
        throw new Exception('Invalid action');
    }

    // Sanitize input
    $invoiceId = intval($data['id']);
    $clientId = intval($data['client_id']);
    $projectId = intval($data['project_id']);
    $issueDate = trim($data['issue_date']);
    $dueDate = trim($data['due_date']);
    $notes = isset($data['notes']) ? trim($data['notes']) : null;

    // Validate dates
    if (!strtotime($issueDate) || !strtotime($dueDate)) {
        throw new Exception('Invalid date format');
    }

    // Format dates for database
    $issueDate = date('Y-m-d', strtotime($issueDate));
    $dueDate = date('Y-m-d', strtotime($dueDate));

    // Check if invoice exists
    $invoiceExists = DB::queryFirstField("SELECT COUNT(*) FROM invoices WHERE id = %i", $invoiceId);
    if (!$invoiceExists) {
        throw new Exception('Invoice not found');
    }

    // Update invoice in database using MeekroDB
    DB::update('invoices', [
        'client_id' => $clientId,
        'project_id' => $projectId,
        'issue_date' => $issueDate,
        'due_date' => $dueDate,
        'notes' => $notes,
        'updated_at' => DB::sqleval('NOW()')
    ], 'id = %i', $invoiceId);

    $response['success'] = true;
    
} catch (MeekroDBException $e) {
    $response['error'] = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>