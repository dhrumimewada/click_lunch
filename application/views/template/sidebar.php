<!-- ========== Left Sidebar Start ========== -->
<?php
$is_admin = $this->auth->is_admin();
$is_vender = $this->auth->is_vender();
?>
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title text-center"><?php echo $_SESSION['session_user']['username']; ?></li>
                

                <?php if($is_admin) {?>

                <li>
                    <a href="<?php echo base_url().'dashboard'; ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo base_url().'cuisine-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-food"></i><span> Cuisine </span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-content-paste"></i><span> Website Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="#">Change Banner</a></li>
                        <li><a href="#">Change Text</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'admin-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Admin Managment </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'customer-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-box"></i><span> Customer Managment</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'email-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-email"></i><span> Push/Email Managment</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-multiple-plus"></i><span> Restaurant Managment <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'vender-list'; ?>">List of All Restaurants </a></li>
                        <li><a href="<?php echo base_url().'vender-perc'; ?>">Percentage of Restaurant </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-content-paste"></i><span> History <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'transaction-history'; ?>">Transaction History </a></li>
                        <li><a href="<?php echo base_url().'receipt-history'; ?>">Receipt History </a></li>
                        <li><a href="<?php echo base_url().'payment-history'; ?>">Payment History</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'earning-report'; ?>" class="waves-effect">
                        <i class="mdi mdi-book-open"></i><span> Revenue</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'delivery-dispatcher-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-motorbike"></i><span> Delivery Dispatcher</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-content-paste"></i><span> All Order <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="#">Delivery</a></li>
                        <li><a href="#">Weekly</a></li>
                        <li><a href="#">Takeout</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'app-setting'; ?>" class="waves-effect">
                        <i class="mdi mdi-settings"></i><span> App Setting </span>
                    </a>
                </li>
                <?php }else{ 
                    if($is_vender){
                ?>

                <li>
                    <a href="<?php echo base_url().'vender-dashboard'; ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'vender-profile'; ?>" class="waves-effect">
                        <i class="mdi mdi-border-color"></i><span> My Profile </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'earning-report'; ?>" class="waves-effect">
                        <i class="mdi mdi-file-document"></i><span> Revenue </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'variant-group-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-google-circles"></i><span> Variant Group </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'item-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-food"></i><span> Products </span>
                    </a>
                </li>

                <?php } 
                if($is_vender) {?>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Orders <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="#">Scheduled</a></li>
                        <li><a href="<?php echo base_url().'order-processing'; ?>">Processing</a></li>
                        <li><a href="#">Completed</a></li>
                        <li><a href="#">Trashed</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'inventory'; ?>" class="waves-effect">
                        <i class="mdi mdi-checkbox-multiple-marked"></i><span> Inventory </span>
                    </a>
                </li>

                

                <li>
                    <a href="<?php echo base_url().'employee-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Employee </span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="mdi mdi-currency-usd"></i><span> Payment History </span>
                    </a>
                </li>

                <?php
                    }
                 } ?>

                 <?php  if(is_allowed($this->auth->get_role_id(), 'promocode') || ($is_vender) || ($is_admin)) {?>
                <li>
                    <a href="<?php echo base_url().'promocode-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-tag-multiple"></i><span> Promocode </span>
                    </a>
                </li>

                <?php
                if($is_admin){
                    ?>
                <li>
                    <a href="<?php echo base_url().'setup-payment'; ?>" class="waves-effect">
                        <i class="mdi mdi-credit-card-multiple"></i><span> Setup Payment Portal </span>
                    </a>
                </li>
            <?php }?>
                
                <?php } ?>

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->