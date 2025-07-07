<?php
require_once('../functions.php'); // Make sure this includes MeekroDB initialization
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$invoiceId = $_POST['invoice_id'] ?? null;
$newStatus = $_POST['new_status'] ?? null;

if (!$invoiceId || !$newStatus) {
    echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
    exit;
}

// Validate status
$allowedStatuses = ['draft', 'pending', 'paid', 'overdue'];
if (!in_array($newStatus, $allowedStatuses)) {
    echo json_encode(['success' => false, 'error' => 'Invalid status']);
    exit;
}

try {
    // Using MeekroDB to update the invoice status
    DB::update('invoices', [
        'status' => $newStatus
    ], "id=%i", $invoiceId);
    
    echo json_encode(['success' => true]);
} catch (MeekroDBException $e) {
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}