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
</ul>

<!-- User Content -->
<div class="tab-content" id="userTabsContent">
    <div class="tab-pane fade show active" id="all-users" role="tabpanel">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form class="row g-3" id="userFiltersForm">
                    <div class="col-md-4">
                        <label for="roleFilter" class="form-label">Role</label>
                        <select class="form-select" id="roleFilter">
                            <?php
                            try {
                                $roles = DB::query("SELECT id, name FROM roles ORDER BY name");
                                echo '<option value="" selected>All Roles</option>';
                                foreach ($roles as $role) {
                                    echo '<option value="' . htmlspecialchars($role['id']) . '">' . htmlspecialchars($role['name']) . '</option>';
                                }
                            } catch (Exception $e) {
                                echo '<option value="" selected>Error loading roles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <?php
                            try {
                                $statuses = DB::query("SELECT DISTINCT status FROM users ORDER BY status");
                                echo '<option value="" selected>All Statuses</option>';
                                foreach ($statuses as $status) {
                                    $formattedStatus = ucfirst($status['status']);
                                    echo '<option value="' . htmlspecialchars($status['status']) . '">' . htmlspecialchars($formattedStatus) . '</option>';
                                }
                            } catch (Exception $e) {
                                echo '<option value="" selected>Error loading statuses</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <button type="button" id="resetFilters" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- User List -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-hover align-middle mb-0">
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
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <input type="hidden" name="action" value="add_user">
                    <div class="mb-3">
                        <label for="userFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="userFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="userLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userUsername" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select class="form-select" id="userRole" name="role_id" required>
                            <!-- Will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userStatus" class="form-label">Status</label>
                        <select class="form-select" id="userStatus" name="status">
                            <option selected value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="userConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="userConfirmPassword" name="confirm_password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitAddUser">Add User</button>
            </div>
        </div>
    </div>
</div>



<!-- Edit user  -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" id="editUserId" name="user_id">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="role_id" required>
                            <!-- Will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitEditUser">Update User</button>
            </div>
        </div>
    </div>
</div>

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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }

    /* Card Styles */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Modal Styles */
    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
</style>

<Script>
    // Update the add user form submission handler
    $('#submitAddUser').on('click', function() {
        const form = $('#addUserForm');
        const formData = form.serializeArray();
        const data = {};

        // Convert form data to object
        formData.forEach(item => {
            data[item.name] = item.value;
        });

        // Validate passwords match
        if (data.password !== data.confirm_password) {
            alert('Passwords do not match!');
            return;
        }

        // Remove confirm_password from data before sending
        delete data.confirm_password;

        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#addUserModal').modal('hide');
                    form[0].reset();
                    alert('User added successfully');
                    window.location.reload(); // Page will refresh
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error adding user: ' + error);
            }
        });
    });
    $(document).ready(function() {
        // Load users on page load
        loadUsers();

        // Handle tab changes
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).data('bs-target');
            loadUsers(target.replace('#', ''));
        });

        // Apply filters
        $('#userFiltersForm').on('submit', function(e) {
            e.preventDefault();
            loadUsers();
        });

        // Add user form
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            addUser();
        });

        // Edit user modal
        $(document).on('click', '.edit-user', function(e) {
            e.preventDefault();
            const userId = $(this).data('id');
            loadUserData(userId);
            $('#editUserModal').modal('show');
        });

        // Update user form
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            updateUser();
        });

        // Delete user
        $(document).on('click', '.delete-user', function() {
            const userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                deleteUser(userId);
            }
        });

        // Change status
        $(document).on('click', '.change-status', function() {
            const userId = $(this).data('id');
            const status = $(this).data('status');
            changeStatus(userId, status);
        });
    });
    $('#submitEditUser').on('click', function() {
        const formData = $('#editUserForm').serializeArray();
        const data = {};
        formData.forEach(item => {
            data[item.name] = item.value;
        });

        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#editUserModal').modal('hide');
                    loadUsers();
                    alert('User updated successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating user: ' + error);
            }
        });
    });
    $(document).ready(function() {
        // Load users on page load
        loadUsers();

        // Handle tab changes
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            const target = $(e.target).data('bs-target');
            loadUsers(target.replace('#', ''));
        });

        // Apply filters
        $('.btn-primary').on('click', function() {
            loadUsers();
        });

        // Load roles for dropdowns
        loadRoles();
    });

    function loadUsers(tab = 'all-users') {

        $('#usersTable tbody').html('<tr><td colspan="7" class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>');

        let roleFilter = $('#roleFilter').val();
        let statusFilter = $('#statusFilter').val();

        // Override status if tab is selected
        let status = '';
        if (tab === 'active-users') status = 'active';
        if (tab === 'inactive-users') status = 'inactive';

        // ⛔️ Don't send filters if they're not real values
        if (roleFilter === 'All Roles') roleFilter = '';
        if (statusFilter === 'All Statuses') statusFilter = '';

        $.ajax({
            url: 'ajax_helpers/ajax_get_user.php',
            type: 'GET',
            dataType: 'json',
            data: {
                action: 'get_users',
                status_filter: status || statusFilter,
                role_filter: roleFilter
            },
            success: function(response) {
                console.log('Full response:', response);
                if (response.success && Array.isArray(response.data)) {
                    if (response.data.length > 0) {
                        renderUsers(response.data);
                    } else {
                        $('#usersTable tbody').html('<tr><td colspan="7" class="text-center py-4">No users found</td></tr>');
                    }
                } else {
                    const errorMsg = response.message || 'Invalid response format';
                    $('#usersTable tbody').html('<tr><td colspan="7" class="text-center py-4">Error: ' + errorMsg + '</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error, xhr.responseText);
                let errorMsg = 'Error loading users';
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMsg = response.message || errorMsg;
                } catch (e) {}
                $('#usersTable tbody').html('<tr><td colspan="7" class="text-center py-4">' + errorMsg + '</td></tr>');
            }
        });
    }

    function renderUsers(users) {
        console.log('Rendering users:', users); // Debug log

        const tbody = $('#usersTable tbody');
        tbody.empty();

        if (!users || users.length === 0) {
            console.warn('No users data received for rendering');
            tbody.append('<tr><td colspan="7" class="text-center py-4">No users found</td></tr>');
            return;
        }

        // Simple date formatter if not defined
        window.formatDate = window.formatDate || function(dateString) {
            if (!dateString) return 'Never';
            const date = new Date(dateString);
            return date.toLocaleString();
        };

        try {
            users.forEach(user => {
                // Debug current user
                console.log('Processing user:', user.user_id, user.first_name, user.last_name);

                // Safely handle username
                const usernameDisplay = user.name ? `@${user.name}` : 'No username';

                // Status handling
                const status = user.status || 'Inactive';
                const statusClass = status === 'Active' ? 'bg-success' :
                    (status === 'Suspended' ? 'bg-warning' : 'bg-secondary');

                // Last active date
                const lastActive = user.last_active ? formatDate(user.last_active) : 'Never';

                // Avatar handling
                let avatar;
                if (user.avatar) {
                    avatar = `<img src="${user.avatar}" class="avatar-img rounded-circle" alt="${user.first_name}">`;
                } else {
                    const initials = (user.first_name?.charAt(0) || '') + (user.last_name?.charAt(0) || '');
                    avatar = `<span class="avatar-title rounded-circle bg-primary text-white">${initials}</span>`;
                }

                // Role handling
                const roleDisplay = user.role_name || user.role || 'No role';

                const row = `
                <tr data-user-id="${user.user_id}">
                    <td>
                        <div class="form-check">
                            <input class="form-check-input user-checkbox" type="checkbox" value="${user.user_id}">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-3">
                                ${avatar}
                            </div>
                            <div>
                                <a href="#" class="text-primary fw-bold">${user.first_name || ''} ${user.last_name || ''}</a>
                                <p class="mb-0 text-muted small">${usernameDisplay}</p>
                            </div>
                        </div>
                    </td>
                    <td>${user.email || 'No email'}</td>
                    <td><span class="badge bg-primary">${roleDisplay}</span></td>
                    <td>${lastActive}</td>
                    <td><span class="badge ${statusClass}">${status}</span></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item edit-user" href="#" data-id="${user.user_id}"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Reset Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item ${status === 'Active' ? 'text-danger change-status' : 'text-success change-status'}" 
                                       href="#" data-id="${user.user_id}" data-status="${status === 'Active' ? 'Inactive' : 'Active'}">
                                        <i class="fas ${status === 'Active' ? 'fa-user-slash' : 'fa-user-check'} me-2"></i> 
                                        ${status === 'Active' ? 'Deactivate' : 'Activate'}
                                    </a>
                                </li>
                                <li><a class="dropdown-item text-danger delete-user" href="#" data-id="${user.user_id}"><i class="fas fa-trash me-2"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            `;

                tbody.append(row);
            });

            console.log('Successfully rendered', users.length, 'users');
        } catch (error) {
            console.error('Error rendering users:', error);
            tbody.append('<tr><td colspan="7" class="text-center py-4 text-danger">Error displaying users</td></tr>');
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();

        if (date.toDateString() === now.toDateString()) {
            return 'Today, ' + date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        const yesterday = new Date(now);
        yesterday.setDate(yesterday.getDate() - 1);
        if (date.toDateString() === yesterday.toDateString()) {
            return 'Yesterday, ' + date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        return date.toLocaleDateString() + ', ' + date.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function addUser() {
        const formData = $('#addUserForm').serializeArray();
        const data = {};
        formData.forEach(item => {
            data[item.name] = item.value;
        });

        if (data.password !== data.confirm_password) {
            alert('Passwords do not match');
            return;
        }

        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'add_user',
                ...data
            },
            success: function(response) {
                if (response.success) {
                    $('#addUserModal').modal('hide');
                    $('#addUserForm')[0].reset();
                    loadUsers();
                    alert('User added successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error adding user: ' + error);
            }
        });
    }

    function loadUserData(userId) {
        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_user',
                user_id: userId
            },
            success: function(response) {
                if (response.success && response.data) {
                    const user = response.data;
                    $('#editUserId').val(user.user_id);
                    $('#editFirstName').val(user.first_name);
                    $('#editLastName').val(user.last_name);
                    $('#editEmail').val(user.email);
                    $('#editUsername').val(user.name);

                    // Set the role dropdown
                    if (user.role_id) {
                        $('#editRole').val(user.role_id);
                    }

                    // Set the status dropdown
                    if (user.status) {
                        $('#editStatus').val(user.status.toLowerCase());
                    }
                } else {
                    alert(response.message || 'Error loading user data');
                }
            },
            error: function(xhr, status, error) {
                alert('Error loading user data: ' + error);
            }
        });
    }

    function updateUser() {
        const formData = $('#editUserForm').serializeArray();
        const data = {};
        formData.forEach(item => {
            data[item.name] = item.value;
        });

        if (data.password && data.password !== data.confirm_password) {
            alert('Passwords do not match');
            return;
        }

        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'update_user',
                ...data
            },
            success: function(response) {
                if (response.success) {
                    $('#editUserModal').modal('hide');
                    loadUsers();
                    alert('User updated successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating user: ' + error);
            }
        });
    }

    function deleteUser(userId) {
        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_user',
                user_id: userId
            },
            success: function(response) {
                if (response.success) {
                    loadUsers();
                    alert('User deleted successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting user: ' + error);
            }
        });
    }

    function changeStatus(userId, status) {
        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'change_status',
                id: userId,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    loadUsers();
                    alert('Status updated successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error changing status: ' + error);
            }
        });
    }
    // Add this to your $(document).ready() function
    loadRoles();

    // Add this new function
    function loadRoles() {
        $.ajax({
            url: 'ajax_helpers/ajax_add_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_roles'
            },
            success: function(response) {
                if (response.success) {
                    populateRoleDropdowns(response.data);
                } else {
                    console.error('Error loading roles:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error loading roles:', error);
            }
        });
    }

    function populateRoleDropdowns(roles) {
        $('#userRole, #editRole').empty();
        $('#userRole, #editRole').append('<option selected disabled>Select Role</option>');

        roles.forEach(role => {
            $('#userRole, #editRole').append(`<option value="${role.id}">${role.name}</option>`);
        });
    }

    // Reset Filters button functionality
    $(document).on('click', '#resetFilters', function(e) {
        e.preventDefault();
        $('#roleFilter').val('');
        $('#statusFilter').val('');
        loadUsers(); // Reload users with default filters
    });
</Script>