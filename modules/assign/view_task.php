<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .task-header {
            background-color: #04665f;
            color: white;
            padding: 1rem;
            border-radius: 0.25rem 0.25rem 0 0;
        }
        .task-detail-card {
            border-left: 4px solid #04665f;
        }
        .attachment-item {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 0.75rem;
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="task-header d-flex justify-content-between align-items-center">
                <h2 id="task-title">Task Details</h2>
                <a href="javascript:history.back()" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Task Details -->
                        <div class="card mb-4 task-detail-card">
                            <div class="card-body">
                                <div id="task-loading" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2">Loading task details...</p>
                                </div>
                                
                                <div id="task-content" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span id="task-status" class="badge"></span>
                                            <span id="task-priority" class="badge ms-2"></span>
                                        </div>
                                        <div id="task-date" class="text-muted"></div>
                                    </div>
                                    
                                    <h4 id="task-name" class="mb-3"></h4>
                                    
                                    <div class="mb-4">
                                        <h5>Description</h5>
                                        <div id="task-description" class="p-3 bg-light rounded"></div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5>Project</h5>
                                            <p id="task-project" class="text-muted"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Assignee</h5>
                                            <p id="task-assignee" class="text-muted"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Estimated Hours</h5>
                                            <p id="task-hours" class="text-muted"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Created</h5>
                                            <p id="task-created" class="text-muted"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comments Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Comments</h5>
                            </div>
                            <div class="card-body">
                                <div id="comments-container">
                                    <p class="text-muted">No comments yet.</p>
                                </div>
                                <form id="comment-form" class="mt-3">
                                    <div class="mb-3">
                                        <textarea class="form-control" id="comment-text" rows="3" placeholder="Add a comment..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-custom">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Task Meta -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6>ClickUp Link</h6>
                                    <p id="clickup-link" class="text-muted">Not provided</p>
                                </div>
                                <div class="mb-3">
                                    <h6>Last Updated</h6>
                                    <p id="task-updated" class="text-muted"></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Attachments -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Attachments</h5>
                            </div>
                            <div class="card-body">
                                <div id="attachments-container">
                                    <p class="text-muted">No attachments.</p>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary mt-2" id="upload-btn">
                                    <i class="fas fa-plus"></i> Add Attachment
                                </button>
                                <input type="file" id="file-upload" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Get task ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const taskId = urlParams.get('task_id');
            
            if (!taskId) {
                showError('No task ID provided');
                return;
            }
            
            try {
                // Fetch task details
                const response = await fetch(`ajax_helpers/get_task.php?task_id=${taskId}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                
                const data = await response.json();
                
                if (data.error || !data.success) {
                    throw new Error(data.error || 'Failed to load task');
                }
                
                if (!data.task) {
                    throw new Error('Task data not found');
                }
                
                const task = data.task;
                
                // Update the page with task details
                document.getElementById('task-title').textContent = task.title || 'Untitled Task';
                
                // Set status badge
                const statusBadge = document.getElementById('task-status');
                statusBadge.textContent = task.status || 'Unknown';
                statusBadge.className = 'badge ' + getStatusClass(task.status);
                
                // Set other task details
                document.getElementById('task-name').textContent = task.title || 'Untitled Task';
                document.getElementById('task-description').innerHTML = task.details 
                    ? formatTextWithLineBreaks(task.details) 
                    : '<em>No description provided</em>';
                
                document.getElementById('task-project').textContent = task.project_name || 'No project';
                document.getElementById('task-assignee').textContent = task.assignee_name 
                    ? `${task.assignee_name} (${task.assignee_initials || ''})` 
                    : 'Unassigned';
                
                document.getElementById('task-hours').textContent = task.hours ? `${task.hours} hours` : 'Not estimated';
                document.getElementById('task-created').textContent = formatDate(task.created_at);
                document.getElementById('task-updated').textContent = formatDate(task.updated_at);
                
                if (task.clickup_link) {
                    const clickupLink = document.getElementById('clickup-link');
                    clickupLink.innerHTML = `<a href="${task.clickup_link}" target="_blank">View in ClickUp <i class="fas fa-external-link-alt"></i></a>`;
                }
                
                // Hide loading spinner and show content
                document.getElementById('task-loading').style.display = 'none';
                document.getElementById('task-content').style.display = 'block';
                
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('task-loading').innerHTML = `
                    <div class="alert alert-danger">
                        Error loading task: ${escapeHtml(error.message)}
                    </div>
                `;
            }
            
            // Helper functions
            function escapeHtml(str) {
                if (!str) return '';
                const div = document.createElement('div');
                div.textContent = str;
                return div.innerHTML;
            }
            
            function getStatusClass(status) {
                if (!status) return 'bg-secondary';
                status = status.toLowerCase();
                if (status.includes('completed')) return 'bg-success';
                if (status.includes('progress')) return 'bg-warning';
                if (status.includes('pending')) return 'bg-info';
                return 'bg-secondary';
            }
            
            function formatDate(dateString) {
                if (!dateString) return 'Not available';
                const date = new Date(dateString);
                if (isNaN(date)) return 'Invalid date';
                
                return date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
            
            function formatTextWithLineBreaks(text) {
                if (!text) return '';
                return escapeHtml(text).replace(/\n/g, '<br>');
            }
            
            function showError(message) {
                const loadingDiv = document.getElementById('task-loading');
                if (loadingDiv) {
                    loadingDiv.innerHTML = `
                        <div class="alert alert-danger">
                            ${escapeHtml(message)}
                        </div>
                    `;
                } else {
                    alert(message);
                }
            }
        });
    </script>
</body>
</html>