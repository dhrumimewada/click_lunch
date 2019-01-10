 <?php
 $total['total_order'] = 0;
 ?>
 <!-- Start content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <?php echo get_msg(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            A Moments of tasty Food Surprise
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-pink">
                        <div class="card-body">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-home-variant float-right"></i>
                            </div>
                            <div class="text-white">
                                <h5 class="text-uppercase mb-2">Live Order </h5>
                                <h3 class="mb-3"><?php echo $total['total_order']; ?></h3>
                                <span>Total added in system</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-orange">
                        <div class="card-body">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-food float-right"></i>
                            </div>
                            <div class="text-white">
                                <h5 class="text-uppercase mb-2">Total Order </h5>
                                <h3 class="mb-3"><?php echo $total['total_order']; ?></h3>
                                <span>Total added in system</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-purple">
                        <div class="card-body">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-currency-usd float-right"></i>
                            </div>
                            <div class="text-white">
                                <h5 class="text-uppercase mb-2">Today Order </h5>
                                <h3 class="mb-3"><?php echo $total['total_order']; ?></h3>
                                <span>Total added in system</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-green">
                        <div class="card-body">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-tag-text-outline  float-right"></i>
                            </div>
                            <div class="text-white">
                                <h5 class="text-uppercase mb-2">Weekly Order</h5>
                                <h3 class="mb-3"><?php echo $total['total_order']; ?></h3>
                                <span>Total added in system</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Orders</h4>
                        <canvas id="lineChart" height="300"></canvas>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


            <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->


<script src="<?php echo base_url() . 'plugins/chart.js/chart.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/pages/chartjs2.init.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/pages/dashboard.js'; ?>"></script>