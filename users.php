<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Users Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">User Management</h1>
            <p class="mb-0 text-muted">Manage system users and permissions</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-1"></i> Add User
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i> Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i> PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i> CSV</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- User Status Tabs -->
    <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-users-tab" data-bs-toggle="tab" data-bs-target="#all-users" type="button" role="tab">
                <i class="fas fa-users me-1"></i> All Users
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="active-users-tab" data-bs-toggle="tab" data-bs-target="#active-users" type="button" role="tab">
                <i class="fas fa-user-check me-1"></i> Active
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="inactive-users-tab" data-bs-toggle="tab" data-bs-target="#inactive-users" type="button" role="tab">
                <i class="fas fa-user-slash me-1"></i> Inactive
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admins-tab" data-bs-toggle="tab" data-bs-target="#admins" type="button" role="tab">
                <i class="fas fa-user-shield me-1"></i> Administrators
            </button>
        </li>
    </ul>

    <!-- User Content -->
    <div class="tab-content" id="userTabsContent">
        <div class="tab-pane fade show active" id="all-users" role="tabpanel">
            <!-- User Filters -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="roleFilter" class="form-label">Role</label>
                            <select class="form-select" id="roleFilter">
                                <option selected>All Roles</option>
                                <option>Administrator</option>
                                <option>Manager</option>
                                <option>Editor</option>
                                <option>Viewer</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="statusFilter" class="form-label">Status</label>
                            <select class="form-select" id="statusFilter">
                                <option selected>All Statuses</option>
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Suspended</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- User List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllUsers">
                                        </div>
                                    </th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Last Active</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="avatar-img rounded-circle" alt="John Doe">
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">John Doe</a>
                                                <p class="mb-0 text-muted small">@johndoe</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>john.doe@example.com</td>
                                    <td><span class="badge bg-primary">Administrator</span></td>
                                    <td>Today, 09:42 AM</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="userActions1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Reset Password</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-user-slash me-2"></i> Deactivate</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar-img rounded-circle" alt="Jane Smith">
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Jane Smith</a>
                                                <p class="mb-0 text-muted small">@janesmith</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>jane.smith@example.com</td>
                                    <td><span class="badge bg-info">Manager</span></td>
                                    <td>Yesterday, 04:15 PM</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="userActions2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Reset Password</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-user-slash me-2"></i> Deactivate</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title rounded-circle bg-warning text-white">MJ</span>
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Mike Johnson</a>
                                                <p class="mb-0 text-muted small">@mikej</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>mike.johnson@example.com</td>
                                    <td><span class="badge bg-secondary">Editor</span></td>
                                    <td>Jul 28, 2023</td>
                                    <td><span class="badge bg-secondary">Inactive</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="userActions3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Reset Password</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-success" href="#"><i class="fas fa-user-check me-2"></i> Activate</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <img src="https://randomuser.me/api/portraits/women/68.jpg" class="avatar-img rounded-circle" alt="Sarah Miller">
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Sarah Miller</a>
                                                <p class="mb-0 text-muted small">@sarahm</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>sarah.miller@example.com</td>
                                    <td><span class="badge bg-success">Viewer</span></td>
                                    <td>Today, 11:20 AM</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userActions4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="userActions4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View Profile</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Reset Password</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-user-slash me-2"></i> Deactivate</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> users</p>
                        </div>
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Other Tab Panes -->
        <div class="tab-pane fade" id="active-users" role="tabpanel">
            <!-- Active users content would go here -->
        </div>
        <div class="tab-pane fade" id="inactive-users" role="tabpanel">
            <!-- Inactive users content would go here -->
        </div>
        <div class="tab-pane fade" id="admins" role="tabpanel">
            <!-- Admin users content would go here -->
        </div>
    </div>
</main>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="userFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="userFirstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="userLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select class="form-select" id="userRole" required>
                            <option selected disabled>Select Role</option>
                            <option>Administrator</option>
                            <option>Manager</option>
                            <option>Editor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userStatus" class="form-label">Status</label>
                        <select class="form-select" id="userStatus">
                            <option selected value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="userConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="userConfirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>

<style>
    /* User Page Specific Styles */
    .nav-tabs {
        border-bottom: 1px solid #e9ecef;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        border-bottom: 3px solid transparent;
    }
    
    .nav-tabs .nav-link:hover {
        color: #3a4f8a;
        border-bottom-color: #dee2e6;
    }
    
    .nav-tabs .nav-link.active {
        color: #3a4f8a;
        background-color: transparent;
        border-bottom-color: #3a4f8a;
    }
    
    /* Avatar Styles */
    .avatar-sm {
        width: 40px;
        height: 40px;
    }
    
    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    
    /* Table Styles */
    .table th {
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Badge Styles */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    
    .badge.bg-primary {
        background-color: #3a4f8a !important;
    }
    
    /* Pagination Styles */
    .page-item.active .page-link {
        background-color: #3a4f8a;
        border-color: #3a4f8a;
    }
    
    .page-link {
        color: #3a4f8a;
    }
    
    /* Dropdown Menu Styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }
    
    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    .card-footer {
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    /* Modal Styles */
    .modal-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .modal-footer {
        border-top: 1px solid rgba(0,0,0,0.05);
    }
</style>