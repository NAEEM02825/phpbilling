
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
            <button type="button" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Save Task
            </button>
        </div>
    </div>

    <!-- New Task Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form>
                        <!-- Task Title -->
                        <div class="mb-4">
                            <label for="taskTitle" class="form-label">Task Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="taskTitle" placeholder="Enter task title">
                        </div>

                        <!-- Task Description -->
                        <div class="mb-4">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" rows="5" placeholder="Enter detailed description"></textarea>
                        </div>

                        <!-- Task Attachments -->
                        <div class="mb-4">
                            <label class="form-label">Attachments</label>
                            <div class="dropzone border rounded p-4 text-center">
                                <div class="dz-message" data-dz-message>
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-3"></i>
                                    <h5 class="mb-1">Drop files here or click to upload</h5>
                                    <p class="text-muted mb-0">(Maximum file size: 5MB)</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-2">
                                        <i class="fas fa-file-pdf text-danger"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-0 text-truncate">project_requirements.pdf</p>
                                        <small class="text-muted">2.4 MB</small>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="#" class="text-danger"><i class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="mb-4">
                            <label class="form-label">Comments</label>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary text-white">JD</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control" placeholder="Add a comment...">
                                </div>
                            </div>
                            <div class="ps-5">
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-success text-white">JS</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card border-light shadow-none">
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-1">Jane Smith</h6>
                                                    <small class="text-muted">2 hours ago</small>
                                                </div>
                                                <p class="mb-0">Please make sure to include all the requirements from the client's brief.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Task Details Sidebar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Task Details</h5>

                    <!-- Project Selection -->
                    <div class="mb-4">
                        <label for="projectSelect" class="form-label">Project <span class="text-danger">*</span></label>
                        <select class="form-select" id="projectSelect">
                            <option selected disabled>Select project</option>
                            <option>E-commerce Platform</option>
                            <option>Mobile App Development</option>
                            <option>Admin Dashboard</option>
                            <option>Marketing Website</option>
                        </select>
                    </div>

                    <!-- Assignee Selection -->
                    <div class="mb-4">
                        <label for="assigneeSelect" class="form-label">Assignee</label>
                        <select class="form-select" id="assigneeSelect">
                            <option selected disabled>Select assignee</option>
                            <option>John Doe</option>
                            <option>Jane Smith</option>
                            <option>Mike Johnson</option>
                            <option>Sarah Williams</option>
                        </select>
                    </div>

                    <!-- Priority Selection -->
                    <div class="mb-4">
                        <label for="prioritySelect" class="form-label">Priority</label>
                        <select class="form-select" id="prioritySelect">
                            <option selected>Medium</option>
                            <option>High</option>
                            <option>Low</option>
                        </select>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-4">
                        <label for="statusSelect" class="form-label">Status</label>
                        <select class="form-select" id="statusSelect">
                            <option selected>Pending</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-4">
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="dueDate">
                    </div>

                    <!-- Tags -->
                    <div class="mb-4">
                        <label for="taskTags" class="form-label">Tags</label>
                        <select class="form-select" id="taskTags" multiple>
                            <option selected>UI</option>
                            <option>Backend</option>
                            <option>Bug</option>
                            <option>Feature</option>
                            <option>Enhancement</option>
                        </select>
                    </div>

                    <!-- Time Estimate -->
                    <div class="mb-4">
                        <label for="timeEstimate" class="form-label">Time Estimate (hours)</label>
                        <input type="number" class="form-control" id="timeEstimate" placeholder="Enter estimated hours">
                    </div>

                    <!-- Task Dependencies -->
                    <div class="mb-4">
                        <label for="dependencies" class="form-label">Dependencies</label>
                        <select class="form-select" id="dependencies" multiple>
                            <option>Dashboard redesign</option>
                            <option>User authentication</option>
                            <option>API documentation</option>
                            <option>Bug fixes</option>
                        </select>
                    </div>
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
</script>