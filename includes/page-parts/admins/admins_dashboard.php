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
                <a href="./my_task.php" class="btn btn-sm btn-outline-primary">View All</a>
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
                            <!-- Will be populated by JavaScript -->
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
                    <!-- Will be populated by JavaScript -->
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
            <div class="row mb-4">
                <div class="col-md-3 col-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-file-invoice text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Invoices</h6>
                            <h4 class="mb-0" id="totalInvoices">0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Paid</h6>
                            <h4 class="mb-0" id="paidInvoices">0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h4 class="mb-0" id="pendingInvoices">0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-danger bg-opacity-10 p-3 rounded">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Overdue</h6>
                            <h4 class="mb-0" id="overdueInvoices">0</h4>
                        </div>
                    </div>
                </div>
            </div>

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
                        <!-- Will be populated by JavaScript -->
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

        // Load projects for task modal
        loadProjectsForTaskModal();

        // Load clients and projects for invoice modal
        loadClientsForInvoiceModal();
    });

    // Initialize charts
    function initializeCharts() {
        const taskActivityCtx = document.getElementById('taskActivityChart').getContext('2d');
        const taskDistributionCtx = document.getElementById('taskDistributionChart').getContext('2d');

        // Task Activity Chart (Line Chart)
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
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
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

        // Task Distribution Chart (Pie Chart)
        taskDistributionChart = new Chart(taskDistributionCtx, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                },
                cutout: '65%'
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
                if (data.success) {
                    $('#totalTasks').text(data.total_tasks);
                    $('#completedTasks').text(data.completed_tasks);
                    $('#pendingTasks').text(data.pending_tasks);
                    $('#inProgressTasks').text(data.in_progress_tasks); // Changed from overdue_tasks to in_progress_tasks

                    // Update progress bars
                    const total = data.total_tasks > 0 ? data.total_tasks : 1;
                    $('#totalTasksProgress').css('width', '100%').attr('aria-valuenow', 100);
                    $('#completedTasksProgress').css('width', (data.completed_tasks / total * 100) + '%').attr('aria-valuenow', data.completed_tasks);
                    $('#pendingTasksProgress').css('width', (data.pending_tasks / total * 100) + '%').attr('aria-valuenow', data.pending_tasks);
                    $('#inProgressTasksProgress').css('width', (data.in_progress_tasks / total * 100) + '%').attr('aria-valuenow', data.in_progress_tasks); // Changed from overdue_tasks to in_progress_tasks
                }
            },
            error: function() {
                console.error('Error fetching task statistics');
            }
        });
    }

    // Fetch recent tasks
    function fetchRecentTasks() {
        $.ajax({
            url: 'api/dashboard/recent-tasks.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let html = '';
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
                                <td>${task.due_date}</td>
                                <td><span class="badge ${statusClass}">${statusText}</span></td>
                            </tr>
                        `;
                    });

                    $('#recentTasksTable').html(html);

                    // Add event listeners to checkboxes
                    $('.task-checkbox').change(function() {
                        const taskId = $(this).data('task-id');
                        const isCompleted = $(this).is(':checked');
                        updateTaskStatus(taskId, isCompleted);
                    });
                }
            },
            error: function() {
                console.error('Error fetching recent tasks');
            }
        });
    }

    // Fetch active projects
   // Fetch active projects - Updated version
function fetchActiveProjects() {
    $.ajax({
        url: 'ajax_helpers/dashboard_active_projects.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success && data.data) {
                let html = '';
                
                // Limit to 5 projects for the dashboard
                const projectsToShow = data.data.slice(0, 5);
                
                projectsToShow.forEach(project => {
                    // Calculate last updated time (simplified)
                    const createdDate = new Date(project.created_at);
                    const now = new Date();
                    const diffDays = Math.floor((now - createdDate) / (1000 * 60 * 60 * 24));
                    const lastUpdated = diffDays === 0 ? 'today' : `${diffDays} days ago`;
                    
                    // Default to 'web' if category is not set
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

                $('#activeProjectsList').html(html);
            } else {
                console.error('Data format error:', data);
                $('#activeProjectsList').html('<div class="list-group-item text-muted">No active projects found</div>');
            }
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
            url: 'api/dashboard/invoice-stats.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#totalInvoices').text(data.total_invoices);
                    $('#paidInvoices').text(data.paid_invoices);
                    $('#pendingInvoices').text(data.pending_invoices);
                    $('#overdueInvoices').text(data.overdue_invoices);
                }
            },
            error: function() {
                console.error('Error fetching invoice statistics');
            }
        });
    }

    // Fetch recent invoices
    function fetchRecentInvoices() {
        $.ajax({
            url: 'api/dashboard/recent-invoices.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let html = '';
                    data.invoices.forEach(invoice => {
                        const statusClass = getInvoiceStatusClass(invoice.status);
                        const statusText = getInvoiceStatusText(invoice.status);

                        html += `
                            <tr>
                                <td><a href="#" class="text-primary">${invoice.invoice_number}</a></td>
                                <td>${invoice.client_name}</td>
                                <td>${invoice.issue_date}</td>
                                <td>${invoice.due_date}</td>
                                <td>$${invoice.total_amount.toFixed(2)}</td>
                                <td><span class="badge ${statusClass}">${statusText}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                        `;
                    });

                    $('#invoicesTable').html(html);
                }
            },
            error: function() {
                console.error('Error fetching recent invoices');
            }
        });
    }

    // Update task activity chart based on time period
    function updateTaskActivityChart(period) {
        currentTimePeriod = period;

        $.ajax({
            url: 'api/dashboard/task-activity.php',
            method: 'GET',
            data: {
                period: period
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    taskActivityChart.data.labels = data.labels;
                    taskActivityChart.data.datasets[0].data = data.completed;
                    taskActivityChart.data.datasets[1].data = data.created;
                    taskActivityChart.update();

                    // Update dropdown button text
                    let periodText = 'This Week';
                    if (period === 'today') periodText = 'Today';
                    else if (period === 'month') periodText = 'This Month';
                    else if (period === 'year') periodText = 'This Year';

                    $('#chartFilterDropdown').html(periodText);
                }
            },
            error: function() {
                console.error('Error fetching task activity data');
            }
        });
    }

    // Update task distribution chart
    function updateTaskDistributionChart() {
        $.ajax({
            url: 'api/dashboard/task-distribution.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Update chart
                    taskDistributionChart.data.labels = data.labels;
                    taskDistributionChart.data.datasets[0].data = data.data;
                    taskDistributionChart.data.datasets[0].backgroundColor = data.backgroundColors;
                    taskDistributionChart.data.datasets[0].borderColor = data.borderColors;
                    taskDistributionChart.update();

                    // Update legend
                    let legendHtml = '';
                    data.labels.forEach((label, index) => {
                        legendHtml += `
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge ${data.backgroundColors[index].replace('bg-', 'bg-')} me-2" style="width: 12px; height: 12px; padding: 0;"></span>
                                <span class="text-muted small">${label}</span>
                                <span class="ms-auto fw-bold">${data.data[index]}%</span>
                            </div>
                        `;
                    });

                    $('#taskDistributionLegend').html(legendHtml);
                }
            },
            error: function() {
                console.error('Error fetching task distribution data');
            }
        });
    }

    // Load projects for task modal
    function loadProjectsForTaskModal() {
        $.ajax({
            url: 'api/projects/list.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let options = '<option value="">Select Project</option>';
                    data.projects.forEach(project => {
                        options += `<option value="${project.id}">${project.name}</option>`;
                    });
                    $('#taskProject').html(options);
                }
            },
            error: function() {
                console.error('Error loading projects for task modal');
            }
        });
    }

    // Load clients for invoice modal
    function loadClientsForInvoiceModal() {
        $.ajax({
            url: 'api/clients/list.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let options = '<option value="">Select Client</option>';
                    data.clients.forEach(client => {
                        options += `<option value="${client.id}">${client.name}</option>`;
                    });
                    $('#invoiceClient').html(options);

                    // Load projects when client is selected
                    $('#invoiceClient').change(function() {
                        const clientId = $(this).val();
                        if (clientId) {
                            loadProjectsForClient(clientId);
                        }
                    });
                }
            },
            error: function() {
                console.error('Error loading clients for invoice modal');
            }
        });
    }

    // Load projects for a specific client
    function loadProjectsForClient(clientId) {
        $.ajax({
            url: 'api/projects/list.php',
            method: 'GET',
            data: {
                client_id: clientId
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    let options = '<option value="">Select Project</option>';
                    data.projects.forEach(project => {
                        options += `<option value="${project.id}">${project.name}</option>`;
                    });
                    $('#invoiceProject').html(options);
                }
            },
            error: function() {
                console.error('Error loading projects for client');
            }
        });
    }

    // Create new task
    function createNewTask() {
        const title = $('#taskTitle').val();
        const projectId = $('#taskProject').val();
        const dueDate = $('#taskDueDate').val();
        const priority = $('#taskPriority').val();
        const description = $('#taskDescription').val();

        if (!title || !projectId || !dueDate) {
            alert('Please fill in all required fields');
            return;
        }

        $.ajax({
            url: 'api/tasks/create.php',
            method: 'POST',
            data: {
                title: title,
                project_id: projectId,
                due_date: dueDate,
                priority: priority,
                description: description
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#newTaskModal').modal('hide');
                    $('#newTaskForm')[0].reset();
                    fetchDashboardData(); // Refresh dashboard data
                } else {
                    alert(data.message || 'Error creating task');
                }
            },
            error: function() {
                alert('Error creating task');
            }
        });
    }

    // Create new invoice
    function createNewInvoice() {
        const clientId = $('#invoiceClient').val();
        const projectId = $('#invoiceProject').val();
        const invoiceDate = $('#invoiceDate').val();
        const dueDate = $('#invoiceDueDate').val();
        const taxRate = $('#invoiceTax').val() || 0;
        const notes = $('#invoiceNotes').val();

        if (!clientId || !projectId || !invoiceDate || !dueDate) {
            alert('Please fill in all required fields');
            return;
        }

        // Collect invoice items
        const items = [];
        $('#invoiceItemsTable tbody tr').each(function() {
            const description = $(this).find('.item-description').val();
            const quantity = $(this).find('.item-quantity').val();
            const price = $(this).find('.item-price').val();

            if (description && quantity && price) {
                items.push({
                    description: description,
                    quantity: quantity,
                    unit_price: price
                });
            }
        });

        if (items.length === 0) {
            alert('Please add at least one invoice item');
            return;
        }

        $.ajax({
            url: 'api/invoices/create.php',
            method: 'POST',
            data: {
                client_id: clientId,
                project_id: projectId,
                invoice_date: invoiceDate,
                due_date: dueDate,
                tax_rate: taxRate,
                notes: notes,
                items: JSON.stringify(items)
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#newInvoiceModal').modal('hide');
                    $('#newInvoiceForm')[0].reset();
                    fetchDashboardData(); // Refresh dashboard data
                } else {
                    alert(data.message || 'Error creating invoice');
                }
            },
            error: function() {
                alert('Error creating invoice');
            }
        });
    }

    // Update task status
    function updateTaskStatus(taskId, isCompleted) {
        $.ajax({
            url: 'api/tasks/update-status.php',
            method: 'POST',
            data: {
                task_id: taskId,
                is_completed: isCompleted
            },
            dataType: 'json',
            success: function(data) {
                if (!data.success) {
                    console.error('Error updating task status');
                    // Revert checkbox state
                    $(`.task-checkbox[data-task-id="${taskId}"]`).prop('checked', !isCompleted);
                }
            },
            error: function() {
                console.error('Error updating task status');
                // Revert checkbox state
                $(`.task-checkbox[data-task-id="${taskId}"]`).prop('checked', !isCompleted);
            }
        });
    }

    // Add invoice item
    function addInvoiceItem() {
        const newRow = `
            <tr>
                <td><input type="text" class="form-control item-description" placeholder="Item description"></td>
                <td><input type="number" class="form-control item-quantity" value="1" min="1"></td>
                <td><input type="number" class="form-control item-price" placeholder="0.00" step="0.01" min="0"></td>
                <td><input type="text" class="form-control item-amount" placeholder="0.00" readonly></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeInvoiceItem(this)"><i class="fas fa-times"></i></button></td>
            </tr>
        `;

        $('#invoiceItemsTable tbody').append(newRow);

        // Add event listeners to new inputs
        const row = $('#invoiceItemsTable tbody tr').last();
        row.find('.item-quantity, .item-price').on('input', calculateInvoiceAmounts);
    }

    // Remove invoice item
    function removeInvoiceItem(button) {
        $(button).closest('tr').remove();
        calculateInvoiceAmounts();
    }

    // Calculate invoice amounts
    function calculateInvoiceAmounts() {
        let subtotal = 0;

        $('#invoiceItemsTable tbody tr').each(function() {
            const quantity = parseFloat($(this).find('.item-quantity').val()) || 0;
            const price = parseFloat($(this).find('.item-price').val()) || 0;
            const amount = quantity * price;

            $(this).find('.item-amount').val(amount.toFixed(2));
            subtotal += amount;
        });

        const taxRate = parseFloat($('#invoiceTax').val()) || 0;
        const taxAmount = subtotal * (taxRate / 100);
        const total = subtotal + taxAmount;

        $('#invoiceSubtotal').val(subtotal.toFixed(2));
        $('#invoiceTotal').val(total.toFixed(2));
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

    // Helper functions
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

    // Initialize invoice item calculations
    $(document).on('input', '.item-quantity, .item-price', calculateInvoiceAmounts);
    $(document).on('input', '#invoiceTax', calculateInvoiceAmounts);
</script>