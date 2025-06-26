<style>
    /* Sidebar Main Styling */
    .sidebar-wrapper {
        background: linear-gradient(180deg, #2C3E50 0%, #1A252F 100%);
        color: #ffffff;
    }
    
    .logo-img {
        width: 140px !important;
        transition: all 0.3s ease;
    }
    
    .logo-img:hover {
        transform: scale(1.05);
    }
    
    /* Menu Items Styling */
    .metismenu {
        padding: 0;
        margin: 0;
    }
    
    .metismenu li {
        position: relative;
        list-style: none;
    }
    
    .metismenu a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #ffffff !important;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .metismenu a:hover {
        background: rgba(78, 205, 196, 0.1) !important;
        color: #4ECDC4 !important;
        border-left: 3px solid #4ECDC4;
    }
    
    .metismenu .active > a {
        background: rgba(78, 205, 196, 0.2) !important;
        color: #4ECDC4 !important;
        border-left: 3px solid #4ECDC4;
    }
    
    /* Icons Styling */
    .parent-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        transition: all 0.3s ease;
    }
    
    .metismenu a:hover .parent-icon {
        transform: scale(1.1);
    }
    
    /* Submenu Styling */
    .metismenu ul {
        background: rgba(0, 0, 0, 0.1) !important;
        padding-left: 0;
        border-left: none;
    }
    
    .metismenu ul a {
        padding-left: 45px;
        font-size: 0.9em;
    }
    
    .metismenu ul a:hover {
        background: rgba(78, 205, 196, 0.15) !important;
    }
    
    /* Menu Title Styling */
    .menu-title {
        font-weight: 500;
        white-space: nowrap;
    }
    
    /* Close Button */
    .sidebar-close {
        position: absolute;
        right: 15px;
        top: 15px;
        cursor: pointer;
    }
    
    .sidebar-close .material-icons-outlined {
        transition: all 0.3s ease;
    }
    
    .sidebar-close:hover .material-icons-outlined {
        color: #4ECDC4 !important;
        transform: rotate(90deg);
    }
    
    /* Section Headers */
    .section-header {
        padding: 15px 20px 5px;
        font-size: 0.75em;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #BDC3C7;
        opacity: 0.8;
    }
</style>

<!-- Sidebar Structure -->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <aside class="sidebar-wrapper" data-simplebar="true">
                
                <!-- Sidebar Header -->
                <div class="sidebar-header">
                    <div class="logo-icon">
                        <?php if (isset($_SESSION['company_logo'])): ?>
                            <img src="<?php echo $_SESSION['company_logo']; ?>" class="logo-img" alt="<?php echo $_SESSION['company_name']; ?> Logo">
                        <?php else: ?>
                            <img src="./assets/images/logo.png" class="image_fluid" alt="Default Logo" style="width:150px;height:50px;mix-blend-mode: multiply;">
                        <?php endif; ?>
                    </div>
                    <div class="sidebar-close">
                        <span class="material-icons-outlined icon">close</span>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="sidebar-nav">
                    <ul class="metismenu" id="sidenav">
                        
                        <!-- Dashboard -->
                        <li>
                            <a href="index.php">
                                <div class="parent-icon">
                                    <i class="material-icons-outlined icon">home</i>
                                </div>
                                <div class="menu-title">Dashboard</div>
                            </a>
                        </li>
                        
                        <!-- Task Management Section -->
                        <div class="section-header">Work Management</div>
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <i class="material-icons-outlined icon">task</i>
                                </div>
                                <div class="menu-title">Task Management</div>
                            </a>
                            <ul>
                                <li>
                                    <a href="index.php?route=modules/task/my_task">
                                        <i class="fas fa-list me-2" style="color: #BDC3C7;"></i> My Tasks
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?route=modules/task/add_task">
                                        <i class="fas fa-plus-circle me-2" style="color: #BDC3C7;"></i> New Task
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Financial Section -->
                        <div class="section-header">Financial</div>
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <i class="material-icons-outlined icon">attach_money</i>
                                </div>
                                <div class="menu-title">Financial</div>
                            </a>
                            <ul>
                                <li>
                                    <a href="index.php?route=modules/financial/invoices">
                                        <i class="fas fa-file-alt me-2" style="color: #BDC3C7;"></i> Invoices
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?route=modules/financial/payment_history">
                                        <i class="fas fa-history me-2" style="color: #BDC3C7;"></i> Payment History
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?route=modules/financial/client_ledger">
                                        <i class="fas fa-book me-2" style="color: #BDC3C7;"></i> Client Ledger
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Administration Section -->
                        <div class="section-header">Administration</div>
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon">
                                    <i class="material-icons-outlined icon">admin_panel_settings</i>
                                </div>
                                <div class="menu-title">Administration</div>
                            </a>
                            <ul>
                                <li>
                                    <a href="index.php?route=modules/client/client">
                                        <i class="fas fa-users me-2" style="color: #BDC3C7;"></i> Clients
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?route=modules/projects/projects">
                                        <i class="fas fa-project-diagram me-2" style="color: #BDC3C7;"></i> Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?route=modules/users/user">
                                        <i class="fas fa-user-cog me-2" style="color: #BDC3C7;"></i> Users
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- User Section -->
                        <div class="section-header">User</div>
                        <li>
                            <a href="index.php?route=modules/profile/profile">
                                <div class="parent-icon">
                                    <i class="material-icons-outlined icon">account_circle</i>
                                </div>
                                <div class="menu-title">Profile</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>