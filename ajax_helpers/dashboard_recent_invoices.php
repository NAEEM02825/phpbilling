<?php
require_once('../functions.php');
header('Content-Type: application/json');

try {
    if (empty($_SESSION['user_id'])) {
        throw new Exception('Login required', 401);
    }

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

    // Fetch all active invoices (without deleted_at check)
    $invoices = DB::query(
        "SELECT 
            i.id,
            i.client_id,
            CONCAT(c.first_name, ' ', c.last_name) as client_name,
            i.project_id,
            p.name as project_name,
            i.invoice_number,
            i.issue_date,
            i.due_date,
            i.status,
            i.total_amount,
            i.notes,
            i.created_at
        FROM invoices i
        LEFT JOIN clients c ON i.client_id = c.id
        LEFT JOIN projects p ON i.project_id = p.id
        ORDER BY i.due_date DESC
        LIMIT %i",
        $limit
    );

    echo json_encode([
        'success' => true,
        'invoices' => $invoices
    ]);

} catch (Exception $e) {
    $code = $e->getCode();
    http_response_code(is_numeric($code) && $code >= 400 && $code < 600 ? $code : 500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}