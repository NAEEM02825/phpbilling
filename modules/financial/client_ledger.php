    <!-- Ledger Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">General Ledger</h1>
            <p class="mb-0 text-muted">View and manage all financial transactions</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> New Entry
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

    <!-- Ledger Account Tabs -->
    <ul class="nav nav-tabs mb-4" id="ledgerTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                <i class="fas fa-list me-1"></i> All Accounts
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="assets-tab" data-bs-toggle="tab" data-bs-target="#assets" type="button" role="tab">
                <i class="fas fa-building me-1"></i> Assets
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="liabilities-tab" data-bs-toggle="tab" data-bs-target="#liabilities" type="button" role="tab">
                <i class="fas fa-hand-holding-usd me-1"></i> Liabilities
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income" type="button" role="tab">
                <i class="fas fa-money-bill-wave me-1"></i> Income
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="expenses-tab" data-bs-toggle="tab" data-bs-target="#expenses" type="button" role="tab">
                <i class="fas fa-receipt me-1"></i> Expenses
            </button>
        </li>
    </ul>

    <!-- Ledger Content -->
    <div class="tab-content" id="ledgerTabsContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <!-- Ledger Filters -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="dateFrom" class="form-label">Date From</label>
                            <input type="date" class="form-control" id="dateFrom">
                        </div>
                        <div class="col-md-3">
                            <label for="dateTo" class="form-label">Date To</label>
                            <input type="date" class="form-control" id="dateTo">
                        </div>
                        <div class="col-md-3">
                            <label for="accountType" class="form-label">Account Type</label>
                            <select class="form-select" id="accountType">
                                <option selected>All Types</option>
                                <option>Assets</option>
                                <option>Liabilities</option>
                                <option>Income</option>
                                <option>Expenses</option>
                                <option>Equity</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Total Debit</h6>
                            <h3 class="mb-0">$45,670.00</h3>
                            <span class="text-success small"><i class="fas fa-arrow-up me-1"></i> 8.2%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Total Credit</h6>
                            <h3 class="mb-0">$38,920.00</h3>
                            <span class="text-danger small"><i class="fas fa-arrow-down me-1"></i> 3.5%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Balance</h6>
                            <h3 class="mb-0">$6,750.00</h3>
                            <span class="text-success small"><i class="fas fa-arrow-up me-1"></i> 4.7%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ledger Accounts List -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Account Code</th>
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1001</td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Cash Account</a>
                                        <p class="mb-0 text-muted small">Main operating account</p>
                                    </td>
                                    <td>Assets</td>
                                    <td>$12,450.00</td>
                                    <td>$8,750.00</td>
                                    <td class="text-success">$3,700.00</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Statement</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2001</td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Accounts Payable</a>
                                        <p class="mb-0 text-muted small">Vendor payments</p>
                                    </td>
                                    <td>Liabilities</td>
                                    <td>$5,200.00</td>
                                    <td>$9,800.00</td>
                                    <td class="text-danger">-$4,600.00</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Statement</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3001</td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Service Revenue</a>
                                        <p class="mb-0 text-muted small">Primary income source</p>
                                    </td>
                                    <td>Income</td>
                                    <td>$0.00</td>
                                    <td>$25,400.00</td>
                                    <td class="text-success">$25,400.00</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Statement</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4001</td>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Office Expenses</a>
                                        <p class="mb-0 text-muted small">General office costs</p>
                                    </td>
                                    <td>Expenses</td>
                                    <td>$8,200.00</td>
                                    <td>$0.00</td>
                                    <td class="text-danger">-$8,200.00</td>
                                    <td><span class="badge bg-warning">Review</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Statement</a></li>
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
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> accounts</p>
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

            <!-- Recent Transactions -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0">Recent Transactions</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jul 18, 2023</td>
                                    <td>TRX-2023-0018</td>
                                    <td>Cash Account</td>
                                    <td>Client payment received</td>
                                    <td class="text-success">$2,500.00</td>
                                    <td>$0.00</td>
                                    <td>$3,700.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-light">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jul 17, 2023</td>
                                    <td>TRX-2023-0017</td>
                                    <td>Office Expenses</td>
                                    <td>Office supplies purchase</td>
                                    <td>$0.00</td>
                                    <td class="text-danger">$450.00</td>
                                    <td>-$8,200.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-light">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jul 16, 2023</td>
                                    <td>TRX-2023-0016</td>
                                    <td>Service Revenue</td>
                                    <td>Web development project</td>
                                    <td>$0.00</td>
                                    <td class="text-danger">$1,800.00</td>
                                    <td>$25,400.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-light">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jul 15, 2023</td>
                                    <td>TRX-2023-0015</td>
                                    <td>Accounts Payable</td>
                                    <td>Vendor invoice payment</td>
                                    <td class="text-success">$950.00</td>
                                    <td>$0.00</td>
                                    <td>-$4,600.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-light">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Other Tab Panes -->
        <div class="tab-pane fade" id="assets" role="tabpanel">
            <!-- Assets content would go here -->
        </div>
        <div class="tab-pane fade" id="liabilities" role="tabpanel">
            <!-- Liabilities content would go here -->
        </div>
        <div class="tab-pane fade" id="income" role="tabpanel">
            <!-- Income content would go here -->
        </div>
        <div class="tab-pane fade" id="expenses" role="tabpanel">
            <!-- Expenses content would go here -->
        </div>
    </div>

<style>
    /* Ledger Page Specific Styles */
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
    
    /* Summary Card Styles */
    .card.border-primary {
        border-left: 4px solid #3a4f8a !important;
    }
    
    .card.border-success {
        border-left: 4px solid #28a745 !important;
    }
    
    .card.border-danger {
        border-left: 4px solid #dc3545 !important;
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
    
    /* Color for debit/credit amounts */
    .text-success {
        color: #28a745 !important;
    }
    
    .text-danger {
        color: #dc3545 !important;
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
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
</style>