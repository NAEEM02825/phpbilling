<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 id="task-title">Loading task...</h2>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body" id="task-details">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Helper functions
            const escapeHtml = (str) => {
                const div = document.createElement('div');
                div.textContent = str;
                return div.innerHTML;
            };

            const getStatusColor = (status) => {
                if (!status) return 'secondary';
                status = status.toLowerCase();
                if (status.includes('completed')) return 'success';
                if (status.includes('progress')) return 'warning';
                if (status.includes('pending')) return 'info';
                return 'secondary';
            };

            const formatDate = (dateString) => {
                if (!dateString) return 'Not set';
                const date = new Date(dateString);
                return isNaN(date) ? 'Invalid date' : date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
            };

            // Get task ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const taskId = urlParams.get('task_id');
            
            if (!taskId) {
                document.getElementById('task-details').innerHTML = 
                    '<div class="alert alert-danger">No task ID provided</div>';
                return;
            }
            
            try {
                // Fetch task details via AJAX
                const response = await fetch(`ajax_helpers/get_task.php`);
                
                // Check if response is successful
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                // Verify content type is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    throw new Error(`Expected JSON but got: ${contentType}. Response: ${text}`);
                }

                const data = await response.json();
                
                // Check for application-level errors
                if (data.error || !data.success) {
                    throw new Error(data.error || 'Unknown error occurred');
                }

                if (!data.task) {
                    throw new Error('Task data not found in response');
                }

                const task = data.task;
                
                // Update the page with task details
                document.getElementById('task-title').textContent = task.title || 'Untitled Task';
                
                const statusColor = getStatusColor(task.status);
                const dueDate = formatDate(task.due_date);
                const description = task.description 
                    ? escapeHtml(task.description).replace(/\n/g, '<br>') 
                    : 'No description';
                
                document.getElementById('task-details').innerHTML = `
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-${statusColor}">
                            ${escapeHtml(task.status || 'Unknown')}
                        </span>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Due Date:</strong>
                        ${dueDate}
                    </div>
                    
                    <hr>
                    
                    <h5>Description</h5>
                    <div class="p-3 bg-light rounded">
                        ${description}
                    </div>
                `;
                
            } catch (error) {
                console.error('Error fetching task:', error);
                document.getElementById('task-details').innerHTML = 
                    `<div class="alert alert-danger">Error loading task: ${escapeHtml(error.message)}</div>`;
            }
        });
    </script>
</body>
</html>