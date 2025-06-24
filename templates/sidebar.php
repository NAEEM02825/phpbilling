<!-- Sidebar -->
<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <!-- Task Entry Accordion -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#taskCollapse" role="button">
                            <i class="fas fa-tasks me-2"></i> Task Entries
                        </a>
                        <div class="collapse show" id="taskCollapse">
                            <ul class="nav flex-column ms-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="tasks.php?action=list">
                                        <i class="fas fa-list me-2"></i> My Tasks
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tasks.php?action=create">
                                        <i class="fas fa-plus-circle me-2"></i> New Task
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Manager Only Sections -->
                    <div class="manager-only">
                        <!-- Invoicing Accordion -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#invoiceCollapse" role="button">
                                <i class="fas fa-file-invoice-dollar me-2"></i> Invoicing
                            </a>
                            <div class="collapse" id="invoiceCollapse">
                                <ul class="nav flex-column ms-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="invoices.php?action=list">
                                            <i class="fas fa-list me-2"></i> All Invoices
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="invoices.php?action=create">
                                            <i class="fas fa-plus-circle me-2"></i> Create Invoice
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Payments Accordion -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#paymentCollapse" role="button">
                                <i class="fas fa-money-bill-wave me-2"></i> Payments
                            </a>
                            <div class="collapse" id="paymentCollapse">
                                <ul class="nav flex-column ms-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="payments.php?action=list">
                                            <i class="fas fa-list me-2"></i> Payment History
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payments.php?action=record">
                                            <i class="fas fa-plus-circle me-2"></i> Record Payment
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="ledger.php">
                                            <i class="fas fa-book me-2"></i> Client Ledger
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Admin Accordion -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#adminCollapse" role="button">
                                <i class="fas fa-cog me-2"></i> Administration
                            </a>
                            <div class="collapse" id="adminCollapse">
                                <ul class="nav flex-column ms-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="clients.php">
                                            <i class="fas fa-users me-2"></i> Clients
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="projects.php">
                                            <i class="fas fa-project-diagram me-2"></i> Projects
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="users.php">
                                            <i class="fas fa-user-shield me-2"></i> User Management
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </div>
                </ul>
                
                <div class="sidebar-footer mt-auto p-3 text-center text-muted">
                    <small>v1.0.0</small>
                </div>
            </div>
        </nav>