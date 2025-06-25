 <style>
     .logo-img {
         width: 140px !important;
     }

     /* Full sidebar styling */
     .sidebar-wrapper,
     .sidebar-wrapper .sidebar-header,
     .sidebar-wrapper .sidebar-nav,
     .sidebar-wrapper .metismenu,
     .metismenu ul,
     /* Target submenus */
     .metismenu li,
     /* Target list items */
     .metismenu a {
         /* Target links */
         background-color: rgb(4, 102, 95) !important;
         color: #ffffff !important;
     }

     /* Hover states */
     .metismenu a:hover,
     .metismenu .active>a,
     .metismenu a:focus {
         background-color: linear-gradient(135deg, rgb(25, 63, 60), rgb(4, 102, 95)) !important;
         color: #ffffff !important;
     }

     /* Submenu indentation fix */
     .metismenu ul {
         padding-left: 0;
         border-left: none;
     }

     /* Menu titles */
     .menu-title {
         color: #ffffff !important;
     }

     /* Icons color */
     .material-icons-outlined.icon {
         color: #ffffff !important;
     }
 </style>
 <!--
       ###########################################################
       #                                                         #
       #                    START OF SIDEBAR                     #
       #                                                         #
       ###########################################################
    -->
 <div class="sticky">
     <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
     <div class="app-sidebar">
         <div class="side-header">
             <aside class="sidebar-wrapper" data-simplebar="true">

                 <!--
           #######################################################
           #               Sidebar Header Section                #
           #######################################################
        -->
                 <div class="sidebar-header">
                     <div class="logo-icon">
                         <?php if (isset($_SESSION['company_logo'])): ?>
                             <img src="<?php echo $_SESSION['company_logo']; ?>" class="logo-img" alt="<?php echo $_SESSION['company_name']; ?> Logo">
                         <?php else: ?>
                             <img src="assets/images/logo.png" class="image_fluid" alt="Default Logo" style="width:150px;height:50px;mix-blend-mode: multiply; color: white;">
                         <?php endif; ?>
                     </div>

                     <div class="sidebar-close">
                         <span class="material-icons-outlined icon" style="color: black;">close</span>
                     </div>
                 </div>
                 <!--
           #######################################################
           #             End of Sidebar Header Section           #
           #######################################################
        -->

                 <div class="sidebar-nav">
                     <!--
               ###################################################
               #                Navigation Section               #
               ###################################################
            -->
                     <ul class="metismenu" id="sidenav">

                         <!-- Dashboard Link -->
                         <li>
                             <a href="index.php" class="">
                                 <div class="parent-icon"><i class="material-icons-outlined icon icon-home"><?php echo lang(key: "home"); ?></i></div>
                                 <div class="menu-title"><?php echo lang(key: "dashboard"); ?></div>
                             </a>
                         </li>

                         <!-- Manage Users Section with Submenu -->
                         <li>
                             <a href="javascript:;" class="has-arrow">
                                 <div class="parent-icon"><i class="fas fa-tasks me-2" style="color: #4ECDC4;"></i></div>
                                 <div class="menu-title">Task Management</div>
                             </a>
                             <ul>

                                 <!-- Add Users Link -->
                                 <li><a href="index.php?route=modules/task/my_task"><i class="fas fa-list me-2" style="color: #BDC3C7;"></i> My Tasks</a></li>

                                 <!-- Users Link -->
                                 <li><a href="index.php?route=modules/task/add_task"><i class="fas fa-plus-circle me-2" style="color: #BDC3C7;"></i> New Task</a></li>
                             </ul>
                         </li>
                         <!-- Position -->
                         <li>
                             <a href="javascript:;" class="has-arrow">
                                 <div class="parent-icon"><i class="material-icons" style="color:white;">business_center</i></div>
                                 <div class="menu-title">Financial</div>
                             </a>
                             <ul>

                                 <!-- Add Users Link -->
                                 <li><a href="index.php?route=modules/financial/invoices"><i class="fas fa-file-alt me-2" style="color: #BDC3C7;"></i> Invoices</a></li>
                                 <li><a href="index.php?route=modules/financial/payment_history"><i class="fas fa-history me-2" style="color: #BDC3C7;"></i> Payment History</a></li>
                                 <li><a href="index.php?route=modules/financial/client_ledger"><i class="fas fa-book me-2" style="color: #BDC3C7;"></i> Client Ledger</a></li>

                             </ul>
                         </li>
                         <!-- TODO: CHECK WHY USER MENU IS OPEN WHEN FRESH LEAD IS CLICKED -->
                         <li>
                             <a href="javascript:;" class="has-arrow">
                                 <div class="parent-icon"><i class="material-icons" style="color:white;">business_center</i></div>
                                 <div class="menu-title">Administration</div>
                             </a>
                             <ul>

                                 <!-- Add Users Link -->
                                 <li><a href="index.php?route=modules/client/client"><i class="fas fa-file-alt me-2" style="color: #BDC3C7;"></i> client</a></li>
                                 <li><a href="index.php?route=modules/projects/projects"><i class="fas fa-history me-2" style="color: #BDC3C7;"></i>Projects</a></li>
                                 <li><a href="index.php?route=modules/users/user"><i class="fas fa-user-cog me-2" style="color: #BDC3C7;"></i>Users</a></li>
                             </ul>
                         </li>

                         <!-- My Account Link -->
                         <li>
                             <a class="" href="javascript:;">
                                 <a href="index.php?route=modules/profile/profile">
                                     <div class="parent-icon"><i class="material-icons-outlined icon icon-badge" style="color: indigo;">badge</i></div>
                                     <div class="menu-title">P</div>
                                 </a>
                             </a>
                         </li>

                     </ul>
                     <!--
               ###################################################
               #               End of Navigation Section          #
               ###################################################
            -->
                 </div>
             </aside>

             <!--
       ###########################################################
       #                                                         #
       #                    END OF SIDEBAR                       #
       #                                                         #
       ###########################################################
    -->