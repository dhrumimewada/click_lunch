<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('user/template/header'); ?>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        
                        <a href="index.html" class="logo">
                            <img src="<?php echo base_url().'assets/images/logo-sm.png'; ?>" alt="" class="logo-small">
                            <img src="<?php echo base_url().'assets/images/click-lunch.png'; ?>" alt="" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="float-right list-unstyled mb-0 ">
                            <li class="dropdown notification-list active">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Home</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Weekly Planner</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Delivery</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Takeout</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Favourite</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">restaurant partners</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">delivery address</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
                                        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    </div>                                                                    
                                </div>
                            </li>
                            <li class="dropdown notification-list last-div">
                                <a class="nav-link waves-effect" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="mdi mdi-cart-outline noti-icon"></i>
                                    <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                                </a>       
                            </li>
                            <li class="menu-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link" id="mobileToggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>    
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

        </header>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-cube-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Orders</h6>
                                    <h4 class="mb-4">1,587</h4>
                                    <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Revenue</h6>
                                    <h4 class="mb-4">$46,782</h4>
                                    <span class="badge badge-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Average Price</h6>
                                    <h4 class="mb-4">$15.9</h4>
                                    <span class="badge badge-warning"> 0% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Product Sold</h6>
                                    <h4 class="mb-4">1890</h4>
                                    <span class="badge badge-info"> +89% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-cube-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Orders</h6>
                                    <h4 class="mb-4">1,587</h4>
                                    <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Revenue</h6>
                                    <h4 class="mb-4">$46,782</h4>
                                    <span class="badge badge-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Average Price</h6>
                                    <h4 class="mb-4">$15.9</h4>
                                    <span class="badge badge-warning"> 0% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Product Sold</h6>
                                    <h4 class="mb-4">1890</h4>
                                    <span class="badge badge-info"> +89% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-cube-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Orders</h6>
                                    <h4 class="mb-4">1,587</h4>
                                    <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Revenue</h6>
                                    <h4 class="mb-4">$46,782</h4>
                                    <span class="badge badge-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Average Price</h6>
                                    <h4 class="mb-4">$15.9</h4>
                                    <span class="badge badge-warning"> 0% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Product Sold</h6>
                                    <h4 class="mb-4">1890</h4>
                                    <span class="badge badge-info"> +89% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-cube-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Orders</h6>
                                    <h4 class="mb-4">1,587</h4>
                                    <span class="badge badge-info"> +11% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Revenue</h6>
                                    <h4 class="mb-4">$46,782</h4>
                                    <span class="badge badge-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Average Price</h6>
                                    <h4 class="mb-4">$15.9</h4>
                                    <span class="badge badge-warning"> 0% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary">
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h6 class="text-uppercase mb-3">Product Sold</h6>
                                    <h4 class="mb-4">1890</h4>
                                    <span class="badge badge-info"> +89% </span> <span class="ml-2">From previous period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->

<!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 Lexa - <span class="d-none d-sm-inline-block"> Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</span>.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


    </body>
</html>