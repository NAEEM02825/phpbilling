<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $invoiceId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($invoiceId <= 0) {
        throw new Exception("Invalid invoice ID");
    }

    // Get invoice header data
    $invoice = DB::queryFirstRow("
        SELECT i.*, 
               CONCAT(c.first_name, ' ', c.last_name) AS client_name, 
               c.email AS client_email, 
               c.address AS client_address, 
               c.phone AS client_phone
        FROM invoices i
        LEFT JOIN clients c ON i.client_id = c.id
        WHERE i.id = %d
    ", $invoiceId);

    if (empty($invoice)) {
        throw new Exception("Invoice not found");
    }

    // Get invoice items (fixed query)
    $items = DB::query("
        SELECT it.*, t.title AS task_title
        FROM invoice_items it
        LEFT JOIN tasks t ON it.task_id = t.id
        WHERE it.invoice_id = %d
    ", $invoiceId);

    echo json_encode([
        'success' => true,
        'invoice' => [
            'id' => $invoice['id'],
            'invoice_number' => $invoice['invoice_number'],
            'client_name' => $invoice['client_name'],
            'client_info' => [
                'email' => $invoice['client_email'],
                'address' => $invoice['client_address'],
                'phone' => $invoice['client_phone']
            ],
            'issue_date' => $invoice['issue_date'],
            'due_date' => $invoice['due_date'],
            'status' => $invoice['status'],
            'total_amount' => $invoice['total_amount'],
            'notes' => $invoice['notes'],
            'items' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'task_id' => $item['task_id'],
                    'task_title' => $item['task_title'],
                    'description' => $item['description'] ?? $item['task_title'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount']
                ];
            }, $items)
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}