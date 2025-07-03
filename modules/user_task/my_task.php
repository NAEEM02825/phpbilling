    <style>
        .task-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .task-card h3 {
            margin-top: 0;
            color: #333;
        }

        .task-meta {
            display: flex;
            gap: 12px;
            margin: 12px 0;
            font-size: 14px;
            flex-wrap: wrap;
        }

        .priority {
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        .priority.high {
            background-color: #ffebee;
            color: #c62828;
        }

        .priority.medium {
            background-color: #fff8e1;
            color: #f57f17;
        }

        .priority.low {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .task-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .task-actions button,
        .task-actions a {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-view {
            background: #e3f2fd;
            color: #1565c0;
        }

        .btn-start {
            background: #fff3e0;
            color: #ef6c00;
        }

        .btn-complete {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .btn-external {
            background: #f3e5f5;
            color: #7b1fa2;
            text-decoration: none;
            display: inline-block;
        }

        #tasks-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .loading {
            text-align: center;
            padding: 20px;
        }
    </style>

    <div id="tasks-container">
        <div class="loading">Loading tasks...</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadTasks();
        });

        async function fetchTasksByAssignee(assigneeId) {
    try {
        const response = await fetch(`ajax_helpers/user_tasks.php?assignee_id=${assigneeId}`);
        if (!response.ok) throw new Error('Failed to fetch tasks');
        const data = await response.json();
        
        // Handle both the success flag and tasks array
        if (data.success === false) {
            throw new Error('API request failed');
        }
        return data.tasks || []; // Return empty array if tasks is undefined
    } catch (error) {
        console.error('Error fetching tasks:', error);
        return []; // Return empty array on error
    }
}

   function renderTasks(tasks) {
    const tasksContainer = document.getElementById('tasks-container');

    if (!tasksContainer) {
        console.error('tasks-container element not found');
        return;
    }

   // Clear the container first
    tasksContainer.innerHTML = '';

    // Check if tasks is an array and if it's empty
    if (!Array.isArray(tasks)) {
        tasksContainer.innerHTML = '<p class="error">Invalid tasks data received</p>';
        return;
    }
    if (tasks.length === 0) {
        tasksContainer.innerHTML = `
            <div class="no-tasks">
                <p>You currently have no tasks assigned.</p>
                <p>Enjoy your free time!</p>
            </div>
        `;
        return;
    }
    tasks.forEach(task => {
        const taskCard = document.createElement('div');
        taskCard.className = 'task-card';

        const taskDate = new Date(task.task_date);
        const formattedDate = taskDate.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric'
        });

        const statusClass = getPriorityClass(task.status);

        taskCard.innerHTML = `
            <h3>${escapeHtml(task.title)}</h3>
            <p>${escapeHtml(task.details?.substring(0, 50) || '')}${task.details?.length > 50 ? '...' : ''}</p>
            <div class="task-meta">
                <span class="due-date">Due: ${formattedDate}</span>
                <span class="priority ${statusClass}">
                    ${formatStatus(task.status)}
                </span>
                ${task.hours ? `<span class="hours">Est: ${task.hours}h</span>` : ''}
            </div>
            <div class="task-actions">
                <button class="btn-view" data-task-id="${task.id}">View Details</button>
                ${task.status !== 'completed' ? `
                    <button class="btn-start" data-task-id="${task.id}">Start Task</button>
                    <button class="btn-complete" data-task-id="${task.id}">Mark Complete</button>
                ` : ''}
                ${task.clickup_link ? `
                    <a href="${escapeHtml(task.clickup_link)}" target="_blank" class="btn-external">View in ClickUp</a>
                ` : ''}
            </div>
        `;

        tasksContainer.appendChild(taskCard);
    });

    addTaskCardEventListeners();
}

        function getPriorityClass(status) {
            status = status.toLowerCase();
            if (status.includes('urgent') || status.includes('high')) return 'high';
            if (status.includes('progress') || status.includes('medium')) return 'medium';
            return 'low';
        }

        function formatStatus(status) {
            return status.split('_').map(word =>
                word.charAt(0).toUpperCase() + word.slice(1)
            ).join(' ');
        }

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function addTaskCardEventListeners() {
            document.querySelectorAll('.btn-view').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.getAttribute('data-task-id');
                    alert(`Viewing task ID: ${taskId}`);
                });
            });

            document.querySelectorAll('.btn-start').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.getAttribute('data-task-id');
                    alert(`Starting task ID: ${taskId}`);
                });
            });

            document.querySelectorAll('.btn-complete').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const taskId = e.target.getAttribute('data-task-id');
                    alert(`Completing task ID: ${taskId}`);
                });
            });
        }

        async function loadTasks() {
            const assigneeId = <?php echo $_SESSION['user_id'] ?? 0; ?>;// Replace with actual user ID from your system
            const tasks = await fetchTasksByAssignee(assigneeId);
            renderTasks(tasks);
        }
    </script>