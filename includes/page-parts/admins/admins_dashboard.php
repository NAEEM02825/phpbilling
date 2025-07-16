<!-- Font Awesome CSS for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Dashboard Header -->
<div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
    <div>
        <h1 class="h2">Welcome Back, <span class="text-primary">ADMIN</span></h1>
        <p class="mb-0 text-muted">Here's what's happening with your projects today</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="timePeriodDropdown" data-bs-toggle="dropdown">
                <i class="fas fa-calendar-alt me-1"></i> This Week
            </button>
            <ul class="dropdown-menu" aria-labelledby="timePeriodDropdown">
                <li><a class="dropdown-item" href="#" onclick="changeTimePeriod('today')">Today</a></li>
                <li><a class="dropdown-item" href="#" onclick="changeTimePeriod('week')">This Week</a></li>
                <li><a class="dropdown-item" href="#" onclick="changeTimePeriod('month')">This Month</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#" onclick="showCustomRangePicker()">Custom Range</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Tasks</h6>
                        <h3 class="mb-0" id="totalTasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" id="totalTasksProgress" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-success shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Completed</h6>
                        <h3 class="mb-0" id="completedTasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" id="completedTasksProgress" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Pending</h6>
                        <h3 class="mb-0" id="pendingTasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" role="progressbar" id="pendingTasksProgress" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">In Progress</h6>
                        <h3 class="mb-0" id="inProgressTasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" role="progressbar" id="inProgressTasksProgress" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>

<!-- Activity Overview -->
<div class="row mb-4">
    <div class="col-lg-8 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0">Task Activity</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartFilterDropdown" data-bs-toggle="dropdown">
                        This Month
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chartFilterDropdown">
                        <li><a class="dropdown-item" href="#" onclick="updateTaskActivityChart('today')">Today</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateTaskActivityChart('week')">This Week</a></li>
                        <li><a class="dropdown-item" href="#" onclick="updateTaskActivityChart('month')">This Month</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="updateTaskActivityChart('year')">This Year</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 300px;">
                    <canvas id="taskActivityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0">Task Distribution</h5>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 220px;">
                    <canvas id="taskDistributionChart"></canvas>
                </div>
                <div class="mt-4" id="taskDistributionLegend">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Tasks & Projects -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0">Recent Tasks</h5>
                <a href="index.php?route=modules/task/my_task" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="recentTasksTable">
                            <tr>
                                <td colspan="4" class="text-muted">Loading tasks...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0">Active Projects</h5>
                <a href="index.php?route=modules/projects/projects" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" id="activeProjectsList">
                    <div class="list-group-item text-muted">Loading projects...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manager Section -->
<div class="manager-section mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Financial Overview</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Client</th>
                            <th>Issued</th>
                            <th>Due</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="invoicesTable">
                        <tr>
                            <td colspan="7" class="text-muted">Loading invoices...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced Color Scheme */
    :root {
        --primary: #3a4f8a;
        --primary-light: rgba(58, 79, 138, 0.1);
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --border-color: #e9ecef;
    }

    body {
        background-color: #f5f7fa;
    }

    .dashboard-header {
        border-bottom: none;
        padding-bottom: 1rem;
    }

    th {
        background-color: #04665f !important;
        color: white !important;
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        background-color: white;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    /* Stat Cards */
    .stat-card {
        border-left: 4px solid;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Progress Bars */
    .progress {
        border-radius: 3px;
        background-color: var(--light);
    }

    /* Tables */
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: var(--secondary);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    /* Badges */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        letter-spacing: 0.5px;
    }

    /* Project Icons */
    .project-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    /* List Group Items */
    .list-group-item {
        padding: 1.25rem 1.5rem;
        border-color: var(--border-color);
    }

    /* Buttons */
    .btn-outline-secondary {
        border-color: var(--border-color);
        color: var(--secondary);
    }

    .btn-outline-secondary:hover {
        background-color: var(--light);
    }

    /* Shadows */
    .shadow-sm {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
    }

    /* Status badges */
    .badge.bg-primary {
        background-color: var(--primary) !important;
    }

    .badge.bg-success {
        background-color: var(--success) !important;
    }

    .badge.bg-warning {
        background-color: var(--warning) !important;
    }

    .badge.bg-danger {
        background-color: var(--danger) !important;
    }
</style>

<!-- Add required libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Global variables
    let taskActivityChart;
    let taskDistributionChart;
    let currentTimePeriod = 'week';

    // Document ready function
    $(document).ready(function() {
        // Initialize charts with empty data
        initializeCharts();

        // Fetch all data for dashboard
        fetchDashboardData();
    });

    // Initialize charts
    function initializeCharts() {
        // Task Activity Chart (Line Chart)
        const taskActivityCtx = document.getElementById('taskActivityChart').getContext('2d');
        taskActivityChart = new Chart(taskActivityCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                        label: 'Tasks Completed',
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Tasks Created',
                        data: [],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });

        // Task Distribution Chart (Doughnut Chart)
        const taskDistributionCtx = document.getElementById('taskDistributionChart').getContext('2d');
        taskDistributionChart = new Chart(taskDistributionCtx, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%'
            }
        });
    }

    // Fetch all dashboard data
    function fetchDashboardData() {
        fetchTaskStats();
        fetchRecentTasks();
        fetchActiveProjects();
        fetchInvoiceStats();
        fetchRecentInvoices();
        updateTaskActivityChart(currentTimePeriod);
        updateTaskDistributionChart();
    }

    // Fetch task statistics
    function fetchTaskStats() {
        $.ajax({
            url: 'ajax_helpers/dashboard_task_status.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.success) {
                    $('#totalTasks').text(data.total_tasks || 0);
                    $('#completedTasks').text(data.completed_tasks || 0);
                    $('#pendingTasks').text(data.pending_tasks || 0);
                    $('#inProgressTasks').text(data.in_progress_tasks || 0);

                    // Update progress bars
                    const total = data.total_tasks > 0 ? data.total_tasks : 1;
                    $('#totalTasksProgress').css('width', '100%').attr('aria-valuenow', 100);
                    $('#completedTasksProgress').css('width', (data.completed_tasks / total * 100) + '%').attr('aria-valuenow', data.completed_tasks);
                    $('#pendingTasksProgress').css('width', (data.pending_tasks / total * 100) + '%').attr('aria-valuenow', data.pending_tasks);
                    $('#inProgressTasksProgress').css('width', (data.in_progress_tasks / total * 100) + '%').attr('aria-valuenow', data.in_progress_tasks);
                } else {
                    console.error('Invalid task stats data format');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching task statistics:', error);
            }
        });
    }

    // Fetch recent tasks
    function fetchRecentTasks() {
        $.ajax({
            url: 'ajax_helpers/dashboard_recent_tasks.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let html = '';
                if (data && data.success && data.tasks && data.tasks.length > 0) {
                    data.tasks.forEach(task => {
                        const checked = task.status === 'completed' ? 'checked' : '';
                        const statusClass = getStatusClass(task.status);
                        const statusText = getStatusText(task.status);

                        html += `
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input task-checkbox" type="checkbox" ${checked} data-task-id="${task.id}">
                                    </div>
                                    <span class="ms-2">${task.title}</span>
                                </div>
                            </td>
                            <td>${task.project_name || 'N/A'}</td>
                            <td>${task.due_date || 'N/A'}</td>
                            <td><span class="badge ${statusClass}">${statusText}</span></td>
                        </tr>
                    `;
                    });
                } else {
                    html = '<tr><td colspan="4" class="text-muted">No tasks found</td></tr>';
                }
                $('#recentTasksTable').html(html);

                // Add event listeners to checkboxes
                $('.task-checkbox').change(function() {
                    const taskId = $(this).data('task-id');
                    const isCompleted = $(this).is(':checked');
                    updateTaskStatus(taskId, isCompleted);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching recent tasks:', error);
                $('#recentTasksTable').html('<tr><td colspan="4" class="text-danger">Error loading tasks</td></tr>');
            }
        });
    }

    // Update task status
    function updateTaskStatus(taskId, isCompleted) {
        $.ajax({
            url: 'ajax_helpers/update_task_status.php',
            method: 'POST',
            data: {
                task_id: taskId,
                status: isCompleted ? 'completed' : 'pending'
            },
            success: function() {
                fetchTaskStats(); // Refresh stats
                fetchRecentTasks(); // Refresh task list
            },
            error: function(xhr, status, error) {
                console.error('Error updating task status:', error);
            }
        });
    }

    // Fetch active projects
    function fetchActiveProjects() {
        $.ajax({
            url: 'ajax_helpers/dashboard_active_projects.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let html = '';
                if (data && data.success && data.data && data.data.length > 0) {
                    // Limit to 5 projects for the dashboard
                    const projectsToShow = data.data.slice(0, 5);

                    projectsToShow.forEach(project => {
                        const createdDate = new Date(project.created_at);
                        const now = new Date();
                        const diffDays = Math.floor((now - createdDate) / (1000 * 60 * 60 * 24));
                        const lastUpdated = diffDays === 0 ? 'today' : `${diffDays} days ago`;

                        const category = project.category || 'web';
                        const iconClass = getProjectIcon(category);
                        const iconColor = getProjectColor(category);

                        html += `
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="project-icon ${iconColor}">
                                    <i class="fas ${iconClass}"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">${project.name}</h6>
                                <p class="mb-0 text-muted small">Created ${lastUpdated}</p>
                            </div>
                            <div class="text-end">
                                <div class="progress mb-1" style="height: 6px; width: 100px;">
                                    <div class="progress-bar ${getProgressBarClass(project.progress)}" 
                                         role="progressbar" 
                                         style="width: ${project.progress}%" 
                                         aria-valuenow="${project.progress}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                                <span class="text-muted small">${project.progress}% complete</span>
                            </div>
                        </div>
                    </div>
                    `;
                    });
                } else {
                    html = '<div class="list-group-item text-muted">No active projects found</div>';
                }
                $('#activeProjectsList').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching active projects:', error);
                $('#activeProjectsList').html('<div class="list-group-item text-danger">Error loading projects</div>');
            }
        });
    }

    // Fetch invoice statistics
    function fetchInvoiceStats() {
        $.ajax({
            url: 'ajax_helpers/dashboard_invoice_stats.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.success) {
                    $('#totalInvoices').text(data.total_invoices || 0);
                    $('#paidInvoices').text(data.paid_invoices || 0);
                    $('#pendingInvoices').text(data.pending_invoices || 0);
                    $('#overdueInvoices').text(data.overdue_invoices || 0);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching invoice stats:', error);
            }
        });
    }

    // Fetch recent invoices
    function fetchRecentInvoices(limit = 5) {
        $.ajax({
            url: 'ajax_helpers/dashboard_recent_invoices.php',
            method: 'GET',
            dataType: 'json',
            data: {
                limit: limit
            },
            success: function(response) {
                let html = '';
                if (response && response.success && response.invoices && response.invoices.length > 0) {
                    response.invoices.forEach(invoice => {
                        const statusClass = getInvoiceStatusClass(invoice.status);
                        const statusText = getInvoiceStatusText(invoice.status);

                        html += `
                    <tr>
                        <td>${invoice.invoice_number || 'N/A'}</td>
                        <td>${invoice.client_name || 'N/A'}</td>
                        <td>${formatDate(invoice.issue_date)}</td>
                        <td>${formatDate(invoice.due_date)}</td>
                        <td>$${parseFloat(invoice.total_amount || 0).toFixed(2)}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice(${invoice.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    `;
                    });
                } else {
                    html = '<tr><td colspan="7" class="text-muted">No invoices found</td></tr>';
                }
                $('#invoicesTable').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching recent invoices:', error);
                $('#invoicesTable').html('<tr><td colspan="7" class="text-danger">Error loading invoices</td></tr>');
            }
        });
    }

    // View invoice details
    function viewInvoice(invoiceId) {
        window.location.href = `index.php?route=modules/invoices/view&id=${invoiceId}`;
    }

    // Update task activity chart based on time period
    function updateTaskActivityChart(period) {
        currentTimePeriod = period;

        $.ajax({
            url: 'ajax_helpers/dashboard_task_activity.php',
            method: 'GET',
            data: {
                period: period
            },
            dataType: 'json',
            success: function(data) {
                if (data && data.success) {
                    taskActivityChart.data.labels = data.labels || [];
                    taskActivityChart.data.datasets[0].data = data.completed || [];
                    taskActivityChart.data.datasets[1].data = data.created || [];
                    taskActivityChart.update();

                    // Update dropdown button text
                    let periodText = 'This Week';
                    if (period === 'today') periodText = 'Today';
                    else if (period === 'month') periodText = 'This Month';
                    else if (period === 'year') periodText = 'This Year';

                    $('#chartFilterDropdown').html(periodText);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching task activity data:', error);
            }
        });
    }

    // Update task distribution chart
    function updateTaskDistributionChart() {
        $.ajax({
            url: 'ajax_helpers/dashboard_task_distribution.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    taskDistributionChart.data.labels = response.labels || [];
                    taskDistributionChart.data.datasets[0].data = response.data || [];
                    taskDistributionChart.data.datasets[0].backgroundColor = response.backgroundColors || [];
                    taskDistributionChart.update();

                    // Update legend
                    updateTaskDistributionLegend(response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching task distribution data:', error);
            }
        });
    }

    // Update task distribution legend
    function updateTaskDistributionLegend(data) {
        let html = '';
        const total = data.data ? data.data.reduce((a, b) => a + b, 0) : 0;

        if (data.labels && data.labels.length > 0) {
            data.labels.forEach((label, index) => {
                const value = data.data ? data.data[index] || 0 : 0;
                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                const color = data.backgroundColors ? data.backgroundColors[index] || '#ccc' : '#ccc';

                html += `
                <div class="d-flex align-items-center mb-2">
                    <span class="legend-color me-2" style="background-color:${color}; width:12px; height:12px; border-radius:50%;"></span>
                    <span class="small">${label}</span>
                    <span class="ms-auto fw-bold">${value} (${percentage}%)</span>
                </div>
            `;
            });

            html += `
            <div class="d-flex align-items-center mt-2 pt-2 border-top">
                <span class="small fw-bold">Total Tasks</span>
                <span class="ms-auto fw-bold">${total}</span>
            </div>
        `;
        } else {
            html = '<div class="text-muted">No task distribution data available</div>';
        }

        $('#taskDistributionLegend').html(html);
    }

    // Helper function to format dates
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        try {
            const date = new Date(dateString);
            return date.toLocaleDateString();
        } catch (e) {
            return 'N/A';
        }
    }

    // Helper functions for status display
    function getStatusClass(status) {
        switch (status) {
            case 'completed':
                return 'bg-success';
            case 'in_progress':
                return 'bg-primary';
            case 'pending':
                return 'bg-warning';
            case 'overdue':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }

    function getStatusText(status) {
        switch (status) {
            case 'completed':
                return 'Completed';
            case 'in_progress':
                return 'In Progress';
            case 'pending':
                return 'Pending';
            case 'overdue':
                return 'Overdue';
            default:
                return status;
        }
    }

    function getInvoiceStatusClass(status) {
        switch (status) {
            case 'paid':
                return 'bg-success';
            case 'sent':
                return 'bg-primary';
            case 'pending':
                return 'bg-warning';
            case 'overdue':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }

    function getInvoiceStatusText(status) {
        switch (status) {
            case 'paid':
                return 'Paid';
            case 'sent':
                return 'Sent';
            case 'pending':
                return 'Pending';
            case 'overdue':
                return 'Overdue';
            default:
                return status;
        }
    }

    function getProjectIcon(category) {
        switch (category) {
            case 'ecommerce':
                return 'fa-shopping-cart';
            case 'mobile':
                return 'fa-mobile-alt';
            case 'web':
                return 'fa-globe';
            case 'dashboard':
                return 'fa-desktop';
            default:
                return 'fa-project-diagram';
        }
    }

    function getProjectColor(category) {
        switch (category) {
            case 'ecommerce':
                return 'bg-primary bg-opacity-10 text-primary';
            case 'mobile':
                return 'bg-info bg-opacity-10 text-info';
            case 'web':
                return 'bg-success bg-opacity-10 text-success';
            case 'dashboard':
                return 'bg-warning bg-opacity-10 text-warning';
            default:
                return 'bg-secondary bg-opacity-10 text-secondary';
        }
    }

    function getProgressBarClass(percentage) {
        if (percentage >= 80) return 'bg-success';
        if (percentage >= 50) return 'bg-primary';
        if (percentage >= 30) return 'bg-warning';
        return 'bg-danger';
    }

    // Change time period
    function changeTimePeriod(period) {
        currentTimePeriod = period;
        updateTaskActivityChart(period);

        // Update dropdown button text
        let periodText = 'This Week';
        if (period === 'today') periodText = 'Today';
        else if (period === 'month') periodText = 'This Month';

        $('#timePeriodDropdown').html(`<i class="fas fa-calendar-alt me-1"></i> ${periodText}`);
    }

    // Show custom range picker (placeholder)
    function showCustomRangePicker() {
        alert('Custom range picker would be implemented here');
    }
</script>