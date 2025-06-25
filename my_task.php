
<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Task Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Task Management</h1>
            <p class="mb-0 text-muted">View and manage all your tasks</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                    <i class="fas fa-plus me-1"></i> New Task
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

    <!-- New Task Modal -->
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
                                <input type="text" class="form-control" id="taskTitle" placeholder="Enter task title" required>
                            </div>
                            <div class="col-md-6">
                                <label for="project" class="form-label">Project</label>
                                <select class="form-select" id="project" required>
                                    <option value="" selected disabled>Select project</option>
                                    <option value="1">Admin Dashboard</option>
                                    <option value="2">E-commerce Platform</option>
                                    <option value="3">Mobile App</option>
                                    <option value="4">Marketing Website</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" id="priority" required>
                                    <option value="" selected disabled>Select priority</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="dueDate" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="dueDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="assignee" class="form-label">Assignee</label>
                                <select class="form-select" id="assignee" required>
                                    <option value="" selected disabled>Select assignee</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Smith</option>
                                    <option value="3">Mike Johnson</option>
                                    <option value="4">Sarah Williams</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" required>
                                    <option value="" selected disabled>Select status</option>
                                    <option value="pending">Pending</option>
                                    <option value="in-progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="taskDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="taskDescription" rows="4" placeholder="Enter task description"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="taskAttachments" class="form-label">Attachments</label>
                                <input class="form-control" type="file" id="taskAttachments" multiple>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTask">Save Task</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Task Status Tabs -->
    <ul class="nav nav-tabs mb-4" id="taskTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                <i class="fas fa-list me-1"></i> All Tasks
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                <i class="fas fa-hourglass-half me-1"></i> Active
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                <i class="fas fa-check-circle me-1"></i> Completed
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="overdue-tab" data-bs-toggle="tab" data-bs-target="#overdue" type="button" role="tab">
                <i class="fas fa-exclamation-circle me-1"></i> Overdue
            </button>
        </li>
    </ul>

    <!-- Task Content -->
    <div class="tab-content" id="taskTabsContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <!-- Task Filters -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="projectFilter" class="form-label">Project</label>
                            <select class="form-select" id="projectFilter">
                                <option selected>All Projects</option>
                                <option>E-commerce Platform</option>
                                <option>Mobile App</option>
                                <option>Admin Dashboard</option>
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
                        <div class="col-md-3">
                            <label for="assigneeFilter" class="form-label">Assignee</label>
                            <select class="form-select" id="assigneeFilter">
                                <option selected>All Assignees</option>
                                <option>John Doe</option>
                                <option>Jane Smith</option>
                                <option>Mike Johnson</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Task List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th>Task</th>
                                    <th>Project</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Assignee</th>
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
                                        <a href="#" class="text-primary fw-bold">Dashboard redesign</a>
                                        <p class="mb-0 text-muted small">Redesign the admin dashboard UI</p>
                                    </td>
                                    <td>Admin Panel</td>
                                    <td><span class="badge bg-danger">High</span></td>
                                    <td>Jul 18, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-primary text-white">JD</span>
                                            </div>
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i> Mark Complete</a></li>
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
                                        <a href="#" class="text-primary fw-bold">User authentication</a>
                                        <p class="mb-0 text-muted small">Implement JWT authentication</p>
                                    </td>
                                    <td>BixiSoft Website</td>
                                    <td><span class="badge bg-warning">Medium</span></td>
                                    <td>Jul 15, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-success text-white">JS</span>
                                            </div>
                                            <span>Jane Smith</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-undo me-2"></i> Reopen</a></li>
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
                                        <a href="#" class="text-primary fw-bold">API documentation</a>
                                        <p class="mb-0 text-muted small">Document all API endpoints</p>
                                    </td>
                                    <td>Mobile App Backend</td>
                                    <td><span class="badge bg-info">Low</span></td>
                                    <td>Jul 20, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-warning text-white">MJ</span>
                                            </div>
                                            <span>Mike Johnson</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i> Mark Complete</a></li>
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
                                        <a href="#" class="text-primary fw-bold">Bug fixes</a>
                                        <p class="mb-0 text-muted small">Fix checkout process bugs</p>
                                    </td>
                                    <td>E-commerce Platform</td>
                                    <td><span class="badge bg-danger">High</span></td>
                                    <td>Jul 16, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-info text-white">JD</span>
                                            </div>
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">Overdue</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i> Mark Complete</a></li>
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
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> tasks</p>
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
        <div class="tab-pane fade" id="active" role="tabpanel">
            <!-- Active tasks content would go here -->
        </div>
        <div class="tab-pane fade" id="completed" role="tabpanel">
            <!-- Completed tasks content would go here -->
        </div>
        <div class="tab-pane fade" id="overdue" role="tabpanel">
            <!-- Overdue tasks content would go here -->
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Save task button functionality
    document.getElementById('saveTask').addEventListener('click', function() {
        // Here you would typically collect the form data and send it to the server
        // For now, we'll just close the modal
        var taskForm = document.getElementById('taskForm');
        if (taskForm.checkValidity()) {
            // Form is valid, proceed with saving
            var bootstrapModal = bootstrap.Modal.getInstance(document.getElementById('newTaskModal'));
            bootstrapModal.hide();
            
            // Show success message
            alert('Task created successfully!');
            
            // Reset form
            taskForm.reset();
        } else {
            // Form is invalid, show validation messages
            taskForm.reportValidity();
        }
    });
});
</script>

<style>
    /* Task Page Specific Styles */
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
     .modal-header {
        border-radius: 0;
        border-bottom: none;
    }
    
    .modal-content {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    /* Form Styles */
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        border: 1px solid #e9ecef;
    }
    
    .form-control:focus, .form-select:focus {
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
</style>