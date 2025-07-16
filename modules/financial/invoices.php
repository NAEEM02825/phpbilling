<?php
$projects = DB::query("SELECT * FROM projects");
?>
<style>
    th {
        background-color: #04665f !important;
        color: white !important;
    }

    .btn-custom {
        background-color: #04665f;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #034b45;
        color: white;
        /* darker shade for hover effect */
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Invoices Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Invoice Management</h1>
        <p class="mb-0 text-muted">View and manage all your invoices</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                <i class="fas fa-plus me-1"></i> New Invoice
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
</ul>

<!-- Invoice Filters -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form class="row g-3" id="invoiceFilterForm">
            <div class="col-md-4">
                <label for="clientFilter" class="form-label">Client</label>
                <select class="form-select" id="clientFilter">
                    <option value="" selected>All Clients</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dateFrom" class="form-label">From</label>
                <input type="date" class="form-control" id="dateFrom">
            </div>
            <div class="col-md-3">
                <label for="dateTo" class="form-label">To</label>
                <input type="date" class="form-control" id="dateTo">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-custom w-100">Apply</button>
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
                                <th>Project</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="invoicesTableBody">
                            <!-- Will be populated dynaically -->
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
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" id="dateFromFilter" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" id="dateToFilter" required>
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
                                    <th>Assignee</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tasksTableBody">
                                <!-- Will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-custom">Create Invoice</button>
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

<!-- Edit Invoice Modal -->
<div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInvoiceForm">
                    <input type="hidden" id="editInvoiceId">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client</label>
                            <select class="form-select" id="editInvoiceClient" required>
                                <option value="">Select Client</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Project</label>
                            <select class="form-select" id="editInvoiceProject" required>
                                <option value="">Select Project</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" id="editDateFromFilter" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" id="editDateToFilter" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" id="editInvoiceNotes" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    /* Ensure dropdown works in table cells */
    .table-responsive {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        z-index: 1000;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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
                // Add these event listeners in your bindEvents() method
                document.getElementById('dateFromFilter').addEventListener('change', function() {
                    if (invoiceManager.selectedClientId && document.getElementById('invoiceProject').value) {
                        const toDate = document.getElementById('dateToFilter').value;
                        if (toDate) {
                            invoiceManager.loadTasksForProject(
                                invoiceManager.selectedClientId,
                                document.getElementById('invoiceProject').value,
                                this.value,
                                toDate
                            );
                        }
                    }
                });

                document.getElementById('dateToFilter').addEventListener('change', function() {
                    if (invoiceManager.selectedClientId && document.getElementById('invoiceProject').value) {
                        const fromDate = document.getElementById('dateFromFilter').value;
                        if (fromDate) {
                            invoiceManager.loadTasksForProject(
                                invoiceManager.selectedClientId,
                                document.getElementById('invoiceProject').value,
                                fromDate,
                                this.value
                            );
                        }
                    }
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
                });

                // New invoice form submission
                document.getElementById('newInvoiceForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.createNewInvoice();
                });

                // Print invoice button
                document.getElementById('printInvoiceBtn').addEventListener('click', function() {
                    const modalContent = document.getElementById('invoiceDetailsContent').innerHTML;
                    const printWindow = window.open('', '', 'width=900,height=700');
                    printWindow.document.write(`
                    <html>
                    <head>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
                        <style>
                            body { background: #fff !important; }
                            .invoice-preview { margin: 40px auto; max-width: 800px; }
                            @media print {
                                body { background: #fff !important; }
                                .invoice-preview { box-shadow: none !important; }
                                @page { margin: 0; }
                                html, body { margin: 0 !important; padding: 0 !important; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="invoice-preview">
                            ${modalContent}
                        </div>
                    </body>
                    </html>
                `);
                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.onload = function() {
                        printWindow.print();
                        printWindow.close();
                    };
                });
            },

            updateFilters: function() {
                const form = document.getElementById('invoiceFilterForm');
                this.filters = {
                    client_id: form.querySelector('#clientFilter').value,
                    date_from: form.querySelector('#dateFrom').value,
                    date_to: form.querySelector('#dateTo').value,
                    status: this.currentTab === 'all' ? '' : this.currentTab
                };
            },

            loadClients: function() {
                fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
                        const clientFilter = document.getElementById('clientFilter');
                        const invoiceClient = document.getElementById('invoiceClient');
                        const editInvoiceClient = document.getElementById('editInvoiceClient');

                        // Clear existing options
                        clientFilter.innerHTML = '<option value="">All Clients</option>';
                        invoiceClient.innerHTML = '<option value="">Select Client</option>';
                        editInvoiceClient.innerHTML = '<option value="">Select Client</option>';

                        clients.forEach(client => {
                            const fullName = `${client.first_name} ${client.last_name}`;

                            // For client filter dropdown
                            const option1 = document.createElement('option');
                            option1.value = client.id;
                            option1.textContent = fullName;
                            clientFilter.appendChild(option1);

                            // For new invoice client dropdown
                            const option2 = document.createElement('option');
                            option2.value = client.id;
                            option2.textContent = fullName;
                            invoiceClient.appendChild(option2);

                            // For edit invoice client dropdown
                            const option3 = document.createElement('option');
                            option3.value = client.id;
                            option3.textContent = fullName;
                            editInvoiceClient.appendChild(option3);
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
                            option.textContent = `${project.name} (Rate: ${project.rate})`;
                            option.dataset.rate = project.rate;
                            projectSelect.appendChild(option);
                        });

                        // In the loadProjectsForClient method, update the project select change handler:
                        projectSelect.addEventListener('change', (e) => {
                            if (e.target.value) {
                                const fromDate = document.getElementById('dateFromFilter').value;
                                const toDate = document.getElementById('dateToFilter').value;

                                if (fromDate && toDate) {
                                    this.loadTasksForProject(clientId, e.target.value, fromDate, toDate);
                                } else {
                                    document.getElementById('tasksTableBody').innerHTML =
                                        '<tr><td colspan="7" class="text-center py-4 text-muted">Please select both From and To dates</td></tr>';
                                }
                            } else {
                                document.getElementById('tasksTableBody').innerHTML = '';
                            }
                        });
                    })
                    .catch(error => console.error('Error loading projects:', error));
            },

            loadTasksForProject: function(clientId, projectId, fromDate, toDate) {
                // Validate dates
                if (!fromDate || !toDate) {
                    document.getElementById('tasksTableBody').innerHTML =
                        '<tr><td colspan="7" class="text-center py-4 text-muted">Please select both From and To dates</td></tr>';
                    return;
                }

                const tbody = document.getElementById('tasksTableBody');
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">Loading tasks...</td></tr>';

                const url = `ajax_helpers/getTasks.php?project_id=${projectId}&start_date=${fromDate}&end_date=${toDate}`;

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
                                data-task_id="${task.id}">
                        </td>
                        <td>${task.title || ''}</td>
                        <td>${task.description || ''}</td>
                        <td>${task.project_name || ''}</td>
                        <td>${task.task_date || ''}</td>
                        <td>${task.assignee_name || ''}</td>
                        <td>${task.status || ''}</td>
                    `;
                                tbody.appendChild(row);
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No tasks found for this project in the selected date range</td></tr>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tasks:', error);
                        tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4 text-danger">Error loading tasks: ${error.message}</td></tr>`;
                    });
            },

            loadInvoices: function() {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4">Loading invoices...</td></tr>';

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
                        tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-danger">Error loading invoices</td></tr>';
                    });
            },

            renderInvoices: function(invoices) {
                const tbody = document.getElementById('invoicesTableBody');
                tbody.innerHTML = '';

                if (invoices.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-muted">No invoices found</td></tr>';
                    return;
                }

                invoices.forEach(invoice => {
                    const row = document.createElement('tr');
                    const dateRange = `${new Date(invoice.date_from).toLocaleDateString()} - ${new Date(invoice.date_to).toLocaleDateString()}`;

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

                    const statusDropdown = `
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'draft')">Draft</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'pending')">Pending</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'paid')">Paid</a></li>
                            <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'overdue')">Overdue</a></li>
                        </ul>
                    </div>
                `;

                    row.innerHTML = `
    <td><div class="form-check"><input class="form-check-input" type="checkbox" value="${invoice.id}"></div></td>
    <td>${invoice.invoice_number}</td>
    <td>${invoice.client_name}</td>
    <td>${invoice.project_name || 'N/A'}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                ${statusBadge} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'draft')">Mark as Draft</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'pending')">Mark as Pending</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'paid')">Mark as Paid</a></li>
                <li><a class="dropdown-item" href="#" onclick="invoiceManager.updateStatus(${invoice.id}, 'overdue')">Mark as Overdue</a></li>
            </ul>
        </div>
    </td>
    <td>
        <button class="btn btn-sm btn-outline-primary me-1 view-invoice-btn" title="View" data-invoice-id="${invoice.id}">
            <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-outline-success me-1" title="Edit" onclick="invoiceManager.editInvoice(${invoice.id})">
            <i class="fas fa-edit"></i>
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

            createNewInvoice: function() {
                const form = document.getElementById('newInvoiceForm');
                const selectedTasks = Array.from(document.querySelectorAll('.task-checkbox:checked'))
                    .map(checkbox => checkbox.getAttribute('data-task_id'));

                if (selectedTasks.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Tasks Selected',
                        text: 'Please select at least one task',
                        confirmButtonColor: '#3085d6',
                    });
                    return;
                }

                const formData = {
                    action: 'create_invoice',
                    client_id: form.querySelector('#invoiceClient').value,
                    project_id: form.querySelector('#invoiceProject').value,
                    date_from: form.querySelector('#dateFromFilter').value,
                    date_to: form.querySelector('#dateToFilter').value,
                    notes: form.querySelector('#invoiceNotes').value,
                    task_ids: JSON.stringify(selectedTasks)
                };

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;

                // Clear any previous error messages
                const errorElements = form.querySelectorAll('.is-invalid, .invalid-feedback');
                errorElements.forEach(el => {
                    el.classList.remove('is-invalid');
                    const errorDiv = el.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.remove();
                    }
                });

                fetch('ajax_helpers/create_New_Invoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            // Handle form validation errors
                            if (data.errors) {
                                Object.entries(data.errors).forEach(([field, message]) => {
                                    const input = form.querySelector(`#${field}`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        const errorDiv = document.createElement('div');
                                        errorDiv.classList.add('invalid-feedback');
                                        errorDiv.textContent = message;
                                        input.parentNode.appendChild(errorDiv);
                                    }
                                });
                                throw new Error('Form validation failed');
                            }
                            throw new Error(data.error || 'Failed to create invoice');
                        }

                        // Success case
                        const modal = bootstrap.Modal.getInstance(document.getElementById('newInvoiceModal'));
                        if (modal) {
                            modal.hide();
                        }

                        // Reset form
                        form.reset();
                        document.getElementById('tasksTableBody').innerHTML = '';
                        document.getElementById('invoiceProject').disabled = true;

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Invoice created successfully!',
                            confirmButtonColor: '#3085d6',
                        }).then(() => {
                            // Force a full page reload after the success message is closed
                            window.location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error creating invoice:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error creating invoice: ' + (error.message || 'Please check your inputs and try again'),
                            confirmButtonColor: '#3085d6',
                        });
                    })
                    .finally(() => {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    });
            },

            viewInvoice: function(invoiceId) {
                fetch(`ajax_helpers/getInvoiceDetails.php?id=${invoiceId}`)
                    .then(response => {
                        if (response.status === 401) {
                            window.location.reload(); // Redirect to login if session expired
                            return;
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error loading invoice details: ' + error,
                            confirmButtonColor: '#3085d6',
                        });
                    });
            },

         showInvoiceModal: function(invoice) {
    try {
        if (!invoice || !invoice.invoice_number) {
            throw new Error('Invalid invoice data received');
        }

        const modalContent = document.getElementById('invoiceDetailsContent');
        
        // Format dates
        const formatDate = (dateStr) => {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        };

        const dateRange = `${formatDate(invoice.date_from)} - ${formatDate(invoice.date_to)}`;

        // Status badge
        const statusBadges = {
            paid: { class: 'bg-success', text: 'Paid' },
            pending: { class: 'bg-primary', text: 'Pending' },
            overdue: { class: 'bg-danger', text: 'Overdue' },
            draft: { class: 'bg-secondary', text: 'Draft' }
        };
        const status = invoice.status || 'draft';
        const statusBadge = statusBadges[status] || statusBadges.draft;

        // Format currency
        const projectRate = parseFloat(invoice.project_rate) || 0;
        const formattedRate = projectRate.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
        });

        // Generate items table
        let itemsHtml = '';
        if (invoice.items && invoice.items.length > 0) {
            invoice.items.forEach(item => {
                // Replace newlines with <br> in the description
                const description = (item.details || 'No details').replace(/\n/g, '<br>');
                
                itemsHtml += `
<tr>
    <td>${formatDate(item.date)}</td>
    <td style="white-space: normal; word-wrap: break-word;">${item.task_title || 'No title'}</td>
    <td style="white-space: normal; word-wrap: break-word;">${description}</td>
    <td>${item.hours || '0'}</td>
</tr>
`;
            });
        } else {
            itemsHtml = `
            <tr>
                <td colspan="4" class="text-center py-3 text-muted">
                    No items found for this invoice
                </td>
            </tr>
            `;
        }

        // Client info
        let clientInfoHtml = '';
        if (invoice.client_info) {
            clientInfoHtml = `
            <p class="mb-1">${invoice.client_info.address || ''}</p>
            <p class="mb-1">Phone: ${invoice.client_info.phone || 'N/A'}</p>
            <p class="mb-1">Email: ${invoice.client_info.email || 'N/A'}</p>
            `;
        }

        // Build the modal content
        modalContent.innerHTML = `
        <div class="invoice-preview">
            <div class="invoice-header d-flex justify-content-between mb-4">
                <div>
                    <h4>Invoice #${invoice.invoice_number}</h4>
                    <p class="mb-1"><strong>Date Range:</strong> ${dateRange}</p>
                    <p class="mb-1"><strong>Project:</strong> ${invoice.project_name || 'N/A'}</p>
                    <p class="mb-1"><strong>Status:</strong> <span class="badge ${statusBadge.class}">${statusBadge.text}</span></p>
                </div>
                <div class="text-end">
                    <h4>${invoice.client_name || 'No client specified'}</h4>
                    ${clientInfoHtml}
                </div>
            </div>
            
            <div class="invoice-summary mb-4">
                <h5 class="mb-3">Invoice Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" style="table-layout: fixed;">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 15%">Date</th>
                                <th style="width: 20%">Task</th>
                                <th style="width: 50%">Description</th>
                                <th style="width: 15%">Hours</th>
                            </tr>
                        </thead>
                        <tbody>${itemsHtml}</tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-end mt-3">
                    <div class="bg-light p-3 rounded" style="min-width:300px;">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Project Rate:</span>
                            <span>${formattedRate}</span>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Amount:</span>
                            <span class="fs-5 fw-bold text-success">${formattedRate}</span>
                        </div>
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

        const modal = new bootstrap.Modal(document.getElementById('viewInvoiceModal'));
        modal.show();

    } catch (error) {
        console.error('Error displaying invoice:', error);
        document.getElementById('invoiceDetailsContent').innerHTML = `
        <div class="alert alert-danger">
            <h4>Error Displaying Invoice</h4>
            <p>${error.message}</p>
            <p>Please check the console for more details.</p>
            <button class="btn btn-sm btn-secondary" onclick="window.location.reload()">
                Reload Page
            </button>
        </div>
        `;
        new bootstrap.Modal(document.getElementById('viewInvoiceModal')).show();
    }
},
            editInvoice: function(invoiceId) {
                fetch(`ajax_helpers/getInvoiceDetails.php?id=${invoiceId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.loadClientsForEditModal().then(() => {
                                this.showEditModal(data.invoice);
                                if (data.invoice.client_id) {
                                    this.loadProjectsForEditModal(data.invoice.client_id, data.invoice.project_id);
                                }
                            });
                        } else {
                            throw new Error(data.error || 'Failed to load invoice for editing');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading invoice for editing:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error loading invoice: ' + error.message,
                            confirmButtonColor: '#3085d6',
                        });
                    });
            },

            showEditModal: function(invoice) {
                document.getElementById('editInvoiceId').value = invoice.id;
                document.getElementById('editInvoiceClient').value = invoice.client_id;

                document.getElementById('editDateFromFilter').value = invoice.date_from ? invoice.date_from.split('T')[0] : '';
                document.getElementById('editDateToFilter').value = invoice.date_to ? invoice.date_to.split('T')[0] : '';

                document.getElementById('editInvoiceNotes').value = invoice.notes || '';

                const clientSelect = document.getElementById('editInvoiceClient');
                clientSelect.addEventListener('change', (e) => {
                    this.loadProjectsForEditModal(e.target.value);
                });

                const modal = new bootstrap.Modal(document.getElementById('editInvoiceModal'));
                modal.show();

                document.getElementById('editInvoiceForm').onsubmit = (e) => {
                    e.preventDefault();
                    this.updateInvoice(invoice.id);
                };
            },

            loadClientsForEditModal: function() {
                return fetch('ajax_helpers/getClients.php')
                    .then(response => response.json())
                    .then(clients => {
                        const clientSelect = document.getElementById('editInvoiceClient');
                        clientSelect.innerHTML = '<option value="">Select Client</option>';

                        clients.forEach(client => {
                            const option = document.createElement('option');
                            option.value = client.id;
                            option.textContent = `${client.first_name} ${client.last_name}`;
                            clientSelect.appendChild(option);
                        });

                        return clients;
                    });
            },

            loadProjectsForEditModal: function(clientId, selectedProjectId = null) {
                if (!clientId) {
                    document.getElementById('editInvoiceProject').innerHTML = '<option value="">Select Project</option>';
                    document.getElementById('editInvoiceProject').disabled = true;
                    return;
                }

                return fetch(`ajax_helpers/getProjects.php?client_id=${clientId}`)
                    .then(response => response.json())
                    .then(projects => {
                        const projectSelect = document.getElementById('editInvoiceProject');
                        projectSelect.innerHTML = '<option value="">Select Project</option>';
                        projectSelect.disabled = false;

                        projects.forEach(project => {
                            const option = document.createElement('option');
                            option.value = project.id;
                            option.textContent = project.name;
                            if (selectedProjectId && project.id == selectedProjectId) {
                                option.selected = true;
                            }
                            projectSelect.appendChild(option);
                        });
                    });
            },

            updateInvoice: function(invoiceId) {
                const form = document.getElementById('editInvoiceForm');
                const formData = {
                    action: 'update_invoice',
                    id: invoiceId,
                    client_id: form.querySelector('#editInvoiceClient').value,
                    project_id: form.querySelector('#editInvoiceProject').value,
                    date_from: form.querySelector('#editDateFromFilter').value,
                    date_to: form.querySelector('#editDateToFilter').value,
                    notes: form.querySelector('#editInvoiceNotes').value
                };

                fetch('ajax_helpers/updateInvoice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            bootstrap.Modal.getInstance(document.getElementById('editInvoiceModal')).hide();
                            this.loadInvoices();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Invoice updated successfully!',
                                confirmButtonColor: '#3085d6',
                            });
                        } else {
                            throw new Error(data.error || 'Failed to update invoice');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating invoice: ' + error.message,
                            confirmButtonColor: '#3085d6',
                        });
                    });
            },

            sendInvoice: function(invoiceId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to send invoice #${invoiceId} to the client?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`ajax_helpers/sendInvoice.php?id=${invoiceId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sent!',
                                        text: 'Invoice sent successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    this.loadInvoices();
                                } else {
                                    throw new Error(data.error || 'Failed to send invoice');
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error sending invoice: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            },

            updateStatus: function(invoiceId, newStatus) {
                console.log(`Attempting to update invoice ${invoiceId} to status ${newStatus}`); // Debug log

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to change this invoice's status to ${newStatus}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('User confirmed status change'); // Debug log

                        fetch('ajax_helpers/updateInvoiceStatus.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    invoice_id: invoiceId,
                                    new_status: newStatus
                                })
                            })
                            .then(response => {
                                console.log('Received response from server'); // Debug log
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response data:', data); // Debug log
                                if (data.success) {
                                    this.loadInvoices();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Updated!',
                                        text: 'Invoice status updated successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                } else {
                                    throw new Error(data.error || 'Failed to update status');
                                }
                            })
                            .catch(error => {
                                console.error('Error updating status:', error); // Debug log
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error updating status: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            },

            deleteInvoice: function(invoiceId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`ajax_helpers/deleteInvoice.php?id=${invoiceId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Invoice deleted successfully',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    this.loadInvoices();
                                } else {
                                    throw new Error(data.error || 'Failed to delete invoice');
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error deleting invoice: ' + error.message,
                                    confirmButtonColor: '#3085d6',
                                });
                            });
                    }
                });
            }
        };

        invoiceManager.init();
        window.invoiceManager = invoiceManager;
    });
</script>