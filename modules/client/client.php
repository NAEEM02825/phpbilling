<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Clients Page Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h2">Client Management</h1>
        <p class="mb-0 text-muted">View and manage all your clients</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="fas fa-plus me-1"></i> New Client
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

<!-- Client Status Tabs -->
<ul class="nav nav-tabs mb-4" id="clientTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-clients-tab" data-bs-toggle="tab" data-bs-target="#all-clients" type="button" role="tab">
            <i class="fas fa-users me-1"></i> All Clients
        </button>
    </li>
</ul>

<!-- Client Content -->
<div class="tab-content" id="clientTabsContent">
    <div class="tab-pane fade show active" id="all-clients" role="tabpanel">
        <!-- Client Filters -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="industryFilter" class="form-label">Industry</label>
                        <select class="form-select" id="industryFilter">
                            <option selected>All Industries</option>
                            <option>Technology</option>
                            <option>Finance</option>
                            <option>Healthcare</option>
                            <option>Retail</option>
                            <option>Education</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option selected>All Statuses</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>VIP</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="countryFilter" class="form-label">Country</label>
                        <select class="form-select" id="countryFilter">
                            <option selected>All Countries</option>
                            <option>United States</option>
                            <option>United Kingdom</option>
                            <option>Canada</option>
                            <option>Australia</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="alertsContainer" class="container mt-3"></div>
        <!-- Client List -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="clientsTable">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllClients">
                                    </div>
                                </th>
                                <th>Client</th>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Created</th>
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
                        <p class="mb-0 text-muted showing-count">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> clients</p>
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
</div>

<!-- Add Client Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addClientForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="clientFirstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" id="clientFirstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientLastName" class="form-label">Last Name*</label>
                            <input type="text" class="form-control" id="clientLastName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientEmail" class="form-label">Email*</label>
                            <input type="email" class="form-control" id="clientEmail" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="clientPhone">
                        </div>
                        <div class="col-md-6">
                            <label for="clientCompany" class="form-label">Company</label>
                            <input type="text" class="form-control" id="clientCompany">
                        </div>
                        <div class="col-md-6">
                            <label for="clientAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="clientAddress">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveClientBtn">Save Client</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Client Page Specific Styles */
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize variables
        let currentPage = 1;
        const perPage = 10;

        // Load clients on page load
        loadClients();

        // Add client form submission
        $('#saveClientBtn').on('click', function() {
            addClient();
        });

        // Handle form submission
        $('#addClientForm').on('submit', function(e) {
            e.preventDefault();
            addClient();
        });

        // Delete client handler
        $(document).on('click', '.delete-client', function() {
            const clientId = $(this).data('id');
            if (confirm('Are you sure you want to delete this client?')) {
                deleteClient(clientId);
            }
        });

        // Pagination handlers
        $(document).on('click', '.page-link:not(.disabled)', function(e) {
            e.preventDefault();
            const target = $(this).text().toLowerCase();

            if (target === 'next') {
                currentPage++;
            } else if (target === 'previous') {
                currentPage--;
            } else {
                currentPage = parseInt(target);
            }

            loadClients();
        });

        // Function to load clients
        function loadClients() {
            $.ajax({
                url: 'ajax_helpers/client_handle.php',
                type: 'GET',
                data: {
                    action: 'get_clients',
                    page: currentPage,
                    per_page: perPage
                },
                success: function(response) {
                    if (response.success) {
                        renderClientsTable(response.data, response.total);
                        updatePagination(response.total);
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to load clients. Please try again.');
                }
            });
        }

        // Function to render clients table
        function renderClientsTable(clients, total) {
            const $tbody = $('#clientsTable tbody');
            $tbody.empty();

            if (clients.length === 0) {
                $tbody.append('<tr><td colspan="7" class="text-center py-4">No clients found</td></tr>');
                return;
            }

            clients.forEach(client => {
                const initials = getInitials(client.first_name + ' ' + client.last_name);
                const createdDate = new Date(client.created_at).toLocaleDateString();

                const row = `
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-3">
                                <span class="avatar-title rounded-circle bg-primary text-white">${initials}</span>
                            </div>
                            <div>
                                <div class="fw-bold">${client.first_name} ${client.last_name}</div>
                                <div class="text-muted small">${client.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>${client.company || '-'}</td>
                    <td>${client.phone || '-'}</td>
                    <td>${client.address || '-'}</td>
                    <td>${createdDate}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="#" 
                               class="btn btn-outline-primary p-0 d-flex align-items-center justify-content-center edit-client" 
                               data-id="${client.id}" 
                               style="width:32px;height:32px;border-radius:6px;border:1px solid #3a4f8a;" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" 
                               class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center delete-client" 
                               data-id="${client.id}" 
                               style="width:32px;height:32px;border-radius:6px;border:1px solid #dc3545;" 
                               title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `;
                $tbody.append(row);
            });

            // Update showing count
            const start = (currentPage - 1) * perPage + 1;
            const end = Math.min(currentPage * perPage, total);
            $('.showing-count').html(`Showing <span class="fw-bold">${start}</span> to <span class="fw-bold">${end}</span> of <span class="fw-bold">${total}</span> clients`);
        }

        // Function to update pagination
        function updatePagination(total) {
            const totalPages = Math.ceil(total / perPage);
            const $pagination = $('.pagination');
            $pagination.empty();

            // Previous button
            const prevDisabled = currentPage === 1 ? 'disabled' : '';
            $pagination.append(`
            <li class="page-item ${prevDisabled}">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
        `);

            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            if (startPage > 1) {
                $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>');
                if (startPage > 2) {
                    $pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const active = i === currentPage ? 'active' : '';
                $pagination.append(`
                <li class="page-item ${active}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    $pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
                $pagination.append(`
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>
                </li>
            `);
            }

            // Next button
            const nextDisabled = currentPage === totalPages ? 'disabled' : '';
            $pagination.append(`
            <li class="page-item ${nextDisabled}">
                <a class="page-link" href="#">Next</a>
            </li>
        `);
        }

        // Function to add a new client
        function addClient() {
            const formData = {
                action: 'add_client',
                first_name: $('#clientFirstName').val().trim(),
                last_name: $('#clientLastName').val().trim(),
                email: $('#clientEmail').val().trim(),
                phone: $('#clientPhone').val().trim(),
                company: $('#clientCompany').val().trim(),
                address: $('#clientAddress').val().trim()
            };

            // Basic validation
            if (!formData.first_name || !formData.last_name) {
                showAlert('danger', 'First name and last name are required');
                return;
            }

            if (!formData.email) {
                showAlert('danger', 'Email is required');
                return;
            }

            if (!isValidEmail(formData.email)) {
                showAlert('danger', 'Please enter a valid email address');
                return;
            }

            $.ajax({
                url: 'ajax_helpers/client_handle.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#addClientModal').modal('hide');
                        resetForm();
                        showAlert('success', response.message);
                        loadClients();
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to add client. Please try again.');
                }
            });
        }

        // Function to delete a client
        function deleteClient(id) {
            $.ajax({
                url: 'ajax_helpers/client_handle.php',
                type: 'POST',
                data: {
                    action: 'delete_client',
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        loadClients();
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to delete client. Please try again.');
                }
            });
        }

        // Helper function to show alerts
        function showAlert(type, message) {
            const alert = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
            $('#alertsContainer').html(alert);
        }

        // Helper function to reset form
        function resetForm() {
            $('#addClientForm')[0].reset();
        }

        // Helper function to get initials from name
        function getInitials(name) {
            return name.split(' ')
                .map(part => part.charAt(0).toUpperCase())
                .join('')
                .substring(0, 2);
        }

        // Helper function to validate email
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>