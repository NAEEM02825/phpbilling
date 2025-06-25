
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
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="active-clients-tab" data-bs-toggle="tab" data-bs-target="#active-clients" type="button" role="tab">
                <i class="fas fa-user-check me-1"></i> Active
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="inactive-clients-tab" data-bs-toggle="tab" data-bs-target="#inactive-clients" type="button" role="tab">
                <i class="fas fa-user-times me-1"></i> Inactive
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="vip-clients-tab" data-bs-toggle="tab" data-bs-target="#vip-clients" type="button" role="tab">
                <i class="fas fa-crown me-1"></i> VIP
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

            <!-- Client List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllClients">
                                        </div>
                                    </th>
                                    <th>Client</th>
                                    <th>Company</th>
                                    <th>Industry</th>
                                    <th>Contact</th>
                                    <th>Projects</th>
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
                                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="avatar-img rounded-circle" alt="Robert Chen">
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Robert Chen</a>
                                                <p class="mb-0 text-muted small">robert.chen@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>TechSolutions Inc.</td>
                                    <td>Technology</td>
                                    <td>(415) 555-0123</td>
                                    <td>12</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="clientActions1" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="clientActions1">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Projects</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
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
                                                <span class="avatar-title rounded-circle bg-primary text-white">SM</span>
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Sarah Miller</a>
                                                <p class="mb-0 text-muted small">sarah.m@financetech.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>FinanceTech LLC</td>
                                    <td>Finance</td>
                                    <td>(212) 555-0187</td>
                                    <td>8</td>
                                    <td><span class="badge bg-primary">VIP</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="clientActions2" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="clientActions2">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Projects</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
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
                                                <img src="https://randomuser.me/api/portraits/women/45.jpg" class="avatar-img rounded-circle" alt="Lisa Wong">
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">Lisa Wong</a>
                                                <p class="mb-0 text-muted small">lisa.wong@healthcare.org</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Healthcare Systems</td>
                                    <td>Healthcare</td>
                                    <td>(310) 555-0155</td>
                                    <td>5</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="clientActions3" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="clientActions3">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Projects</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
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
                                                <span class="avatar-title rounded-circle bg-warning text-white">DJ</span>
                                            </div>
                                            <div>
                                                <a href="#" class="text-primary fw-bold">David Johnson</a>
                                                <p class="mb-0 text-muted small">d.johnson@retailcorp.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>RetailCorp International</td>
                                    <td>Retail</td>
                                    <td>(305) 555-0199</td>
                                    <td>3</td>
                                    <td><span class="badge bg-secondary">Inactive</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="clientActions4" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="clientActions4">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice me-2"></i> Projects</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
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
                            <p class="mb-0 text-muted">Showing <span class="fw-bold">1</span> to <span class="fw-bold">4</span> of <span class="fw-bold">24</span> clients</p>
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
        <div class="tab-pane fade" id="active-clients" role="tabpanel">
            <!-- Active clients content would go here -->
        </div>
        <div class="tab-pane fade" id="inactive-clients" role="tabpanel">
            <!-- Inactive clients content would go here -->
        </div>
        <div class="tab-pane fade" id="vip-clients" role="tabpanel">
            <!-- VIP clients content would go here -->
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
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="clientFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="clientFirstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="clientLastName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="clientEmail" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="clientPhone">
                        </div>
                        <div class="col-md-6">
                            <label for="clientCompany" class="form-label">Company</label>
                            <input type="text" class="form-control" id="clientCompany" required>
                        </div>
                        <div class="col-md-6">
                            <label for="clientPosition" class="form-label">Position</label>
                            <input type="text" class="form-control" id="clientPosition">
                        </div>
                        <div class="col-md-6">
                            <label for="clientIndustry" class="form-label">Industry</label>
                            <select class="form-select" id="clientIndustry">
                                <option selected>Select Industry</option>
                                <option>Technology</option>
                                <option>Finance</option>
                                <option>Healthcare</option>
                                <option>Retail</option>
                                <option>Education</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="clientStatus" class="form-label">Status</label>
                            <select class="form-select" id="clientStatus">
                                <option selected value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="vip">VIP</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="clientAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="clientAddress">
                        </div>
                        <div class="col-md-6">
                            <label for="clientCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="clientCity">
                        </div>
                        <div class="col-md-4">
                            <label for="clientState" class="form-label">State/Province</label>
                            <input type="text" class="form-control" id="clientState">
                        </div>
                        <div class="col-md-2">
                            <label for="clientZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="clientZip">
                        </div>
                        <div class="col-md-6">
                            <label for="clientCountry" class="form-label">Country</label>
                            <select class="form-select" id="clientCountry">
                                <option selected>United States</option>
                                <option>United Kingdom</option>
                                <option>Canada</option>
                                <option>Australia</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="clientSource" class="form-label">How did they find you?</label>
                            <select class="form-select" id="clientSource">
                                <option selected>Select Source</option>
                                <option>Referral</option>
                                <option>Website</option>
                                <option>Social Media</option>
                                <option>Advertisement</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="clientNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="clientNotes" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Client</button>
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