<?php
$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) {
    die('User not logged in.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Tasks</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9fb;
        }

        .task-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 18px 20px;
            margin-bottom: 18px;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: box-shadow .2s;
        }

        .task-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
        }

        .task-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #3a4f8a;
        }

        .task-meta {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .badge-status {
            font-size: 0.85em;
        }

        .task-actions button {
            margin-right: 8px;
        }

        .no-tasks {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }

        .modal-title {
            color: #3a4f8a;
        }

        .form-label {
            font-weight: 500;
        }

        .alert-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 250px;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Tasks</h2>
            <button class="btn btn-primary" id="btnNewTask"><i class="fas fa-plus me-1"></i> New Task</button>
        </div>
        <div id="tasks-container">
            <div class="text-center py-5">
                <div class="spinner-border text-primary"></div>
            </div>
        </div>
    </div>

    <!-- Task Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="taskForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="taskTitle" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="taskProject" class="form-label">Project</label>
                        <select class="form-select" name="project_id" id="taskProject" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="task_date" id="taskDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskHours" class="form-label">Hours Taken</label>
                        <input type="number" class="form-control" name="hours" id="taskHours" min="0.5" step="0.5" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="taskStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskDetails" class="form-label">Details</label>
                        <textarea class="form-control" name="details" id="taskDetails" rows="3" maxlength="500"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clickupLink" class="form-label">ClickUp Link</label>
                        <input type="url" class="form-control" name="clickup_link" id="clickupLink" placeholder="https://app.clickup.com/t/xxxxxx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alert -->
    <div id="alertBox" class="alert alert-success alert-fixed d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const userId = <?= (int)$userId ?>;

        // Load all tasks for this user
        async function loadTasks() {
            const container = document.getElementById('tasks-container');
            container.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'get_my_tasks',
                    user_id: userId
                })
            });
            const data = await res.json();
            if (!data.success) {
                container.innerHTML = '<div class="alert alert-danger">Failed to load tasks.</div>';
                return;
            }
            if (!data.tasks.length) {
                container.innerHTML = `<div class="no-tasks"><i class="fas fa-check-circle fa-2x mb-2"></i><br>No tasks assigned yet.</div>`;
                return;
            }
            container.innerHTML = '';
            data.tasks.forEach(task => {
                const card = document.createElement('div');
                card.className = 'task-card';
                card.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="task-title">${escapeHtml(task.title)}</span>
                <span class="badge badge-status ${getStatusClass(task.status)}">${escapeHtml(task.status)}</span>
            </div>
            <div class="task-meta mb-2">
                <i class="fas fa-project-diagram me-1"></i> ${escapeHtml(task.project_name || 'No project')}
                &nbsp;|&nbsp; <i class="fas fa-calendar-alt me-1"></i> ${escapeHtml(task.task_date)}
                &nbsp;|&nbsp; <i class="fas fa-clock me-1"></i> ${task.hours || '0'}h
            </div>
            <div class="mb-2">${escapeHtml(task.details || '')}</div>
<div>
    ${task.clickup_link ? `<a href="${escapeHtml(task.clickup_link)}" target="_blank" class="btn btn-sm btn-outline-info me-2"><i class="fab fa-clickup"></i> ClickUp</a>` : ''}
    ${task.status === 'Pending' ? 
        `<button class="btn btn-sm btn-outline-warning me-2" onclick="startTask(${task.id})"><i class="fas fa-play"></i> Start</button>` : 
        ''}
    ${task.status !== 'Completed' ? 
        `<button class="btn btn-sm btn-outline-success me-2" onclick="completeTask(${task.id})" ${task.status === 'Pending' ? 'disabled' : ''}><i class="fas fa-check"></i> Complete</button>` : 
        ''}
    <button class="btn btn-sm btn-outline-primary me-2" onclick="editTask(${task.id})" ${task.status === 'Completed' ? 'disabled' : ''}><i class="fas fa-edit"></i> Edit</button>
    <button class="btn btn-sm btn-outline-danger" onclick="deleteTask(${task.id})" ${task.status === 'Completed' ? 'disabled' : ''}><i class="fas fa-trash"></i> Delete</button>
</div>`;
                container.appendChild(card);
            });
        }

        // Load project options for select
        async function loadProjectOptions() {
            const select = document.getElementById('taskProject');
            select.innerHTML = '<option value="">Loading...</option>';
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'get_projects'
                })
            });
            const data = await res.json();
            select.innerHTML = '<option value="">Select project</option>';
            if (data.success && Array.isArray(data.projects)) {
                data.projects.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.name;
                    select.appendChild(opt);
                });
            }
        }

        // Complete task
        async function completeTask(taskId) {
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'complete_task',
                    task_id: taskId,
                    user_id: userId
                })
            });
            const data = await res.json();
            if (data.success) {
                showAlert('Task marked as completed!');
                loadTasks();
            } else {
                showAlert(data.error || 'Failed to complete task', 'danger');
            }
        }
        // Edit task
        async function editTask(taskId) {
            // Load task data
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'get_task',
                    task_id: taskId,
                    user_id: userId
                })
            });
            const data = await res.json();

            if (!data.success) {
                showAlert(data.error || 'Failed to load task', 'danger');
                return;
            }

            const task = data.task;

            // Set modal title
            document.getElementById('taskModalLabel').textContent = 'Edit Task';

            // Load projects
            await loadProjectOptions();

            // Fill form with task data
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskProject').value = task.project_id;
            document.getElementById('taskDate').value = task.task_date;
            document.getElementById('taskHours').value = task.hours;
            document.getElementById('taskStatus').value = task.status;
            document.getElementById('taskDetails').value = task.details || '';
            document.getElementById('clickupLink').value = task.clickup_link || '';

            // Store task ID in form for update
            const form = document.getElementById('taskForm');
            form.dataset.taskId = taskId;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            modal.show();
        }
        // Start task (change status to In Progress)
        async function startTask(taskId) {
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'start_task',
                    task_id: taskId,
                    user_id: userId
                })
            });
            const data = await res.json();
            if (data.success) {
                showAlert('Task started! Status changed to In Progress.');
                loadTasks();
            } else {
                showAlert(data.error || 'Failed to start task', 'danger');
            }
        }
        // Delete task
        async function deleteTask(taskId) {
            if (!confirm('Are you sure you want to delete this task?')) return;
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'delete_task',
                    task_id: taskId,
                    user_id: userId
                })
            });
            const data = await res.json();
            if (data.success) {
                showAlert('Task deleted!');
                loadTasks();
            } else {
                showAlert(data.error || 'Failed to delete task', 'danger');
            }
        }

        // Show alert
        function showAlert(msg, type = 'success') {
            const box = document.getElementById('alertBox');
            box.className = `alert alert-${type} alert-fixed`;
            box.textContent = msg;
            box.classList.remove('d-none');
            setTimeout(() => box.classList.add('d-none'), 3000);
        }

        // Escape HTML
        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                })[m];
            });
        }

        // Status badge class
        function getStatusClass(status) {
            status = (status || '').toLowerCase();
            if (status === 'completed') return 'bg-success';
            if (status === 'in progress') return 'bg-primary';
            return 'bg-warning';
        }

        // Open modal for new task
        document.getElementById('btnNewTask').onclick = () => {
            document.getElementById('taskModalLabel').textContent = 'Create Task';
            document.getElementById('taskForm').reset();
            delete document.getElementById('taskForm').dataset.taskId;
            loadProjectOptions();
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            modal.show();
        };

        // Handle form submit (create/update task)
        document.getElementById('taskForm').onsubmit = async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const isEdit = !!this.dataset.taskId;

            if (isEdit) {
                formData.append('action', 'update_task');
                formData.append('task_id', this.dataset.taskId);
            } else {
                formData.append('action', 'create_task');
                formData.append('assignee_id', userId);
                // Status will come from the form selection
            }
            formData.append('user_id', userId);

            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success) {
                showAlert(isEdit ? 'Task updated!' : 'Task created!');
                bootstrap.Modal.getInstance(document.getElementById('taskModal')).hide();
                loadTasks();
            } else {
                showAlert(data.error || (isEdit ? 'Failed to update task' : 'Failed to create task'), 'danger');
            }
        };

        // Initial load
        loadTasks();
    </script>
</body>

</html>