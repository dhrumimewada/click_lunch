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
                                <h5 class="text-uppercase mb-2">Total Orders </h5>
                                <h3 class="mb-3"><?php echo "1000"; ?></h3>
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
                                <h5 class="text-uppercase mb-2">Products </h5>
                                <h3 class="mb-3"><?php echo "1000"; ?></h3>
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
                                <h5 class="text-uppercase mb-2">Total Earnings </h5>
                                <h3 class="mb-3"><?php echo "$1000" ; ?></h3>
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
                                <h5 class="text-uppercase mb-2">Promocode</h5>
                                <h3 class="mb-3"><?php echo "10"; ?></h3>
                                <span>Total added in system</span>
                            </div>
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
                            <h4 class="mt-0 m-b-30 header-title">Latest Orders</h4>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Promocode</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($promocode) && is_array($promocode)){
                                        foreach ($promocode as $key => $value) {
                                            echo "<tr><td>".$value['promocode']."</td>";
                                            if($value['status'] == 0){
                                                echo "<td><button class='btn btn-primary waves-effect waves-light r-8 btn-xs'>Pending</button></td>";
                                            }elseif($value['status'] == 1){
                                                echo "<td><button class='btn btn-primary waves-effect waves-light r-8 btn-xs'>Confirm</button></td>";
                                            }else{
                                                echo '<td><i class="mdi mdi-checkbox-blank-circle text-success"></i> NA</td>';
                                            }
                                             echo "<td>".$value['amount']."</td>";

                                            $created_date_ts = strtotime($value["created_at"]);
                                            $created_date = date("j M, Y", $created_date_ts);

                                            echo "<td>".$created_date."</td></tr>";
                                        }
                                    }else{
                                        echo "<tr><td>No Any promocode found</td></tr>";
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