<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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

    <!-- Project Status Tabs -->
    <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-projects-tab" data-bs-toggle="tab" data-bs-target="#all-projects" type="button" role="tab">
                <i class="fas fa-list me-1"></i> All Projects
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="active-projects-tab" data-bs-toggle="tab" data-bs-target="#active-projects" type="button" role="tab">
                <i class="fas fa-rocket me-1"></i> Active
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-projects-tab" data-bs-toggle="tab" data-bs-target="#completed-projects" type="button" role="tab">
                <i class="fas fa-check-circle me-1"></i> Completed
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="onhold-projects-tab" data-bs-toggle="tab" data-bs-target="#onhold-projects" type="button" role="tab">
                <i class="fas fa-pause-circle me-1"></i> On Hold
            </button>
        </li>
    </ul>

    <!-- Project Content -->
    <div class="tab-content" id="projectTabsContent">
        <div class="tab-pane fade show active" id="all-projects" role="tabpanel">
            <!-- Project Filters -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="clientFilter" class="form-label">Client</label>
                            <select class="form-select" id="clientFilter">
                                <option selected>All Clients</option>
                                <option>TechSolutions Inc.</option>
                                <option>FinanceTech LLC</option>
                                <option>Healthcare Systems</option>
                                <option>RetailCorp International</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="statusFilter" class="form-label">Status</label>
                            <select class="form-select" id="statusFilter">
                                <option selected>All Statuses</option>
                                <option>Planning</option>
                                <option>In Progress</option>
                                <option>On Hold</option>
                                <option>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="priorityFilter" class="form-label">Priority</label>
                            <select class="form-select" id="priorityFilter">
                                <option selected>All Priorities</option>
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Project List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllProjects">
                                        </div>
                                    </th>
                                    <th>Project</th>
                                    <th>Client</th>
                                    <th>Team</th>
                                    <th>Progress</th>
                                    <th>Due Date</th>
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
                                        <a href="#" class="text-primary fw-bold">E-commerce Platform</a>
                                        <p class="mb-0 text-muted small">Online store development</p>
                                    </td>
                                    <td>RetailCorp International</td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="John Doe">
                                                <span class="avatar-title rounded-circle bg-primary text-white">JD</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Jane Smith">
                                                <span class="avatar-title rounded-circle bg-success text-white">JS</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Mike Johnson">
                                                <span class="avatar-title rounded-circle bg-warning text-white">MJ</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="+2">
                                                <span class="avatar-title rounded-circle bg-secondary text-white">+2</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="small">75%</span>
                                        </div>
                                    </td>
                                    <td>Aug 15, 2023</td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
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
                                        <a href="#" class="text-primary fw-bold">Mobile App Redesign</a>
                                        <p class="mb-0 text-muted small">UI/UX redesign for mobile app</p>
                                    </td>
                                    <td>TechSolutions Inc.</td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Jane Smith">
                                                <span class="avatar-title rounded-circle bg-success text-white">JS</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Sarah Miller">
                                                <span class="avatar-title rounded-circle bg-info text-white">SM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="small">30%</span>
                                        </div>
                                    </td>
                                    <td>Sep 05, 2023</td>
                                    <td><span class="badge bg-secondary">Planning</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
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
                                        <a href="#" class="text-primary fw-bold">Admin Dashboard</a>
                                        <p class="mb-0 text-muted small">New admin panel development</p>
                                    </td>
                                    <td>FinanceTech LLC</td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="John Doe">
                                                <span class="avatar-title rounded-circle bg-primary text-white">JD</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Mike Johnson">
                                                <span class="avatar-title rounded-circle bg-warning text-white">MJ</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="small">100%</span>
                                        </div>
                                    </td>
                                    <td>Jul 28, 2023</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
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
                                        <a href="#" class="text-primary fw-bold">API Integration</a>
                                        <p class="mb-0 text-muted small">Third-party API integration</p>
                                    </td>
                                    <td>Healthcare Systems</td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Jane Smith">
                                                <span class="avatar-title rounded-circle bg-success text-white">JS</span>
                                            </div>
                                            <div class="avatar-xs" data-bs-toggle="tooltip" title="Lisa Wong">
                                                <span class="avatar-title rounded-circle bg-danger text-white">LW</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="small">15%</span>
                                        </div>
                                    </td>
                                    <td>Aug 30, 2023</td>
                                    <td><span class="badge bg-warning">On Hold</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Tasks</a></li>
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
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">12</span> projects</p>
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
        <div class="tab-pane fade" id="active-projects" role="tabpanel">
            <!-- Active projects content would go here -->
        </div>
        <div class="tab-pane fade" id="completed-projects" role="tabpanel">
            <!-- Completed projects content would go here -->
        </div>
        <div class="tab-pane fade" id="onhold-projects" role="tabpanel">
            <!-- On Hold projects content would go here -->
        </div>
    </div>
</main>

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
                        <div class="col-md-6">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="projectClient" class="form-label">Client</label>
                            <select class="form-select" id="projectClient" required>
                                <option selected disabled>Select Client</option>
                                <option>TechSolutions Inc.</option>
                                <option>FinanceTech LLC</option>
                                <option>Healthcare Systems</option>
                                <option>RetailCorp International</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="projectStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="projectStartDate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="projectEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="projectEndDate">
                        </div>
                        <div class="col-md-6">
                            <label for="projectPriority" class="form-label">Priority</label>
                            <select class="form-select" id="projectPriority">
                                <option selected>Medium</option>
                                <option>High</option>
                                <option>Low</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="projectStatus" class="form-label">Status</label>
                            <select class="form-select" id="projectStatus">
                                <option selected>Planning</option>
                                <option>In Progress</option>
                                <option>On Hold</option>
                                <option>Completed</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="projectTeam" class="form-label">Team Members</label>
                            <select class="form-select" id="projectTeam" multiple>
                                <option selected>John Doe</option>
                                <option selected>Jane Smith</option>
                                <option>Mike Johnson</option>
                                <option>Sarah Miller</option>
                                <option>Lisa Wong</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="projectDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="projectDescription" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="projectBudget" class="form-label">Budget</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="projectBudget" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Project</button>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>

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
    
    /* Avatar Group Styles */
    .avatar-group {
        display: flex;
        flex-wrap: wrap;
    }
    
    .avatar-xs {
        width: 28px;
        height: 28px;
        margin-right: -8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Progress Bar Styles */
    .progress {
        background-color: #f0f2f5;
        border-radius: 3px;
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
    
    .badge.bg-primary {
        background-color: #3a4f8a !important;
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
    
    /* Modal Styles */
    .modal-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .modal-footer {
        border-top: 1px solid rgba(0,0,0,0.05);
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>