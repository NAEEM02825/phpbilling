<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BixiTech Billing System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            /* Updated Color Palette */
            --primary-color: #3a4f8a;       /* Deep navy blue */
            --secondary-color: #2c3e66;     /* Darker navy */
            --accent-color: #4cc9f0;        /* Bright teal */
            --success-color: #28a745;       /* Green */
            --warning-color: #ffc107;       /* Amber */
            --danger-color: #dc3545;        /* Red */
            --light-color: #f8fafc;         /* Off-white */
            --dark-color: #1e293b;          /* Dark slate */
            --gray-color: #64748b;          /* Medium gray */
            
            /* Additional UI Colors */
            --sidebar-bg: #1e293b;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            color: var(--text-primary);
        }
        
        /* Enhanced Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 0.8rem 1.5rem;
        }
        
        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
            color: white;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            opacity: 0.9;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
            filter: brightness(0) invert(1);
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        /* Navigation Items */
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.85);
            border-radius: 6px;
            margin: 0 2px;
        }
        
        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Dropdown Menus */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            padding: 0.5rem 0;
            margin-top: 8px;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
            color: var(--text-primary);
        }
        
        .dropdown-item:hover {
            background-color: rgba(74, 144, 226, 0.1);
            color: var(--primary-color);
        }
        
        .dropdown-divider {
            border-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Notification Dropdowns */
        .dropdown-notifications, .dropdown-messages {
            min-width: 320px;
        }
        
        .dropdown-header {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .dropdown-footer {
            background-color: #f8f9fa;
        }
        
        /* User Section */
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color) 0%, #3a86ff 100%);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .dropdown-header .user-avatar {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 10px;
            background-color: var(--danger-color);
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        /* Buttons */
        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                background: white;
                margin-top: 12px;
                border-radius: 8px;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                padding: 15px;
            }
            
            .nav-link {
                color: var(--dark-color) !important;
                padding: 0.75rem 0;
                margin: 2px 0;
            }
            
            .dropdown-menu {
                box-shadow: none;
                border: 1px solid var(--border-color);
            }
            
            .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.3);
            }
            
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Enhanced Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./assets/images/logo.png" alt="BixiTech Logo" height="32" class="d-inline-block align-text-top me-2">
                <span class="d-none d-sm-inline">BixiTech Billing</span>
            </a>
            
            <!-- Quick Actions (Visible on desktop) -->
            <div class="d-none d-lg-flex ms-auto me-3">
                <button class="btn btn-sm btn-outline-light me-2">
                    <i class="fas fa-plus me-1"></i> New Invoice
                </button>
                <button class="btn btn-sm btn-outline-light">
                    <i class="fas fa-chart-line me-1"></i> Reports
                </button>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="topNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <!-- Notifications -->
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="notification-badge badge rounded-pill">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-notifications p-0">
                            <li class="dropdown-header bg-light py-2 px-3">
                                <strong>Notifications</strong>
                            </li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-file-invoice text-primary me-2"></i> New invoice received</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-money-bill-wave text-success me-2"></i> Payment processed</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-cloud-download-alt text-info me-2"></i> System update available</a></li>
                            <li class="dropdown-footer text-center py-2">
                                <a href="#" class="text-primary">View All</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Messages -->
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-envelope fa-lg"></i>
                            <span class="notification-badge badge rounded-pill">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-messages p-0">
                            <li class="dropdown-header bg-light py-2 px-3">
                                <strong>Messages</strong>
                            </li>
                            <li><a class="dropdown-item py-2 px-3" href="#"><i class="fas fa-building text-secondary me-2"></i> Client inquiry - Acme Corp</a></li>
                            <li class="dropdown-footer text-center py-2">
                                <a href="#" class="text-primary">View All</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- User Profile -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">JD</div>
                            <span class="d-none d-lg-inline">John Doe</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header py-2 px-3">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2">JD</div>
                                    <div>
                                        <h6 class="mb-0">John Doe</h6>
                                        <small class="text-muted">Administrator</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-user me-2" style="color: var(--primary-color);"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-cog me-2" style="color: var(--primary-color);"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-question-circle me-2" style="color: var(--primary-color);"></i> Help
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-sign-out-alt me-2" style="color: var(--danger-color);"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>