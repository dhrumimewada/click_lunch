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
                            <a href="<?php echo base_url().'maintenance6'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-home-variant float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Total Orders </h5>
                                    <h3 class="mb-3"><?php echo $total['total_order']; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-orange">
                        <div class="card-body">
                            <a href="<?php echo base_url().'item-list'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-food float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Products </h5>
                                    <h3 class="mb-3"><?php echo $total['total_product']; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-purple">
                        <div class="card-body">
                            <a href="<?php echo base_url().'earning-report'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-currency-usd float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Total Earnings </h5>
                                    <h3 class="mb-3"><?php echo $total['total_earning']; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-green">
                        <div class="card-body">
                            <a href="<?php echo base_url().'promocode-list'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline  float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Promocode</h5>
                                    <h3 class="mb-3"><?php echo $total['total_promocode']; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Monthly Earnings</h4>
                            <div id="morris-donut-example" class="dashboard-charts morris-charts"></div>
                            <div class="row text-left color-indicate">
                                
                                <div class="col-6">
                                    <h6 class="text-muted orange">Today<span class="float-right">40%</span></h6>
                                    <h6 class="text-muted blue">Weekly<span class="float-right">10%</span></h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-muted yellow">Monthly<span class="float-right">25%</span></h6>
                                    <h6 class="text-muted green">Yearly<span class="float-right">25%</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-10 m-b-30 header-title d-inline-block">Latest Orders</h4>
                            <div class="float-right d-inline-block mb-3">
                                <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url().'order-all'; ?>">View All</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Type</th>
                                            <th>Customer Name</th>
                                            <th>Amount</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($order) && !empty($order)){
                                            foreach ($order as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>#CL<?php echo $value['id']; ?></td>
                                                <td>
                                                    <?php

                                                    if($value['order_type'] == 1){
                                                        $order_type_str = 'Delivery Now';
                                                    }else if($value['order_type'] == 2){
                                                        $order_type_str = 'Delivery Later';
                                                    }else if($value['order_type'] == 3){
                                                        $order_type_str = 'Takeout Now';
                                                    }else if($value['order_type'] == 4){
                                                        $order_type_str = 'Takeout Later';
                                                    }else if($value['order_type'] == 5){
                                                        $order_type_str = 'Weekly Delivery';
                                                    }else if($value['order_type'] == 6){
                                                        $order_type_str = 'Weekly Takeout';
                                                    }else{
                                                       $order_type_str = '';
                                                    }
                                                    echo $order_type_str;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $value['username']; ?>
                                                </td>
                                                <td>$
                                                    <?php echo $value['total']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if($value['order_status'] == 0){
                                                        echo $order_status = '<span class="badge badge-primary">Pending</span>';
                                                    }else if($value['order_status'] == 1){
                                                        echo $order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                                                    }else if($value['order_status'] == 2){
                                                        echo $order_status = '<span class="badge badge-danger">Rejected by Restaurant</span>';
                                                    }else if($value['order_status'] == 3){
                                                        echo $order_status = '<span class="badge badge-info">Delivery Boy Assigned</span>';
                                                    }else if($value['order_status'] == 4){
                                                        echo $order_status = '<span class="badge badge-info">Accepted by Delivery Boy</span>';
                                                    }else if($value['order_status'] == 5){
                                                        echo $order_status = '<span class="badge badge-info">Picked up</span>';
                                                    }else if($value['order_status'] == 6){
                                                        echo $order_status = '<span class="badge badge-success">Delivered</span>';
                                                    }else if($value['order_status'] == 7){
                                                        echo $order_status = '<span class="badge badge-danger">Delivery Fail</span>';
                                                    }else if($value['order_status'] == 8){
                                                        echo $order_status = '<span class="badge badge-danger">Cancelled by Customer</span>';
                                                    }else{
                                                        $order_status ='';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                 <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Transaction History</h4>

                            <ul class="list-inline m-t-20 m-b-15 toggle-div">
                                <li class="list-inline-item m-r-15 pointer daily">
                                    <p class="text-muted chart-radio active">Daily</p>
                                </li>
                                <li class="list-inline-item m-r-15 pointer monthly">
                                    <p class="text-muted chart-radio">Monthly</p>
                                </li>
                                <li class="list-inline-item m-r-15 pointer yearly">
                                    <p class="text-muted chart-radio">Yearly</p>
                                </li>
                            </ul>

                            <div id="chart-with-area-daily" class="ct-chart ct-golden-section"></div>
                            <div id="chart-with-area-monthly" class="ct-chart ct-golden-section"></div>
                            <div id="chart-with-area-yearly" class="ct-chart ct-golden-section"></div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


            <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->

<script src="<?php echo base_url() . 'plugins/chartist/js/chartist.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'plugins/chartist/js/chartist-plugin-tooltip.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/pages/dashboard.js'; ?>"></script>