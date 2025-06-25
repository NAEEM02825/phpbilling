
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center py-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Manager</li>
            </ol>
          </nav>
        </div>
        <div class="ms-auto">
          <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
              data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                href="javascript:;">Action</a>
              <a class="dropdown-item" href="javascript:;">Another action</a>
              <a class="dropdown-item" href="javascript:;">Something else here</a>
              <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
          </div>
        </div>
      </div>
      <!--end breadcrumb-->
      <!--Start My Apps-->
      <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Apps</h3>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-1">
                    <div class="card card-transparent pt-2" 
                        style="height: 120px;width:100px; cursor: pointer; background-color: white;" 
                        onclick="window.open('fresh_applicant.php', '_blank')">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center"
                            style="padding: 10px;">
                            <i class="material-icons text-success" 
                            style="font-size: 66px; color: #228000;;">add_circle</i>
                            <span class="text-success" style="font-size: 14px;">Applicant</span>
                        </div>
                    </div>

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-1">
                        <div class="card card-transparent" style="height:120px;width:100px; cursor: pointer; background-color: white;" onclick="openModalAddNewLeadFl()">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding: 10px;">
                                <i class="material-icons" style="font-size: 66px; color: #228000;">email</i>
                                <div>
                                    <span style="color: #228000; font-size: 14px;">Send Form</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Example static card for links -->
                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-1">
                        <div class="card card-transparent pb-4 pt-4" style="height:120px;width:100px; cursor: pointer; background-color: #f5f5f5;" onclick="window.open('link_url_here', '_blank')">
                            <div class="card-body my-apps-bg-image  d-flex align-items-center justify-content-center" style="background: url('thumbnail_url_here') no-repeat center center; background-size: contain; height: 150px; padding: 20px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    <!--end My Apps-->
      <div class="row row-cols-1 row-cols-xl-3">
      <div class="col">
            <div class="card rounded-4 bg-indigo">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-light">$9,568</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">bar_chart</span>
                        </div>
                    </div>
                    <p class="mb-0 text-light">Total Sales</p>
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center  justify-content-between mb-2 gap-3">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-light">85,247</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-success text-success bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">23.7%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">attach_money</span>
                        </div>
                    </div>
                    <p class="mb-0 text-white">Total Revenue</p>
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-info">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">money_off</span> <!-- Daily revenue icon -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">Daily Revenue Needed</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-success">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">star</span>
                        </div>
                    </div>
                    <p class="mb-0 text-white">Today Average Deals</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">emoji_events</span> <!-- Change the icon here -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">Monthly Average Deals</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-black">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">cancel</span> <!-- Monthly cancel icon -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">Monthly Cancel</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons ">access_time</span> <!-- Timer icon -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">App  Today</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4" style="background-color:#8B0000;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">calendar_today</span> <!-- Calendar icon -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">App  Months</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 me-2 text-white">$69,452</h3>
                            <p class="dash-label d-flex align-items-center mb-0 bg-danger text-danger bg-opacity-10" style="margin: 0;">
                                <span class="material-icons-outlined fs-6">arrow_downward</span>
                                <span style="margin-left: 5px;">8.6%</span>
                            </p>
                        </div>
                        <div class="bg-white d-flex align-items-center justify-content-center" 
                            style="width: 40px; height: 40px; border-radius: 50%;">
                            <span class="material-icons">check_circle</span> <!-- Covered icon -->
                        </div>
                    </div>
                    <p class="mb-0 text-white">App Covered Today</p>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
      </div><!--end row-->