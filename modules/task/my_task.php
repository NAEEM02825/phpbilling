    <!-- Project/Task Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Project & Task Management</h1>
            <p class="mb-0 text-muted">Manage projects and their associated tasks</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                    <i class="fas fa-plus me-1"></i> New Project
                </button>
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
                        <table class="table table-hover align-middle mb-0">
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
                                <!-- SF 1 Project -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 1</a>
                                        <p class="mb-0 text-muted small">Client A</p>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <span class="avatar avatar-sm rounded-circle bg-primary text-white" title="John Doe">JD</span>
                                            <span class="avatar avatar-sm rounded-circle bg-success text-white" title="Jane Smith">JS</span>
                                            <span class="avatar avatar-sm rounded-circle bg-info text-white" title="Mike Johnson">MJ</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted">12/16 tasks completed</small>
                                    </td>
                                    <td><span class="badge bg-primary">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions1">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewProjectModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editProjectModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignUsersModal"><i class="fas fa-users me-2"></i> Assign Users</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- SF 2 Project -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">SF 2</a>
                                        <p class="mb-0 text-muted small">Client B</p>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <span class="avatar avatar-sm rounded-circle bg-warning text-white" title="Sarah Williams">SW</span>
                                            <span class="avatar avatar-sm rounded-circle bg-danger text-white" title="David Brown">DB</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted">9/20 tasks completed</small>
                                    </td>
                                    <td><span class="badge bg-primary">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions2">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewProjectModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editProjectModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignUsersModal"><i class="fas fa-users me-2"></i> Assign Users</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- DAL Project -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">DAL</a>
                                        <p class="mb-0 text-muted small">Client D</p>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <span class="avatar avatar-sm rounded-circle bg-info text-white" title="Mike Johnson">MJ</span>
                                            <span class="avatar avatar-sm rounded-circle bg-secondary text-white" title="Emily Davis">ED</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted">15/15 tasks completed</small>
                                    </td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="projectActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="projectActions3">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewProjectModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editProjectModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignUsersModal"><i class="fas fa-users me-2"></i> Assign Users</a></li>
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
            </div>
        </div>
        
        <!-- All Tasks Tab -->
        <div class="tab-pane fade" id="tasks" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
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
                                <!-- Task 1 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Dashboard redesign</a>
                                        <p class="mb-0 text-muted small">Redesign the admin dashboard UI</p>
                                    </td>
                                    <td>SF 1</td>
                                    <td>2023-07-18</td>
                                    <td>4.5</td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                    <td><a href="#" target="_blank" class="text-info">View in ClickUp</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="taskActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="taskActions1">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTaskModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Task 2 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">API development</a>
                                        <p class="mb-0 text-muted small">Implement user authentication API</p>
                                    </td>
                                    <td>SF 2</td>
                                    <td>2023-07-15</td>
                                    <td>6.0</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td><a href="#" target="_blank" class="text-info">View in ClickUp</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="taskActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="taskActions2">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTaskModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Task 3 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Database migration</a>
                                        <p class="mb-0 text-muted small">Migrate to new database schema</p>
                                    </td>
                                    <td>DAL</td>
                                    <td>2023-07-20</td>
                                    <td>8.0</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td><a href="#" target="_blank" class="text-info">View in ClickUp</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="taskActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="taskActions3">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTaskModal"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fas fa-edit me-2"></i> Edit</a></li>
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
            </div>
        </div>
        
        <!-- My Tasks Tab -->
        <div class="tab-pane fade" id="my-tasks" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
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
                                <!-- My Task 1 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Dashboard redesign</a>
                                        <p class="mb-0 text-muted small">Redesign the admin dashboard UI</p>
                                    </td>
                                    <td>SF 1</td>
                                    <td>2023-07-18</td>
                                    <td>4.5</td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                    <td><a href="#" target="_blank" class="text-info">View in ClickUp</a></td>
                                    <td>
                                        <button class="btn btn-sm btn-success me-1">Complete</button>
                                        <button class="btn btn-sm btn-outline-secondary">Log Time</button>
                                    </td>
                                </tr>
                                
                                <!-- My Task 2 -->
                                <tr>
                                    <td>
                                        <a href="#" class="text-primary fw-bold">Bug fixes</a>
                                        <p class="mb-0 text-muted small">Fix checkout process issues</p>
                                    </td>
                                    <td>SF 2</td>
                                    <td>2023-07-19</td>
                                    <td>3.0</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td><a href="#" target="_blank" class="text-info">View in ClickUp</a></td>
                                    <td>
                                        <button class="btn btn-sm btn-success me-1">Complete</button>
                                        <button class="btn btn-sm btn-outline-secondary">Log Time</button>
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="newProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" placeholder="e.g. SF 1, DAL, etc." required>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="projectDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="projectDescription" rows="3" placeholder="Brief project description"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="clientName" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="clientName" placeholder="Client or company name" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="projectStatus" class="form-label">Status</label>
                            <select class="form-select" id="projectStatus" required>
                                <option value="active">Active</option>
                                <option value="on-hold">On Hold</option>
                                <option value="completed">Completed</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Assign Team Members</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="assignUser1" checked>
                                <label class="form-check-label" for="assignUser1">
                                    John Doe (Project Manager)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="assignUser2">
                                <label class="form-check-label" for="assignUser2">
                                    Jane Smith (Developer)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3" id="assignUser3">
                                <label class="form-check-label" for="assignUser3">
                                    Mike Johnson (Designer)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4" id="assignUser4">
                                <label class="form-check-label" for="assignUser4">
                                    Sarah Williams (QA)
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveProject">Create Project</button>
            </div>
        </div>
    </div>
</div>

<!-- Assign Users Modal -->
<div class="modal fade" id="assignUsersModal" tabindex="-1" aria-labelledby="assignUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="assignUsersModalLabel">Assign Users to Project</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Select Team Members</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="assignUser1" checked>
                            <label class="form-check-label" for="assignUser1">
                                John Doe (Project Manager)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="assignUser2">
                            <label class="form-check-label" for="assignUser2">
                                Jane Smith (Developer)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="assignUser3">
                            <label class="form-check-label" for="assignUser3">
                                Mike Johnson (Designer)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="4" id="assignUser4">
                            <label class="form-check-label" for="assignUser4">
                                Sarah Williams (QA)
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
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
                            <label for="taskProject" class="form-label">Project</label>
                            <select class="form-select" id="taskProject" required>
                                <option value="" selected disabled>Select project</option>
                                <option value="1">SF 1</option>
                                <option value="2">SF 2</option>
                                <option value="3">SF 3</option>
                                <option value="4">DAL</option>
                                <option value="5">CRAFT</option>
                                <option value="6">DRD</option>
                                <option value="7">PLATINUM</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="taskDate" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskHours" class="form-label">Estimated Hours</label>
                            <input type="number" class="form-control" id="taskHours" step="0.5" min="0.5" placeholder="0.0" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskAssignee" class="form-label">Assignee</label>
                            <select class="form-select" id="taskAssignee" required>
                                <option value="" selected disabled>Select assignee</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                                <option value="3">Mike Johnson</option>
                                <option value="4">Sarah Williams</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="taskStatus" class="form-label">Status</label>
                            <select class="form-select" id="taskStatus" required>
                                <option value="pending" selected>Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="taskDetails" class="form-label">Task Details</label>
                            <textarea class="form-control" id="taskDetails" rows="3" placeholder="Detailed description of the task"></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label for="clickupLink" class="form-label">ClickUp Link</label>
                            <input type="url" class="form-control" id="clickupLink" placeholder="https://app.clickup.com/t/xxxxxx">
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

<!-- View Task Modal -->
<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="viewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewTaskModalLabel">Task Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4>Dashboard redesign</h4>
                        <p class="text-muted">Redesign the admin dashboard UI with new components and improved UX</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-primary fs-6">In Progress</span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted">Project</h6>
                            <p>SF 1</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Date</h6>
                            <p>July 18, 2023</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Hours Logged</h6>
                            <p>4.5 / 8.0 estimated</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-muted">Assignee</h6>
                            <div class="d-flex align-items-center">
                                <span class="avatar avatar-sm rounded-circle bg-primary text-white me-2">JD</span>
                                <span>John Doe</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">ClickUp Link</h6>
                            <p><a href="#" target="_blank">https://app.clickup.com/t/123456</a></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Created</h6>
                            <p>July 10, 2023 by Jane Smith</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5 class="mb-3">Time Logs</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Hours</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jul 12, 2023</td>
                                    <td>John Doe</td>
                                    <td>2.0</td>
                                    <td>Initial design concepts</td>
                                </tr>
                                <tr>
                                    <td>Jul 15, 2023</td>
                                    <td>John Doe</td>
                                    <td>2.5</td>
                                    <td>Component development</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Save project button functionality
    document.getElementById('saveProject').addEventListener('click', function() {
        var projectForm = document.getElementById('projectForm');
        if (projectForm.checkValidity()) {
            // Form is valid, proceed with saving
            var bootstrapModal = bootstrap.Modal.getInstance(document.getElementById('newProjectModal'));
            bootstrapModal.hide();
            
            // Show success message
            alert('Project created successfully!');
            
            // Reset form
            projectForm.reset();
        } else {
            // Form is invalid, show validation messages
            projectForm.reportValidity();
        }
    });
    
    // Save task button functionality
    document.getElementById('saveTask').addEventListener('click', function() {
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
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

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
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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