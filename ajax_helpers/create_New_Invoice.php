<?php
require('../functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_invoice') {
    try {
        DB::startTransaction();
        
        // First validate all required fields
        $requiredFields = ['client_id', 'project_id', 'task_ids'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // Get project details to check if it has a rate
        $project = DB::queryFirstRow("SELECT * FROM projects WHERE id = %i", $_POST['project_id']);
        if (!$project) {
            throw new Exception("Project not found");
        }

        // Calculate total amount from tasks
        $taskIds = json_decode($_POST['task_ids'], true);
        $totalAmount = 0;
        
        // First pass to calculate total amount
        foreach ($taskIds as $taskId) {
            $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i", $taskId);
            
            if (!$task) {
                throw new Exception("Task with ID $taskId not found");
            }
            
            // Use project rate if available, otherwise fall back to task rate
            $unitPrice = $project['hourly_rate'] ?? $task['hourly_rate'] ?? $task['fixed_price'] ?? 0;
            $quantity = $task['hours'] ?? 1;
            $totalAmount += $quantity * $unitPrice;
        }

        // Insert invoice and get the correct invoice ID
        DB::insert('invoices', [
            'client_id' => $_POST['client_id'],
            'project_id' => $_POST['project_id'],
            'invoice_number' => generateInvoiceNumber(),
            'issue_date' => date('Y-m-d'), // Current date as issue date
            'due_date' => date('Y-m-d', strtotime('+30 days')), // 30 days from now as due date
            'status' => 'pending',
            'total_amount' => $totalAmount,
            'notes' => $_POST['notes'] ?? '',
            'created_at' => DB::sqleval('NOW()')
        ]);
        $invoiceId = DB::insertId();
        
        if (!$invoiceId) {
            throw new Exception("Failed to create invoice record");
        }

        // Second pass to insert invoice items
        foreach ($taskIds as $taskId) {
            $task = DB::queryFirstRow("SELECT * FROM tasks WHERE id = %i", $taskId);
            
            // Use project rate if available, otherwise fall back to task rate
            $unitPrice = $project['hourly_rate'] ?? $task['hourly_rate'] ?? $task['fixed_price'] ?? 0;
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