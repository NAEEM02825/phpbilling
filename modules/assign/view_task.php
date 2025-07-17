    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .task-header {
            background-color: #04665f;
            color: white !important;
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        #taskTitle {
            color: white;
        }

        .task-details-card {
            border-radius: 0 0 0.5rem 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .file-card {
            border-left: 4px solid #04665f;
            transition: all 0.3s ease;
        }

        .file-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge-custom {
            background-color: #04665f;
            color: white;
        }

        .assignee-avatar {
            width: 40px;
            height: 40px;
            background-color: #04665f;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
        }
    </style>
    </head>

    <body>
        <div class="container py-4">
            <!-- Back Button -->
            <button class="btn btn-outline-secondary mb-3" onclick="window.history.back()">
                <i class="fas fa-arrow-left me-2"></i>Back to Tasks
            </button>

            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading task details...</p>
            </div>

            <!-- Task Details Container -->
            <div id="taskContainer" style="display: none;">
                <!-- Task Header -->
                <div class="task-header mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 id="taskTitle" class="h4 mb-1"></h2>
                            <p class="mb-0 small">Created: <span id="taskCreated"></span></p>
                        </div>
                        <span id="taskStatus" class="badge rounded-pill"></span>
                    </div>
                </div>

                <!-- Task Details Card -->
                <div class="card task-details-card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-8">
                                <h5 class="card-title mb-3">Task Details</h5>
                                <div id="taskDetails" class="mb-4"></div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Estimated Hours</h6>
                                    <p id="taskHours" class="mb-0"></p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Due Date</h6>
                                    <p id="taskDate" class="mb-0"></p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">ClickUp Link</h6>
                                    <a id="clickupLink" href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-1"></i> View in ClickUp
                                    </a>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <h5 class="card-title mb-3">Project Information</h5>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-project-diagram me-2 text-muted"></i>
                                        <span id="projectName" class="fw-bold"></span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="card-title mb-3">Assignee</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="assignee-avatar me-2" id="assigneeInitials"></div>
                                        <span id="assigneeName" class="fw-bold"></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h5 class="card-title mb-3">Task ID</h5>
                                    <span id="taskId" class="badge bg-secondary"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Files Section -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Attachments</h5>
                    </div>
                    <div class="card-body">
                        <div id="filesContainer" class="row">
                            <!-- Files will be loaded here -->
                        </div>
                        <div id="noFilesMessage" class="text-center py-3" style="display: none;">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No files attached to this task</p>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="text-end text-muted small">
                    Last updated: <span id="taskUpdated"></span>
                </div>
            </div>

            <!-- Error Message -->
            <div id="errorMessage" class="alert alert-danger text-center" style="display: none;"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const taskId = urlParams.get('task_id');

                if (!taskId) {
                    showError('No task ID provided');
                    return;
                }

                loadTaskDetails(taskId);
            });

            function loadTaskDetails(taskId) {
                fetch(`ajax_helpers/get_task.php?task_id=${taskId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            throw new Error(data.error || 'Failed to load task details');
                        }

                        displayTaskDetails(data.task, data.files);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showError(error.message);
                    });
            }

            function displayTaskDetails(task, files) {
                // Hide loading spinner and show container
                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('taskContainer').style.display = 'block';

                // Set basic task info
                document.getElementById('taskTitle').textContent = task.title;
                document.getElementById('taskId').textContent = task.id;
                document.getElementById('taskDetails').textContent = task.details || 'No details provided';
                document.getElementById('taskHours').textContent = task.hours + ' hours';

                // Format dates
                document.getElementById('taskCreated').textContent = new Date(task.created_at).toLocaleString();
                document.getElementById('taskUpdated').textContent = new Date(task.updated_at).toLocaleString();
                document.getElementById('taskDate').textContent = new Date(task.task_date).toLocaleDateString();

                // Set status badge
                const statusBadge = document.getElementById('taskStatus');
                statusBadge.textContent = task.status;
                statusBadge.className = 'badge rounded-pill ' + getStatusClass(task.status);

                // Set project info
                document.getElementById('projectName').textContent = task.project_name || 'No project assigned';

                // Set assignee info
                if (task.assignee_name) {
                    document.getElementById('assigneeName').textContent = task.assignee_name;
                    document.getElementById('assigneeInitials').textContent =
                        task.assignee_name.split(' ').map(n => n[0]).join('').toUpperCase();
                } else {
                    document.getElementById('assigneeName').textContent = 'Unassigned';
                    document.getElementById('assigneeInitials').textContent = '?';
                }

                // Set ClickUp link
                const clickupLink = document.getElementById('clickupLink');
                if (task.clickup_link) {
                    clickupLink.href = task.clickup_link;
                } else {
                    clickupLink.style.display = 'none';
                }

                // Display files
                const filesContainer = document.getElementById('filesContainer');
                const noFilesMessage = document.getElementById('noFilesMessage');

                if (files.length === 0) {
                    noFilesMessage.style.display = 'block';
                    filesContainer.style.display = 'none';
                } else {
                    noFilesMessage.style.display = 'none';
                    filesContainer.style.display = 'flex';
                    filesContainer.innerHTML = '';

                    files.forEach(file => {
                        const fileCard = document.createElement('div');
                        fileCard.className = 'col-md-4 mb-3';
                        fileCard.innerHTML = `
                <div class="card file-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas ${getFileIcon(file.file_type)} me-2 text-muted"></i>
                            <h6 class="mb-0">${file.file_name}</h6>
                        </div>
                        <p class="small text-muted mb-2">
                            ${formatFileSize(file.file_size)} • ${new Date(file.uploaded_at).toLocaleDateString()}
                        </p>
                        <div class="d-flex">
                            <a href="ajax_helpers/download_file.php?file_id=${file.id}" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                            <a href="${file.display_path}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            `;
                        filesContainer.appendChild(fileCard);
                    });
                }
            }

            function getStatusClass(status) {
                switch (status.toLowerCase()) {
                    case 'pending':
                        return 'bg-warning';
                    case 'in progress':
                        return 'bg-primary';
                    case 'completed':
                        return 'bg-success';
                    default:
                        return 'bg-secondary';
                }
            }

            function getFileIcon(fileType) {
                if (!fileType) return 'fa-file';

                const type = fileType.split('/')[0];
                switch (type) {
                    case 'image':
                        return 'fa-file-image';
                    case 'video':
                        return 'fa-file-video';
                    case 'audio':
                        return 'fa-file-audio';
                    case 'application':
                        if (fileType.includes('pdf')) return 'fa-file-pdf';
                        if (fileType.includes('word')) return 'fa-file-word';
                        if (fileType.includes('excel')) return 'fa-file-excel';
                        if (fileType.includes('powerpoint')) return 'fa-file-powerpoint';
                        if (fileType.includes('zip')) return 'fa-file-archive';
                        return 'fa-file';
                    default:
                        return 'fa-file';
                }
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function showError(message) {
                document.getElementById('loadingSpinner').style.display = 'none';
                const errorElement = document.getElementById('errorMessage');
                errorElement.textContent = message;
                errorElement.style.display = 'block';

                // Also show a SweetAlert for better visibility
                Swal.fire({
                    title: 'Error',
                    text: message,
                    icon: 'error',
                    confirmButtonColor: '#04665f'
                });
            }
        </script>
    </body>

    </html>