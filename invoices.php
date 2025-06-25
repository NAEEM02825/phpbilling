<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Invoices Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Invoice Management</h1>
            <p class="mb-0 text-muted">View and manage all your invoices</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary">
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
            <form class="row g-3">
                <div class="col-md-3">
                    <label for="clientFilter" class="form-label">Client</label>
                    <select class="form-select" id="clientFilter">
                        <option selected>All Clients</option>
                        <option>Acme Corporation</option>
                        <option>Globex Inc.</option>
                        <option>Stark Industries</option>
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
                    <input type="number" class="form-control" id="amountFrom" placeholder="$0.00">
                </div>
                <div class="col-md-2">
                    <label for="amountTo" class="form-label">Amount To</label>
                    <input type="number" class="form-control" id="amountTo" placeholder="$10,000.00">
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
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">INV-2023-001</a>
                                    </td>
                                    <td>Acme Corporation</td>
                                    <td>Jun 15, 2023</td>
                                    <td>Jul 15, 2023</td>
                                    <td>$2,450.00</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Download PDF</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Send to Client</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">INV-2023-002</a>
                                    </td>
                                    <td>Globex Inc.</td>
                                    <td>Jun 18, 2023</td>
                                    <td>Jul 18, 2023</td>
                                    <td>$3,750.00</td>
                                    <td><span class="badge bg-primary">Pending</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Download PDF</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Send to Client</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">INV-2023-003</a>
                                    </td>
                                    <td>Stark Industries</td>
                                    <td>Jun 20, 2023</td>
                                    <td>Jul 20, 2023</td>
                                    <td>$5,200.00</td>
                                    <td><span class="badge bg-primary">Pending</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Download PDF</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Send to Client</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">INV-2023-004</a>
                                    </td>
                                    <td>Wayne Enterprises</td>
                                    <td>May 28, 2023</td>
                                    <td>Jun 28, 2023</td>
                                    <td>$1,850.00</td>
                                    <td><span class="badge bg-danger">Overdue</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> Download PDF</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Send to Client</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">INV-2023-005</a>
                                    </td>
                                    <td>Oscorp Industries</td>
                                    <td>Jun 25, 2023</td>
                                    <td>Jul 25, 2023</td>
                                    <td>$3,150.00</td>
                                    <td><span class="badge bg-secondary">Draft</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown5" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown5">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle me-2"></i> Mark as Sent</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">5</span> of <span class="fw-bold">12</span> invoices</p>
                        </div>
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Other Tab Panes -->
        <div class="tab-pane fade" id="paid" role="tabpanel">
            <!-- Paid invoices content would go here -->
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel">
            <!-- Pending invoices content would go here -->
        </div>
        <div class="tab-pane fade" id="overdue" role="tabpanel">
            <!-- Overdue invoices content would go here -->
        </div>
        <div class="tab-pane fade" id="draft" role="tabpanel">
            <!-- Draft invoices content would go here -->
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>

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
</style>

<script>
    // Initialize invoice page functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const invoiceTabs = document.querySelectorAll('#invoiceTabs button[data-bs-toggle="tab"]');
        invoiceTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // This would load the appropriate invoice data for the tab
                console.log('Loading invoices for:', this.id);
            });
        });
        
        // Select all checkbox functionality
        const selectAllCheckbox = document.getElementById('selectAllInvoices');
        const invoiceCheckboxes = document.querySelectorAll('tbody .form-check-input');
        
        selectAllCheckbox.addEventListener('change', function() {
            invoiceCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
        
        // Filter form submission
        const filterForm = document.querySelector('.card-body form');
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Applying filters...');
            // This would apply the filters and reload the invoice data
        });
    });
</script>