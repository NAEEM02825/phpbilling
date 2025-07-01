<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['per_page']) ? max(1, intval($_GET['per_page'])) : 10;
    $offset = ($page - 1) * $perPage;
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $clientId = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

    // Build WHERE clause
    $where = [];

    if (!empty($status)) {
        $where["status"] = $status;
    }

    if ($clientId > 0) {
        $where["client_id"] = $clientId;
    }

    if (!empty($_GET['date_from'])) {
        $where["issue_date >= %s"] = $_GET['date_from'];
    }

    if (!empty($_GET['date_to'])) {
        $where["issue_date <= %s"] = $_GET['date_to'];
    }

    if (!empty($_GET['amount_from'])) {
        $where["total_amount >= %f"] = floatval($_GET['amount_from']);
    }

    if (!empty($_GET['amount_to'])) {
        $where["total_amount <= %f"] = floatval($_GET['amount_to']);
    }

    // Get total count using MeekroDB's count function
    $total = DB::queryFirstField("SELECT COUNT(*) FROM invoices %l", $where);

    // Get paginated invoice data using DB::select with LEFT JOIN
    $invoices = DB::query(
        "SELECT i.*, CONCAT(c.first_name, ' ', c.last_name) AS client_name
         FROM invoices i
         LEFT JOIN clients c ON i.client_id = c.id
         %l
         ORDER BY i.issue_date DESC
         LIMIT $perPage OFFSET $offset",
        $where
    );

    echo json_encode([
        'success' => true,
        'invoices' => $invoices,
        'total' => $total
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}