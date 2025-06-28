<?php
require('../functions.php');

class InvoiceManager {
    
    // Get all invoices with filters
    public function getInvoices($filters = []) {
        $where = [];
        $whereArgs = [];
        
        // Apply filters
        if (!empty($filters['status'])) {
            $where[] = 'i.status = %s';
            $whereArgs[] = $filters['status'];
        }
        
        if (!empty($filters['client_id'])) {
            $where[] = 'i.client_id = %i';
            $whereArgs[] = $filters['client_id'];
        }
        
        if (!empty($filters['date_from'])) {
            $where[] = 'i.issue_date >= %s';
            $whereArgs[] = $filters['date_from'];
        }
        
        if (!empty($filters['date_to'])) {
            $where[] = 'i.issue_date <= %s';
            $whereArgs[] = $filters['date_to'];
        }
        
        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        
        $query = "SELECT i.*, c.name as client_name, p.name as project_name 
                  FROM invoices i
                  LEFT JOIN clients c ON i.client_id = c.id
                  LEFT JOIN projects p ON i.project_id = p.id
                  $whereClause
                  ORDER BY i.issue_date DESC";
        
        return DB::query($query, ...$whereArgs);
    }
    
    // Get invoice by ID with items
    public function getInvoice($invoiceId) {
        // Get invoice header
        $invoice = DB::queryFirstRow(
            "SELECT i.*, c.name as client_name, c.address, c.email, c.phone, 
                    p.name as project_name
             FROM invoices i
             LEFT JOIN clients c ON i.client_id = c.id
             LEFT JOIN projects p ON i.project_id = p.id
             WHERE i.id = %i", 
            $invoiceId
        );
        
        if (!$invoice) return null;
        
        // Get invoice items
        $invoice['items'] = DB::query(
            "SELECT ii.*, t.name as task_name 
             FROM invoice_items ii
             LEFT JOIN tasks t ON ii.task_id = t.id
             WHERE ii.invoice_id = %i",
            $invoiceId
        );
        
        return $invoice;
    }
    
    // Create new invoice from project tasks
    public function createInvoice($projectId, $clientId, $tasks, $issueDate, $dueDate) {
        DB::startTransaction();
        
        try {
            // Generate invoice number
            $invoiceNumber = 'INV-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Calculate total amount
            $totalAmount = 0;
            foreach ($tasks as $task) {
                $totalAmount += $task['quantity'] * $task['unit_price'];
            }
            
            // Insert invoice header
            $invoiceId = DB::insert('invoices', [
                'invoice_number' => $invoiceNumber,
                'project_id' => $projectId,
                'client_id' => $clientId,
                'issue_date' => $issueDate,
                'due_date' => $dueDate,
                'total_amount' => $totalAmount,
                'status' => 'draft'
            ]);
            
            // Insert invoice items
            foreach ($tasks as $task) {
                DB::insert('invoice_items', [
                    'invoice_id' => $invoiceId,
                    'task_id' => $task['task_id'],
                    'description' => $task['description'],
                    'quantity' => $task['quantity'],
                    'unit_price' => $task['unit_price']
                ]);
            }
            
            DB::commit();
            return $invoiceId;
        } catch (MeekroDBException $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    // Update invoice status
    public function updateInvoiceStatus($invoiceId, $status) {
        DB::update('invoices', [
            'status' => $status
        ], 'id = %i', $invoiceId);
        
        return DB::affectedRows() > 0;
    }
    
    // Get clients for dropdown
    public function getClients() {
        return DB::query("SELECT id, name FROM clients ORDER BY name");
    }
    
    // Get tasks available for invoicing
    public function getBillableTasks($projectId) {
        return DB::query(
            "SELECT t.id as task_id, t.name, t.description, t.rate, 
                    IFNULL(SUM(ii.quantity), 0) as already_invoiced,
                    t.hours - IFNULL(SUM(ii.quantity), 0) as remaining
             FROM tasks t
             LEFT JOIN invoice_items ii ON t.id = ii.task_id
             WHERE t.project_id = %i AND t.status = 'completed'
             GROUP BY t.id
             HAVING remaining > 0",
            $projectId
        );
    }
}
?>