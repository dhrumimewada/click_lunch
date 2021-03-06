========== Left Sidebar Start ========== -->
<?php
$is_admin = $this->auth->is_admin();
$is_vender = $this->auth->is_vender();
$is_employee = $this->auth->is_employee();
$is_dispatcher = $this->auth->is_dispatcher();

$user_id = $this->auth->get_user_id();
$user_data = get_loggedin_detail($user_id);

$username = '';
if($is_admin){
    $username = $user_data->username;
}else if($is_vender){
    $username = $user_data->shop_name;
}else if($is_employee){
    $username = $user_data->first_name.' '.$user_data->last_name;
}else if($is_dispatcher){
    $username = $user_data->full_name;
}else{

}
?>
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <!-- <li class="menu-title text-center"><?php echo $username; ?></li> -->
                
                <?php if($is_dispatcher) {?>

                <li>
                    <a href="<?php echo base_url().'dispatcher-dashboard'; ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Orders <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'new-orders'; ?>">New Order</a></li>
                        <li><a href="<?php echo base_url().'live-orders'; ?>">Live Order</a></li>
                        <li><a href="<?php echo base_url().'cancel-orders'; ?>">Cancelled</a></li>
                        <li><a href="<?php echo base_url().'completed-orders'; ?>">Completed</a></li>
                        <li><a href="<?php echo base_url().'all-weekly-orders'; ?>">Weekly Order</a></li>
                        <li><a href="<?php echo base_url().'all-orders'; ?>">All Order</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'delivery-boy-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-truck-delivery"></i><span> Delivery Boy </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'custom-push-deliveryboy'; ?>" class="waves-effect">
                        <i class="mdi mdi-bell-ring"></i><span> Push to Delivery Boy</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'order-single-assign'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-settings"></i><span> Assign Delivery Boy </span>
                    </a>
                </li>

                <!-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Assign Order <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php //echo base_url().'order-single-assign'; ?>">Single Order</a></li>
                        <li><a href="<?php //echo base_url().'maintenance8'; ?>">Multiple Order</a></li>
                        <li><a href="<?php //echo base_url().'maintenance9'; ?>">Weekly Order</a></li>
                    </ul>
                </li> -->

                <li>
                    <a href="<?php echo base_url().'maintenance10'; ?>" class="waves-effect">
                        <i class="mdi mdi-book-open"></i><span> Reports </span>
                    </a>
                </li>

                <?php } ?>

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
                    <a href="<?php echo base_url().'category-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-food-fork-drink"></i><span> Category </span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-image-area"></i><span> Website Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'banner-list'; ?>">Banners </a></li>
                        <li><a href="<?php echo base_url().'highlight-list'; ?>">Highlights </a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'admin-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Admin Management </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'customer-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-box"></i><span> Customer Management</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'email-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-email"></i><span> Push/Email Management</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-multiple-plus"></i><span> Restaurant Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'vender-list'; ?>">List of All Restaurants </a></li>
                        <li><a href="<?php echo base_url().'vender-perc'; ?>">Percentage of Restaurant </a></li>
                        <li><a href="<?php echo base_url().'vender-requests'; ?>">Pending Requests </a></li>
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
                        <li><a href="<?php echo base_url().'delivery-orders'; ?>">Delivery</a></li>
                        <li><a href="<?php echo base_url().'takeout-orders'; ?>">Takeout</a></li>
                        <li><a href="<?php echo base_url().'weekly-orders'; ?>">Weekly</a></li>
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

                <?php
                }
                if(($is_vender) || (is_allowed($this->auth->get_role_id(), 'orders'))){
                ?>

                <li>
                    <a href="<?php echo base_url().'vender-profile'; ?>" class="waves-effect">
                        <i class="mdi mdi-border-color"></i><span> My Profile </span>
                    </a>
                </li>

                <?php } 
                 if($is_vender){
                ?>

                <li>
                    <a href="<?php echo base_url().'variant-group-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-google-circles"></i><span> Variant Group </span>
                    </a>
                </li>

                <?php
                }
                if(($is_vender) || (is_allowed($this->auth->get_role_id(), 'item'))) {
                ?>

                <li>
                    <a href="<?php echo base_url().'item-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-food"></i><span> Products </span>
                    </a>
                </li>

                <?php } 
                if(($is_vender) || (is_allowed($this->auth->get_role_id(), 'orders'))) {?>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart"></i><span> Orders <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'order-single-assign'; ?>">Arrived</a></li>
                        <li><a href="<?php echo base_url().'order-accepted'; ?>">Accepted</a></li>
                        <li><a href="<?php echo base_url().'order-rejected'; ?>">Rejected / Cancelled</a></li>
                        <li><a href="<?php echo base_url().'order-today'; ?>">Today</a></li>
                        <li><a href="<?php echo base_url().'order-upcoming'; ?>">Upcoming</a></li>
                        <li><a href="<?php echo base_url().'order-completed'; ?>">Completed</a></li>
                        <!-- <li><a href="<?php echo base_url().'order-trashed'; ?>">Trashed</a></li> -->
                        <li><a href="<?php echo base_url().'order-all'; ?>">All Orders</a></li>
                    </ul>
                </li>

                <?php
                }
                if(($is_vender) || (is_allowed($this->auth->get_role_id(), 'inventory'))) {
                ?>

                <li>
                    <a href="<?php echo base_url().'inventory'; ?>" class="waves-effect">
                        <i class="mdi mdi-checkbox-multiple-marked"></i><span> Inventory </span>
                    </a>
                </li>

                
                <?php
                }
                if($is_vender){
                ?>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> Push/Email Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'vender-custom-push-customer'; ?>">Push Notification</a></li>
                        <li><a href="<?php echo base_url().'vender-custom-email-customer'; ?>">Email</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url().'employee-list'; ?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Employee </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url().'maintenance9'; ?>" class="waves-effect">
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
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker-multiple"></i><span> Popular Location <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url().'popular-location-list'; ?>">View Locations</a></li>
                        <li><a href="<?php echo base_url().'popular-location-requests'; ?>">Location Requests</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url().'contact-us-data'; ?>" class="waves-effect">
                        <i class="mdi mdi-message-text"></i><span> Contact Us </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'maintenance10'; ?>" class="waves-effect">
                        <i class="mdi mdi-credit-card-multiple"></i><span> Setup Payment Portal </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'setting'; ?>" class="waves-effect">
                        <i class="mdi mdi-settings-box"></i><span> Setting </span>
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
<!-- Left Sidebar End