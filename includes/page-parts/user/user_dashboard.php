
<?php
$user_id = $_GET['user_id'] ?? null; // Get user_id from request

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

try {    
    // Query to get task counts
    $query = "
        SELECT 
            COUNT(*) as total_tasks,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'overdue' THEN 1 ELSE 0 END) as overdue
        FROM tasks
        WHERE user_id = :user_id
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'total' => (int)$result['total_tasks'],
        'completed' => (int)$result['completed'],
        'pending' => (int)$result['pending'],
        'overdue' => (int)$result['overdue']
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Dashboard Header -->
<div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
    <div>
        <h1 class="h2">Welcome Back, <span class="text-primary" id="username">ADMIN</span></h1>
        <p class="mb-0 text-muted">Here's what's happening with your projects today</p>
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
                        <h3 class="mb-0"><span class="loading-spinner spinner-border spinner-border-sm me-2"></span><span class="stat-value">0</span></h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary stat-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <h3 class="mb-0"><span class="loading-spinner spinner-border spinner-border-sm me-2"></span><span class="stat-value">0</span></h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success stat-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <h3 class="mb-0"><span class="loading-spinner spinner-border spinner-border-sm me-2"></span><span class="stat-value">0</span></h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning stat-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-danger shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Overdue</h6>
                        <h3 class="mb-0"><span class="loading-spinner spinner-border spinner-border-sm me-2"></span><span class="stat-value">0</span></h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-danger stat-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current user ID (in a real app, this would come from your authentication system)
    const userId = getCurrentUserId(); // Implement this function based on your auth system
    
    // Fetch user data first (optional)
    fetchUserData(userId).then(user => {
        document.getElementById('username').textContent = user.name;
    });
    
    // Then fetch task statistics
    fetchTaskStatistics(userId);
});

function getCurrentUserId() {
    // Implement this based on how you store user session
    // This might come from a cookie, local storage, or session
    return 1; // Example - replace with actual implementation
}

async function fetchUserData(userId) {
    try {
        const response = await fetch(`/api/user.php?id=${userId}`);
        if (!response.ok) throw new Error('Failed to fetch user data');
        return await response.json();
    } catch (error) {
        console.error('Error fetching user data:', error);
        return { name: 'User' }; // Fallback
    }
}

async function fetchTaskStatistics(userId) {
    try {
        const response = await fetch(`/api/task_stats.php?user_id=${userId}`);
        if (!response.ok) throw new Error('Failed to fetch task statistics');
        const data = await response.json();
        
        updateDashboard(data);
    } catch (error) {
        console.error('Error fetching task statistics:', error);
        // Optionally show error to user
    }
}

function updateDashboard(data) {
    // Hide loading spinners
    document.querySelectorAll('.loading-spinner').forEach(spinner => {
        spinner.style.display = 'none';
    });
    
    // Update values
    const cards = document.querySelectorAll('.stat-card');
    
    // Total Tasks
    cards[0].querySelector('.stat-value').textContent = data.total;
    cards[0].querySelector('.stat-progress').style.width = 
        data.total > 0 ? `${(data.completed / data.total) * 100}%` : '0%';
    
    // Completed
    cards[1].querySelector('.stat-value').textContent = data.completed;
    cards[1].querySelector('.stat-progress').style.width = 
        data.total > 0 ? `${(data.completed / data.total) * 100}%` : '0%';
    
    // Pending
    cards[2].querySelector('.stat-value').textContent = data.pending;
    cards[2].querySelector('.stat-progress').style.width = 
        data.total > 0 ? `${(data.pending / data.total) * 100}%` : '0%';
    
    // Overdue
    cards[3].querySelector('.stat-value').textContent = data.overdue;
    cards[3].querySelector('.stat-progress').style.width = 
        data.total > 0 ? `${(data.overdue / data.total) * 100}%` : '0%';
}
</script>