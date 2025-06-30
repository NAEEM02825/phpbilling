<!-- New Task Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Create New Task</h1>
        <p class="mb-0 text-muted">Add a new task to your project</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-outline-secondary me-2">
            <i class="fas fa-times me-1"></i> Cancel
        </button>
        <button type="button" class="btn btn-primary" id="saveTask">
            <i class="fas fa-save me-1"></i> Save Task
        </button>
    </div>
</div>

<!-- New Task Form -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm mb-4">
            <!-- Center the card-body content -->
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <form id="taskForm" class="w-100">
                    <!-- Task Title -->
                    <div class="mb-4 w-100">
                        <label for="taskTitle" class="form-label">Task Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="taskTitle" name="title" placeholder="Enter task title" required>
                    </div>

                    <!-- Task Description -->
                    <div class="mb-4 w-100">
                        <label for="taskDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="taskDescription" name="details" rows="5" placeholder="Enter detailed description"></textarea>
                    </div>

                    <!-- Project Selection -->
                    <div class="mb-4 w-100">
                        <label for="projectSelect" class="form-label">Project <span class="text-danger">*</span></label>
                        <select class="form-select" id="projectSelect" name="project_id" required>
                            <option selected disabled value="">Select project</option>
                            <!-- Populate with PHP or JS -->
                        </select>
                    </div>

                    <!-- Assignee Selection -->
                    <div class="mb-4 w-100">
                        <label for="assigneeSelect" class="form-label">Assignee</label>
                        <select class="form-select" id="assigneeSelect" name="assignee_id">
                            <option selected disabled value="">Select assignee</option>
                            <!-- Populate with PHP or JS -->
                        </select>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-4 w-100">
                        <label for="statusSelect" class="form-label">Status</label>
                        <select class="form-select" id="statusSelect" name="status">
                            <option selected>Pending</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-4 w-100">
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="dueDate" name="task_date">
                    </div>

                    <!-- Hours Field -->
                    <div class="mb-4 w-100">
                        <label for="taskHours" class="form-label">Hours</label>
                        <input type="number" class="form-control" id="taskHours" name="hours" min="0" step="0.1" placeholder="Enter estimated hours">
                    </div>

                    <!-- ClickUp Link Field -->
                    <div class="mb-4 w-100">
                        <label for="clickupLink" class="form-label">ClickUp Link</label>
                        <input type="url" class="form-control" id="clickupLink" name="clickup_link" placeholder="Paste ClickUp task link">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="saveTask">
                            <i class="fas fa-save me-1"></i> Save Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* New Task Page Specific Styles */
    .dropzone {
        border: 2px dashed #dee2e6;
        background: #f8f9fa;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .dropzone:hover {
        border-color: #3a4f8a;
        background: rgba(58, 79, 138, 0.05);
    }
    
    /* Form Control Styles */
    .form-control-lg {
        font-size: 1.25rem;
        padding: 0.75rem 1rem;
    }
    
    /* Select2 Styles (for multiple select) */
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        min-height: 38px;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3a4f8a;
        border: none;
        color: white;
        border-radius: 4px;
        padding: 0 8px;
        margin-right: 5px;
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
    
    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    /* Comment Card Styles */
    .card.border-light {
        border: 1px solid rgba(0,0,0,0.03) !important;
    }
</style>

<script>
    // Initialize form plugins
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize dropzone for file uploads
        // This would be replaced with actual Dropzone.js initialization
        console.log('Dropzone would be initialized here');
        
        // Initialize select2 for multiple select elements
        // This would be replaced with actual Select2 initialization
        console.log('Select2 would be initialized for multiple select elements');
        
        // Form validation would go here
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form would be validated and submitted here');
            // Actual form submission would go here
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // --- Populate Project Dropdown ---
        fetch('ajax_helpers/task_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=get_projects'
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && Array.isArray(data.data)) {
                const projectSelect = document.getElementById('projectSelect');
                data.data.forEach(project => {
                    const opt = document.createElement('option');
                    opt.value = project.id;
                    opt.textContent = project.name;
                    projectSelect.appendChild(opt);
                });
            }
        });

        // --- Populate Assignee Dropdown ---
        fetch('ajax_helpers/task_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=get_users'
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && Array.isArray(data.users)) {
                const assigneeSelect = document.getElementById('assigneeSelect');
                data.users.forEach(user => {
                    const opt = document.createElement('option');
                    opt.value = user.user_id;
                    opt.textContent = user.name;
                    assigneeSelect.appendChild(opt);
                });
            }
        });

        // --- Save Task AJAX ---
        document.getElementById('saveTask').addEventListener('click', async function() {
            const form = document.getElementById('taskForm');
            if (!form.taskTitle.value.trim()) {
                alert('Task Title is required');
                return;
            }
            if (!form.projectSelect.value) {
                alert('Project is required');
                return;
            }
            const formData = new FormData(form);
            formData.append('action', 'create_task');
            try {
                const response = await fetch('ajax_helpers/task_handler.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (!data.success) {
                    alert(data.error || 'Failed to create task');
                    return;
                }
                alert('Task created successfully!');
                form.reset();
            } catch (error) {
                alert('Error creating task: ' + error.message);
            }
        });
    });
</script>