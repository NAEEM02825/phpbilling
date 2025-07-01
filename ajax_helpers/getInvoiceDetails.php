<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $invoiceId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($invoiceId <= 0) {
        throw new Exception("Invalid invoice ID");
    }

    // Get invoice header data with project information
    $invoice = DB::queryFirstRow("
        SELECT i.*, 
               CONCAT(c.first_name, ' ', c.last_name) AS client_name, 
               c.email AS client_email, 
               c.address AS client_address, 
               c.phone AS client_phone,
               p.name AS project_name,
               p.id AS project_id,
               p.rate AS project_rate
        FROM invoices i
        LEFT JOIN clients c ON i.client_id = c.id
        LEFT JOIN projects p ON i.project_id = p.id
        WHERE i.id = %d
    ", $invoiceId);

    if (empty($invoice)) {
        throw new Exception("Invoice not found");
    }

    // Get invoice items with project information and project rate
    $items = DB::query("
        SELECT it.*, 
               t.title AS task_title,
               t.details AS task_details,
               p.name AS project_name,
               p.id AS project_id,
               IFNULL(p.rate, 0) AS project_rate
        FROM invoice_items it
        LEFT JOIN tasks t ON it.task_id = t.id
        LEFT JOIN projects p ON t.project_id = p.id
        WHERE it.invoice_id = %d
    ", $invoiceId);

    // Calculate total project rate (sum each unique project's rate only once)
    $uniqueProjectRates = [];
    foreach ($items as $item) {
        if (!isset($uniqueProjectRates[$item['project_id']])) {
            $uniqueProjectRates[$item['project_id']] = floatval($item['project_rate']);
        }
    }
    $totalProjectRate = array_sum($uniqueProjectRates);

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
            'project_id' => $invoice['project_id'],
            'project_name' => $invoice['project_name'],
            'project_rate' => $invoice['project_rate'],
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
                    'project_id' => $item['project_id'],
                    'project_name' => $item['project_name'],
                    'rate' => $item['project_rate'], // Add rate for each item
                    'description' => $item['task_details'] ?? $item['task_title'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $item['amount']
                ];
            }, $items),
            'total_project_rate' => $totalProjectRate // Add total
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}