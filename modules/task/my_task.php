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
            <button class="nav-link active" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab">
                <i class="fas fa-project-diagram me-1"></i> Projects
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab">
                <i class="fas fa-tasks me-1"></i> All Tasks
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="my-tasks-tab" data-bs-toggle="tab" data-bs-target="#my-tasks" type="button" role="tab">
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
                                    <th>Assigned Users</th>
                                    <th>Tasks</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Will be populated by JavaScript -->
                                <tr>
                                    <td colspan="5" class="text-center py-4">
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
                                    <th>Status</th>
                                    <th>ClickUp Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Will be populated by JavaScript -->
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
                                <!-- Will be populated by JavaScript -->
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
    </div>


    <!-- Assign Users Modal -->
    <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="newTaskModalLabel">Create New Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="taskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" placeholder="Enter task title" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskProject" class="form-label">Project</label>
                            <select class="form-select" id="taskProject" name="project_id" required>
                                <option value="" selected disabled>Loading projects...</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="taskDate" name="due_date" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskHours" class="form-label">Estimated Hours</label>
                            <input type="number" class="form-control" id="taskHours" name="estimated_hours" step="0.5" min="0.5" placeholder="0.0" required>
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
                                <option value="pending" selected>Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="taskDetails" class="form-label">Task Details</label>
                            <textarea class="form-control" id="taskDetails" name="details" rows="3" placeholder="Detailed description of the task"></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label for="clickupLink" class="form-label">ClickUp Link</label>
                            <input type="url" class="form-control" id="clickupLink" name="clickup_link" placeholder="https://app.clickup.com/t/xxxxxx">
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
   

    <style>
        /* Project/Task Page Specific Styles */
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

        /* Avatar Styles */
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

        .avatar-group .avatar:last-child {
            margin-right: 0;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
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

        /* Modal Styles */
        .modal-header {
            border-radius: 0;
            border-bottom: none;
        }

        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        /* Form Styles */
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

        /* Button Styles */
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

        /* Progress Bar Styles */
        .progress {
            background-color: #f1f3f5;
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
        document.addEventListener('DOMContentLoaded', function() {
    // Load initial data
    loadProjects();
    loadTasks();
    
    // Modal show event - load dropdown options
    document.getElementById('newTaskModal').addEventListener('show.bs.modal', function() {
        loadProjectOptions();
        loadUserOptions();
    });
    
    // Save task button functionality
    document.getElementById('saveTask').addEventListener('click', function() {
        const taskForm = document.getElementById('taskForm');
        if (taskForm.checkValidity()) {
            saveTask();
        } else {
            taskForm.reportValidity();
        }
    });
    
    // Tab change events
    const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', function(event) {
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

function loadProjects() {
    fetch('task_handler.php?action=get_projects')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#projectsTable tbody');
                tbody.innerHTML = '';
                
                if (data.projects.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No projects found</td></tr>';
                    return;
                }
                
                data.projects.forEach(project => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <a href="#" class="text-primary fw-bold">${project.name}</a>
                        </td>
                        <td>
                            <div class="avatar-group">
                                <span class="avatar avatar-sm rounded-circle bg-primary text-white">${project.name.charAt(0)}</span>
                            </div>
                        </td>
                        <td>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">0 tasks</small>
                        </td>
                        <td><span class="badge bg-secondary">No tasks</span></td>
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
            } else {
                showError('Failed to load projects: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading projects: ' + error);
        });
}

function loadTasks() {
    fetch('task_handler.php?action=get_tasks')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#tasksTable tbody');
                tbody.innerHTML = '';
                
                if (data.tasks.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No tasks found</td></tr>';
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
                        <td>${task.due_date}</td>
                        <td>${task.estimated_hours || '0'}</td>
                        <td><span class="badge ${getStatusClass(task.status)}">${formatStatus(task.status)}</span></td>
                        <td>
                            ${task.clickup_link ? `<a href="${task.clickup_link}" target="_blank" class="text-info">View in ClickUp</a>` : 'No link'}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTaskModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                showError('Failed to load tasks: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading tasks: ' + error);
        });
}

function loadMyTasks() {
    // Similar to loadTasks but filtered for current user
    fetch('task_handler.php?action=get_tasks')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#myTasksTable tbody');
                tbody.innerHTML = '';
                
                // Filter tasks for current user (in a real app, you would filter on the server)
                const myTasks = data.tasks; // Replace with actual filter
                
                if (myTasks.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No tasks assigned to you</td></tr>';
                    return;
                }
                
                myTasks.forEach(task => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <a href="#" class="text-primary fw-bold">${task.title}</a>
                            <p class="mb-0 text-muted small">${task.details || 'No description'}</p>
                        </td>
                        <td>${task.project_name || 'No project'}</td>
                        <td>${task.due_date}</td>
                        <td>${task.estimated_hours || '0'}</td>
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
            } else {
                showError('Failed to load tasks: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading tasks: ' + error);
        });
}

function loadProjectOptions() {
    const select = document.getElementById('taskProject');
    select.innerHTML = '<option value="" selected disabled>Loading projects...</option>';
    
    fetch('task_handler.php?action=get_projects')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                select.innerHTML = '<option value="" selected disabled>Select project</option>';
                data.projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.id;
                    option.textContent = project.name;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="" selected disabled>Failed to load projects</option>';
            }
        })
        .catch(error => {
            select.innerHTML = '<option value="" selected disabled>Error loading projects</option>';
        });
}

function loadUserOptions() {
    const select = document.getElementById('taskAssignee');
    select.innerHTML = '<option value="" selected disabled>Loading users...</option>';
    
    fetch('task_handler.php?action=get_users')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                select.innerHTML = '<option value="" selected disabled>Select assignee</option>';
                data.users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="" selected disabled>Failed to load users</option>';
            }
        })
        .catch(error => {
            select.innerHTML = '<option value="" selected disabled>Error loading users</option>';
        });
}

function saveTask() {
    const form = document.getElementById('taskForm');
    const formData = new FormData(form);
    formData.append('action', 'create_task');
    
    fetch('task_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('newTaskModal'));
            modal.hide();
            
            // Show success message
            showAlert('Task created successfully!', 'success');
            
            // Reset form
            form.reset();
            
            // Reload tasks
            loadTasks();
        } else {
            showError('Failed to create task: ' + data.error);
        }
    })
    .catch(error => {
        showError('Error creating task: ' + error);
    });
}

function getStatusClass(status) {
    switch(status) {
        case 'pending': return 'bg-warning';
        case 'in-progress': return 'bg-primary';
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Load initial data
    loadProjects();
    loadTasks();
    
    // Modal show event - load dropdown options
    document.getElementById('newTaskModal').addEventListener('show.bs.modal', function() {
        loadProjectOptions();
        loadUserOptions();
    });
    
    // Save task button functionality
    document.getElementById('saveTask').addEventListener('click', function() {
        const taskForm = document.getElementById('taskForm');
        if (taskForm.checkValidity()) {
            saveTask();
        } else {
            taskForm.reportValidity();
        }
    });
    
    // Tab change events
    const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', function(event) {
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

function loadProjects() {
    fetch('task_handler.php?action=get_projects')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#projectsTable tbody');
                tbody.innerHTML = '';
                
                if (data.projects.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No projects found</td></tr>';
                    return;
                }
                
                data.projects.forEach(project => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <a href="#" class="text-primary fw-bold">${project.name}</a>
                        </td>
                        <td>
                            <div class="avatar-group">
                                <span class="avatar avatar-sm rounded-circle bg-primary text-white">${project.name.charAt(0)}</span>
                            </div>
                        </td>
                        <td>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">0 tasks</small>
                        </td>
                        <td><span class="badge bg-secondary">No tasks</span></td>
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
            } else {
                showError('Failed to load projects: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading projects: ' + error);
        });
}

function loadTasks() {
    fetch('task_handler.php?action=get_tasks')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#tasksTable tbody');
                tbody.innerHTML = '';
                
                if (data.tasks.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No tasks found</td></tr>';
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
                        <td>${task.due_date}</td>
                        <td>${task.estimated_hours || '0'}</td>
                        <td><span class="badge ${getStatusClass(task.status)}">${formatStatus(task.status)}</span></td>
                        <td>
                            ${task.clickup_link ? `<a href="${task.clickup_link}" target="_blank" class="text-info">View in ClickUp</a>` : 'No link'}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTaskModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                showError('Failed to load tasks: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading tasks: ' + error);
        });
}

function loadMyTasks() {
    // Similar to loadTasks but filtered for current user
    fetch('task_handler.php?action=get_tasks')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tbody = document.querySelector('#myTasksTable tbody');
                tbody.innerHTML = '';
                
                // Filter tasks for current user (in a real app, you would filter on the server)
                const myTasks = data.tasks; // Replace with actual filter
                
                if (myTasks.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No tasks assigned to you</td></tr>';
                    return;
                }
                
                myTasks.forEach(task => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <a href="#" class="text-primary fw-bold">${task.title}</a>
                            <p class="mb-0 text-muted small">${task.details || 'No description'}</p>
                        </td>
                        <td>${task.project_name || 'No project'}</td>
                        <td>${task.due_date}</td>
                        <td>${task.estimated_hours || '0'}</td>
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
            } else {
                showError('Failed to load tasks: ' + data.error);
            }
        })
        .catch(error => {
            showError('Error loading tasks: ' + error);
        });
}

function loadProjectOptions() {
    const select = document.getElementById('taskProject');
    select.innerHTML = '<option value="" selected disabled>Loading projects...</option>';
    
    fetch('task_handler.php?action=get_projects')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                select.innerHTML = '<option value="" selected disabled>Select project</option>';
                data.projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.id;
                    option.textContent = project.name;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="" selected disabled>Failed to load projects</option>';
            }
        })
        .catch(error => {
            select.innerHTML = '<option value="" selected disabled>Error loading projects</option>';
        });
}

function loadUserOptions() {
    const select = document.getElementById('taskAssignee');
    select.innerHTML = '<option value="" selected disabled>Loading users...</option>';
    
    fetch('task_handler.php?action=get_users')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                select.innerHTML = '<option value="" selected disabled>Select assignee</option>';
                data.users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="" selected disabled>Failed to load users</option>';
            }
        })
        .catch(error => {
            select.innerHTML = '<option value="" selected disabled>Error loading users</option>';
        });
}

function saveTask() {
    const form = document.getElementById('taskForm');
    const formData = new FormData(form);
    formData.append('action', 'create_task');
    
    fetch('task_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('newTaskModal'));
            modal.hide();
            
            // Show success message
            showAlert('Task created successfully!', 'success');
            
            // Reset form
            form.reset();
            
            // Reload tasks
            loadTasks();
        } else {
            showError('Failed to create task: ' + data.error);
        }
    })
    .catch(error => {
        showError('Error creating task: ' + error);
    });
}

function getStatusClass(status) {
    switch(status) {
        case 'pending': return 'bg-warning';
        case 'in-progress': return 'bg-primary';
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