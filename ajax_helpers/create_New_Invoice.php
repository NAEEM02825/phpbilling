<?php
require('../functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_invoice') {
    try {
        DB::startTransaction();
        
        // First validate all required fields
        if (empty($_POST['client_id']) || empty($_POST['project_id']) || empty($_POST['task_ids'])) {
            throw new Exception("Missing required fields");
        }

        // Insert invoice and verify it was created
        $invoiceId = DB::insert('invoices', [
            'client_id' => $_POST['client_id'],
            'project_id' => $_POST['project_id'],
            'invoice_number' => generateInvoiceNumber(),
            'issue_date' => $_POST['issue_date'],
            'due_date' => $_POST['due_date'],
            'status' => 'pending',
            'total_amount' => $_POST['total_amount'],
            'notes' => $_POST['notes'],
            'created_at' => DB::sqleval('NOW()')
        ]);
        
        if (!$invoiceId) {
            throw new Exception("Failed to create invoice record");
        }

        // Insert invoice items
        $taskIds = json_decode($_POST['task_ids'], true);
        foreach ($taskIds as $taskId) {
            $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i", $taskId);
            
            if (!$task) {
                throw new Exception("Task with ID $taskId not found");
            }
            
            $unitPrice = $task['hourly_rate'] ?? $task['fixed_price'] ?? 0;
            $quantity = $task['hours'] ?? 1;
            $amount = $quantity * $unitPrice;
            
            $itemId = DB::insert('invoice_items', [
                'invoice_id' => $invoiceId,
                'task_id' => $taskId,
                'description' => $task['title'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'amount' => $amount
            ]);
            
            if (!$itemId) {
                throw new Exception("Failed to create invoice item for task $taskId");
            }
        }
        
        DB::commit();
        echo json_encode(['success' => true, 'invoice_id' => $invoiceId]);
        exit;
    } catch (Exception $e) {
        DB::rollback();
        error_log("Invoice creation error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Error creating invoice: ' . $e->getMessage()]);
        exit;
    }
}

function generateInvoiceNumber() {
    $lastInvoice = DB::queryFirstRow("SELECT invoice_number FROM invoices ORDER BY id DESC LIMIT 1");
    $lastNumber = $lastInvoice ? intval(preg_replace('/[^0-9]/', '', $lastInvoice['invoice_number'])) : 0;
    return 'INV-' . date('Y') . '-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
}
?>