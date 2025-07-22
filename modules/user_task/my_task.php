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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Work report</h5>
            <div>
                <button class="btn btn-primary btn-sm" id="btnNewTask">
                    <i class="fas fa-plus me-1"></i> Add Task
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tasksTable">
                    <thead>
                        <tr>
                            <th> <!-- Adjust colspan based on your total columns -->
                                <input type="text" class="form-control form-control-sm search-input"
                                    placeholder="Search all..." id="globalSearch">
                            </th>
                               <th>
            <select class="form-select form-select-sm search-input" data-column="4" id="statusFilter">
                <option value="">All</option>
                <option>Pending</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
        </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="sortable" data-sort="title">Title <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="project_name">Project <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="task_date">Date <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="hours">Hours <i class="fas fa-sort"></i></th>
                            <th class="sortable" data-sort="status">Status <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tasksTableBody"></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="form-text">Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of <span
                        id="totalTasks">0</span> tasks</div>
                <nav>
                    <ul class="pagination pagination-sm mb-0" id="pagination">
                        <!-- Pagination will be inserted here by JS -->
                    </ul>
                </nav>
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
                        <label for="taskDate" class="form-label"> Date</label>
                        <input type="date" class="form-control" name="task_date" id="taskDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskProject" class="form-label">Project</label>
                        <select class="form-select" name="project_id" id="taskProject" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskHours" class="form-label">Hours Taken</label>
                        <input type="number" class="form-control" name="hours" id="taskHours" min="0.5" step="0.5"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDetails" class="form-label">Description</label>
                        <textarea class="form-control" name="details" id="taskDetails" rows="3"
                            maxlength="500"></textarea>
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
        const userId = <?= (int) $userId ?>;

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
    <div class="mb-2">${escapeHtml(truncateWords(task.details, 10))}</div>
    ${task.details && task.details.split(/\s+/).length > 10 ?
                        '<div><a href="#" onclick="viewTask(' + task.id + ')" class="small">View more</a></div>' :
                        ''}
    <div>
        <a href="index.php?route=modules/user_task/view_task&task_id=${task.id}" 
           class="btn btn-sm btn-outline-secondary me-2" 
           style="width:32px;height:32px;border-radius:6px;border:1px solid #dee2e6;" 
           title="View Task"
           aria-label="View Task">
           <i class="fas fa-eye"></i>
        </a>
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

        // Start task (change status to In Progress)
        async function startTask(taskId) {
            try {
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
            } catch (error) {
                showAlert('Error starting task: ' + error.message, 'danger');
            }
        }

        // Complete task
        async function completeTask(taskId) {
            try {
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
            } catch (error) {
                showAlert('Error completing task: ' + error.message, 'danger');
            }
        }
        // Helper function to truncate text to 10 words
        function truncateWords(text, maxWords) {
            if (!text) return '';
            const words = text.trim().split(/\s+/);
            if (words.length <= maxWords) return text;
            return words.slice(0, maxWords).join(' ') + '...';
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
            document.getElementById('taskForm').onsubmit = async function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const isEdit = !!this.dataset.taskId;

                if (isEdit) {
                    formData.append('action', 'update_task');
                    formData.append('task_id', this.dataset.taskId);
                } else {
                    formData.append('action', 'create_task');
                    formData.append('assignee_id', userId);
                }
                formData.append('user_id', userId);

                try {
                    const res = await fetch('ajax_helpers/user_task_crud.php', {
                        method: 'POST',
                        body: formData // No headers needed for FormData
                    });
                    const data = await res.json();
                    if (data.success) {
                        showAlert(isEdit ? 'Task updated!' : 'Task created!');
                        bootstrap.Modal.getInstance(document.getElementById('taskModal')).hide();
                        loadTasks();
                    } else {
                        showAlert(data.error || (isEdit ? 'Failed to update task' : 'Failed to create task'), 'danger');
                    }
                } catch (error) {
                    showAlert('Error: ' + error.message, 'danger');
                }
            };
            form.dataset.taskId = taskId;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            modal.show();
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
            return (str || '').replace(/[&<>"']/g, function (m) {
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
        document.getElementById('taskForm').onsubmit = async function (e) {
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

        function viewTask(taskId) {
            // Redirect to the view task page with the task ID
            window.location.href = `index.php?route=modules/assign/view_task&task_id=${taskId}`;
        }
        // Initial load

        // Add these global variables
        let currentPage = 1;
        let globalSearchTerm = "";
        const tasksPerPage = 10;
        let allTasks = [];
        let sortColumn = 'task_date';
        let sortDirection = 'desc';
        let searchTerms = ['', '', '', '', ''];
        let statusFilter = "";

        // Replace loadTasks() with this version
        async function loadTasks() {
            const res = await fetch('ajax_helpers/user_task_crud.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'get_my_tasks',
                    user_id: userId
                })
            });
            const data = await res.json();

            if (data.success) {
                allTasks = data.tasks;
                applySortingAndFiltering();
                renderTable();
                updatePagination();
            } else {
                document.getElementById('tasksTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center text-danger">Failed to load tasks</td></tr>`;
            }
        }

        document.getElementById("globalSearch").addEventListener("input", function (e) {
            globalSearchTerm = e.target.value.toLowerCase();
            updateFilteredTasks(); // Call your filtering function
        });
        document.getElementById("statusFilter")?.addEventListener("change", function(e) {
    statusFilter = e.target.value; // Will be "" for "All" option
    currentPage = 1;
    renderTable();
});

        // Add these new functions
      function applySortingAndFiltering() {
    // Filtering - first apply global search
    let filteredTasks = allTasks.filter(task => {
        if (globalSearchTerm) {
            const matchesSearch = (
                task.title.toLowerCase().includes(globalSearchTerm) ||
                (task.project_name || '').toLowerCase().includes(globalSearchTerm) ||
                task.task_date.includes(globalSearchTerm) ||
                task.hours.toString().includes(globalSearchTerm) ||
                (task.status || '').toLowerCase().includes(globalSearchTerm)
            );
            if (!matchesSearch) return false;
        }
        
        // Then apply status filter if set
        if (statusFilter && task.status !== statusFilter) {
            return false;
        }
        
        return true;
    });

    // Sorting
    filteredTasks.sort((a, b) => {
        const valA = a[sortColumn] || '';
        const valB = b[sortColumn] || '';

        if (valA < valB) return sortDirection === 'asc' ? -1 : 1;
        if (valA > valB) return sortDirection === 'asc' ? 1 : -1;
        return 0;
    });

    return filteredTasks;
}
        function renderTable() {
            const filteredTasks = applySortingAndFiltering();
            const startIdx = (currentPage - 1) * tasksPerPage;
            const paginatedTasks = filteredTasks.slice(startIdx, startIdx + tasksPerPage);

            const tbody = document.getElementById('tasksTableBody');
            tbody.innerHTML = paginatedTasks.length ? '' :
                `<tr><td colspan="6" class="text-center">No tasks found</td></tr>`;

            paginatedTasks.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${escapeHtml(task.title)}</td>
            <td>${escapeHtml(task.project_name || '—')}</td>
            <td>${escapeHtml(task.task_date)}</td>
            <td>${task.hours || '0'}h</td>
            <td><span class="badge ${getStatusClass(task.status)}">${escapeHtml(task.status)}</span></td>
            <td class="text-nowrap">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="viewTask(${task.id})" title="View">
                    <i class="fas fa-eye"></i>
                </button>
                ${task.status === 'Pending' ?
                        `<button class="btn btn-sm btn-outline-warning me-1" onclick="startTask(${task.id})" title="Start">
                        <i class="fas fa-play"></i>
                    </button>` : ''}
                ${task.status !== 'Completed' ?
                        `<button class="btn btn-sm btn-outline-success me-1" onclick="completeTask(${task.id})" 
                        ${task.status === 'Pending' ? 'disabled' : ''} title="Complete">
                        <i class="fas fa-check"></i>
                    </button>` : ''}
                <button class="btn btn-sm btn-outline-primary me-1" onclick="editTask(${task.id})" 
                    ${task.status === 'Completed' ? 'disabled' : ''} title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteTask(${task.id})" 
                    ${task.status === 'Completed' ? 'disabled' : ''} title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>`;
                tbody.appendChild(row);
            });

            // Update showing X-Y of Z
            document.getElementById('showingFrom').textContent = paginatedTasks.length ? startIdx + 1 : 0;
            document.getElementById('showingTo').textContent = startIdx + paginatedTasks.length;
            document.getElementById('totalTasks').textContent = filteredTasks.length;
        }

        function updatePagination() {
            const filteredTasks = applySortingAndFiltering();
            const totalPages = Math.ceil(filteredTasks.length / tasksPerPage);
            const paginationEl = document.getElementById('pagination');
            paginationEl.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
            prevLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            paginationEl.appendChild(prevLi);

            // Page buttons
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderTable();
                });
                paginationEl.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
            nextLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            paginationEl.appendChild(nextLi);
        }

        // Add sorting functionality
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', () => {
                const column = header.dataset.sort;
                if (sortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortColumn = column;
                    sortDirection = 'asc';
                }

                // Update sort icons
                document.querySelectorAll('.sortable i').forEach(icon => {
                    icon.className = 'fas fa-sort';
                });
                const icon = header.querySelector('i');
                icon.className = `fas fa-sort-${sortDirection === 'asc' ? 'up' : 'down'}`;

                currentPage = 1;
                renderTable();
            });
        });

        // Add search functionality
        document.querySelectorAll('.search-input').forEach(input => {
            input.addEventListener('input', () => {
                const column = parseInt(input.dataset.column);
                searchTerms[column] = input.value;
                currentPage = 1;
                renderTable();
            });
        });
        loadTasks();
    </script>