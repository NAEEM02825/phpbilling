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
  <!-- Projects Page Header (same as before) -->
<!-- Week Information (same as before) -->
<!-- Project Tabs (same as before) -->

<!-- Project Content -->
<div class="tab-content" id="projectTabsContent">
    <div class="tab-pane fade show active" id="all-projects" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="allProjectsTable">
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
                            <!-- Projects will be loaded dynamically -->
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
                    <table class="table table-hover align-middle mb-0" id="sfProjectsTable">
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
                            <!-- SF Projects will be loaded dynamically -->
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
                    <table class="table table-hover align-middle mb-0" id="otherProjectsTable">
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
                            <!-- Other Projects will be loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Project Modal (modified form) -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" name="name" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="fromCompany" class="form-label">From Company</label>
                            <input type="text" class="form-control" id="fromCompany" name="from_company" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="toClient" class="form-label">To Client</label>
                            <input type="text" class="form-control" id="toClient" name="to_client" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Project Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="recurringType" value="Recurring" checked>
                                <label class="form-check-label" for="recurringType">
                                    Recurring
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="hourlyType" value="Hourly">
                                <label class="form-check-label" for="hourlyType">
                                    Hourly
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div id="recurringRateField">
                                <label for="recurringRate" class="form-label">Recurring Rate ($)</label>
                                <input type="number" class="form-control" id="recurringRate" name="rate" step="0.01">
                            </div>
                            <div id="hourlyRateField" style="display: none;">
                                <label for="hourlyRate" class="form-label">Hourly Rate ($)</label>
                                <input type="number" class="form-control" id="hourlyRate" name="rate" step="0.01">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="paymentCycle" class="form-label">Payment Cycle</label>
                            <select class="form-select" id="paymentCycle" name="payment_cycle">
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

<!-- Task Modal (dynamic content) -->
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
                    <table class="table table-hover" id="tasksTable">
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
                            <!-- Tasks will be loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Task Modal (modified form) -->
<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <input type="hidden" id="taskProjectId" name="project_id">
                    
                    <div class="mb-3">
                        <label for="taskDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="taskDate" name="task_date" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskDetails" class="form-label">Task Details</label>
                        <textarea class="form-control" id="taskDetails" name="details" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskHours" class="form-label">Hours</label>
                        <input type="number" class="form-control" id="taskHours" name="hours" step="0.5" min="0.5" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskStatus" class="form-label">Status</label>
                        <select class="form-select" id="taskStatus" name="status">
                            <option value="WIP">Work in Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="clickupLink" class="form-label">ClickUp Link</label>
                        <input type="url" class="form-control" id="clickupLink" name="clickup_link">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Load projects when page loads
    loadProjects('all');
    
    // Load projects when tab changes
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        const target = $(e.target).attr('data-bs-target');
        if (target === '#all-projects') {
            loadProjects('all');
        } else if (target === '#sf-projects') {
            loadProjects('SF');
        } else if (target === '#other-projects') {
            loadProjects('Other');
        }
    });
    
    // Toggle between recurring and hourly rate fields
    $('input[name="type"]').change(function() {
        if ($(this).val() === 'Recurring') {
            $('#recurringRateField').show();
            $('#hourlyRateField').hide();
        } else {
            $('#recurringRateField').hide();
            $('#hourlyRateField').show();
        }
    });
    
    // Handle project form submission
    $('#projectForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php?action=create',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#newProjectModal').modal('hide');
                    $('#projectForm')[0].reset();
                    loadProjects('all');
                    loadProjects('SF');
                    loadProjects('Other');
                    alert('Project created successfully!');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.error);
            }
        });
    });
    
    // Handle task form submission
    $('#taskForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        $.ajax({
            url: 'tasks.php?action=create',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#newTaskModal').modal('hide');
                    $('#taskForm')[0].reset();
                    loadTasks($('#taskProjectId').val());
                    alert('Task added successfully!');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.error);
            }
        });
    });
    
    // When task modal opens, load tasks for the project
    $('#taskModal').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const projectId = button.data('project-id');
        const projectName = button.data('project-name');
        
        $('#taskModalLabel').text('Tasks for ' + projectName);
        $('#taskProjectId').val(projectId);
        loadTasks(projectId);
    });
});

function loadProjects(category) {
    let tableId = 'allProjectsTable';
    if (category === 'SF') tableId = 'sfProjectsTable';
    else if (category === 'Other') tableId = 'otherProjectsTable';
    
    $.ajax({
        url: 'projects.php?action=list&category=' + category,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const tbody = $('#' + tableId + ' tbody');
                tbody.empty();
                
                response.data.forEach(function(project) {
                    const typeBadge = project.type === 'Recurring' ? 
                        '<span class="badge bg-info">Recurring</span>' : 
                        '<span class="badge bg-warning">Hourly</span>';
                    
                    const rate = project.type === 'Recurring' ? 
                        '$' + project.rate : 
                        '$' + project.rate + '/hr';
                    
                    const row = `
                        <tr>
                            <td>
                                <a href="#" class="text-primary fw-bold">${project.name}</a>
                            </td>
                            <td>${project.from_company}</td>
                            <td>${project.to_client}</td>
                            <td>${typeBadge}</td>
                            <td>${rate}</td>
                            <td>${project.payment_cycle}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary view-tasks" 
                                    data-bs-toggle="modal" data-bs-target="#taskModal"
                                    data-project-id="${project.id}"
                                    data-project-name="${project.name}">
                                    View Tasks (${project.task_count || 0})
                                </button>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item view-tasks" href="#" data-bs-toggle="modal" data-bs-target="#taskModal"
                                            data-project-id="${project.id}" data-project-name="${project.name}">
                                            <i class="fas fa-tasks me-2"></i> Tasks
                                        </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `;
                    
                    tbody.append(row);
                });
            }
        },
        error: function(xhr) {
            alert('Error loading projects: ' + xhr.responseJSON.error);
        }
    });
}

function loadTasks(projectId) {
    $.ajax({
        url: 'tasks.php?action=list&project_id=' + projectId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const tbody = $('#tasksTable tbody');
                tbody.empty();
                
                response.data.forEach(function(task) {
                    const statusBadge = task.status === 'Completed' ? 
                        '<span class="badge bg-success">Completed</span>' : 
                        '<span class="badge bg-warning">WIP</span>';
                    
                    const clickupLink = task.clickup_link ? 
                        `<a href="${task.clickup_link}" target="_blank">View in ClickUp</a>` : 
                        'N/A';
                    
                    const row = `
                        <tr>
                            <td>${task.task_date}</td>
                            <td>${task.details}</td>
                            <td>${task.hours}</td>
                            <td>${statusBadge}</td>
                            <td>${clickupLink}</td>
                            <td>
                                <button class="btn btn-sm btn-light"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    `;
                    
                    tbody.append(row);
                });
            }
        },
        error: function(xhr) {
            alert('Error loading tasks: ' + xhr.responseJSON.error);
        }
    });
}
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