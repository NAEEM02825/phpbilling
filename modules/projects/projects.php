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
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown"
                data-bs-toggle="dropdown">
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
        <button class="nav-link active" id="all-projects-tab" data-bs-toggle="tab" data-bs-target="#all-projects"
            type="button" role="tab">
            <i class="fas fa-list me-1"></i> All Projects
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
                            <label for="clientSelect" class="form-label"> To Client</label>
                            <select class="form-select" id="clientSelect" name="client_id">
                                <option value="">Select a client...</option>
                                <!-- Client options will be populated here -->
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>">
                                        <?php echo htmlspecialchars($client['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <!-- Keep the original to_client field as hidden for backward compatibility -->
                            <input type="hidden" id="toClient" name="to_client">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Project Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="recurringType"
                                    value="Recurring" checked>
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
                <div class="table-responsive">
                    <table class="table table-hover" id="tasksTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Task Details</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th>ClickUp Link</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="newTaskModalLabel">Create New Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="taskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title"
                                placeholder="Enter task title" required>
                        </div>

                        <div class="col-md-6">
                            <label for="taskProject" class="form-label">Project</label>
                            <select class="form-select" id="taskProject" name="project_id" required>
                                <option value="" selected disabled>Loading projects...</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="taskDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="taskDate" name="task_date" required>
                        </div>

                        <div class="col-md-6">
                            <label for="taskHours" class="form-label">Estimated Hours</label>
                            <input type="number" class="form-control" id="taskHours" name="hours" step="0.5" min="0.5"
                                placeholder="0.0" required>
                        </div>

                        <div class="col-md-6">
                            <label for="taskAssignee" class="form-label">Assignee</label>
                            <select class="form-select" id="taskAssignee" name="assignee_id" required>
                                <option value="" selected disabled>Loading users...</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="taskStatus" class="form-label">Status</label>
                            <select class="form-select" id="taskStatus" name="status" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="taskDetails" class="form-label">Task Details</label>
                            <textarea class="form-control" id="taskDetails" name="details" rows="3"
                                placeholder="Detailed description of the task"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="clickupLink" class="form-label">ClickUp Link</label>
                            <input type="url" class="form-control" id="clickupLink" name="clickup_link"
                                placeholder="https://app.clickup.com/t/xxxxxx">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveTask">Create Task</button>
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
          <div id="usersCheckboxList"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveUserAssignments">Save</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('clientSelect');
        select.disabled = true; // Disable while loading

        fetch('ajax_helpers/getClients.php')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(clients => {
                // Clear loading message
                select.innerHTML = '<option value="">Select a client...</option>';

                clients.forEach(client => {
                    const fullName = `${client.first_name} ${client.last_name}`;
                    const option = new Option(fullName, client.id);
                    select.add(option);
                });
                select.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message to user
                select.innerHTML = '<option value="">Failed to load clients</option>';
            });
    });
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
                $('#recurringRate').attr('name', 'rate').prop('disabled', false);
                $('#hourlyRate').removeAttr('name').prop('disabled', true);
            } else {
                $('#recurringRateField').hide();
                $('#hourlyRateField').show();
                $('#hourlyRate').attr('name', 'rate').prop('disabled', false);
                $('#recurringRate').removeAttr('name').prop('disabled', true);
            }
        });
        // Trigger change on page load to set correct state
        $('input[name="type"]:checked').trigger('change');

        // Handle project form submission
        $('#projectForm').submit(function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const editId = $(this).data('edit-id');
            let url = 'ajax_helpers/ajax_add_projects.php?action=create';

            if (editId) {
                url = 'ajax_helpers/ajax_add_projects.php?action=update&project_id=' + editId;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#newProjectModal').modal('hide');
                        $('#projectForm')[0].reset();
                        $('#projectForm').removeData('edit-id');
                        $('#newProjectModalLabel').text('Create New Project');
                        loadProjects('all');
                        loadProjects('SF');
                        loadProjects('Other');
                        alert(editId ? 'Project updated successfully!' : 'Project created successfully!');
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
                url: 'ajax_helpers/ajax_add_tasks.php?action=create',
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

        $('#newProjectModal').on('hidden.bs.modal', function() {
            $('#projectForm button[type="submit"]').text('Create Project');
            $('#newProjectModalLabel').text('Create New Project');
        });
    });

    function loadProjects(category) {
        let tableId = 'allProjectsTable';
        if (category === 'SF') tableId = 'sfProjectsTable';
        else if (category === 'Other') tableId = 'otherProjectsTable';

        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php?action=list&category=' + category,
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
    <div class="d-flex gap-2">
        <a href="#"
           class="btn btn-outline-secondary p-0 d-flex align-items-center justify-content-center action-view-project"
           style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;"
           title="View Project" data-id="${project.id}">
            <i class="fas fa-eye"></i>
        </a>
        <a href="#"
           class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center action-edit-project"
           style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;"
           title="Edit Project" data-id="${project.id}">
            <i class="fas fa-edit"></i>
        </a>
        <a href="#"
           class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center action-delete-project"
           style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;"
           title="Delete Project" data-id="${project.id}">
            <i class="fas fa-trash"></i>
        </a>
        <a href="#"
           class="btn btn-outline-info p-0 d-flex align-items-center justify-content-center view-tasks"
           style="width:32px;height:32px;border-radius:6px;border:1px solid #17a2b8;"
           title="View Tasks"
           data-bs-toggle="modal" data-bs-target="#taskModal"
           data-project-id="${project.id}" data-project-name="${project.name}">
            <i class="fas fa-tasks"></i>
        </a>
        <button class="btn btn-sm btn-outline-info assign-users-btn" data-project-id="${project.id}" title="Assign Users">
            <i class="fas fa-users"></i>
        </button>
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
    async function loadProjectOptions(targetId = 'taskProject') {
        const select = document.getElementById(targetId);
        select.innerHTML = '<option value="" selected disabled>Loading projects...</option>';

        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_projects'
            });
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to load projects');
            }

            select.innerHTML = '<option value="" selected disabled>Select project</option>';
            data.data.forEach(project => {
                const option = document.createElement('option');
                option.value = project.id;
                option.textContent = project.name;
                select.appendChild(option);
            });
        } catch (error) {
            select.innerHTML = '<option value="" selected disabled>Error loading projects</option>';
            showError('Error loading projects: ' + error.message);
        }
    }

    // Load User Options for Select Dropdowns
    async function loadUserOptions(targetId = 'taskAssignee') {
        const select = document.getElementById(targetId);
        select.innerHTML = '<option value="" selected disabled>Loading users...</option>';

        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_users'
            });
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to load users');
            }

            select.innerHTML = '<option value="" selected disabled>Select assignee</option>';
            data.users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.user_id;
                option.textContent = user.name;
                select.appendChild(option);
            });
        } catch (error) {
            select.innerHTML = '<option value="" selected disabled>Error loading users</option>';
            showError('Error loading users: ' + error.message);
        }
    }

    // Save New Task
    async function saveTask() {
        const form = document.getElementById('taskForm');
        const formData = new FormData(form);
        formData.append('action', 'create_task');

        // Validate required fields
        if (!formData.get('title') || !formData.get('project_id') || !formData.get('task_date') ||
            !formData.get('assignee_id') || !formData.get('status')) {
            showError('Please fill all required fields');
            return;
        }

        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to create task');
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('newTaskModal'));
            modal.hide();

            showAlert('Task created successfully!', 'success');
            form.reset();
            loadTasks();
        } catch (error) {
            showError('Error creating task: ' + error.message);
        }
    }

    // Delete Task
    async function deleteTask(taskId) {
        if (!confirm('Are you sure you want to delete this task?')) return;

        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=delete_task&task_id=${taskId}`
            });
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to delete task');
            }

            showAlert('Task deleted successfully!', 'success');
            loadTasks();
        } catch (error) {
            showError('Error deleting task: ' + error.message);
        }
    }

    // Edit Task - Load Data into Modal
    async function editTask(taskId) {
        try {
            // First fetch task details
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=get_task_details&task_id=${taskId}`
            });
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to load task details');
            }

            const task = data.data.task;

            // Populate the edit modal
            document.getElementById('editTaskTitle').value = task.title;
            document.getElementById('editTaskProject').value = task.project_id;
            document.getElementById('editTaskDate').value = task.task_date;
            document.getElementById('editTaskHours').value = task.hours;
            document.getElementById('editTaskAssignee').value = task.assignee_id;
            document.getElementById('editTaskStatus').value = task.status;
            document.getElementById('editTaskDetails').value = task.details || '';
            document.getElementById('editClickupLink').value = task.clickup_link || '';
            document.getElementById('editTaskId').value = task.id;

            // Show the modal
            const editModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
            editModal.show();
        } catch (error) {
            showError('Error loading task details: ' + error.message);
        }
    }

    // Update Task
    async function updateTask() {
        const form = document.getElementById('editTaskForm');
        const formData = new FormData(form);
        formData.append('action', 'update_task');

        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to update task');
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('editTaskModal'));
            modal.hide();

            showAlert('Task updated successfully!', 'success');
            loadTasks();
        } catch (error) {
            showError('Error updating task: ' + error.message);
        }
    }

    $(document).on('click', '.action-edit-project', function(e) {
        e.preventDefault();
        const projectId = $(this).data('id');

        // Fetch project data from the server
        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php?action=get&project_id=' + projectId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.data) {
                    const project = response.data;

                    // Fill modal fields
                    $('#newProjectModalLabel').text('Edit Project');
                    $('#projectForm button[type="submit"]').text('Update Project'); // <-- Add this line
                    $('#projectName').val(project.name);
                    $('#fromCompany').val(project.from_company);
                    $('#toClient').val(project.to_client);
                    $('input[name="type"][value="' + project.type + '"]').prop('checked', true).trigger('change');
                    $('#recurringRate').val(project.type === 'Recurring' ? project.rate : '');
                    $('#hourlyRate').val(project.type === 'Hourly' ? project.rate : '');
                    $('#paymentCycle').val(project.payment_cycle);

                    // Store project ID for update
                    $('#projectForm').data('edit-id', project.id);

                    // Show modal
                    $('#newProjectModal').modal('show');
                } else {
                    alert('Could not load project data.');
                }
            },
            error: function() {
                alert('Error loading project data.');
            }
        });
    });
    $(document).on('click', '.action-delete-project', function(e) {
        e.preventDefault();
        const projectId = $(this).data('id');
        if (!confirm('Are you sure you want to delete this project? This action cannot be undone.')) return;

        $.ajax({
            url: 'ajax_helpers/ajax_add_projects.php?action=delete&project_id=' + projectId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadProjects('all');
                    alert('Project deleted successfully!');
                } else {
                    alert(response.error || 'Failed to delete project.');
                }
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON?.error || 'Failed to delete project.'));
            }
        });
    });

    function loadTasks(projectId) {
        $.ajax({
            url: 'ajax_helpers/ajax_add_tasks.php?action=list&project_id=' + projectId,
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
                            <td>${task.title || ''}</td>
                            <td>${task.task_date}</td>
                            <td>${task.details}</td>
                            <td>${task.hours}</td>
                            <td>${statusBadge}</td>
                            <td>${clickupLink}</td>
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

    // Assign Users to Project
    $(document).on('click', '.assign-users-btn', function() {
        const projectId = $(this).data('project-id');
        $('#assignProjectId').val(projectId);
        // Load all users
        $.get('ajax_helpers/ajax_get_user.php', {action: 'get_users'}, function(data) {
            let html = '';
            data.data.forEach(u => {
                html += `<div class="form-check">
                <input class="form-check-input" type="checkbox" value="${u.user_id}" id="userCheck${u.user_id}" name="user_ids[]">
                <label class="form-check-label" for="userCheck${u.user_id}">${u.first_name} ${u.last_name}</label>
            </div>`;
            });
            $('#usersCheckboxList').html(html);
            // Load project's assigned users
            $.get('ajax_helpers/user_project_assign.php', {action: 'get_project_users', project_id: projectId}, function(res) {
                if (res.success) {
                    res.users.forEach(u => {
                        $(`#userCheck${u.id}`).prop('checked', true);
                    });
                }
                $('#assignUsersModal').modal('show');
            });
        });
    });

    $('#saveUserAssignments').on('click', function() {
        const projectId = $('#assignProjectId').val();
        const userIds = $('#assignUsersForm input[name="user_ids[]"]:checked').map(function(){return this.value;}).get();
        $.post('ajax_helpers/user_project_assign.php', {action: 'assign_users_to_project', project_id: projectId, user_ids: userIds}, function(res) {
            if (res.success) {
                $('#assignUsersModal').modal('hide');
                alert('Users assigned!');
            } else {
                alert(res.error || 'Failed to assign users');
            }
        }, 'json');
    });
</script>

<!-- Keep your existing styles -->
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