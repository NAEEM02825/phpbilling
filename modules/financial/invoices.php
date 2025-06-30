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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }

    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                // Fetch clients from server
                fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
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
                    })
                    .catch(error => {
                        console.error('Error loading clients:', error);
                    });
            },

            loadProjectsForClient: function(clientId) {
                if (!clientId) {
                    document.getElementById('invoiceProject').disabled = true;
                    document.getElementById('invoiceProject').innerHTML = '<option value="">Select Project</option>';
                    document.getElementById('tasksTableBody').innerHTML = '';
                    return;
                }

                // Fetch projects for selected client
                fetch(`ajax_helpers/getProjects.php?client_id=${clientId}`)
                    .then(response => response.json())
                    .then(projects => {
                        const projectSelect = document.getElementById('invoiceProject');
                        projectSelect.innerHTML = '<option value="">Select Project</option>';
                        projectSelect.disabled = false;

                        projects.forEach(project => {
                            const option = document.createElement('option');
                            option.value = project.id;
                            option.textContent = project.name;
                            projectSelect.appendChild(option);
                        });

                        // Clear tasks table when changing project
                        projectSelect.addEventListener('change', (e) => {
                            if (e.target.value) {
                                this.loadTasksForProject(clientId, e.target.value);
                            } else {
                                document.getElementById('tasksTableBody').innerHTML = '';
                                document.getElementById('invoiceTotal').textContent = '0.00';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error loading projects:', error);
                    });
            },

            loadTasksForProject: function(clientId, projectId) {
                // Calculate date range (last 15 days)
                const endDate = new Date();
                const startDate = new Date();
                startDate.setDate(endDate.getDate() - 15);

                // Format dates for API
                const formatDate = (date) => date.toISOString().split('T')[0];

                // Show loading state
                const tbody = document.getElementById('tasksTableBody');
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Loading tasks...</td></tr>';

                // Fetch tasks for selected project within last 15 days
                fetch(`ajax_helpers/getTasks.php?project_id=${projectId}&start_date=${formatDate(startDate)}&end_date=${formatDate(endDate)}`)
                    .then(response => {
                        // First check if the response is JSON
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error('Response is not JSON');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            throw new Error(data.error || 'Failed to load tasks');
                        }

                        const tasks = data.data;
                        tbody.innerHTML = '';

                        if (tasks && tasks.length > 0) {
                            tasks.forEach(task => {
                                const row = document.createElement('tr');
                                const amount = (task.hours * task.rate).toFixed(2);

                                row.innerHTML = `
                        <td><input type="checkbox" class="form-check-input task-checkbox" 
                            data-rate="${task.rate}" data-hours="${task.hours}"></td>
                        <td>${task.name || 'No name'}</td>
                        <td>${task.description || 'No description'}</td>
                        <td>${task.hours || 0}</td>
                        <td>$${(task.rate || 0).toFixed(2)}</td>
                        <td>$${amount}</td>
                    `;

                                tbody.appendChild(row);
                            });

                            // Add event listeners to task checkboxes
                            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                                checkbox.addEventListener('change', this.calculateInvoiceTotal.bind(this));
                            });
                        } else {
                            tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            No tasks found for this project in the last 15 days
                        </td>
                    </tr>
                `;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tasks:', error);
                        tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-danger">
                        Error loading tasks: ${error.message}
                    </td>
                </tr>
            `;
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
                        items: [{
                                description: 'Website Design Services',
                                quantity: 1,
                                unit_price: 2000.00,
                                amount: 2000.00
                            },
                            {
                                description: 'Hosting Setup',
                                quantity: 1,
                                unit_price: 300.00,
                                amount: 300.00
                            },
                            {
                                description: 'SEO Optimization',
                                quantity: 1,
                                unit_price: 150.00,
                                amount: 150.00
                            }
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
                switch (invoice.status) {
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