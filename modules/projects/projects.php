<!-- Add these CDN links at the top of your file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <h3 class="mb-0">
                    <?php echo date('M d', strtotime('-7 days')) . ' - ' . date('M d', strtotime('-1 day')); ?>
                </h3>
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
            <i class="fas fa-cloud me-1"></i> SF Projects
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="other-projects-tab" data-bs-toggle="tab" data-bs-target="#other-projects" type="button" role="tab">
            <i class="fas fa-cubes me-1"></i> Other Projects
        </button>
    </li>
</ul>

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

<!-- New Project Modal -->
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
                            <label for="projectName" class="form-label">Project Name*</label>
                            <input type="text" class="form-control" id="projectName" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="fromCompany" class="form-label">From Company*</label>
                            <input type="text" class="form-control" id="fromCompany" name="from_company" required>
                        </div>

                        <div class="col-md-6">
                            <label for="clientSelect" class="form-label">To Client*</label>
                            <select class="form-select" id="clientSelect" name="client_id" required>
                                <option value="">Select a client...</option>
                                <!-- Client options will be populated here -->
                            </select>
                            <input type="hidden" id="toClient" name="to_client">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Project Type*</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="recurringType" value="Recurring" checked>
                                <label class="form-check-label" for="recurringType">Recurring</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="hourlyType" value="Hourly">
                                <label class="form-check-label" for="hourlyType">Hourly</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="recurringRateField">
                                <label for="recurringRate" class="form-label">Recurring Rate ($)*</label>
                                <input type="number" class="form-control" id="recurringRate" name="rate" step="0.01" required>
                            </div>
                            <div id="hourlyRateField" style="display: none;">
                                <label for="hourlyRate" class="form-label">Hourly Rate ($)*</label>
                                <input type="number" class="form-control" id="hourlyRate" name="rate" step="0.01" disabled required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="paymentCycle" class="form-label">Payment Cycle*</label>
                            <select class="form-select" id="paymentCycle" name="payment_cycle" required>
                                <option value="weekly">Weekly</option>
                                <option value="15days">15 Days</option>
                                <option value="monthly" selected>Monthly</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveProjectBtn">Save Project</button>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Project Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-sm btn-primary" id="addTaskBtn">
                        <i class="fas fa-plus me-1"></i> Add Task
                    </button>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control form-control-sm" id="taskSearch" placeholder="Search tasks...">
                        <select class="form-select form-select-sm" id="taskStatusFilter" style="width: 150px;">
                            <option value="">All Statuses</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tasksTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Details</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th>Assignee</th>
                                <th>ClickUp</th>
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

<!-- New/Edit Task Modal -->
<div class="modal fade" id="taskFormModal" tabindex="-1" aria-labelledby="taskFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="taskFormModalLabel">Create New Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <input type="hidden" id="taskId" name="task_id">
                    <input type="hidden" id="taskProjectId" name="project_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="taskTitle" class="form-label">Task Title*</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" required>
                        </div>
                        <div class="col-md-6">
                            <label for="taskDate" class="form-label">Date*</label>
                            <input type="date" class="form-control" id="taskDate" name="task_date" required>
                        </div>
                        <div class="col-md-4">
                            <label for="taskHours" class="form-label">Hours*</label>
                            <input type="number" class="form-control" id="taskHours" name="hours" step="0.5" min="0.5" required>
                        </div>
                        <div class="col-md-4">
                            <label for="taskAssignee" class="form-label">Assignee*</label>
                            <select class="form-select" id="taskAssignee" name="assignee_id" required>
                                <option value="">Loading users...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="taskStatus" class="form-label">Status*</label>
                            <select class="form-select" id="taskStatus" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="taskDetails" class="form-label">Task Details</label>
                            <textarea class="form-control" id="taskDetails" name="details" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="clickupLink" class="form-label">ClickUp Link</label>
                            <input type="url" class="form-control" id="clickupLink" name="clickup_link">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveTaskBtn">Save Task</button>
            </div>
        </div>
    </div>
</div>

<!-- Assign Users Modal -->
<div class="modal fade" id="assignUsersModal" tabindex="-1" aria-labelledby="assignUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignUsersModalLabel">Assign Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="assignUsersForm">
                    <input type="hidden" id="assignProjectId" name="project_id">
                    <div id="usersCheckboxList" class="d-flex flex-column gap-2"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveUserAssignments">Save Assignments</button>
            </div>
        </div>
    </div>
</div>

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

    .badge.bg-success {
        background-color: #28a745 !important;
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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
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

<script>
$(document).ready(function() {
    // Initialize variables
    let currentProjectTab = 'all';
    let currentProjectId = null;
    const perPage = 10;
    
    // Initialize modals
    const newProjectModal = new bootstrap.Modal('#newProjectModal');
    const taskModal = new bootstrap.Modal('#taskModal');
    const taskFormModal = new bootstrap.Modal('#taskFormModal');
    const assignUsersModal = new bootstrap.Modal('#assignUsersModal');

    // Load initial data
    loadClients();
    loadProjects('all');

    // Tab change handler
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        const target = $(e.target).attr('data-bs-target');
        if (target === '#all-projects') {
            currentProjectTab = 'all';
            loadProjects('all');
        } else if (target === '#sf-projects') {
            currentProjectTab = 'SF';
            loadProjects('SF');
        } else if (target === '#other-projects') {
            currentProjectTab = 'Other';
            loadProjects('Other');
        }
    });

    // Toggle between recurring and hourly rate fields
    $('input[name="type"]').change(function() {
        if ($(this).val() === 'Recurring') {
            $('#recurringRateField').show();
            $('#hourlyRateField').hide();
            $('#recurringRate').prop('disabled', false).attr('required', true);
            $('#hourlyRate').prop('disabled', true).removeAttr('required');
        } else {
            $('#recurringRateField').hide();
            $('#hourlyRateField').show();
            $('#hourlyRate').prop('disabled', false).attr('required', true);
            $('#recurringRate').prop('disabled', true).removeAttr('required');
        }
    });

    // Load clients for select dropdown
    function loadClients() {
        $.ajax({
            url: 'ajax_helpers/getClients.php',
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#clientSelect').html('<option value="">Loading clients...</option>');
            },
            success: function(response) {
                if (response.success) {
                    $('#clientSelect').html('<option value="">Select a client...</option>');
                    response.data.forEach(client => {
                        const fullName = `${client.first_name} ${client.last_name}`;
                        $('#clientSelect').append(`<option value="${client.id}">${fullName}</option>`);
                    });
                } else {
                    showError('Failed to load clients: ' + response.message);
                    $('#clientSelect').html('<option value="">Error loading clients</option>');
                }
            },
            error: function(xhr) {
                showError('Failed to load clients');
                $('#clientSelect').html('<option value="">Error loading clients</option>');
            }
        });
    }

    // Load projects
    function loadProjects(category) {
        const tableId = `${category.toLowerCase()}ProjectsTable`;
        
        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php',
            type: 'GET',
            data: { 
                action: 'list',
                category: category 
            },
            dataType: 'json',
            beforeSend: function() {
                $(`#${tableId} tbody`).html(`
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                `);
            },
            success: function(response) {
                if (response.success) {
                    renderProjectsTable(response.data, tableId);
                } else {
                    showError(response.message || 'Failed to load projects');
                    $(`#${tableId} tbody`).html(`
                        <tr>
                            <td colspan="8" class="text-center py-4">No projects found</td>
                        </tr>
                    `);
                }
            },
            error: function(xhr) {
                showError('Failed to load projects');
                $(`#${tableId} tbody`).html(`
                    <tr>
                        <td colspan="8" class="text-center py-4">Error loading projects</td>
                    </tr>
                `);
            }
        });
    }

    // Render projects table
    function renderProjectsTable(projects, tableId) {
        const tbody = $(`#${tableId} tbody`);
        tbody.empty();

        if (projects.length === 0) {
            tbody.html(`
                <tr>
                    <td colspan="8" class="text-center py-4">No projects found</td>
                </tr>
            `);
            return;
        }

        projects.forEach(project => {
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
                            data-project-id="${project.id}"
                            data-project-name="${project.name}">
                            View Tasks (${project.task_count || 0})
                        </button>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary action-btn action-view-project" 
                                title="View Project" data-id="${project.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-primary action-btn action-edit-project" 
                                title="Edit Project" data-id="${project.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger action-btn action-delete-project" 
                                title="Delete Project" data-id="${project.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="btn btn-outline-info action-btn view-tasks" 
                                title="View Tasks"
                                data-project-id="${project.id}" 
                                data-project-name="${project.name}">
                                <i class="fas fa-tasks"></i>
                            </button>
                            <button class="btn btn-outline-success action-btn assign-users-btn" 
                                title="Assign Users" data-project-id="${project.id}">
                                <i class="fas fa-users"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Save project handler
    $('#saveProjectBtn').click(function() {
        const formData = $('#projectForm').serializeArray();
        const editId = $('#projectForm').data('edit-id');
        const action = editId ? 'update' : 'create';
        
        // Set to_client value from client_id
        const clientId = $('#clientSelect').val();
        const clientName = $('#clientSelect option:selected').text();
        formData.push({name: 'to_client', value: clientName});
        
        // Validate form
        if (!validateProjectForm()) {
            return;
        }

        $.ajax({
            url: `ajax_helpers/ajax_add_projects.php?action=${action}` + (editId ? `&project_id=${editId}` : ''),
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#saveProjectBtn').prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                `);
            },
            success: function(response) {
                $('#saveProjectBtn').prop('disabled', false).html('Save Project');
                
                if (response.success) {
                    newProjectModal.hide();
                    $('#projectForm')[0].reset();
                    $('#projectForm').removeData('edit-id');
                    $('#newProjectModalLabel').text('Create New Project');
                    
                    showSuccess(response.message || (action === 'create' ? 'Project created successfully!' : 'Project updated successfully!'));
                    
                    // Reload all project tabs
                    loadProjects('all');
                    loadProjects('SF');
                    loadProjects('Other');
                } else {
                    showError(response.message || 'Failed to save project');
                }
            },
            error: function(xhr) {
                $('#saveProjectBtn').prop('disabled', false).html('Save Project');
                showError('Failed to save project');
            }
        });
    });

    // Project form validation
    function validateProjectForm() {
        let isValid = true;
        
        // Reset validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Validate required fields
        const requiredFields = [
            '#projectName', '#fromCompany', '#clientSelect', 
            $('input[name="type"]:checked').val() === 'Recurring' ? '#recurringRate' : '#hourlyRate'
        ];
        
        requiredFields.forEach(field => {
            if (!$(field).val()) {
                $(field).addClass('is-invalid');
                $(field).after(`<div class="invalid-feedback">This field is required</div>`);
                isValid = false;
            }
        });
        
        return isValid;
    }

    // Edit project handler
    $(document).on('click', '.action-edit-project', function() {
        const projectId = $(this).data('id');
        
        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php?action=get&project_id=' + projectId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading project...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                Swal.close();
                
                if (response.success && response.data) {
                    const project = response.data;
                    
                    // Fill modal fields
                    $('#newProjectModalLabel').text('Edit Project');
                    $('#projectForm button[type="submit"]').text('Update Project');
                    $('#projectName').val(project.name);
                    $('#fromCompany').val(project.from_company);
                    $('#toClient').val(project.to_client);
                    $('#clientSelect').val(project.client_id || '');
                    $(`input[name="type"][value="${project.type}"]`).prop('checked', true).trigger('change');
                    
                    if (project.type === 'Recurring') {
                        $('#recurringRate').val(project.rate);
                    } else {
                        $('#hourlyRate').val(project.rate);
                    }
                    
                    $('#paymentCycle').val(project.payment_cycle);
                    
                    // Store project ID for update
                    $('#projectForm').data('edit-id', project.id);
                    
                    // Show modal
                    newProjectModal.show();
                } else {
                    showError(response.message || 'Failed to load project data');
                }
            },
            error: function() {
                Swal.close();
                showError('Failed to load project data');
            }
        });
    });

    // Delete project handler
    $(document).on('click', '.action-delete-project', function() {
        const projectId = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3a4f8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax_helpers/ajax_add_projects.php?action=delete&project_id=' + projectId,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Deleting project...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        
                        if (response.success) {
                            showSuccess(response.message || 'Project deleted successfully!');
                            
                            // Reload all project tabs
                            loadProjects('all');
                            loadProjects('SF');
                            loadProjects('Other');
                        } else {
                            showError(response.message || 'Failed to delete project');
                        }
                    },
                    error: function() {
                        Swal.close();
                        showError('Failed to delete project');
                    }
                });
            }
        });
    });

    // View tasks handler
    $(document).on('click', '.view-tasks', function() {
        currentProjectId = $(this).data('project-id');
        const projectName = $(this).data('project-name');
        
        $('#taskModalLabel').text(`Tasks for ${projectName}`);
        $('#taskProjectId').val(currentProjectId);
        
        loadTasks(currentProjectId);
        taskModal.show();
    });

    // Load tasks for a project
    function loadTasks(projectId) {
        $.ajax({
            url: 'ajax_helpers/ajax_add_tasks.php',
            type: 'GET',
            data: { 
                action: 'list',
                project_id: projectId 
            },
            dataType: 'json',
            beforeSend: function() {
                $('#tasksTable tbody').html(`
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                `);
            },
            success: function(response) {
                if (response.success) {
                    renderTasksTable(response.data);
                } else {
                    showError(response.message || 'Failed to load tasks');
                    $('#tasksTable tbody').html(`
                        <tr>
                            <td colspan="8" class="text-center py-4">No tasks found</td>
                        </tr>
                    `);
                }
            },
            error: function() {
                showError('Failed to load tasks');
                $('#tasksTable tbody').html(`
                    <tr>
                        <td colspan="8" class="text-center py-4">Error loading tasks</td>
                    </tr>
                `);
            }
        });
    }

    // Render tasks table
    function renderTasksTable(tasks) {
        const tbody = $('#tasksTable tbody');
        tbody.empty();

        if (tasks.length === 0) {
            tbody.html(`
                <tr>
                    <td colspan="8" class="text-center py-4">No tasks found</td>
                </tr>
            `);
            return;
        }

        tasks.forEach(task => {
            const statusBadge = task.status === 'Completed' ? 
                '<span class="badge bg-success">Completed</span>' : 
                task.status === 'In Progress' ? 
                '<span class="badge bg-warning">In Progress</span>' : 
                '<span class="badge bg-secondary">Pending</span>';

            const clickupLink = task.clickup_link ? 
                `<a href="${task.clickup_link}" target="_blank" class="text-primary">View</a>` : 
                'N/A';

            const row = `
                <tr>
                    <td>${task.title}</td>
                    <td>${task.task_date}</td>
                    <td>${task.details || '-'}</td>
                    <td>${task.hours}</td>
                    <td>${statusBadge}</td>
                    <td>${task.assignee_name || '-'}</td>
                    <td>${clickupLink}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm action-edit-task" 
                                title="Edit Task" data-task-id="${task.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm action-delete-task" 
                                title="Delete Task" data-task-id="${task.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Add new task handler
    $('#addTaskBtn').click(function() {
        $('#taskFormModalLabel').text('Create New Task');
        $('#taskForm')[0].reset();
        $('#taskId').val('');
        $('#taskProjectId').val(currentProjectId);
        $('#saveTaskBtn').text('Create Task');
        
        loadUsersForTaskForm();
        taskFormModal.show();
    });

    // Edit task handler
    $(document).on('click', '.action-edit-task', function() {
        const taskId = $(this).data('task-id');
        
        $.ajax({
            url: 'ajax_helpers/ajax_add_tasks.php?action=get&task_id=' + taskId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading task...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                Swal.close();
                
                if (response.success && response.data) {
                    const task = response.data;
                    
                    $('#taskFormModalLabel').text('Edit Task');
                    $('#taskId').val(task.id);
                    $('#taskProjectId').val(task.project_id);
                    $('#taskTitle').val(task.title);
                    $('#taskDate').val(task.task_date);
                    $('#taskHours').val(task.hours);
                    $('#taskDetails').val(task.details || '');
                    $('#clickupLink').val(task.clickup_link || '');
                    $('#taskStatus').val(task.status);
                    
                    // Load users and set the selected one
                    loadUsersForTaskForm(task.assignee_id);
                    
                    $('#saveTaskBtn').text('Update Task');
                    taskFormModal.show();
                } else {
                    showError(response.message || 'Failed to load task data');
                }
            },
            error: function() {
                Swal.close();
                showError('Failed to load task data');
            }
        });
    });

    // Load users for task form
    function loadUsersForTaskForm(selectedUserId = null) {
        $.ajax({
            url: 'ajax_helpers/ajax_get_user.php',
            type: 'GET',
            data: { action: 'get_users' },
            dataType: 'json',
            beforeSend: function() {
                $('#taskAssignee').html('<option value="">Loading users...</option>');
            },
            success: function(response) {
                if (response.success) {
                    $('#taskAssignee').html('<option value="">Select assignee...</option>');
                    
                    response.data.forEach(user => {
                        const fullName = `${user.first_name} ${user.last_name}`;
                        const option = new Option(fullName, user.user_id);
                        if (selectedUserId && user.user_id == selectedUserId) {
                            option.selected = true;
                        }
                        $('#taskAssignee').append(option);
                    });
                } else {
                    showError(response.message || 'Failed to load users');
                    $('#taskAssignee').html('<option value="">Error loading users</option>');
                }
            },
            error: function() {
                showError('Failed to load users');
                $('#taskAssignee').html('<option value="">Error loading users</option>');
            }
        });
    }

    // Save task handler
    $('#saveTaskBtn').click(function() {
        const formData = $('#taskForm').serializeArray();
        const taskId = $('#taskId').val();
        const action = taskId ? 'update' : 'create';
        
        // Validate form
        if (!validateTaskForm()) {
            return;
        }

        $.ajax({
            url: `ajax_helpers/ajax_add_tasks.php?action=${action}` + (taskId ? `&task_id=${taskId}` : ''),
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#saveTaskBtn').prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                `);
            },
            success: function(response) {
                $('#saveTaskBtn').prop('disabled', false).html(taskId ? 'Update Task' : 'Create Task');
                
                if (response.success) {
                    taskFormModal.hide();
                    $('#taskForm')[0].reset();
                    
                    showSuccess(response.message || (action === 'create' ? 'Task created successfully!' : 'Task updated successfully!'));
                    
                    // Reload tasks
                    loadTasks(currentProjectId);
                } else {
                    showError(response.message || 'Failed to save task');
                }
            },
            error: function() {
                $('#saveTaskBtn').prop('disabled', false).html(taskId ? 'Update Task' : 'Create Task');
                showError('Failed to save task');
            }
        });
    });

    // Task form validation
    function validateTaskForm() {
        let isValid = true;
        
        // Reset validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Validate required fields
        const requiredFields = ['#taskTitle', '#taskDate', '#taskHours', '#taskAssignee', '#taskStatus'];
        
        requiredFields.forEach(field => {
            if (!$(field).val()) {
                $(field).addClass('is-invalid');
                $(field).after(`<div class="invalid-feedback">This field is required</div>`);
                isValid = false;
            }
        });
        
        // Validate hours
        const hours = parseFloat($('#taskHours').val());
        if (isNaN(hours) {
            $('#taskHours').addClass('is-invalid');
            $('#taskHours').after(`<div class="invalid-feedback">Please enter a valid number</div>`);
            isValid = false;
        } else if (hours < 0.5) {
            $('#taskHours').addClass('is-invalid');
            $('#taskHours').after(`<div class="invalid-feedback">Minimum 0.5 hours required</div>`);
            isValid = false;
        }
        
        return isValid;
    }

    // Delete task handler
    $(document).on('click', '.action-delete-task', function() {
        const taskId = $(this).data('task-id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3a4f8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax_helpers/ajax_add_tasks.php?action=delete&task_id=' + taskId,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Deleting task...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        
                        if (response.success) {
                            showSuccess(response.message || 'Task deleted successfully!');
                            loadTasks(currentProjectId);
                        } else {
                            showError(response.message || 'Failed to delete task');
                        }
                    },
                    error: function() {
                        Swal.close();
                        showError('Failed to delete task');
                    }
                });
            }
        });
    });

    // Assign users to project handler
    $(document).on('click', '.assign-users-btn', function() {
        const projectId = $(this).data('project-id');
        $('#assignProjectId').val(projectId);
        
        // Load all users
        $.ajax({
            url: 'ajax_helpers/ajax_get_user.php',
            type: 'GET',
            data: { action: 'get_users' },
            dataType: 'json',
            beforeSend: function() {
                $('#usersCheckboxList').html(`
                    <div class="text-center py-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);
            },
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(user => {
                        html += `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="${user.user_id}" 
                                id="userCheck${user.user_id}" name="user_ids[]">
                            <label class="form-check-label" for="userCheck${user.user_id}">
                                ${user.first_name} ${user.last_name}
                            </label>
                        </div>
                        `;
                    });
                    $('#usersCheckboxList').html(html);
                    
                    // Load project's assigned users
                    loadAssignedUsers(projectId);
                } else {
                    showError(response.message || 'Failed to load users');
                    $('#usersCheckboxList').html('<div class="text-danger">Error loading users</div>');
                }
            },
            error: function() {
                showError('Failed to load users');
                $('#usersCheckboxList').html('<div class="text-danger">Error loading users</div>');
            }
        });
    });

    // Load assigned users for a project
    function loadAssignedUsers(projectId) {
        $.ajax({
            url: 'ajax_helpers/user_project_assign.php',
            type: 'GET',
            data: { 
                action: 'get_project_users',
                project_id: projectId 
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Check the checkboxes for assigned users
                    response.users.forEach(user => {
                        $(`#userCheck${user.id}`).prop('checked', true);
                    });
                    
                    // Show the modal
                    assignUsersModal.show();
                } else {
                    showError(response.message || 'Failed to load assigned users');
                }
            },
            error: function() {
                showError('Failed to load assigned users');
            }
        });
    }

    // Save user assignments
    $('#saveUserAssignments').click(function() {
        const projectId = $('#assignProjectId').val();
        const userIds = $('#assignUsersForm input[name="user_ids[]"]:checked').map(function() {
            return this.value;
        }).get();
        
        $.ajax({
            url: 'ajax_helpers/user_project_assign.php',
            type: 'POST',
            data: { 
                action: 'assign_users_to_project',
                project_id: projectId,
                user_ids: userIds 
            },
            dataType: 'json',
            beforeSend: function() {
                $('#saveUserAssignments').prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...
                `);
            },
            success: function(response) {
                $('#saveUserAssignments').prop('disabled', false).html('Save Assignments');
                
                if (response.success) {
                    assignUsersModal.hide();
                    showSuccess(response.message || 'Users assigned successfully!');
                } else {
                    showError(response.message || 'Failed to assign users');
                }
            },
            error: function() {
                $('#saveUserAssignments').prop('disabled', false).html('Save Assignments');
                showError('Failed to assign users');
            }
        });
    });

    // Search tasks
    $('#taskSearch').on('keyup', function() {
        const searchText = $(this).val().toLowerCase();
        $('#tasksTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
    });

    // Filter tasks by status
    $('#taskStatusFilter').change(function() {
        const status = $(this).val();
        if (status) {
            $('#tasksTable tbody tr').hide();
            $(`#tasksTable tbody tr:contains("${status}")`).show();
        } else {
            $('#tasksTable tbody tr').show();
        }
    });

    // Helper function to show success message
    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            timer: 3000,
            showConfirmButton: false
        });
    }

    // Helper function to show error message
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            timer: 3000,
            showConfirmButton: false
        });
    }
});
</script>