<?php
require('../functions.php');

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'Invoice ID is required']);
    exit;
}

$invoiceId = intval($_GET['id']);

try {
    // Check if invoice exists
    $invoice = DB::queryFirstRow("SELECT id FROM invoices WHERE id = %i", $invoiceId);
    
    if (!$invoice) {
        echo json_encode(['success' => false, 'error' => 'Invoice not found']);
        exit;
    }
    
    // Delete invoice (use transaction if there are related records)
    DB::startTransaction();
    
    // First delete invoice items if they exist in a separate table
    DB::delete('invoice_items', 'invoice_id = %i', $invoiceId);
    
    // Then delete the invoice
    DB::delete('invoices', 'id = %i', $invoiceId);
    
    DB::commit();
    
    echo json_encode(['success' => true]);
} catch (MeekroDBException $e) {
    DB::rollback();
    error_log("Error deleting invoice: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error occurred']);
}
?>