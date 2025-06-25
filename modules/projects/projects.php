    <!-- Projects Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Project Management</h1>
            <p class="mb-0 text-muted">Track and manage all your projects</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                    <i class="fas fa-plus me-1"></i> New Project
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

    <!-- Week Information -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-muted">Week Number of Year</h6>
                    <h3 class="mb-0"><?php echo date('W'); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-muted">Current Week</h6>
                    <h3 class="mb-0"><?php echo date('M d') . ' - ' . date('M d', strtotime('+6 days')); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-muted">Last Week</h6>
                    <h3 class="mb-0"><?php echo date('M d', strtotime('-7 days')) . ' - ' . date('M d', strtotime('-1 day')); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Tabs -->
    <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-projects-tab" data-bs-toggle="tab" data-bs-target="#all-projects" type="button" role="tab">
                <i class="fas fa-list me-1"></i> All Projects
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sf-projects-tab" data-bs-toggle="tab" data-bs-target="#sf-projects" type="button" role="tab">
                SF Projects
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="other-projects-tab" data-bs-toggle="tab" data-bs-target="#other-projects" type="button" role="tab">
                Other Projects
            </button>
        </li>
    </ul>

    <!-- Project Content -->
    <div class="tab-content" id="projectTabsContent">
        <div class="tab-pane fade show active" id="all-projects" role="tabpanel">
            <!-- Project List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project</th>
                                    <th>From Company</th>
                                    <th>To Client</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Payment Cycle</th>
                                    <th>Tasks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- SF 1 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 1</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client A</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$5,000</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (3)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- SF 2 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 2</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client B</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$75/hr</td>
                                    <td>Weekly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (5)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- SF 3 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 3</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client C</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$3,500</td>
                                    <td>15 Days</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (2)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- DAL -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">DAL</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client D</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$85/hr</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (7)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- CRAFT -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">CRAFT</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client E</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$4,200</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (4)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions5" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions5">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- DRD -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">DRD</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client F</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$65/hr</td>
                                    <td>Weekly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (6)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions6" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions6">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- PLATINUM -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">PLATINUM</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client G</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$6,000</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (8)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions7" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions7">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SF Projects Tab -->
        <div class="tab-pane fade" id="sf-projects" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project</th>
                                    <th>From Company</th>
                                    <th>To Client</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Payment Cycle</th>
                                    <th>Tasks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- SF 1 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 1</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client A</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$5,000</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (3)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="sf1Actions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="sf1Actions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- SF 2 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 2</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client B</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$75/hr</td>
                                    <td>Weekly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (5)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="sf2Actions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="sf2Actions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- SF 3 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 3</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client C</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$3,500</td>
                                    <td>15 Days</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (2)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="sf3Actions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="sf3Actions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Other Projects Tab -->
        <div class="tab-pane fade" id="other-projects" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project</th>
                                    <th>From Company</th>
                                    <th>To Client</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Payment Cycle</th>
                                    <th>Tasks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DAL -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">DAL</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client D</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$85/hr</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (7)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dalActions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dalActions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- CRAFT -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">CRAFT</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client E</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$4,200</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (4)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="craftActions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="craftActions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- DRD -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">DRD</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client F</td>
                                    <td><span class="badge bg-warning">Hourly</span></td>
                                    <td>$65/hr</td>
                                    <td>Weekly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (6)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="drdActions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="drdActions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- PLATINUM -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">PLATINUM</a>
                                    </td>
                                    <td>Your Company</td>
                                    <td>Client G</td>
                                    <td><span class="badge bg-info">Recurring</span></td>
                                    <td>$6,000</td>
                                    <td>Monthly</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Tasks (8)</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="platinumActions" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="platinumActions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- New Project Modal -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="fromCompany" class="form-label">From Company</label>
                            <input type="text" class="form-control" id="fromCompany" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="toClient" class="form-label">To Client</label>
                            <input type="text" class="form-control" id="toClient" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Project Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="projectType" id="recurringType" checked>
                                <label class="form-check-label" for="recurringType">
                                    Recurring
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="projectType" id="hourlyType">
                                <label class="form-check-label" for="hourlyType">
                                    Hourly
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div id="recurringRateField">
                                <label for="recurringRate" class="form-label">Recurring Rate ($)</label>
                                <input type="number" class="form-control" id="recurringRate">
                            </div>
                            <div id="hourlyRateField" style="display: none;">
                                <label for="hourlyRate" class="form-label">Hourly Rate ($)</label>
                                <input type="number" class="form-control" id="hourlyRate">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="paymentCycle" class="form-label">Payment Cycle</label>
                            <select class="form-select" id="paymentCycle">
                                <option value="weekly">Weekly</option>
                                <option value="15days">15 Days</option>
                                <option value="monthly" selected>Monthly</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal (Example) -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Project Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                        <i class="fas fa-plus me-1"></i> Add Task
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Task Details</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th>ClickUp Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-06-01</td>
                                <td>Initial project setup</td>
                                <td>4</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" target="_blank">View in ClickUp</a></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-06-05</td>
                                <td>Database design</td>
                                <td>6</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td><a href="#" target="_blank">View in ClickUp</a></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2023-06-10</td>
                                <td>API development</td>
                                <td>8</td>
                                <td><span class="badge bg-warning">WIP</span></td>
                                <td><a href="#" target="_blank">View in ClickUp</a></td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Task Modal -->
<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="taskDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="taskDate" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskDetails" class="form-label">Task Details</label>
                        <textarea class="form-control" id="taskDetails" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskHours" class="form-label">Hours</label>
                        <input type="number" class="form-control" id="taskHours" step="0.5" min="0.5" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskStatus" class="form-label">Status</label>
                        <select class="form-select" id="taskStatus">
                            <option value="wip">Work in Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="clickupLink" class="form-label">ClickUp Link</label>
                        <input type="url" class="form-control" id="clickupLink">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
// Toggle between recurring and hourly rate fields
document.querySelectorAll('input[name="projectType"]').forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.id === 'recurringType') {
            document.getElementById('recurringRateField').style.display = 'block';
            document.getElementById('hourlyRateField').style.display = 'none';
        } else {
            document.getElementById('recurringRateField').style.display = 'none';
            document.getElementById('hourlyRateField').style.display = 'block';
        }
    });
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>

<style>
    /* Project Page Specific Styles */
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
    
    /* Badge Styles */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
    
    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #212529;
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
    
    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    /* Week Info Cards */
    .card.bg-light {
        background-color: #f8f9fa !important;
    }
    
    .card-title.text-muted {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>