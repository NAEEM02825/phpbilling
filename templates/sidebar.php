<!-- Sidebar -->
<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background: linear-gradient(180deg, #2C3E50 0%, #1A252F 100%);">
            <div class="position-sticky pt-3">
                <!-- Brand Logo/Header -->
                <div class="sidebar-header text-center mb-4">
                    <h4 class="text-white font-weight-bold">
                        <i class="fas fa-project-diagram me-2" style="color: #4ECDC4;"></i>
                        <span style="color: #FFFFFF;">TaskFlow</span>
                        <span style="color: #4ECDC4;">Pro</span>
                    </h4>
                </div>
                
                <ul class="nav flex-column">
                    <!-- Dashboard -->
                    <li class="nav-item mb-1">
                        <a class="nav-link active" href="dashboard.php" style="color: #FFFFFF; background-color: rgba(78, 205, 196, 0.2); border-left: 3px solid #4ECDC4;">
                            <i class="fas fa-tachometer-alt me-2" style="color: #4ECDC4;"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Task Management Section -->
                    <li class="nav-item mb-1">
                        <div class="accordion" id="taskAccordion">
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed px-3 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#taskCollapse" 
                                            style="background-color: transparent; color: #FFFFFF; box-shadow: none;">
                                        <i class="fas fa-tasks me-2" style="color: #4ECDC4;"></i>
                                        <span>Task Management</span>
                                    </button>
                                </h2>
                                <div id="taskCollapse" class="accordion-collapse collapse" data-bs-parent="#taskAccordion">
                                    <div class="accordion-body p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link ps-4 py-2" href="./my_task.php" style="color: #BDC3C7;">
                                                    <i class="fas fa-list me-2" style="color: #BDC3C7;"></i> My Tasks
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ps-4 py-2" href="./add_new_task.php" style="color: #BDC3C7;">
                                                    <i class="fas fa-plus-circle me-2" style="color: #BDC3C7;"></i> New Task
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Manager Sections -->
                    <div class="manager-only">
                        <!-- Financial Section -->
                        <li class="nav-item mb-1">
                            <div class="accordion" id="financeAccordion">
                                <div class="accordion-item border-0 bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed px-3 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#financeCollapse" 
                                                style="background-color: transparent; color: #FFFFFF; box-shadow: none;">
                                            <i class="fas fa-file-invoice-dollar me-2" style="color: #E74C3C;"></i>
                                            <span>Financial</span>
                                        </button>
                                    </h2>
                                    <div id="financeCollapse" class="accordion-collapse collapse" data-bs-parent="#financeAccordion">
                                        <div class="accordion-body p-0">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="./invoices.php" style="color: #BDC3C7;">
                                                        <i class="fas fa-file-alt me-2" style="color: #BDC3C7;"></i> Invoices
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="payments.php?action=list" style="color: #BDC3C7;">
                                                        <i class="fas fa-history me-2" style="color: #BDC3C7;"></i> Payment History
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="ledger.php" style="color: #BDC3C7;">
                                                        <i class="fas fa-book me-2" style="color: #BDC3C7;"></i> Client Ledger
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- Administration Section -->
                        <li class="nav-item mb-1">
                            <div class="accordion" id="adminAccordion">
                                <div class="accordion-item border-0 bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed px-3 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse" 
                                                style="background-color: transparent; color: #FFFFFF; box-shadow: none;">
                                            <i class="fas fa-cog me-2" style="color: #3498DB;"></i>
                                            <span>Administration</span>
                                        </button>
                                    </h2>
                                    <div id="adminCollapse" class="accordion-collapse collapse" data-bs-parent="#adminAccordion">
                                        <div class="accordion-body p-0">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="clients.php" style="color: #BDC3C7;">
                                                        <i class="fas fa-users me-2" style="color: #BDC3C7;"></i> Clients
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="projects.php" style="color: #BDC3C7;">
                                                        <i class="fas fa-project-diagram me-2" style="color: #BDC3C7;"></i> Projects
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link ps-4 py-2" href="users.php" style="color: #BDC3C7;">
                                                        <i class="fas fa-user-cog me-2" style="color: #BDC3C7;"></i> Users
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
                
                <!-- Sidebar Footer -->
                <div class="sidebar-footer mt-auto p-3 text-center" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <div class="user-info mb-2">
                        <div class="avatar-sm mx-auto mb-2" style="width: 40px; height: 40px; background-color: #4ECDC4; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white font-weight-bold">JD</span>
                        </div>
                        <small class="text-white d-block">John Doe</small>
                        <small class="text-white">Administrator</small>
                    </div>
                    <small class="text-white" style="font-size: 0.75rem;">v2.1.0</small>
                </div>
            </div>
        </nav>