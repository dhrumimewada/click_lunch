<?php
$is_customer = $this->auth->is_customer();
$profile_picture = 'https://bootdey.com/img/Content/avatar/avatar5.png';
if($is_customer){
    $user_id = $this->auth->get_user_id();
    $user_data = get_loggedin_detail($user_id);
    if($user_data->profile_picture != ''){
        $profile_picture = base_url().$this->config->item("customer_profile_path") . '/'.$user_data->profile_picture;
    }
}
?>
<!-- Navigation Bar-->
<header id="topnav" class="home-header">
    <div class="container"> 
        <div class="header-bar"> 
            <nav class="navbar navbar-expand-lg navbar-light header-box">
                <div class="header-app">
                    <a class="navbar-brand logo" href="https://play.google.com/store?hl=en"><img src="<?php echo BASE_URL(); ?>assets/images/click-lunch.png" alt="" class="logo-large"></a>
                    <a href="https://play.google.com/store?hl=en">Get the App </a>
                </div>                      
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
              </button>

                <div class="collapse navbar-collapse header-menu" id="navbarSupportedContent">
                  <ul class="navbar-nav">
                    <?php 
                    if($this->uri->segment(1) == 'welcome'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>
                    <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>welcome" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">Home</strong>
                        </a>       
                    </li>
                    <?php 
                    if($this->uri->segment(1) == 'weekly-planner'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>
                    <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>weekly-planner" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">Weekly Planner</strong>
                        </a>       
                    </li>
                    <?php 
                    if($this->uri->segment(1) == 'delivery-restaurants'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>
                     <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>delivery-restaurants" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">Delivery</strong>
                        </a>       
                    </li>
                    <?php 
                    if($this->uri->segment(1) == 'takeout-restaurants'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>                
                    <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>takeout-restaurants" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">Takeout</strong>
                        </a>       
                    </li>
                    <?php 
                    if($this->uri->segment(1) == 'restaurant-partner-form'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>
                    <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>restaurant-partner-form" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">Restaurant Partners</strong>
                        </a>       
                    </li>
                    <?php 
                    if($this->uri->segment(1) == 'faq'){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                    ?>
                    <li class="dropdown notification-list <?php echo $active; ?>">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>faq" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase <?php echo $active; ?>">FAQ</strong>
                        </a>       
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>add-request-address" role="button" aria-haspopup="false" aria-expanded="false">
                            <strong class="text-uppercase">Popular Address</strong>
                        </a>       
                    </li>
                    
                    <?php
                    if($is_customer && $this->auth->is_logged_in()){
                    ?>

                    <?php
                    }else{
                    ?>
                    <li class="dropdown notification-list">
                        <a class="dropdown-item drop-down-icon" href="javascript:void(0)" data-toggle="modal" data-target="#loginFormModal">
                            <strong class="text-uppercase">Login</strong>
                        </a>       
                    </li>
                    <li class="dropdown notification-list">
                        <a class="dropdown-item drop-down-icon" href="javascript:void(0)" data-toggle="modal" data-target="#registerFormModal">
                            <strong class="text-uppercase">Register</strong>
                        </a>       
                    </li>
                    <?php
                    }
                    ?>
                
                    </ul>                            
                </div>
            </nav>
            <div class="header-link-box">
                <?php
                if($is_customer && $this->auth->is_logged_in()){
                ?>
                <div class="header-link notification-list">
                    <div class="dropdown notification-list nav-pro-img">
                        <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="<?php echo $profile_picture; ?>" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        
                            <nav class="navbar drop-list">
                                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                            
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">                                         
                                        <li class="nav-item dropdown drop-down-icon profile-submenu sub-list">                                            
                                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?php echo $assets; ?>images/My-Profile.png">
                                            <span>My Profile</span></a>

                                            <div class="dropdown-menu  drop-box" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="<?php echo BASE_URL(); ?>contact-info"><i class="mdi mdi-account-circle m-r-5"></i> Contact Information</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL(); ?>customer-payment-setting"><i class="mdi mdi-account-circle m-r-5"></i> Payment Methods</a>                                                
                                            </div>
                                        </li> 

                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>order-history">
                                                    <img src="<?php echo $assets; ?>images/Order-History.png">
                                                    <span>Order History</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>favourite-orders">
                                                    <img src="<?php echo $assets; ?>images/favorite-heart-button.png">
                                                    <span>Favourites</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>coming-soon">
                                                    <img src="<?php echo $assets; ?>images/calendar-weekly.png">
                                                    <span>Weekly Planner</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>coming-soon">
                                                    <img src="<?php echo $assets; ?>images/Group-Order.png">
                                                    <span>Group Order</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>change-location">
                                                    <img src="<?php echo $assets; ?>images/Change-Location.png">
                                                    <span>Change Location</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>about-us">
                                                    <img src="<?php echo $assets; ?>images/About-US.png">
                                                    <span>About Us</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                        <li class="nav-item dropdown drop-down-icon">
                                            <div class="sub-list">
                                                <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>customer-logout">
                                                    <img src="<?php echo $assets; ?>images/logout.png">
                                                    <span>Logout</span>
                                                </a>
                                            </div>                                               
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>                                                                    
                    </div>
                </div>
                <?php
                }
                $items = count($this->cart->contents());
                ?>
                <div class="header-link notification-list last-div">
                    <a class="nav-link waves-effect cart-icon p-0" href="<?php echo BASE_URL(); ?>cart" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="dot"><?php echo $items; ?></span>
                        <img src="<?php echo $assets; ?>images/Cart.png" />
                        
                        
                    </a>       
                </div>              
            </div>
        </div>
    </div>
</header>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).on('change','#order-price',function(){

    });
</script>