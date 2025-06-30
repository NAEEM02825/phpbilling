<!-- Payment Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Payment History</h1>
            <p class="mb-0 text-muted">View and manage all payment transactions</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> New Payment
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

    <!-- Payment Status Tabs -->
    <ul class="nav nav-tabs mb-4" id="paymentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                <i class="fas fa-list me-1"></i> All Payments
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                <i class="fas fa-check-circle me-1"></i> Completed
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                <i class="fas fa-hourglass-half me-1"></i> Pending
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="failed-tab" data-bs-toggle="tab" data-bs-target="#failed" type="button" role="tab">
                <i class="fas fa-times-circle me-1"></i> Failed
            </button>
        </li>
    </ul>

    <!-- Payment Content -->
    <div class="tab-content" id="paymentTabsContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <!-- Payment Filters -->
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
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option selected>All Methods</option>
                                <option>Credit Card</option>
                                <option>PayPal</option>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payment Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Total Payments</h6>
                            <h3 class="mb-0">$12,450.00</h3>
                            <span class="text-success small"><i class="fas fa-arrow-up me-1"></i> 12.5%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Completed</h6>
                            <h3 class="mb-0">$10,200.00</h3>
                            <span class="text-success small"><i class="fas fa-arrow-up me-1"></i> 8.3%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Pending</h6>
                            <h3 class="mb-0">$1,750.00</h3>
                            <span class="text-danger small"><i class="fas fa-arrow-down me-1"></i> 3.2%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted small">Failed</h6>
                            <h3 class="mb-0">$500.00</h3>
                            <span class="text-danger small"><i class="fas fa-arrow-down me-1"></i> 1.8%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Invoice</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">#PAY-2023-001</a>
                                    </td>
                                    <td>Jul 18, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-primary text-white">AC</span>
                                            </div>
                                            <span>Acme Corporation</span>
                                        </div>
                                    </td>
                                    <td>$2,500.00</td>
                                    <td>Bank Transfer</td>
                                    <td><a href="#" class="text-primary">INV-2023-015</a></td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" 
                                               class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center action-view-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;"
                                               title="View Payment">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-info p-0 d-flex align-items-center justify-content-center action-invoice-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #17a2b8;"
                                               title="View Invoice">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center action-print-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;"
                                               title="Print Payment">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <!-- For Pending/Failed payments, you can conditionally show Mark Paid or Retry -->
                                            <!-- Example for Mark Paid: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-success p-0 d-flex align-items-center justify-content-center action-mark-paid-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #198754;"
                                               title="Mark as Paid">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            -->
                                            <!-- Example for Retry: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-warning p-0 d-flex align-items-center justify-content-center action-retry-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #ffc107;"
                                               title="Retry Payment">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            -->
                                            <a href="#" 
                                               class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center action-delete-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;"
                                               title="Delete Payment">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">#PAY-2023-002</a>
                                    </td>
                                    <td>Jul 16, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-success text-white">TC</span>
                                            </div>
                                            <span>Tech Solutions Inc.</span>
                                        </div>
                                    </td>
                                    <td>$1,800.00</td>
                                    <td>Credit Card</td>
                                    <td><a href="#" class="text-primary">INV-2023-014</a></td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" 
                                               class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center action-view-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;"
                                               title="View Payment">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-info p-0 d-flex align-items-center justify-content-center action-invoice-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #17a2b8;"
                                               title="View Invoice">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center action-print-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;"
                                               title="Print Payment">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <!-- For Pending/Failed payments, you can conditionally show Mark Paid or Retry -->
                                            <!-- Example for Mark Paid: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-success p-0 d-flex align-items-center justify-content-center action-mark-paid-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #198754;"
                                               title="Mark as Paid">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            -->
                                            <!-- Example for Retry: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-warning p-0 d-flex align-items-center justify-content-center action-retry-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #ffc107;"
                                               title="Retry Payment">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            -->
                                            <a href="#" 
                                               class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center action-delete-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;"
                                               title="Delete Payment">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">#PAY-2023-003</a>
                                    </td>
                                    <td>Jul 15, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-warning text-white">DG</span>
                                            </div>
                                            <span>Design Gallery</span>
                                        </div>
                                    </td>
                                    <td>$950.00</td>
                                    <td>PayPal</td>
                                    <td><a href="#" class="text-primary">INV-2023-013</a></td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" 
                                               class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center action-view-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;"
                                               title="View Payment">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-info p-0 d-flex align-items-center justify-content-center action-invoice-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #17a2b8;"
                                               title="View Invoice">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center action-print-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;"
                                               title="Print Payment">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <!-- For Pending/Failed payments, you can conditionally show Mark Paid or Retry -->
                                            <!-- Example for Mark Paid: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-success p-0 d-flex align-items-center justify-content-center action-mark-paid-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #198754;"
                                               title="Mark as Paid">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            -->
                                            <!-- Example for Retry: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-warning p-0 d-flex align-items-center justify-content-center action-retry-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #ffc107;"
                                               title="Retry Payment">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            -->
                                            <a href="#" 
                                               class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center action-delete-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;"
                                               title="Delete Payment">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">#PAY-2023-004</a>
                                    </td>
                                    <td>Jul 12, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-info text-white">SW</span>
                                            </div>
                                            <span>Software World</span>
                                        </div>
                                    </td>
                                    <td>$3,200.00</td>
                                    <td>Bank Transfer</td>
                                    <td><a href="#" class="text-primary">INV-2023-012</a></td>
                                    <td><span class="badge bg-danger">Failed</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#" 
                                               class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center action-view-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;"
                                               title="View Payment">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-info p-0 d-flex align-items-center justify-content-center action-invoice-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #17a2b8;"
                                               title="View Invoice">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <a href="#" 
                                               class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center action-print-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;"
                                               title="Print Payment">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <!-- For Pending/Failed payments, you can conditionally show Mark Paid or Retry -->
                                            <!-- Example for Mark Paid: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-success p-0 d-flex align-items-center justify-content-center action-mark-paid-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #198754;"
                                               title="Mark as Paid">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            -->
                                            <!-- Example for Retry: -->
                                            <!--
                                            <a href="#" 
                                               class="btn btn-outline-warning p-0 d-flex align-items-center justify-content-center action-retry-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #ffc107;"
                                               title="Retry Payment">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            -->
                                            <a href="#" 
                                               class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center action-delete-payment"
                                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;"
                                               title="Delete Payment">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> payments</p>
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
        <div class="tab-pane fade" id="completed" role="tabpanel">
            <!-- Completed payments content would go here -->
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel">
            <!-- Pending payments content would go here -->
        </div>
        <div class="tab-pane fade" id="failed" role="tabpanel">
            <!-- Failed payments content would go here -->
        </div>
    </div>
<style>
    /* Payment Page Specific Styles */
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
    
    .card.border-warning {
        border-left: 4px solid #ffc107 !important;
    }
    
    .card.border-danger {
        border-left: 4px solid #dc3545 !important;
    }
    
    /* Avatar Styles */
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-title {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 0.875rem;
        font-weight: 600;
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
</style>