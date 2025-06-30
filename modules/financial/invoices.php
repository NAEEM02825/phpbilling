<?php
$projects = DB::query("SELECT * FROM projects ");

?>
<!-- Invoices Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Invoice Management</h1>
        <p class="mb-0 text-muted">View and manage all your invoices</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                <i class="fas fa-plus me-1"></i> New Invoice
            </button>
            <button type="button" class="btn btn-outline-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown">
                <i class="fas fa-download me-1"></i> Export
            </button>
            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i> Excel</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> PDF</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i> CSV</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Invoice Status Tabs -->
<ul class="nav nav-tabs mb-4" id="invoiceTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
            <i class="fas fa-list me-1"></i> All Invoices
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" type="button" role="tab">
            <i class="fas fa-check-circle me-1"></i> Paid
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
            <i class="fas fa-hourglass-half me-1"></i> Pending
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="overdue-tab" data-bs-toggle="tab" data-bs-target="#overdue" type="button" role="tab">
            <i class="fas fa-exclamation-circle me-1"></i> Overdue
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab">
            <i class="fas fa-file-alt me-1"></i> Drafts
        </button>
    </li>
</ul>

<!-- Invoice Filters -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form class="row g-3" id="invoiceFilterForm">
            <div class="col-md-3">
                <label for="clientFilter" class="form-label">Client</label>
                <select class="form-select" id="clientFilter">
                    <option value="" selected>All Clients</option>
                    <!-- Will be populated dynamically -->
                </select>
            </div>
            <div class="col-md-2">
                <label for="dateFrom" class="form-label">From</label>
                <input type="date" class="form-control" id="dateFrom">
            </div>
            <div class="col-md-2">
                <label for="dateTo" class="form-label">To</label>
                <input type="date" class="form-control" id="dateTo">
            </div>
            <div class="col-md-2">
                <label for="amountFrom" class="form-label">Amount From</label>
                <input type="number" class="form-control" id="amountFrom" placeholder="$0.00" min="0">
            </div>
            <div class="col-md-2">
                <label for="amountTo" class="form-label">Amount To</label>
                <input type="number" class="form-control" id="amountTo" placeholder="$10,000.00" min="0">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Apply</button>
            </div>
        </form>
    </div>
</div>

<!-- Invoice Content -->
<div class="tab-content" id="invoiceTabsContent">
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        <!-- Invoice List -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllInvoices">
                                    </div>
                                </th>
                                <th>Invoice #</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="invoicesTableBody">
                            <!-- Will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-muted" id="paginationInfo">Loading invoices...</p>
                    </div>
                    <nav>
                        <ul class="pagination mb-0" id="paginationControls">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Other Tab Panes (empty as they'll use the same table with filtered data) -->
    <div class="tab-pane fade" id="paid" role="tabpanel"></div>
    <div class="tab-pane fade" id="pending" role="tabpanel"></div>
    <div class="tab-pane fade" id="overdue" role="tabpanel"></div>
    <div class="tab-pane fade" id="draft" role="tabpanel"></div>
</div>

<!-- New Invoice Modal -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newInvoiceForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <select class="form-select" id="invoiceClient" required>
                                <option value="">Select Client</option>
                                <!-- Will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Project</label>
                            <select class="form-select" id="invoiceProject" required disabled>
                                <option value="">Select Project</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="invoiceIssueDate" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="invoiceDueDate" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" id="invoiceNotes" rows="2"></textarea>
                    </div>
                    
                    <h6 class="mb-3">Select Tasks to Invoice</h6>
                    <div class="table-responsive">
                        <table class="table" id="tasksTable">
                            <thead>
                                <tr>
                                    <th width="40"><input type="checkbox" id="selectAllTasks"></th>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Hours/Qty</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="tasksTableBody">
                                <!-- Will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="fw-bold">Total: $<span id="invoiceTotal">0.00</span></div>
                        <button type="submit" class="btn btn-primary">Create Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Invoice Modal -->
<div class="modal fade" id="viewInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="invoiceDetailsContent">
                <!-- Will be populated dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printInvoiceBtn">Print</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Invoice Page Specific Styles */
    .nav-tabs {
        border-bottom: 1px solid #e9ecef;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        border-bottom: 3px solid transparent;
    }
    
    .nav-tabs .nav-link:hover {
        color: #3a4f8a;
        border-bottom-color: #dee2e6;
    }
    
    .nav-tabs .nav-link.active {
        color: #3a4f8a;
        background-color: transparent;
        border-bottom-color: #3a4f8a;
    }
    
    /* Table Styles */
    .table th {
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Badge Styles */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    
    /* Pagination Styles */
    .page-item.active .page-link {
        background-color: #3a4f8a;
        border-color: #3a4f8a;
    }
    
    .page-link {
        color: #3a4f8a;
    }
    
    /* Dropdown Menu Styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }
    
    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    .card-footer {
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    /* Amount Column Styles */
    td:nth-child(6) {
        font-weight: 600;
        color: #3a4f8a;
    }
    
    /* Invoice Preview Styles */
    .invoice-preview {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    
    .invoice-items {
        margin: 2rem 0;
    }
    
    .invoice-totals {
        border-top: 1px solid #eee;
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .invoice-status {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: bold;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const invoiceManager = {
        currentTab: 'all',
        currentPage: 1,
        itemsPerPage: 10,
        totalInvoices: 0,
        filters: {},
        selectedClientId: null,
        
        init: function() {
            this.bindEvents();
            this.loadClients();
            this.loadInvoices();
        },
        
        bindEvents: function() {
            // Tab switching
            document.querySelectorAll('#invoiceTabs button[data-bs-toggle="tab"]').forEach(tab => {
                tab.addEventListener('click', (e) => {
                    this.currentTab = e.target.getAttribute('data-bs-target').substring(1);
                    this.currentPage = 1;
                    this.loadInvoices();
                });
            });
            
            // Select all checkbox
            document.getElementById('selectAllInvoices').addEventListener('change', function() {
                document.querySelectorAll('#invoicesTableBody .form-check-input').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
            
            // Filter form submission
            document.getElementById('invoiceFilterForm').addEventListener('submit', (e) => {
                e.preventDefault();
                this.currentPage = 1;
                this.updateFilters();
                this.loadInvoices();
            });
            
            // Pagination controls
            document.getElementById('paginationControls').addEventListener('click', (e) => {
                if (e.target.classList.contains('page-link')) {
                    e.preventDefault();
                    
                    if (e.target.textContent === 'Previous') {
                        if (this.currentPage > 1) {
                            this.currentPage--;
                            this.loadInvoices();
                        }
                    } else if (e.target.textContent === 'Next') {
                        this.currentPage++;
                        this.loadInvoices();
                    } else if (!isNaN(parseInt(e.target.textContent))) {
                        this.currentPage = parseInt(e.target.textContent);
                        this.loadInvoices();
                    }
                }
            });
            
            // New invoice modal client selection
            document.getElementById('invoiceClient').addEventListener('change', (e) => {
                this.selectedClientId = e.target.value;
                this.loadProjectsForClient(this.selectedClientId);
            });
            
            // Select all tasks checkbox
            document.getElementById('selectAllTasks').addEventListener('change', function() {
                document.querySelectorAll('#tasksTableBody .task-checkbox').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                this.calculateInvoiceTotal();
            }.bind(this));
            
            // New invoice form submission
            document.getElementById('newInvoiceForm').addEventListener('submit', (e) => {
                e.preventDefault();
                this.createNewInvoice();
            });
            
            // Print invoice button
            document.getElementById('printInvoiceBtn').addEventListener('click', () => {
                window.print();
            });
        },
        
        updateFilters: function() {
            const form = document.getElementById('invoiceFilterForm');
            this.filters = {
                client_id: form.querySelector('#clientFilter').value,
                date_from: form.querySelector('#dateFrom').value,
                date_to: form.querySelector('#dateTo').value,
                amount_from: form.querySelector('#amountFrom').value,
                amount_to: form.querySelector('#amountTo').value,
                status: this.currentTab === 'all' ? '' : this.currentTab
            };
        },
        
        loadClients: function() {
            // Simulate API call
            setTimeout(() => {
                // Normally this would come from your backend API
                const clients = [
                    { id: 1, name: 'Acme Corporation' },
                    { id: 2, name: 'Globex Inc.' },
                    { id: 3, name: 'Stark Industries' },
                    { id: 4, name: 'Wayne Enterprises' },
                    { id: 5, name: 'Oscorp Industries' }
                ];
                
                // Populate filter dropdown
                const clientFilter = document.getElementById('clientFilter');
                clients.forEach(client => {
                    const option = document.createElement('option');
                    option.value = client.id;
                    option.textContent = client.name;
                    clientFilter.appendChild(option);
                });
                
                // Populate new invoice modal dropdown
                const invoiceClient = document.getElementById('invoiceClient');
                clients.forEach(client => {
                    const option = document.createElement('option');
                    option.value = client.id;
                    option.textContent = client.name;
                    invoiceClient.appendChild(option);
                });
            }, 500);
        },
        
        loadProjectsForClient: function(clientId) {
            if (!clientId) {
                document.getElementById('invoiceProject').disabled = true;
                return;
            }
            
            // Simulate API call
            setTimeout(() => {
                // Normally this would come from your backend API
                const projects = {
                    1: [
                        { id: 101, name: 'Website Redesign' },
                        { id: 102, name: 'E-commerce Platform' }
                    ],
                    2: [
                        { id: 201, name: 'Mobile App Development' }
                    ],
                    3: [
                        { id: 301, name: 'AI Research Project' },
                        { id: 302, name: 'Robotics Prototype' }
                    ],
                    4: [
                        { id: 401, name: 'Security System Upgrade' }
                    ],
                    5: [
                        { id: 501, name: 'Genetic Research' }
                    ]
                };
                
                const projectSelect = document.getElementById('invoiceProject');
                projectSelect.innerHTML = '<option value="">Select Project</option>';
                projectSelect.disabled = false;
                
                if (projects[clientId]) {
                    projects[clientId].forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.id;
                        option.textContent = project.name;
                        projectSelect.appendChild(option);
                    });
                }
                
                // Load tasks when project is selected
                projectSelect.addEventListener('change', (e) => {
                    if (e.target.value) {
                        this.loadTasksForProject(clientId, e.target.value);
                    } else {
                        document.getElementById('tasksTableBody').innerHTML = '';
                        document.getElementById('invoiceTotal').textContent = '0.00';
                    }
                });
            }, 500);
        },
        
        loadTasksForProject: function(clientId, projectId) {
            // Simulate API call
            setTimeout(() => {
                // Normally this would come from your backend API
                const tasks = {
                    // Projects for client 1
                    101: [
                        { id: 1001, name: 'Design Homepage', description: 'Create new homepage design', hours: 10, rate: 75 },
                        { id: 1002, name: 'Design Product Pages', description: 'Create product page templates', hours: 15, rate: 75 }
                    ],
                    102: [
                        { id: 1003, name: 'Shopping Cart', description: 'Develop shopping cart functionality', hours: 25, rate: 100 },
                        { id: 1004, name: 'Payment Gateway', description: 'Integrate payment processing', hours: 20, rate: 100 }
                    ],
                    // Projects for client 2
                    201: [
                        { id: 2001, name: 'UI Development', description: 'Build user interface components', hours: 40, rate: 90 }
                    ],
                    // Projects for client 3
                    301: [
                        { id: 3001, name: 'Machine Learning Model', description: 'Develop predictive model', hours: 60, rate: 120 }
                    ],
                    302: [
                        { id: 3002, name: 'Prototype Assembly', description: 'Build physical prototype', hours: 80, rate: 110 }
                    ],
                    // Projects for client 4
                    401: [
                        { id: 4001, name: 'System Audit', description: 'Security vulnerability assessment', hours: 30, rate: 150 }
                    ],
                    // Projects for client 5
                    501: [
                        { id: 5001, name: 'DNA Sequencing', description: 'Genetic marker analysis', hours: 50, rate: 200 }
                    ]
                };
                
                const tbody = document.getElementById('tasksTableBody');
                tbody.innerHTML = '';
                
                if (tasks[projectId]) {
                    tasks[projectId].forEach(task => {
                        const row = document.createElement('tr');
                        const amount = (task.hours * task.rate).toFixed(2);
                        
                        row.innerHTML = `
                            <td><input type="checkbox" class="form-check-input task-checkbox" data-rate="${task.rate}" data-hours="${task.hours}"></td>
                            <td>${task.name}</td>
                            <td>${task.description}</td>
                            <td>${task.hours}</td>
                            <td>$${task.rate.toFixed(2)}</td>
                            <td>$${amount}</td>
                        `;
                        
                        tbody.appendChild(row);
                    });
                    
                    // Add event listeners to task checkboxes
                    document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                        checkbox.addEventListener('change', this.calculateInvoiceTotal.bind(this));
                    });
                }
            }, 500);
        },
        
        calculateInvoiceTotal: function() {
            let total = 0;
            
            document.querySelectorAll('#tasksTableBody .task-checkbox:checked').forEach(checkbox => {
                const hours = parseFloat(checkbox.getAttribute('data-hours'));
                const rate = parseFloat(checkbox.getAttribute('data-rate'));
                total += hours * rate;
            });
            
            document.getElementById('invoiceTotal').textContent = total.toFixed(2);
        },
        
        createNewInvoice: function() {
            const form = document.getElementById('newInvoiceForm');
            const clientId = form.querySelector('#invoiceClient').value;
            const projectId = form.querySelector('#invoiceProject').value;
            const issueDate = form.querySelector('#invoiceIssueDate').value;
            const dueDate = form.querySelector('#invoiceDueDate').value;
            const notes = form.querySelector('#invoiceNotes').value;
            
            // Get selected tasks
            const selectedTasks = [];
            document.querySelectorAll('#tasksTableBody .task-checkbox:checked').forEach(checkbox => {
                const row = checkbox.closest('tr');
                selectedTasks.push({
                    name: row.cells[1].textContent,
                    description: row.cells[2].textContent,
                    hours: parseFloat(checkbox.getAttribute('data-hours')),
                    rate: parseFloat(checkbox.getAttribute('data-rate'))
                });
            });
            
            if (selectedTasks.length === 0) {
                alert('Please select at least one task to invoice');
                return;
            }
            
            // Calculate total amount
            const totalAmount = selectedTasks.reduce((sum, task) => sum + (task.hours * task.rate), 0);
            
            // Simulate API call to create invoice
            setTimeout(() => {
                // Normally this would be a POST to your backend
                console.log('Creating new invoice:', {
                    clientId,
                    projectId,
                    issueDate,
                    dueDate,
                    notes,
                    tasks: selectedTasks,
                    totalAmount
                });
                
                // Close modal and show success message
                bootstrap.Modal.getInstance(document.getElementById('newInvoiceModal')).hide();
                alert('Invoice created successfully!');
                
                // Refresh invoices list
                this.loadInvoices();
                
                // Reset form
                form.reset();
                document.getElementById('tasksTableBody').innerHTML = '';
                document.getElementById('invoiceTotal').textContent = '0.00';
                document.getElementById('invoiceProject').disabled = true;
            }, 1000);
        },
        
        loadInvoices: function() {
            // Show loading state
            document.getElementById('invoicesTableBody').innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading invoices...</p>
                    </td>
                </tr>
            `;
            
            // Simulate API call
            setTimeout(() => {
                // Normally this would come from your backend API
                const allInvoices = [
                    {
                        id: 1,
                        invoice_number: 'INV-2023-001',
                        client_name: 'Acme Corporation',
                        issue_date: '2023-06-15',
                        due_date: '2023-07-15',
                        total_amount: 2450.00,
                        status: 'paid'
                    },
                    {
                        id: 2,
                        invoice_number: 'INV-2023-002',
                        client_name: 'Globex Inc.',
                        issue_date: '2023-06-18',
                        due_date: '2023-07-18',
                        total_amount: 3750.00,
                        status: 'pending'
                    },
                    {
                        id: 3,
                        invoice_number: 'INV-2023-003',
                        client_name: 'Stark Industries',
                        issue_date: '2023-06-20',
                        due_date: '2023-07-20',
                        total_amount: 5200.00,
                        status: 'pending'
                    },
                    {
                        id: 4,
                        invoice_number: 'INV-2023-004',
                        client_name: 'Wayne Enterprises',
                        issue_date: '2023-05-28',
                        due_date: '2023-06-28',
                        total_amount: 1850.00,
                        status: 'overdue'
                    },
                    {
                        id: 5,
                        invoice_number: 'INV-2023-005',
                        client_name: 'Oscorp Industries',
                        issue_date: '2023-06-25',
                        due_date: '2023-07-25',
                        total_amount: 3150.00,
                        status: 'draft'
                    },
                    {
                        id: 6,
                        invoice_number: 'INV-2023-006',
                        client_name: 'Acme Corporation',
                        issue_date: '2023-06-10',
                        due_date: '2023-07-10',
                        total_amount: 4200.00,
                        status: 'paid'
                    },
                    {
                        id: 7,
                        invoice_number: 'INV-2023-007',
                        client_name: 'Stark Industries',
                        issue_date: '2023-06-05',
                        due_date: '2023-07-05',
                        total_amount: 6800.00,
                        status: 'paid'
                    },
                    {
                        id: 8,
                        invoice_number: 'INV-2023-008',
                        client_name: 'Globex Inc.',
                        issue_date: '2023-06-22',
                        due_date: '2023-07-22',
                        total_amount: 2950.00,
                        status: 'pending'
                    },
                    {
                        id: 9,
                        invoice_number: 'INV-2023-009',
                        client_name: 'Wayne Enterprises',
                        issue_date: '2023-06-15',
                        due_date: '2023-07-15',
                        total_amount: 5300.00,
                        status: 'pending'
                    },
                    {
                        id: 10,
                        invoice_number: 'INV-2023-010',
                        client_name: 'Oscorp Industries',
                        issue_date: '2023-06-30',
                        due_date: '2023-07-30',
                        total_amount: 2100.00,
                        status: 'draft'
                    }
                ];
                
                // Apply filters
                let filteredInvoices = [...allInvoices];
                
                if (this.filters.client_id) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        invoice.client_name === document.querySelector(`#clientFilter option[value="${this.filters.client_id}"]`).textContent
                    );
                }
                
                if (this.filters.date_from) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        new Date(invoice.issue_date) >= new Date(this.filters.date_from)
                    );
                }
                
                if (this.filters.date_to) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        new Date(invoice.issue_date) <= new Date(this.filters.date_to)
                    );
                }
                
                if (this.filters.amount_from) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        invoice.total_amount >= parseFloat(this.filters.amount_from)
                    );
                }
                
                if (this.filters.amount_to) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        invoice.total_amount <= parseFloat(this.filters.amount_to)
                    );
                }
                
                if (this.filters.status) {
                    filteredInvoices = filteredInvoices.filter(invoice => 
                        invoice.status === this.filters.status
                    );
                }
                
                this.totalInvoices = filteredInvoices.length;
                
                // Paginate results
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                const endIndex = startIndex + this.itemsPerPage;
                const paginatedInvoices = filteredInvoices.slice(startIndex, endIndex);
                
                // Render invoices
                this.renderInvoices(paginatedInvoices);
                
                // Update pagination controls
                this.updatePagination();
            }, 800);
        },
        
        renderInvoices: function(invoices) {
            const tbody = document.getElementById('invoicesTableBody');
            
            if (invoices.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x mb-3 text-muted"></i>
                            <p class="mb-0">No invoices found matching your criteria</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = '';
            
            invoices.forEach(invoice => {
                const row = document.createElement('tr');
                
                // Status badge
                let statusBadge;
                switch(invoice.status) {
                    case 'paid':
                        statusBadge = '<span class="badge bg-success">Paid</span>';
                        break;
                    case 'pending':
                        statusBadge = '<span class="badge bg-primary">Pending</span>';
                        break;
                    case 'overdue':
                        statusBadge = '<span class="badge bg-danger">Overdue</span>';
                        break;
                    default:
                        statusBadge = '<span class="badge bg-secondary">Draft</span>';
                }
                
                row.innerHTML = `
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" data-id="${invoice.id}">
                        </div>
                    </td>
                    <td>
                        <a href="#" class="text-primary fw-bold view-invoice" data-id="${invoice.id}">${invoice.invoice_number}</a>
                    </td>
                    <td>${invoice.client_name}</td>
                    <td>${new Date(invoice.issue_date).toLocaleDateString()}</td>
                    <td>${new Date(invoice.due_date).toLocaleDateString()}</td>
                    <td>$${invoice.total_amount.toFixed(2)}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item view-invoice" href="#" data-id="${invoice.id}"><i class="fas fa-eye me-2"></i> View</a></li>
                                <li><a class="dropdown-item edit-invoice" href="#" data-id="${invoice.id}"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                <li><a class="dropdown-item download-invoice" href="#"><i class="fas fa-file-pdf me-2"></i> Download PDF</a></li>
                                <li><a class="dropdown-item send-invoice" href="#" data-id="${invoice.id}"><i class="fas fa-envelope me-2"></i> Send to Client</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger delete-invoice" href="#" data-id="${invoice.id}"><i class="fas fa-trash me-2"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                `;
                
                tbody.appendChild(row);
            });
            
            // Add event listeners to action buttons
            document.querySelectorAll('.view-invoice').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.viewInvoice(e.target.closest('[data-id]').getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.edit-invoice').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.editInvoice(e.target.closest('[data-id]').getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.send-invoice').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.sendInvoice(e.target.closest('[data-id]').getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.delete-invoice').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.deleteInvoice(e.target.closest('[data-id]').getAttribute('data-id'));
                });
            });
        },
        
        updatePagination: function() {
            const totalPages = Math.ceil(this.totalInvoices / this.itemsPerPage);
            const pagination = document.getElementById('paginationControls');
            
            pagination.innerHTML = '';
            
            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${this.currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#">Previous</a>`;
            pagination.appendChild(prevLi);
            
            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            if (startPage > 1) {
                const firstLi = document.createElement('li');
                firstLi.className = 'page-item';
                firstLi.innerHTML = `<a class="page-link" href="#">1</a>`;
                pagination.appendChild(firstLi);
                
                if (startPage > 2) {
                    const ellipsisLi = document.createElement('li');
                    ellipsisLi.className = 'page-item disabled';
                    ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
                    pagination.appendChild(ellipsisLi);
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === this.currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pagination.appendChild(li);
            }
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsisLi = document.createElement('li');
                    ellipsisLi.className = 'page-item disabled';
                    ellipsisLi.innerHTML = `<span class="page-link">...</span>`;
                    pagination.appendChild(ellipsisLi);
                }
                
                const lastLi = document.createElement('li');
                lastLi.className = 'page-item';
                lastLi.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
                pagination.appendChild(lastLi);
            }
            
            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${this.currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
            pagination.appendChild(nextLi);
            
            // Update showing text
            const startItem = (this.currentPage - 1) * this.itemsPerPage + 1;
            const endItem = Math.min(this.currentPage * this.itemsPerPage, this.totalInvoices);
            document.getElementById('paginationInfo').textContent = 
                `Showing ${startItem} to ${endItem} of ${this.totalInvoices} invoices`;
        },
        
        viewInvoice: function(invoiceId) {
            // Simulate API call
            setTimeout(() => {
                // Normally this would come from your backend API
                const invoiceDetails = {
                    id: invoiceId,
                    invoice_number: `INV-2023-00${invoiceId}`,
                    client_name: ['Acme Corporation', 'Globex Inc.', 'Stark Industries', 'Wayne Enterprises', 'Oscorp Industries'][invoiceId % 5],
                    issue_date: '2023-06-15',
                    due_date: '2023-07-15',
                    status: ['paid', 'pending', 'overdue', 'draft'][invoiceId % 4],
                    total_amount: [2450.00, 3750.00, 5200.00, 1850.00, 3150.00][invoiceId % 5],
                    notes: 'Thank you for your business. Please make payment by the due date.',
                    items: [
                        { description: 'Website Design Services', quantity: 1, unit_price: 2000.00, amount: 2000.00 },
                        { description: 'Hosting Setup', quantity: 1, unit_price: 300.00, amount: 300.00 },
                        { description: 'SEO Optimization', quantity: 1, unit_price: 150.00, amount: 150.00 }
                    ]
                };
                
                this.showInvoiceModal(invoiceDetails);
            }, 500);
        },
        
        showInvoiceModal: function(invoice) {
            const modalContent = document.getElementById('invoiceDetailsContent');
            
            // Format dates
            const issueDate = new Date(invoice.issue_date).toLocaleDateString();
            const dueDate = new Date(invoice.due_date).toLocaleDateString();
            
            // Status badge
            let statusBadge;
            switch(invoice.status) {
                case 'paid':
                    statusBadge = '<span class="badge bg-success">Paid</span>';
                    break;
                case 'pending':
                    statusBadge = '<span class="badge bg-primary">Pending</span>';
                    break;
                case 'overdue':
                    statusBadge = '<span class="badge bg-danger">Overdue</span>';
                    break;
                default:
                    statusBadge = '<span class="badge bg-secondary">Draft</span>';
            }
            
            // Items table
            let itemsHtml = '';
            invoice.items.forEach(item => {
                itemsHtml += `
                    <tr>
                        <td>${item.description}</td>
                        <td class="text-end">${item.quantity}</td>
                        <td class="text-end">$${item.unit_price.toFixed(2)}</td>
                        <td class="text-end">$${item.amount.toFixed(2)}</td>
                    </tr>
                `;
            });
            
            // Total row
            const subtotal = invoice.items.reduce((sum, item) => sum + item.amount, 0);
            const tax = subtotal * 0.1; // 10% tax for example
            const total = subtotal + tax;
            
            modalContent.innerHTML = `
                <div class="invoice-preview">
                    <div class="invoice-header">
                        <div>
                            <h4>Invoice ${invoice.invoice_number}</h4>
                            <p class="mb-1"><strong>Status:</strong> ${statusBadge}</p>
                            <p class="mb-1"><strong>Issue Date:</strong> ${issueDate}</p>
                            <p class="mb-1"><strong>Due Date:</strong> ${dueDate}</p>
                        </div>
                        <div class="text-end">
                            <h4>${invoice.client_name}</h4>
                            <p class="mb-1">123 Business Street</p>
                            <p class="mb-1">City, State 10001</p>
                            <p class="mb-1">client@example.com</p>
                        </div>
                    </div>
                    
                    <div class="invoice-items">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${itemsHtml}
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="invoice-totals text-end">
                        <div class="row justify-content-end">
                            <div class="col-4">
                                <table class="table">
                                    <tr>
                                        <td><strong>Subtotal:</strong></td>
                                        <td class="text-end">$${subtotal.toFixed(2)}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tax (10%):</strong></td>
                                        <td class="text-end">$${tax.toFixed(2)}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td class="text-end">$${total.toFixed(2)}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Notes</h5>
                        <p>${invoice.notes}</p>
                    </div>
                </div>
            `;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('viewInvoiceModal'));
            modal.show();
        },
        
        editInvoice: function(invoiceId) {
            alert(`Edit invoice ${invoiceId} - This would open an edit form in a real application`);
        },
        
        sendInvoice: function(invoiceId) {
            alert(`Send invoice ${invoiceId} to client - This would trigger an email in a real application`);
        },
        
        deleteInvoice: function(invoiceId) {
            if (confirm('Are you sure you want to delete this invoice?')) {
                // Simulate API call
                setTimeout(() => {
                    alert(`Invoice ${invoiceId} deleted successfully`);
                    this.loadInvoices();
                }, 500);
            }
        }
    };
    
    invoiceManager.init();
});
</script>