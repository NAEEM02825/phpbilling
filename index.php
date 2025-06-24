<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
        <div>
            <h1 class="h2">Welcome Back, <span class="text-primary">[User]</span></h1>
            <p class="mb-0 text-muted">Here's what's happening with your projects today</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-3">
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus me-1"></i> New Task
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-file-invoice me-1"></i> Create Invoice
                </button>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="timePeriodDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-alt me-1"></i> This Week
                </button>
                <ul class="dropdown-menu" aria-labelledby="timePeriodDropdown">
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Week</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">Custom Range</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-start-lg border-start-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="ms-auto text-end">
                            <h6 class="text-muted mb-1">Total Tasks</h6>
                            <h3 class="mb-0">24</h3>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="tasks.php?action=list" class="stretched-link"></a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-start-lg border-start-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="ms-auto text-end">
                            <h6 class="text-muted mb-1">Completed</h6>
                            <h3 class="mb-0">18</h3>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="tasks.php?action=list&status=completed" class="stretched-link"></a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-start-lg border-start-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="ms-auto text-end">
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h3 class="mb-0">6</h3>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="tasks.php?action=list&status=pending" class="stretched-link"></a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-start-lg border-start-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="ms-auto text-end">
                            <h6 class="text-muted mb-1">Overdue</h6>
                            <h3 class="mb-0">2</h3>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="tasks.php?action=list&status=overdue" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Overview -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Task Activity</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="chartFilterDropdown" data-bs-toggle="dropdown">
                            This Month
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="chartFilterDropdown">
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <!-- Chart would be rendered here -->
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Task completion chart will appear here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Task Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <!-- Pie chart would be rendered here -->
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Task distribution chart will appear here</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-primary me-2">&nbsp;</span>
                            <span class="text-muted">Development</span>
                            <span class="ms-auto fw-bold">45%</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-success me-2">&nbsp;</span>
                            <span class="text-muted">Design</span>
                            <span class="ms-auto fw-bold">30%</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-info me-2">&nbsp;</span>
                            <span class="text-muted">Testing</span>
                            <span class="ms-auto fw-bold">15%</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-warning me-2">&nbsp;</span>
                            <span class="text-muted">Documentation</span>
                            <span class="ms-auto fw-bold">10%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks & Projects -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Tasks</h5>
                    <a href="tasks.php" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Task</th>
                                    <th>Project</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                            <span class="ms-2">User authentication</span>
                                        </div>
                                    </td>
                                    <td>BixiSoft Website</td>
                                    <td>Jul 15, 2023</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                            <span class="ms-2">Dashboard redesign</span>
                                        </div>
                                    </td>
                                    <td>Admin Panel</td>
                                    <td>Jul 18, 2023</td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                            <span class="ms-2">API documentation</span>
                                        </div>
                                    </td>
                                    <td>Mobile App Backend</td>
                                    <td>Jul 20, 2023</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                            <span class="ms-2">Bug fixes</span>
                                        </div>
                                    </td>
                                    <td>E-commerce Platform</td>
                                    <td>Jul 16, 2023</td>
                                    <td><span class="badge bg-danger">Overdue</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Active Projects</h5>
                    <a href="projects.php" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="project-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">E-commerce Platform</h6>
                                    <p class="mb-0 text-muted small">Last updated 2 days ago</p>
                                </div>
                                <div class="text-end">
                                    <div class="progress mb-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted small">85% complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="project-icon bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Mobile App</h6>
                                    <p class="mb-0 text-muted small">Last updated 1 week ago</p>
                                </div>
                                <div class="text-end">
                                    <div class="progress mb-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted small">65% complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="project-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Admin Dashboard</h6>
                                    <p class="mb-0 text-muted small">Last updated 3 days ago</p>
                                </div>
                                <div class="text-end">
                                    <div class="progress mb-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted small">45% complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="project-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Company Website</h6>
                                    <p class="mb-0 text-muted small">Last updated yesterday</p>
                                </div>
                                <div class="text-end">
                                    <div class="progress mb-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted small">30% complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Manager Section -->
    <div class="manager-section mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Financial Overview</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-file-invoice text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Total Invoices</h6>
                                <h4 class="mb-0">8</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Paid</h6>
                                <h4 class="mb-0">5</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Pending</h6>
                                <h4 class="mb-0">2</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-danger bg-opacity-10 p-3 rounded">
                                <i class="fas fa-times-circle text-danger"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Overdue</h6>
                                <h4 class="mb-0">1</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice #</th>
                                <th>Client</th>
                                <th>Issued</th>
                                <th>Due</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="text-primary">INV-2023-001</a></td>
                                <td>Mansoor LLC</td>
                                <td>Jul 1, 2023</td>
                                <td>Jul 15, 2023</td>
                                <td>$1,250.00</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-primary">INV-2023-002</a></td>
                                <td>TechSolutions Inc.</td>
                                <td>Jul 5, 2023</td>
                                <td>Jul 20, 2023</td>
                                <td>$3,450.00</td>
                                <td><span class="badge bg-primary">Sent</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-primary">INV-2023-003</a></td>
                                <td>Global Systems</td>
                                <td>Jun 25, 2023</td>
                                <td>Jul 10, 2023</td>
                                <td>$2,150.00</td>
                                <td><span class="badge bg-danger">Overdue</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>

<style>
    .dashboard-header {
        border-bottom: none;
        padding-bottom: 1rem;
    }
    
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        border-left: 4px solid;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .project-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
    }
    
    .list-group-item {
        padding: 1.25rem 1.5rem;
        border-color: rgba(0,0,0,0.05);
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
</style>