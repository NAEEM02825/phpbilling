<!-- Project/Task Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Task Management</h1>
        <p class="mb-0 text-muted">Manage Tasks and their associated projects</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                <i class="fas fa-plus me-1"></i> New Task
            </button>
        </div>
    </div>
</div>

<!-- Project Tabs -->
<ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button"
            role="tab">
            <i class="fas fa-project-diagram me-1"></i> Projects
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab">
            <i class="fas fa-tasks me-1"></i> All Tasks
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="my-tasks-tab" data-bs-toggle="tab" data-bs-target="#my-tasks" type="button"
            role="tab">
            <i class="fas fa-user-check me-1"></i> My Tasks
        </button>
    </li>
</ul>

<!-- Project/Task Content -->
<div class="tab-content" id="projectTabsContent">
    <!-- Projects Tab -->
    <div class="tab-pane fade show active" id="projects" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="projectsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Project</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Tasks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- All Tasks Tab -->
    <div class="tab-pane fade" id="tasks" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tasksTable">
                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Assignee</th>
                                <th>Status</th>
                                <th>ClickUp Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- My Tasks Tab -->
    <div class="tab-pane fade" id="my-tasks" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="myTasksTable">
                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th>ClickUp Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
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

<!-- New Task Modal -->
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

<!-- Add this new modal for editing tasks -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTaskForm">
                    <input type="hidden" id="editTaskId" name="task_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editTaskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="editTaskTitle" name="title" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editTaskProject" class="form-label">Project</label>
                            <select class="form-select" id="editTaskProject" name="project_id" required>
                                <option value="" selected disabled>Loading projects...</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editTaskDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="editTaskDate" name="task_date" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editTaskHours" class="form-label">Estimated Hours</label>
                            <input type="number" class="form-control" id="editTaskHours" name="hours" step="0.5"
                                min="0.5" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editTaskAssignee" class="form-label">Assignee</label>
                            <select class="form-select" id="editTaskAssignee" name="assignee_id" required>
                                <option value="" selected disabled>Loading users...</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editTaskStatus" class="form-label">Status</label>
                            <select class="form-select" id="editTaskStatus" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="editTaskDetails" class="form-label">Task Details</label>
                            <textarea class="form-control" id="editTaskDetails" name="details" rows="3"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="editClickupLink" class="form-label">ClickUp Link</label>
                            <input type="url" class="form-control" id="editClickupLink" name="clickup_link">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateTask()">Update Task</button>
            </div>
        </div>
    </div>
</div>

<style>
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

    .avatar {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .avatar-sm {
        width: 24px;
        height: 24px;
        font-size: 0.75rem;
    }

    .avatar-group .avatar {
        margin-right: -10px;
        border: 2px solid #fff;
        position: relative;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }

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

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .modal-header {
        border-radius: 0;
        border-bottom: none;
    }

    .modal-content {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        border: 1px solid #e9ecef;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3a4f8a;
        box-shadow: 0 0 0 0.25rem rgba(58, 79, 138, 0.25);
    }

    .btn-primary {
        background-color: #3a4f8a;
        border-color: #3a4f8a;
    }

    .btn-primary:hover {
        background-color: #2c3d6b;
        border-color: #2c3d6b;
    }

    .btn-outline-secondary:hover {
        color: #3a4f8a;
        border-color: #3a4f8a;
    }

    .progress {
        background-color: #f1f3f5;
    }

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
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the page
        loadProjects();
        loadTasks();

        // Set up modal event listeners
        const newTaskModal = document.getElementById('newTaskModal');
        if (newTaskModal) {
            newTaskModal.addEventListener('show.bs.modal', function () {
                loadProjectOptions();
                loadUserOptions();
            });
        }

        // Add event listener for edit modal show
        const editTaskModal = document.getElementById('editTaskModal');
        if (editTaskModal) {
            editTaskModal.addEventListener('show.bs.modal', function () {
                loadProjectOptions('editTaskProject');
                loadUserOptions('editTaskAssignee');
            });
        }

        // Set up save task button
        const saveTaskBtn = document.getElementById('saveTask');
        if (saveTaskBtn) {
            saveTaskBtn.addEventListener('click', function () {
                const taskForm = document.getElementById('taskForm');
                if (taskForm.checkValidity()) {
                    saveTask();
                } else {
                    taskForm.reportValidity();
                }
            });
        }

        // Set up tab change events
        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEls.forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function (event) {
                const target = event.target.getAttribute('data-bs-target');
                if (target === '#tasks') {
                    loadTasks();
                } else if (target === '#my-tasks') {
                    loadMyTasks();
                } else if (target === '#projects') {
                    loadProjects();
                }
            });
        });
    });

    async function loadProjects() {
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

            const tbody = document.querySelector('#projectsTable tbody');
            tbody.innerHTML = '';

            if (data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4">No projects found</td></tr>';
                return;
            }

            data.data.forEach(project => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>
                    <a href="#" class="text-primary fw-bold">${project.name}</a>
                    <small class="text-muted d-block">${project.from_company}</small>
                </td>
                <td>${project.to_client}</td>
                <td>${project.type}</td>
                <td>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: ${(project.completed_tasks / project.task_count) * 100 || 0}%" 
                             aria-valuenow="${project.completed_tasks}" 
                             aria-valuemin="0" 
                             aria-valuemax="${project.task_count}">
                        </div>
                    </div>
                    <small class="text-muted">${project.completed_tasks} of ${project.task_count} tasks</small>
                </td>
                <td><span class="badge ${project.completed_tasks == project.task_count ? 'bg-success' : 'bg-primary'}">
                    ${project.completed_tasks == project.task_count ? 'Completed' : 'In Progress'}
                </span></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                        </ul>
                    </div>
                </td>
            `;
                tbody.appendChild(row);
            });
        } catch (error) {
            showError('Error loading projects: ' + error.message);
        }
    }

    async function loadTasks() {
        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_tasks'
            });
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to load tasks');
            }

            const tbody = document.querySelector('#tasksTable tbody');
            tbody.innerHTML = '';

            if (data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4">No tasks found</td></tr>';
                return;
            }

            data.data.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <a href="#" class="text-primary fw-bold">
                            ${task.title ? task.title.substring(0, 30) : ''}
                            ${task.title && task.title.length > 30 ? '...' : ''}
                        </a>
                        <p class="mb-0 text-muted small">Details:
                            ${task.details ? task.details.substring(0, 50) : ''}
                            ${task.details && task.details.length > 50 ? '...' : ''}
                        </p>
                        <p class="mb-0 text-muted small">Created: ${new Date(task.created_at).toLocaleDateString()}</p>
                    </td>
                    <td>${task.project_name || 'No project'}</td>
                    <td>${new Date(task.task_date).toLocaleDateString()}</td>
                    <td>${task.hours || '0'}</td>
                    <td>
                        <span class="avatar avatar-sm rounded-circle bg-primary text-white">${task.assignee_initials}</span>
                        <span class="ms-2">${task.assignee_name}</span>
                    </td>
                    <td><span class="badge ${getStatusClass(task.status)}">${task.status}</span></td>
                    <td>
                        ${task.clickup_link ? `<a href="${task.clickup_link}" target="_blank" class="text-info">View</a>` : 'No link'}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="editTask(${task.id})"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteTask(${task.id})"><i class="fas fa-trash me-2"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        } catch (error) {
            showError('Error loading tasks: ' + error.message);
        }
    }

    async function loadMyTasks() {
        try {
            const response = await fetch('ajax_helpers/task_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_my_tasks'
            });
            const data = await response.json();

            if (!data.success || !data.tasks) {
                throw new Error(data.error || 'No tasks data received');
            }

            const tbody = document.querySelector('#myTasksTable tbody');
            tbody.innerHTML = '';

            if (data.tasks.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No tasks assigned to you</td></tr>';
                return;
            }

            data.tasks.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>
                    <a href="#" class="text-primary fw-bold">${task.title}</a>
                    <p class="mb-0 text-muted small">${task.details || 'No description'}</p>
                </td>
                <td>${task.project_name || 'No project'}</td>
                <td>${task.task_date}</td>
                <td>${task.hours || '0'}</td>
                <td><span class="badge ${getStatusClass(task.status)}">${formatStatus(task.status)}</span></td>
                <td>
                    ${task.clickup_link ? `<a href="${task.clickup_link}" target="_blank" class="text-info">View in ClickUp</a>` : 'No link'}
                </td>
                <td>
                    <button class="btn btn-sm btn-success me-1">Complete</button>
                    <button class="btn btn-sm btn-outline-secondary">Log Time</button>
                </td>
            `;
                tbody.appendChild(row);
            });
        } catch (error) {
            showError('Error loading your tasks: ' + error.message);
        }
    }

    // Modified loadProjectOptions to accept target select element
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

    // Modified loadUserOptions to accept target select element
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

    // New function to handle task deletion
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

    // New function to handle task editing
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


    // New function to handle task update
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

    function getStatusClass(status) {
        switch (status.toLowerCase()) {
            case 'pending': return 'bg-warning';
            case 'in progress': return 'bg-primary';
            case 'completed': return 'bg-success';
            default: return 'bg-secondary';
        }
    }

    function formatStatus(status) {
        return status.split('-').map(word =>
            word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
    }

    function showAlert(message, type = 'success') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
        alert.style.zIndex = '1100';
        alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

        document.body.appendChild(alert);

        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    }

    function showError(message) {
        showAlert(message, 'danger');
    }
</script>