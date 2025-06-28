<?php
require_once '../invoice_functions.php';
header('Content-Type: application/json');


$invoiceManager = new InvoiceManager();
$response = ['success' => false];

try {
    $action = $_POST['action'] ?? ($_GET['action'] ?? '');
    
    switch ($action) {
        case 'get_invoices':
            $filters = json_decode($_POST['filters'] ?? '[]', true);
            $page = intval($_POST['page'] ?? 1);
            $perPage = intval($_POST['per_page'] ?? 10);
            
            // Get total count first for pagination
            $total = DB::queryFirstField(
                "SELECT COUNT(*) FROM invoices i WHERE 1=1" . 
                $this->buildWhereClause($filters)
            );
            
            // Get paginated results
            $invoices = DB::query(
                "SELECT i.*, c.name as client_name, p.name as project_name 
                 FROM invoices i
                 LEFT JOIN clients c ON i.client_id = c.id
                 LEFT JOIN projects p ON i.project_id = p.id
                 " . $this->buildWhereClause($filters) . "
                 ORDER BY i.issue_date DESC
                 LIMIT %i OFFSET %i",
                $perPage,
                ($page - 1) * $perPage
            );
            
            $response = [
                'success' => true,
                'invoices' => $invoices,
                'total' => $total,
                'page' => $page,
                'per_page' => $perPage
            ];
            break;
            
        case 'get_invoice':
            $invoiceId = intval($_POST['id'] ?? $_GET['id'] ?? 0);
            $invoice = $invoiceManager->getInvoice($invoiceId);
            
            if ($invoice) {
                $response = [
                    'success' => true,
                    'invoice' => $invoice
                ];
            } else {
                $response['message'] = 'Invoice not found';
            }
            break;
            
        case 'get_clients':
            $clients = DB::query("SELECT id, name FROM clients ORDER BY name");
            $response = [
                'success' => true,
                'clients' => $clients
            ];
            break;
            
        case 'download_pdf':
            $invoiceId = intval($_GET['id']);
            $invoice = $invoiceManager->getInvoice($invoiceId);
            
            if ($invoice) {
                // Generate PDF (you'll need a PDF library like TCPDF or Dompdf)
                $response = [
                    'success' => true,
                    'pdf_url' => generatePdf($invoice) // Implement this function
                ];
            } else {
                $response['message'] = 'Invoice not found';
            }
            break;
            
        case 'create_invoice':
            $data = json_decode($_POST['data'], true);
            $invoiceId = $invoiceManager->createInvoice(
                $data['project_id'],
                $data['client_id'],
                $data['tasks'],
                $data['issue_date'],
                $data['due_date']
            );
            $response = [
                'success' => true,
                'invoice_id' => $invoiceId
            ];
            break;
            
        default:
            $response['message'] = 'Invalid action';
    }
} catch (MeekroDBException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    error_log($e->getMessage());
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    error_log($e->getMessage());
}

echo json_encode($response);

// Helper function to build WHERE clause from filters
function buildWhereClause($filters) {
    $where = [];
    $args = [];
    
    if (!empty($filters['status'])) {
        $where[] = "i.status = %s";
        $args[] = $filters['status'];
    }
    
    if (!empty($filters['client_id'])) {
        $where[] = "i.client_id = %i";
        $args[] = $filters['client_id'];
    }
    
    if (!empty($filters['date_from'])) {
        $where[] = "i.issue_date >= %s";
        $args[] = $filters['date_from'];
    }
    
    if (!empty($filters['date_to'])) {
        $where[] = "i.issue_date <= %s";
        $args[] = $filters['date_to'];
    }
    
    return !empty($where) ? " WHERE " . implode(" AND ", $where) : "";
}
?>