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
                        <div class="card-body pointer">
                            <a href="<?php echo base_url().'vender-list'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-home-variant float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Restaurant </h5>
                                    <h3 class="mb-3"><?php echo $total_shop; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-orange">
                        <div class="card-body pointer">
                            <a href="<?php echo base_url().'customer-list'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-shopping float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Customers </h5>
                                    <h3 class="mb-3"><?php echo $total_customer; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-purple">
                        <div class="card-body pointer">
                            <a href="<?php echo base_url().'maintenance3'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-food float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Orders </h5>
                                    <h3 class="mb-3"><?php echo $total_order; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-green">
                        <div class="card-body pointer">
                            <a href="<?php echo base_url().'promocode-list'; ?>">
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-tag-text-outline  float-right"></i>
                                </div>
                                <div class="text-white">
                                    <h5 class="text-uppercase mb-2">Promocode</h5>
                                    <h3 class="mb-3"><?php echo $total_promocode; ?></h3>
                                    <span>Total added in system</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <span class="mt-0 m-b-30 header-title">Recent Restaurants</span>
                            <div class="float-right d-inline-block mb-3">
                                <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url().'vender-list'; ?>">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Status</th>
                                            <th>Restaurant Code</th>
                                            <th>Created Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($shops) && is_array($shops)){
                                        foreach ($shops as $key => $value) {
                                            if($value['profile_picture'] != ''){
                                                $shop_img = base_url().$this->config->item("profile_path") . '/'.$value['profile_picture'];
                                            }else{
                                                $shop_img = base_url().'web-assets/images/logo-3.png';
                                            }
                                            echo "<tr><td><img src='".$shop_img."' class='thumb-sm img-fit rounded-circle mr-2'>".$value['shop_name']."</td>";
                                            if($value['status'] == 0){
                                                echo "<td><label class='text-center btn-deactive r-8 btn-sm' disabled>Pending</label></td>";
                                            }elseif($value['status'] == 1){
                                                echo "<td><label class='text-center btn-success r-8 btn-sm'>Active</label></td>";
                                            }elseif($value['status'] == 2){
                                                echo "<td><label class='text-center btn-danger r-8 btn-sm'>Deacivate</label></td>";
                                            }else{
                                                echo '<td><i class="mdi mdi-checkbox-blank-circle text-success"></i> NA</td>';
                                            }
                                             echo "<td>".$value['shop_code']."</td>";

                                            $created_date_ts = strtotime($value["created_at"]);
                                            $created_date = date("j M, Y", $created_date_ts);

                                            echo "<td>".$created_date."</td></tr>";
                                        }
                                    }else{
                                        echo "<tr><td>No Any Shop found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <!-- <div class="col-xl-9">
                </div> -->
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Completed Orders of 2018</h4>
                            <canvas id="lineChart" height="300"></canvas>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

    </div> <!-- container-fluid -->

</div> <!-- content -->

<script src="<?php echo base_url() . 'plugins/chart.js/chart.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/pages/chartjs.init.js'; ?>"></script>


