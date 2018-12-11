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
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-cube-outline float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Restaurant </h6>
                                <h4 class="mb-4"><?php echo $total_shop; ?></h4>
                                <span>Total added in system</span>
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
                                <h6 class="text-uppercase mb-3">Product </h6>
                                <h4 class="mb-4"><?php echo $total_shop; ?></h4>
                                <span>Total added in system</span>
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
                                <h6 class="text-uppercase mb-3">Orders </h6>
                                <h4 class="mb-4"><?php echo $total_cuisine; ?></h4>
                                <span>Total added in system</span>
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
                                <h6 class="text-uppercase mb-3">Promocode</h6>
                                <h4 class="mb-4"><?php echo $total_promocode; ?></h4>
                                <span>Total added in system</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 m-b-30 header-title">Latest Shops</h4>

                            <div class="table-responsive">
                                <table class="table table-vertical">
                                    <tbody>
                                    <?php 
                                    if(!empty($shops) && is_array($shops)){
                                        foreach ($shops as $key => $value) {
                                            echo "<tr><td>".$value['shop_name']."</td>";
                                            if($value['status'] == 0){
                                                echo "<td><i class='mdi mdi-checkbox-blank-circle text-warning'></i> Pending</td>";
                                            }elseif($value['status'] == 1){
                                                echo '<td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>';
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

    </div> <!-- container-fluid -->

</div> <!-- content -->

<script src="<?php echo base_url() . 'assets/pages/dashboard.js'; ?>"></script>
