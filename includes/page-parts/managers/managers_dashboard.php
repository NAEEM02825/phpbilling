<?php
// Fetch real user data
$user_id = $_SESSION['user_id'] ?? 0;
$user = DB::queryFirstRow("
    SELECT first_name, last_name, name, role_id 
    FROM users 
    WHERE user_id = %i
", $user_id);

$displayName = $user['first_name'] ?? $user['name'] ?? 'User';

// Fetch stats
$totalProjects = DB::queryFirstField("SELECT COUNT(*) FROM projects") ?? 0;
$totalClients = DB::queryFirstField("SELECT COUNT(*) FROM clients") ?? 0;
$totalInvoices = DB::queryFirstField("SELECT COUNT(*) FROM invoices") ?? 0;
$totalTasks = DB::queryFirstField("SELECT COUNT(*) FROM tasks") ?? 0;

$pendingTasks = DB::queryFirstField("SELECT COUNT(*) FROM tasks WHERE status = 'Pending'") ?? 0;
$completedTasks = DB::queryFirstField("SELECT COUNT(*) FROM tasks WHERE status = 'Completed'") ?? 0;
$inProgressTasks = DB::queryFirstField("SELECT COUNT(*) FROM tasks WHERE status = 'In Progress'") ?? 0;

$paidInvoices = DB::queryFirstField("SELECT COUNT(*) FROM invoices WHERE status = 'paid'") ?? 0;
$pendingInvoices = DB::queryFirstField("SELECT COUNT(*) FROM invoices WHERE status = 'pending'") ?? 0;
$overdueInvoices = DB::queryFirstField("SELECT COUNT(*) FROM invoices WHERE status = 'overdue' AND due_date < CURDATE()") ?? 0;

// Recent data
$recentProjects = DB::query("
    SELECT p.*, CONCAT(c.first_name, ' ', c.last_name) AS client_name
    FROM projects p
    LEFT JOIN clients c ON p.client_id = c.id
    ORDER BY p.created_at DESC
    LIMIT 5
");

$recentTasks = DB::query("
    SELECT t.*, p.name AS project_name, 
           CONCAT(u.first_name, ' ', u.last_name) AS assignee_name
    FROM tasks t
    LEFT JOIN projects p ON t.project_id = p.id
    LEFT JOIN users u ON t.assignee_id = u.user_id
    ORDER BY t.created_at DESC
    LIMIT 10
");

$recentInvoices = DB::query("
    SELECT i.*, c.first_name AS client_first, c.last_name AS client_last,
           p.name AS project_name
    FROM invoices i
    LEFT JOIN clients c ON i.client_id = c.id
    LEFT JOIN projects p ON i.project_id = p.id
    ORDER BY i.created_at DESC
    LIMIT 5
");
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Dashboard Header -->
<div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
    <div>
        <h1 class="h2">Welcome Back, <span class="text-primary"><?= htmlspecialchars(strtoupper($displayName)) ?></span></h1>
        <p class="mb-0 text-muted">Here's what's happening with your projects today</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickTaskModal">
                <i class="fas fa-plus me-1"></i> Quick Task
            </button>
        </div>
        <div class="btn-group me-2">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#quickProjectModal">
                <i class="fas fa-project-diagram me-1"></i> New Project
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#quickClientModal">
                <i class="fas fa-user-plus me-1"></i> New Client
            </button>
        </div>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="row mb-4">
    <!-- Total Projects -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-primary shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Projects</h6>
                        <h3 class="mb-0"><?= $totalProjects ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Clients -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-success shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Clients</h6>
                        <h3 class="mb-0"><?= $totalClients ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Invoices -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-info shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-info bg-opacity-10 text-info rounded">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Invoices</h6>
                        <h3 class="mb-0"><?= $totalInvoices ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Tasks -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-warning shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Tasks</h6>
                        <h3 class="mb-0"><?= $totalTasks ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Stats Row -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-spinner fa-2x mb-2"></i>
                <h3><?= $inProgressTasks ?></h3>
                <p class="mb-0">In Progress Tasks</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-warning text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-hourglass-half fa-2x mb-2"></i>
                <h3><?= $pendingTasks ?></h3>
                <p class="mb-0">Pending Tasks</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-2x mb-2"></i>
                <h3><?= $completedTasks ?></h3>
                <p class="mb-0">Completed Tasks</p>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Stats Row -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-success h-100">
            <div class="card-body text-center">
                <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                <h3 class="text-success"><?= $paidInvoices ?></h3>
                <p class="mb-0">Paid Invoices</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-warning h-100">
            <div class="card-body text-center">
                <i class="fas fa-clock text-warning fa-2x mb-2"></i>
                <h3 class="text-warning"><?= $pendingInvoices ?></h3>
                <p class="mb-0">Pending Invoices</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-danger h-100">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-2x mb-2"></i>
                <h3 class="text-danger"><?= $overdueInvoices ?></h3>
                <p class="mb-0">Overdue Invoices</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="row">
    <!-- Recent Tasks -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-tasks me-2 text-primary"></i>Recent Tasks</h5>
                <a href="index.php?route=modules/task/my_task" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Assignee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentTasks)): ?>
                            <tr><td colspan="5" class="text-center text-muted py-4">No tasks found</td></tr>
                            <?php else: ?>
                            <?php foreach ($recentTasks as $task): ?>
                            <tr>
                                <td><?= htmlspecialchars($task['title']) ?></td>
                                <td><?= htmlspecialchars($task['project_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($task['assignee_name'] ?? 'Unassigned') ?></td>
                                <td>
                                    <?php
                                    $statusClass = match(strtolower($task['status'] ?? '')) {
                                        'completed' => 'success',
                                        'in progress' => 'primary',
                                        'pending' => 'warning',
                                        default => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $statusClass ?>"><?= htmlspecialchars($task['status']) ?></span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary assign-task-btn" 
                                            data-task-id="<?= $task['id'] ?>"
                                            data-task-title="<?= htmlspecialchars($task['title']) ?>">
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-project-diagram me-2 text-success"></i>Recent Projects</h5>
                <a href="index.php?route=modules/projects/projects" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (empty($recentProjects)): ?>
                    <div class="list-group-item text-center text-muted py-4">No projects found</div>
                    <?php else: ?>
                    <?php foreach ($recentProjects as $project): ?>
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="project-icon bg-primary bg-opacity-10 text-primary rounded">
                                    <i class="fas fa-folder"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= htmlspecialchars($project['name']) ?></h6>
                                <p class="mb-0 text-muted small">
                                    Client: <?= htmlspecialchars($project['client_name'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <span class="badge bg-<?= $project['status'] == 'active' ? 'success' : 'secondary' ?>">
                                    <?= htmlspecialchars($project['status'] ?? 'active') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Quick Task Modal -->
<div class="modal fade" id="quickTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Quick Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="quickTaskForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Task Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Project</label>
                        <select class="form-select" name="project_id" required>
                            <option value="">Select Project</option>
                            <?php foreach ($recentProjects as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                  <div class="mb-3">
    <label class="form-label">Assign To</label>
    <select class="form-select" name="assignee_id">
        <option value="">Select User</option>
        <?php 
        $assignableUsers = DB::query("
            SELECT user_id, first_name, last_name 
            FROM users 
            WHERE status='active' AND role_id = 3
            ORDER BY first_name
        ");
        foreach ($assignableUsers as $u): 
        ?>
        <option value="<?= $u['user_id'] ?>">
            <?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?>
        </option>
        <?php endforeach; ?>
    </select>
</div>
                    <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="due_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Project Modal -->
<div class="modal fade" id="quickProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-project-diagram me-2"></i>New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="quickProjectForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client</label>
                        <select class="form-select" name="client_id">
                            <option value="">Select Client</option>
                            <?php 
                            $clients = DB::query("SELECT id, first_name, last_name FROM clients ORDER BY first_name LIMIT 20");
                            foreach ($clients as $c): 
                            ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Project Type</label>
                        <select class="form-select" name="type">
                            <option value="hourly">Hourly</option>
                            <option value="fixed">Fixed Price</option>
                            <option value="recurring">Recurring</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate ($)</label>
                        <input type="number" class="form-control" name="rate" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Client Modal -->
<div class="modal fade" id="quickClientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="quickClientForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" name="company_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Add Client</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign Task Modal -->
<div class="modal fade" id="assignTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Task: <span id="assignTaskTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="assignTaskForm">
                <input type="hidden" name="task_id" id="assignTaskId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Assign To</label>
                        <select class="form-select" name="assignee_id" required>
                            <option value="">Select User</option>
                            <?php foreach ($users as $u): ?>
                            <option value="<?= $u['user_id'] ?>"><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.stat-card {
    border-left: 4px solid;
    transition: transform 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.stat-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.project-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}
.border-start-primary { border-left-color: #3a4f8a !important; }
.border-start-success { border-left-color: #28a745 !important; }
.border-start-info { border-left-color: #17a2b8 !important; }
.border-start-warning { border-left-color: #ffc107 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick Task Form
    $('#quickTaskForm').on('submit', function(e) {
        e.preventDefault();
        $.post('ajax_helpers/task_handler.php', $(this).serialize() + '&action=create_task', function(res) {
            if (res.success) {
                location.reload();
            } else {
                alert('Error: ' + (res.error || 'Failed to create task'));
            }
        }, 'json');
    });

    // Quick Project Form
    $('#quickProjectForm').on('submit', function(e) {
        e.preventDefault();
        $.post('ajax_helpers/ajax_add_projects.php?action=create', $(this).serialize(), function(res) {
            if (res.success) {
                location.reload();
            } else {
                alert('Error: ' + (res.error || 'Failed to create project'));
            }
        }, 'json');
    });

    // Quick Client Form
    $('#quickClientForm').on('submit', function(e) {
        e.preventDefault();
        $.post('ajax_helpers/ajax_add_client.php', $(this).serialize(), function(res) {
            if (res.success) {
                location.reload();
            } else {
                alert('Error: ' + (res.error || 'Failed to add client'));
            }
        }, 'json');
    });

    // Assign Task Button
    $('.assign-task-btn').on('click', function() {
        const taskId = $(this).data('task-id');
        const taskTitle = $(this).data('task-title');
        $('#assignTaskId').val(taskId);
        $('#assignTaskTitle').text(taskTitle);
        $('#assignTaskModal').modal('show');
    });

    // Assign Task Form
    $('#assignTaskForm').on('submit', function(e) {
        e.preventDefault();
        $.post('ajax_helpers/task_handler.php', $(this).serialize() + '&action=update_task', function(res) {
            if (res.success) {
                location.reload();
            } else {
                alert('Error: ' + (res.error || 'Failed to assign task'));
            }
        }, 'json');
    });
});
</script>