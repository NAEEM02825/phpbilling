<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Dashboard Header -->
<div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4">
    <div>
        <h1 class="h2">Welcome Back, <span class="text-primary">Employee</span></h1>
        <p class="mb-0 text-muted">Here's what's happening with your projects today</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">

    <!-- Total Tasks -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Total Tasks</h6>
                        <h3 class="mb-0" id="total-tasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" id="progress-total" role="progressbar" style="width: 0%"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Completed -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-success shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Completed</h6>
                        <h3 class="mb-0" id="completed-tasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" id="progress-completed" role="progressbar" style="width: 0%"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Pending</h6>
                        <h3 class="mb-0" id="pending-tasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" id="progress-pending" role="progressbar" style="width: 0%"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Overdue -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-start-lg border-start-danger shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ms-auto text-end">
                        <h6 class="text-muted mb-1">Overdue</h6>
                        <h3 class="mb-0" id="overdue-tasks">0</h3>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-danger" id="progress-overdue" role="progressbar" style="width: 0%"></div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Task Stats AJAX -->
<script>
    $(document).ready(function() {
        const userId = <?php echo $_SESSION['user_id']; ?>;

        $.ajax({
            url: 'ajax_helpers/ajax_task_stats.php',
            method: 'GET',
            dataType: 'json',
            data: {
                user_id: userId
            },
            success: function(data) {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                const total = data.total || 0;
                const completed = data.completed || 0;
                const pending = data.pending || 0;
                const overdue = data.overdue || 0;

                // Update numbers
                $('#total-tasks').text(total);
                $('#Completed-tasks').text(completed);
                $('#pending-tasks').text(pending);
                $('#overdue-tasks').text(overdue);

                // Calculate percentages safely
                const safeDiv = total > 0 ? total : 1;

                // Update progress bars
                $('#progress-total').css('width', `${(completed / safeDiv) * 100}%`);
                $('#progress-Completed').css('width', `${(completed / safeDiv) * 100}%`);
                $('#progress-pending').css('width', `${(pending / safeDiv) * 100}%`);
                $('#progress-overdue').css('width', `${(overdue / safeDiv) * 100}%`);
            },
            error: function(xhr) {
                console.error("AJAX error", xhr.responseText);
            }
        });
    });
</script>