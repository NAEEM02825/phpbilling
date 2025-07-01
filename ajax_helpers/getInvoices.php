<?php
require('../functions.php');
header('Content-Type: application/json');

try {
    // Get parameters

    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $clientId = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

    // Build WHERE clause
    $where = [];
    $whereArgs = [];

    if (!empty($status)) {
        $where[] = "i.status = %s";
        $whereArgs[] = $status;
    }

    if ($clientId > 0) {
        $where[] = "i.client_id = %d";
        $whereArgs[] = $clientId;
    }

    if (!empty($_GET['date_from'])) {
        $where[] = "i.issue_date >= %s";
        $whereArgs[] = $_GET['date_from'];
    }

    if (!empty($_GET['date_to'])) {
        $where[] = "i.issue_date <= %s";
        $whereArgs[] = $_GET['date_to'];
    }

    if (!empty($_GET['amount_from'])) {
        $where[] = "i.total_amount >= %f";
        $whereArgs[] = floatval($_GET['amount_from']);
    }

    if (!empty($_GET['amount_to'])) {
        $where[] = "i.total_amount <= %f";
        $whereArgs[] = floatval($_GET['amount_to']);
    }

    // Build the WHERE clause string
    $whereClause = '';
    if (!empty($where)) {
        $whereClause = 'WHERE ' . implode(' AND ', $where);
    }

    // Get total count
    $totalQuery = "SELECT COUNT(*) FROM invoices i $whereClause";
    $total = DB::queryFirstField($totalQuery, ...$whereArgs);

    // Get paginated data
    $query = "SELECT i.*, c.name AS client_name
              FROM invoices i
              LEFT JOIN clients c ON i.client_id = c.id
              $whereClause
              ORDER BY i.issue_date DESC
              LIMIT %d OFFSET %d";
              
    // Combine all arguments
    $args = array_merge($whereArgs, [$perPage, $offset]);
    
    $invoices = DB::query($query, ...$args);

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