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

    <!-- Other Tab Panes -->
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
                                    <th>Project</th>
                                    <th>Date</th>
                                    <th>Hours</th>
                                    <th>Assignee</th>
                                    <th>Status</th>
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
                // View invoice button click
                document.addEventListener('click', (e) => {
                    if (e.target.closest('.view-invoice-btn')) {
                        const invoiceId = e.target.closest('.view-invoice-btn').getAttribute('data-invoice-id');
                        this.viewInvoice(invoiceId);
                    }
                });

                // Tab switching
                document.querySelectorAll('#invoiceTabs button[data-bs-toggle="tab"]').forEach(tab => {
                    tab.addEventListener('click', (e) => {
                        this.currentTab = e.target.getAttribute('data-bs-target').substring(1);
                        this.currentPage = 1;
                        this.loadInvoices();
                    });
                });

                // Filter form submission
                document.getElementById('invoiceFilterForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.currentPage = 1;
                    this.updateFilters();
                    this.loadInvoices();
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
                fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
                        const clientFilter = document.getElementById('clientFilter');
                        const invoiceClient = document.getElementById('invoiceClient');

                        clients.forEach(client => {
                            const option1 = document.createElement('option');
                            option1.value = client.id;
                            option1.textContent = client.first_name;
                            clientFilter.appendChild(option1);

                            const option2 = document.createElement('option');
                            option2.value = client.id;
                            option2.textContent = client.first_name;
                            invoiceClient.appendChild(option2);
                        });
                    })
                    .catch(error => console.error('Error loading clients:', error));
            },

            loadProjectsForClient: function(clientId) {
                if (!clientId) {
                    document.getElementById('invoiceProject').disabled = true;
                    document.getElementById('invoiceProject').innerHTML = '<option value="">Select Project</option>';
                    document.getElementById('tasksTableBody').innerHTML = '';
                    return;
                }

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

                        projectSelect.addEventListener('change', (e) => {
                            if (e.target.value) {
                                this.loadTasksForProject(clientId, e.target.value);
                            } else {
                                document.getElementById('tasksTableBody').innerHTML = '';
                                document.getElementById('invoiceTotal').textContent = '0.00';
                            }
                        });
                    })
                    .catch(error => console.error('Error loading projects:', error));
            },

            loadTasksForProject: function(clientId, projectId) {
                const endDate = new Date();
                const startDate = new Date();
                startDate.setDate(endDate.getDate() - 15);

                const tbody = document.getElementById('tasksTableBody');
                tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4">Loading tasks...</td></tr>';

                const url = `ajax_helpers/getTasks.php?project_id=${projectId}&start_date=${startDate.toISOString().split('T')[0]}&end_date=${endDate.toISOString().split('T')[0]}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        tbody.innerHTML = '';

                        if (data && data.length > 0) {
                            data.forEach(task => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>
                                        <input type="checkbox" class="form-check-input task-checkbox" 
                                            data-task_id="${task.id}" data-hours="${task.hours || 0}">
                                    </td>
                                    <td>${task.title || ''}</td>
                                    <td>${task.details || ''}</td>
                                    <td>${task.project_name || ''}</td>
                                    <td>${task.task_date || ''}</td>
                                    <td>${task.hours || '0'}</td>
                                    <td>${task.assignee_name || ''}</td>
                                    <td>${task.status || ''}</td>
                                `;
                                tbody.appendChild(row);
                            });

                            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                                checkbox.addEventListener('change', this.calculateInvoiceTotal.bind(this));
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-muted">No tasks found for this project</td></tr>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tasks:', error);
                        tbody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-danger">Error loading tasks: ${error.message}</td></tr>`;
                    });
            },

            loadInvoices: function() {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4">Loading invoices...</td></tr>';

                const params = new URLSearchParams({
                    page: this.currentPage,
                    per_page: this.itemsPerPage,
                    status: this.currentTab === 'all' ? '' : this.currentTab,
                    ...this.filters
                });

                fetch(`ajax_helpers/getInvoices.php?${params.toString()}`)
                    .then(response => response.json())
                    .then(data => {
                        this.totalInvoices = data.total;
                        this.renderInvoices(data.invoices);
                        this.updatePagination();
                    })
                    .catch(error => {
                        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-danger">Error loading invoices</td></tr>';
                    });
            },

            renderInvoices: function(invoices) {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '';

                if (invoices.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-muted">No invoices found</td></tr>';
                    return;
                }

                invoices.forEach(invoice => {
                    const row = document.createElement('tr');
                    const issueDate = new Date(invoice.issue_date).toLocaleDateString();
                    const dueDate = new Date(invoice.due_date).toLocaleDateString();

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

                    row.innerHTML = `
                        <td><div class="form-check"><input class="form-check-input" type="checkbox" value="${invoice.id}"></div></td>
                        <td>${invoice.invoice_number}</td>
                        <td>${invoice.client_name}</td>
                        <td>${issueDate}</td>
                        <td>${dueDate}</td>
                        <td>$${parseFloat(invoice.total_amount).toFixed(2)}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1 view-invoice-btn" title="View" data-invoice-id="${invoice.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-success me-1" title="Edit" onclick="invoiceManager.editInvoice(${invoice.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-info me-1" title="Send" onclick="invoiceManager.sendInvoice(${invoice.id})">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="invoiceManager.deleteInvoice(${invoice.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
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
                prevLi.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.loadInvoices();
                    }
                });
                pagination.appendChild(prevLi);

                // Page numbers
                const maxVisiblePages = 5;
                let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === this.currentPage ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                    li.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.currentPage = i;
                        this.loadInvoices();
                    });
                    pagination.appendChild(li);
                }

                // Next button
                const nextLi = document.createElement('li');
                nextLi.className = `page-item ${this.currentPage === totalPages ? 'disabled' : ''}`;
                nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
                nextLi.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (this.currentPage < totalPages) {
                        this.currentPage++;
                        this.loadInvoices();
                    }
                });
                pagination.appendChild(nextLi);

                // Update showing text
                const startItem = (this.currentPage - 1) * this.itemsPerPage + 1;
                const endItem = Math.min(this.currentPage * this.itemsPerPage, this.totalInvoices);
                document.getElementById('paginationInfo').textContent =
                    `Showing ${startItem} to ${endItem} of ${this.totalInvoices} invoices`;
            },

            calculateInvoiceTotal: function() {
                let total = 0;
                document.querySelectorAll('.task-checkbox:checked').forEach(checkbox => {
                    const hours = parseFloat(checkbox.getAttribute('data-hours')) || 0;
                    total += hours;
                });
                document.getElementById('invoiceTotal').textContent = total.toFixed(2);
            },

            createNewInvoice: function() {
                const form = document.getElementById('newInvoiceForm');
                const selectedTasks = Array.from(document.querySelectorAll('.task-checkbox:checked'))
                    .map(checkbox => checkbox.getAttribute('data-task_id'));

                if (selectedTasks.length === 0) {
                    alert('Please select at least one task');
                    return;
                }

                const formData = {
                    action: 'create_invoice',
                    client_id: form.querySelector('#invoiceClient').value,
                    project_id: form.querySelector('#invoiceProject').value,
                    issue_date: form.querySelector('#invoiceIssueDate').value,
                    due_date: form.querySelector('#invoiceDueDate').value,
                    total_amount: parseFloat(document.getElementById('invoiceTotal').textContent),
                    notes: form.querySelector('#invoiceNotes').value,
                    task_ids: JSON.stringify(selectedTasks)
                };

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
                submitBtn.disabled = true;

                fetch('ajax_helpers/create_New_Invoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            bootstrap.Modal.getInstance(document.getElementById('newInvoiceModal')).hide();
                            this.loadInvoices();
                            alert('Invoice created successfully!');
                        } else {
                            throw new Error(data.error || 'Failed to create invoice');
                        }
                    })
                    .catch(error => alert('Error creating invoice: ' + error.message))
                    .finally(() => {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    });
            },

            viewInvoice: function(invoiceId) {
                fetch(`ajax_helpers/getInvoiceDetails.php?id=${invoiceId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            throw new Error(data.error || 'Failed to load invoice');
                        }
                        this.showInvoiceModal(data.invoice);
                    })
                    .catch(error => {
                        console.error('Error loading invoice:', error);
                        alert('Error loading invoice details: ' + error.message);
                    });
            },

            showInvoiceModal: function(invoice) {
                try {
                    // Validate required fields
                    if (!invoice || !invoice.invoice_number) {
                        throw new Error('Invalid invoice data received');
                    }

                    const modalContent = document.getElementById('invoiceDetailsContent');
                    
                    // Format dates with fallbacks
                    const issueDate = invoice.issue_date 
                        ? new Date(invoice.issue_date).toLocaleDateString() 
                        : 'Not specified';
                        
                    const dueDate = invoice.due_date 
                        ? new Date(invoice.due_date).toLocaleDateString() 
                        : 'Not specified';

                    // Status badge with fallback
                    const status = invoice.status || 'draft';
                    const statusBadges = {
                        paid: 'bg-success',
                        pending: 'bg-primary',
                        overdue: 'bg-danger',
                        draft: 'bg-secondary'
                    };
                    const statusBadge = `<span class="badge ${statusBadges[status]}">${status}</span>`;

                    // Build items table
                    let itemsHtml = '';
                    (invoice.items || []).forEach(item => {
                        // Convert string prices to numbers
                        const unitPrice = parseFloat(item.unit_price) || 0;
                        const amount = parseFloat(item.amount) || 0;
                        
                        itemsHtml += `
                            <tr>
                                <td>${item.task_title || 'No title'}</td>
                                <td class="text-end">${item.quantity || 1}</td>
                                <td class="text-end">$${unitPrice.toFixed(2)}</td>
                                <td class="text-end">$${amount.toFixed(2)}</td>
                            </tr>`;
                    });

                    // Calculate totals
                    const subtotal = parseFloat(invoice.total_amount) || 
                        (invoice.items || []).reduce((sum, item) => sum + (parseFloat(item.amount) || 0), 0);
                    const total = subtotal.toFixed(2);

                    // Build the modal content
                    modalContent.innerHTML = `
                        <div class="invoice-preview">
                            <div class="invoice-header d-flex justify-content-between mb-4">
                                <div>
                                    <h4>Invoice ${invoice.invoice_number}</h4>
                                    <p class="mb-1"><strong>Status:</strong> ${statusBadge}</p>
                                    <p class="mb-1"><strong>Issue Date:</strong> ${issueDate}</p>
                                    <p class="mb-1"><strong>Due Date:</strong> ${dueDate}</p>
                                </div>
                                <div class="text-end">
                                    <h4>${invoice.client_name || 'No client'}</h4>
                                    ${invoice.client_info ? `
                                    <p class="mb-1">${invoice.client_info.address || ''}</p>
                                    <p class="mb-1">Phone: ${invoice.client_info.phone || ''}</p>
                                    <p class="mb-1">Email: ${invoice.client_info.email || ''}</p>
                                    ` : ''}
                                </div>
                            </div>
                            
                            <div class="invoice-items mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Description</th>
                                            <th class="text-end">Qty</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>${itemsHtml}</tbody>
                                </table>
                            </div>
                            
                            <div class="invoice-totals">
                                <div class="row justify-content-end">
                                    <div class="col-md-4">
                                        <table class="table">
                                            <tr class="table-active">
                                                <td><strong>Total:</strong></td>
                                                <td class="text-end">$${total}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            ${invoice.notes ? `
                            <div class="mt-4 p-3 bg-light rounded">
                                <h5>Notes</h5>
                                <p class="mb-0">${invoice.notes}</p>
                            </div>
                            ` : ''}
                        </div>
                    `;

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('viewInvoiceModal'));
                    modal.show();

                } catch (error) {
                    console.error('Error displaying invoice:', error);
                    document.getElementById('invoiceDetailsContent').innerHTML = `
                        <div class="alert alert-danger">
                            <h4>Error Displaying Invoice</h4>
                            <p>${error.message}</p>
                            <button class="btn btn-sm btn-secondary" onclick="window.location.reload()">
                                Reload Page
                            </button>
                        </div>
                    `;
                    new bootstrap.Modal(document.getElementById('viewInvoiceModal')).show();
                }
            },

            editInvoice: function(invoiceId) {
                alert(`Edit invoice ${invoiceId} - This would open an edit form`);
            },

            sendInvoice: function(invoiceId) {
                if (confirm(`Are you sure you want to send invoice #${invoiceId} to the client?`)) {
                    fetch(`ajax_helpers/sendInvoice.php?id=${invoiceId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Invoice sent successfully');
                                this.loadInvoices();
                            } else {
                                throw new Error(data.error || 'Failed to send invoice');
                            }
                        })
                        .catch(error => alert('Error sending invoice: ' + error.message));
                }
            },

            deleteInvoice: function(invoiceId) {
                if (confirm('Are you sure you want to delete this invoice?')) {
                    fetch(`ajax_helpers/deleteInvoice.php?id=${invoiceId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Invoice deleted successfully');
                                this.loadInvoices();
                            } else {
                                throw new Error(data.error || 'Failed to delete invoice');
                            }
                        })
                        .catch(error => alert('Error deleting invoice: ' + error.message));
                }
            }
        };

        invoiceManager.init();
        window.invoiceManager = invoiceManager;
    });
</script>