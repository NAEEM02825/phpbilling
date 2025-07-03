<?php
//Show sidebars based on role_id in session variable defined in includes/config.php

// else if ($_SESSION['role_id'] == ROLE_ID_MARKETING_MANAGER) {
//   include_once('includes/page-parts/marketing_manager/marketing_manager_sidebar.php');
// }

if ($_SESSION['role_id'] == ROLE_ID_ADMIN) {
    include_once('includes/page-parts/admins/admins_sidebar.php');
}  else if ($_SESSION['role_id'] == ROLE_ID_USER) {
    include_once('includes/page-parts/user/user_sidebar.php');
}   else { // Default sidebar for all other roles
    
  ?>
<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div class="logo-icon">
      <img src="assets/images/logo-icon.png" class="logo-img" alt="">
    </div>
    <div class="logo-name flex-grow-1">
      <h5 class="mb-0">BixiTech Team</h5>
    </div>
    <div class="sidebar-close">
      <span class="material-icons-outlined icon" style="color: black;">close</span>
    </div>
  </div>
  <div class="sidebar-nav">
      <!--navigation-->
      <ul class="metismenu" id="sidenav">
        <li>
          <a href="javascript:;" class="">
            <div class="parent-icon"><i class="material-icons-outlined icon draft">home</i>
            </div>
            <div class="menu-title">Dashboard</div>
          </a>
        </li>

        <li>
          <a href="index.php?route=modules/applicants/list_applicants" class="">
            <div class="parent-icon"><i class="material-icons-outlined icon draft">person</i>
            </div>
            <div class="menu-title">Applicants</div>
          </a>
        </li>
    
          <a class=" " href="javascript:;">
            <div class="parent-icon"><i class="material-icons-outlined icon" style="color: #673AB7;">person</i>
            </div>
            <div class="menu-title">My Account</div>
          </a>
        </li>
      </ul>
      <!--end navigation-->
  </div>   
</aside>
<!--end sidebar-->
<?php } ?>