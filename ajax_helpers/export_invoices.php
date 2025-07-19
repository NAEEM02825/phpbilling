<?php
require('../functions.php');

// Check if it's an export request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    // Handle export request
    handleExportRequest();
    exit;
}

// Otherwise, handle the normal JSON API request
handleJsonRequest();

function handleJsonRequest() {
    header('Content-Type: application/json');

    try {
        // Pagination parameters
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = isset($_GET['per_page']) ? max(1, intval($_GET['per_page'])) : 10;
        $offset = ($page - 1) * $perPage;
        
        // Filter parameters
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $clientId = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;
        $projectId = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        // Date range filters
        $dateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : '';
        $dateTo = isset($_GET['date_to']) ? $_GET['date_to'] : '';
        
        // Amount range filters
        $amountFrom = isset($_GET['amount_from']) ? floatval($_GET['amount_from']) : null;
        $amountTo = isset($_GET['amount_to']) ? floatval($_GET['amount_to']) : null;

        // Build WHERE clause
        $where = [];
        $whereValues = [];

        if (!empty($status)) {
            $where[] = "i.status = %s";
            $whereValues[] = $status;
        }

        if ($clientId > 0) {
            $where[] = "i.client_id = %i";
            $whereValues[] = $clientId;
        }

        if ($projectId > 0) {
            $where[] = "i.project_id = %i";
            $whereValues[] = $projectId;
        }

        if (!empty($dateFrom)) {
            $where[] = "i.issue_date >= %s";
            $whereValues[] = $dateFrom;
        }

        if (!empty($dateTo)) {
            $where[] = "i.issue_date <= %s";
            $whereValues[] = $dateTo;
        }

        if ($amountFrom !== null) {
            $where[] = "i.total_amount >= %f";
            $whereValues[] = $amountFrom;
        }

        if ($amountTo !== null) {
            $where[] = "i.total_amount <= %f";
            $whereValues[] = $amountTo;
        }

        if (!empty($search)) {
            $where[] = "(i.invoice_number LIKE %ss OR c.first_name LIKE %ss OR c.last_name LIKE %ss OR c.company LIKE %ss OR p.name LIKE %ss)";
            $whereValues[] = $search;
            $whereValues[] = $search;
            $whereValues[] = $search;
            $whereValues[] = $search;
            $whereValues[] = $search;
        }

        // Prepare WHERE clause
        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        // Get total count
        $total = DB::queryFirstField(
            "SELECT COUNT(*) FROM invoices i
             LEFT JOIN clients c ON i.client_id = c.id
             LEFT JOIN projects p ON i.project_id = p.id
             $whereClause",
            ...$whereValues
        );

        // Get paginated invoice data with proper column selection
        $invoices = DB::query(
            "SELECT 
                i.id,
                i.client_id,
                i.project_id,
                i.invoice_number,
                i.issue_date,
                i.due_date,
                i.status,
                i.total_amount,
                i.notes,
                i.created_at,
                i.updated_at,
                CONCAT(c.first_name, ' ', c.last_name) AS client_name,
                c.email AS client_email,
                c.phone AS client_phone,
                c.address AS client_address,
                c.company AS client_company,
                p.name AS project_name,
                p.from_company AS project_from_company,
                p.to_client AS project_to_client,
                p.type AS project_type,
                p.rate AS project_rate,
                p.payment_cycle AS project_payment_cycle,
                p.category AS project_category
             FROM invoices i
             LEFT JOIN clients c ON i.client_id = c.id
             LEFT JOIN projects p ON i.project_id = p.id
             $whereClause
             ORDER BY i.issue_date DESC
             LIMIT %i OFFSET %i",
            ...array_merge($whereValues, [$perPage, $offset])
        );

        // Format response data
        foreach ($invoices as &$invoice) {
            // Format dates
            $invoice['issue_date_formatted'] = date('M d, Y', strtotime($invoice['issue_date']));
            $invoice['due_date_formatted'] = date('M d, Y', strtotime($invoice['due_date']));
            $invoice['created_at_formatted'] = date('M d, Y', strtotime($invoice['created_at']));
            
            // Format amounts
            $invoice['total_amount_formatted'] = number_format($invoice['total_amount'], 2);
            $invoice['project_rate_formatted'] = $invoice['project_rate'] ? number_format($invoice['project_rate'], 2) : null;
            
            // Add client full details
            $invoice['client'] = [
                'id' => $invoice['client_id'],
                'name' => $invoice['client_name'],
                'email' => $invoice['client_email'],
                'phone' => $invoice['client_phone'],
                'address' => $invoice['client_address'],
                'company' => $invoice['client_company']
            ];
            
            // Add project details if exists
            if ($invoice['project_id']) {
                $invoice['project'] = [
                    'id' => $invoice['project_id'],
                    'name' => $invoice['project_name'],
                    'from_company' => $invoice['project_from_company'],
                    'to_client' => $invoice['project_to_client'],
                    'type' => $invoice['project_type'],
                    'rate' => $invoice['project_rate'],
                    'payment_cycle' => $invoice['project_payment_cycle'],
                    'category' => $invoice['project_category']
                ];
            } else {
                $invoice['project'] = null;
            }
            
            // Remove redundant fields
            unset(
                $invoice['client_id'],
                $invoice['client_name'],
                $invoice['client_email'],
                $invoice['client_phone'],
                $invoice['client_address'],
                $invoice['client_company'],
                $invoice['project_id'],
                $invoice['project_name'],
                $invoice['project_from_company'],
                $invoice['project_to_client'],
                $invoice['project_type'],
                $invoice['project_rate'],
                $invoice['project_payment_cycle'],
                $invoice['project_category']
            );
        }

        echo json_encode([
            'success' => true,
            'data' => [
                'invoices' => $invoices,
                'pagination' => [
                    'total' => (int)$total,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($total / $perPage)
                ]
            ]
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}

function handleExportRequest() {
    // Get the export type and filters from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $exportType = $data['exportType'] ?? '';
    $filters = $data['filters'] ?? [];

    // Validate export type
    $allowedTypes = ['pdf', 'csv', 'excel'];
    if (!in_array($exportType, $allowedTypes)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid export type']);
        exit;
    }

    // Build WHERE clause based on filters
    $where = [];
    $whereValues = [];

    if (!empty($filters['status'])) {
        $where[] = "i.status = %s";
        $whereValues[] = $filters['status'];
    }

    if (!empty($filters['client_id'])) {
        $where[] = "i.client_id = %i";
        $whereValues[] = $filters['client_id'];
    }

    if (!empty($filters['project_id'])) {
        $where[] = "i.project_id = %i";
        $whereValues[] = $filters['project_id'];
    }

    if (!empty($filters['date_from'])) {
        $where[] = "i.issue_date >= %s";
        $whereValues[] = $filters['date_from'];
    }

    if (!empty($filters['date_to'])) {
        $where[] = "i.issue_date <= %s";
        $whereValues[] = $filters['date_to'];
    }

    if (isset($filters['amount_from']) && $filters['amount_from'] !== '') {
        $where[] = "i.total_amount >= %f";
        $whereValues[] = $filters['amount_from'];
    }

    if (isset($filters['amount_to']) && $filters['amount_to'] !== '') {
        $where[] = "i.total_amount <= %f";
        $whereValues[] = $filters['amount_to'];
    }

    if (!empty($filters['search'])) {
        $where[] = "(i.invoice_number LIKE %ss OR c.first_name LIKE %ss OR c.last_name LIKE %ss OR c.company LIKE %ss OR p.name LIKE %ss)";
        $whereValues[] = $filters['search'];
        $whereValues[] = $filters['search'];
        $whereValues[] = $filters['search'];
        $whereValues[] = $filters['search'];
        $whereValues[] = $filters['search'];
    }

    // Prepare WHERE clause
    $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    try {
        // Get invoices data for export
$invoices = DB::query(
    "SELECT 
        i.id, 
        i.invoice_number, 
        CONCAT(c.first_name, ' ', c.last_name) AS client_name,
        c.company AS client_company,
        p.name AS project_name,
        p.rate AS project_rate,
        i.issue_date,
        i.due_date,
        i.status,
        i.total_amount AS invoice_amount,
        p.rate AS total_amount
    FROM invoices i
    LEFT JOIN clients c ON i.client_id = c.id
    LEFT JOIN projects p ON i.project_id = p.id
    $whereClause
    ORDER BY i.issue_date DESC",
    ...$whereValues
);
        // Process the export based on type
        switch ($exportType) {
            case 'pdf':
                exportToPDF($invoices);
                break;
            case 'csv':
                exportToCSV($invoices);
                break;
            case 'excel':
                exportToExcel($invoices);
                break;
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
}

function exportToPDF($invoices) {
    // Generate HTML content
    $html = '<!DOCTYPE html>
    <html>
    <head>
        <title>Invoices Export</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            h1 { color: #333; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #f2f2f2; text-align: left; padding: 8px; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            .text-right { text-align: right; }
            .text-center { text-align: center; }
            @media print {
                body { margin: 0; padding: 0; }
                .no-print { display: none; }
            }
        </style>
    </head>
    <body>
        <h1>Invoices List</h1>
        <button class="no-print" onclick="window.print()" style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 20px;">
            Print/Save as PDF
        </button>
        <table>
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Client</th>
                    <th>Company</th>
                    <th>Project</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach ($invoices as $invoice) {
        $html .= '<tr>
            <td>' . htmlspecialchars($invoice['invoice_number']) . '</td>
            <td>' . htmlspecialchars($invoice['client_name']) . '</td>
            <td>' . htmlspecialchars($invoice['client_company'] ?? '') . '</td>
            <td>' . htmlspecialchars($invoice['project_name'] ?? '') . '</td>
            <td class="text-center">' . date('m/d/Y', strtotime($invoice['issue_date'])) . '</td>
            <td class="text-center">' . date('m/d/Y', strtotime($invoice['due_date'])) . '</td>
            <td class="text-center">' . ucfirst($invoice['status']) . '</td>
            <td class="text-right">$' . number_format($invoice['total_amount'], 2) . '</td>
        </tr>';
    }
    
    $html .= '</tbody>
        </table>
        <script>
            window.onload = function() {
                window.print();
                setTimeout(function() {
                    window.close();
                }, 1000);
            };
        </script>
    </body>
    </html>';
    
    // Output the HTML
    header('Content-Type: text/html');
    echo $html;
    exit;
}

function exportToCSV($invoices) {
    // Check if headers are already sent
    if (headers_sent()) {
        throw new RuntimeException("Cannot export CSV: Headers already sent.");
    }

    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="invoices_export_' . date('Y-m-d') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Open output stream
    $output = fopen('php://output', 'w');
    if ($output === false) {
        throw new RuntimeException("Failed to open output stream.");
    }

    // Add UTF-8 BOM (for Excel compatibility)
    fwrite($output, "\xEF\xBB\xBF");

    // Write CSV header
    fputcsv($output, [
        'Invoice Number',
        'Client',
        'Company',
        'Project',
        'Issue Date',
        'Due Date',
        'Status',
        'Amount'
    ]);

    // Write data rows
    foreach ($invoices as $invoice) {
        $row = [
            $invoice['invoice_number'] ?? '',
            $invoice['client_name'] ?? '',
            $invoice['client_company'] ?? '',
            $invoice['project_name'] ?? '',
            isset($invoice['issue_date']) ? date('m/d/Y', strtotime($invoice['issue_date'])) : '',
            isset($invoice['due_date']) ? date('m/d/Y', strtotime($invoice['due_date'])) : '',
            isset($invoice['status']) ? ucfirst($invoice['status']) : '',
            isset($invoice['total_amount']) ? number_format((float) $invoice['total_amount'], 2) : '0.00'
        ];
        
        if (fputcsv($output, $row) === false) {
            throw new RuntimeException("Failed to write CSV data.");
        }
    }

    // Close the output stream
    fclose($output);
    exit;
}

function exportToExcel($invoices) {
    // Generate HTML content that Excel can open
    $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!--[if gte mso 9]>
        <xml>
            <x:ExcelWorkbook>
                <x:ExcelWorksheets>
                    <x:ExcelWorksheet>
                        <x:Name>Invoices</x:Name>
                        <x:WorksheetOptions>
                            <x:DisplayGridlines/>
                        </x:WorksheetOptions>
                    </x:ExcelWorksheet>
                </x:ExcelWorksheets>
            </x:ExcelWorkbook>
        </xml>
        <![endif]-->
        <style>
            .text-right { text-align: right; }
            .text-center { text-align: center; }
            table { border-collapse: collapse; width: 100%; }
            th { background-color: #f2f2f2; font-weight: bold; border: 1px solid #ddd; padding: 5px; }
            td { border: 1px solid #ddd; padding: 5px; }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>Invoice Number</th>
                <th>Client</th>
                <th>Company</th>
                <th>Project</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th class="text-right">Amount</th>
            </tr>';
    
    foreach ($invoices as $invoice) {
        $html .= '<tr>
            <td>' . htmlspecialchars($invoice['invoice_number']) . '</td>
            <td>' . htmlspecialchars($invoice['client_name']) . '</td>
            <td>' . htmlspecialchars($invoice['client_company'] ?? '') . '</td>
            <td>' . htmlspecialchars($invoice['project_name'] ?? '') . '</td>
            <td class="text-center">' . date('m/d/Y', strtotime($invoice['issue_date'])) . '</td>
            <td class="text-center">' . date('m/d/Y', strtotime($invoice['due_date'])) . '</td>
            <td class="text-center">' . ucfirst($invoice['status']) . '</td>
            <td class="text-right">$' . number_format($invoice['total_amount'], 2) . '</td>
        </tr>';
    }
    
    $html .= '</table>
    </body>
    </html>';
    
    // Set headers for Excel download
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="invoices_export_' . date('Y-m-d') . '.xls"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Output the HTML
    echo $html;
    exit;
}