<style>
    /* Modern sidebar styling with unique color palette */
    :root {
        --primary-color: #04665f; /* Deep teal */
        --secondary-color: #1a3a3a; /* Dark forest green */
        --accent-color: #4ECDC4; /* Light teal */
        --text-color: #ffffff;
        --hover-gradient: linear-gradient(135deg, #1a3a3a, #04665f);
        --icon-color: #ffffff;
        --submenu-indent: #0a5550; /* Slightly darker teal for hierarchy */
    }

    /* Sidebar container styling */
    .sidebar-wrapper,
    .sidebar-wrapper .sidebar-header,
    .sidebar-wrapper .sidebar-nav,
    .sidebar-wrapper .metismenu {
        background-color: var(--primary-color) !important;
        color: var(--text-color) !important;
        transition: all 0.3s ease;
    }

    /* Logo styling */
    .logo-img {
        width: 140px !important;
        padding: 10px 0;
        filter: brightness(0) invert(1); /* Makes logo white */
    }

    /* Menu items */
    .metismenu li,
    .metismenu a {
        background-color: var(--primary-color) !important;
        color: var(--text-color) !important;
        transition: all 0.2s ease;
    }

    /* Hover and active states */
    .metismenu a:hover,
    .metismenu .active>a,
    .metismenu a:focus {
        background: var(--hover-gradient) !important;
        color: var(--text-color) !important;
        border-left: 4px solid var(--accent-color);
    }

    /* Submenu styling */
    .metismenu ul {
        background-color: var(--submenu-indent) !important;
        padding-left: 0;
        border-left: none;
    }

    /* Menu titles */
    .menu-title {
        color: var(--text-color) !important;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Icons */
    .material-icons-outlined.icon,
    .parent-icon i {
        color: var(--icon-color) !important;
        font-size: 1.2rem;
    }

    /* Submenu icons */
    .metismenu ul i {
        color: var(--accent-color) !important;
    }

    /* Active menu indicator */
    .metismenu .mm-active > a {
        background: var(--hover-gradient) !important;
        box-shadow: inset 3px 0 0 var(--accent-color);
    }

    /* Smooth transitions */
    .metismenu, .metismenu ul, .metismenu li, .metismenu a {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Sidebar header */
    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Close button */
    .sidebar-close .material-icons-outlined {
        color: var(--text-color) !important;
        transition: transform 0.3s ease;
    }

    .sidebar-close .material-icons-outlined:hover {
        transform: scale(1.1);
    }
</style>

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <aside class="sidebar-wrapper" data-simplebar="true">
                <!-- Sidebar Header Section -->
                <div class="sidebar-header">
                    <div class="logo-icon">
                        <?php if (isset($_SESSION['company_logo'])): ?>
                            <img src="<?php echo $_SESSION['company_logo']; ?>" class="logo-img" alt="<?php echo $_SESSION['company_name']; ?> Logo">
                        <?php else: ?>
                            <img src="assets/images/logo1.png" class="logo-img" alt="Default Logo">
                        <?php endif; ?>
                    </div>
                    <div class="sidebar-close">
                        <span class="material-icons-outlined icon">close</span>
                    </div>
                </div>

                <div class="sidebar-nav">
                    <ul class="metismenu" id="sidenav">
                        <!-- Dashboard Link -->
                        <li>
                            <a href="index.php" class="">
                                <div class="parent-icon"><i class="material-icons-outlined icon">home</i></div>
                                <div class="menu-title"><?php echo lang(key: "dashboard"); ?></div>
                            </a>
                        </li>

                        <!-- Task Management Section -->
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon"><i class="material-icons-outlined icon">task</i></div>
                                <div class="menu-title">Task Management</div>
                            </a>
                            <ul>
                                <li><a href="index.php?route=modules/assign/assigned_task"><i class="material-icons-outlined icon">list_alt</i> My Tasks</a></li>
                                <li><a href="index.php?route=modules/assign/add_task"><i class="material-icons-outlined icon">add_task</i> New Task</a></li>
                            </ul>
                        </li>

                        <!-- Financial Section -->
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon"><i class="material-icons-outlined icon">payments</i></div>
                                <div class="menu-title">Financial</div>
                            </a>
                            <ul>
                                <li><a href="index.php?route=modules/financial/invoices"><i class="material-icons-outlined icon">receipt</i> Invoices</a></li>
                                <!-- <li><a href="index.php?route=modules/financial/payment_history"><i class="material-icons-outlined icon">history</i> Payment History</a></li>
                                <li><a href="index.php?route=modules/financial/client_ledger"><i class="material-icons-outlined icon">book</i> Client Ledger</a></li> -->
                            </ul>
                        </li>

                        <!-- Administration Section -->
                        <li>
                            <a href="javascript:;" class="has-arrow">
                                <div class="parent-icon"><i class="material-icons-outlined icon">admin_panel_settings</i></div>
                                <div class="menu-title">Administration</div>
                            </a>
                            <ul>
                                <li><a href="index.php?route=modules/client/client"><i class="material-icons-outlined icon">people</i> Clients</a></li>
                                <li><a href="index.php?route=modules/projects/projects"><i class="material-icons-outlined icon">work</i> Projects</a></li>
                                <li><a href="index.php?route=modules/users/user"><i class="material-icons-outlined icon">manage_accounts</i> Users</a></li>
                            </ul>
                        </li>

                        <!-- Profile Link -->
                        <li>
                            <a href="index.php?route=modules/profile/profile">
                                <div class="parent-icon"><i class="material-icons-outlined icon">account_circle</i></div>
                                <div class="menu-title">Profile</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>