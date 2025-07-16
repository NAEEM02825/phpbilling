<!-- New Task Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
    
</div>

<!-- New Task Form -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm mb-4">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                 <div>
        <h1 class="h2">Create New Task</h1>
        <p class="mb-0 text-muted">Add a new task to your project</p>
    </div>
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
                            <!-- Populated via JavaScript -->
                        </select>
                    </div>

                    <!-- Assignee Selection -->
                    <div class="mb-4 w-100">
                        <label for="assigneeSelect" class="form-label">Assignee</label>
                        <select class="form-select" id="assigneeSelect" name="assignee_id">
                            <option selected value="">Select assignee</option>
                            <!-- Populated via JavaScript -->
                        </select>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-4 w-100">
                        <label for="statusSelect" class="form-label">Status</label>
                        <select class="form-select" id="statusSelect" name="status">
                            <option selected value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
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
                        <button type="submit" class="btn btn-custom" id="saveTask">
                            <i class="fas fa-save me-1"></i> Save Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
        .btn-custom {
        background-color: #04665f;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #034b45;
        color: white;
        /* darker shade for hover effect */
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

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch projects and users when page loads
        fetchProjects();
        fetchUsers();

        // Function to fetch projects
        async function fetchProjects() {
            try {
                console.log("Fetching projects...");
                const response = await fetch('ajax_helpers/task_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=get_projects'
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log("Projects data:", data);
                
                const projectSelect = document.getElementById('projectSelect');
                
                if (data.success && Array.isArray(data.data)) {
                    // Clear existing options except the first one
                    while (projectSelect.options.length > 1) {
                        projectSelect.remove(1);
                    }
                    
                    data.data.forEach(project => {
                        const opt = document.createElement('option');
                        opt.value = project.id;
                        opt.textContent = project.name;
                        projectSelect.appendChild(opt);
                    });
                } else {
                    throw new Error(data.error || 'Invalid projects data format');
                }
            } catch (error) {
                console.error("Error fetching projects:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load projects: ' + error.message,
                    confirmButtonColor: '#3a4f8a'
                });
            }
        }

        // Function to fetch users
        async function fetchUsers() {
            try {
                console.log("Fetching users...");
                const response = await fetch('ajax_helpers/task_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=get_users'
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log("Users data:", data);
                
                const assigneeSelect = document.getElementById('assigneeSelect');
                
                if (data.success && Array.isArray(data.users)) {
                    // Clear existing options except the first one
                    while (assigneeSelect.options.length > 1) {
                        assigneeSelect.remove(1);
                    }
                    
                    data.users.forEach(user => {
                        const opt = document.createElement('option');
                        opt.value = user.user_id;
                        opt.textContent = user.name;
                        assigneeSelect.appendChild(opt);
                    });
                } else {
                    throw new Error(data.error || 'Invalid users data format');
                }
            } catch (error) {
                console.error("Error fetching users:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load users: ' + error.message,
                    confirmButtonColor: '#3a4f8a'
                });
            }
        }
    });
</script>