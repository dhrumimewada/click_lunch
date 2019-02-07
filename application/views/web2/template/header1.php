<?php $assets = $this->config->item('website_assest'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/style.css">
   
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/responsive.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/owl.theme.default.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/popper.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/bootstrap.min.js"></script>
     <!-- <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript" src="<?php echo $assets; ?>js/bootstrap-input-spinner.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>js/custom.js"></script>

    <script src="<?php echo $assets; ?>js/timepicki.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/timepicki.css">
    <script type="text/javascript" src="<?php echo $assets; ?>js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/datepicker.min.css">


</head>

    <body>
         <!-- Navigation Bar-->
        <header id="topnav" class="home-header">
            <div class="container"> 
                <div class="header-bar"> 
                    <nav class="navbar navbar-expand-lg navbar-light header-box">
                        <div class="header-app">
                            <a class="navbar-brand logo" href="<?php echo BASE_URL(); ?>web/home"><img src="<?php echo BASE_URL(); ?>assets/images/click-lunch.png" alt="" class="logo-large"></a>
                            <a href="<?php echo BASE_URL(); ?>web/home/get_the_app">Get the App</a>
                        </div>                      
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                      </button>

                        <div class="collapse navbar-collapse header-menu" id="navbarSupportedContent">
                          <ul class="navbar-nav ">
                            <li class="dropdown notification-list active">
                                <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>web/home" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase active">Home</strong>
                                </a>       
                            </li>
                             <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>web/home/delivery" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Delivery</strong>
                                </a>       
                            </li>                  
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>web/home/takeout_restaurant" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Takeout</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>web/home/restaurant_partner" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">Restaurant Partner</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="nav-link waves-effect" href="<?php echo BASE_URL(); ?>web/home/faq" role="button" aria-haspopup="false" aria-expanded="false">
                                    <strong class="text-uppercase">FAQ</strong>
                                </a>       
                            </li>
                           
                            <li class="dropdown notification-list">
                                <a class="dropdown-item drop-down-icon" href="javascript:void(0)" data-toggle="modal" data-target="#loginFormModal">
                                    <strong class="text-uppercase">Login</strong>
                                </a>       
                            </li>
                            <li class="dropdown notification-list">
                                <a class="dropdown-item drop-down-icon" href="javascript:void(0)" data-toggle="modal" data-target="#registerFormModal">
                                    <strong class="text-uppercase">Create an Account</strong>
                                </a>       
                            </li>
                        
                            </ul>                            
                        </div>
                    </nav>
                    <div class="header-link-box">
                        <div class="header-link notification-list">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="rounded-circle">
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
                                                <a class="dropdown-item" href="<?php echo BASE_URL(); ?>web/home/profile"><i class="mdi mdi-account-circle m-r-5"></i> Contact Information</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL(); ?>web/home/add_card"><i class="mdi mdi-account-circle m-r-5"></i> Payment Methods</a>                                                
                                            </div>
                                          </li> 

                                            <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/order_history">
                                                        <img src="<?php echo $assets; ?>images/Order-History.png">
                                                        <span>Order History</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                            <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/favourites">
                                                        <img src="<?php echo $assets; ?>images/favorite-heart-button.png">
                                                        <span>Favourites</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                            <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/weekly_planner">
                                                        <img src="<?php echo $assets; ?>images/calendar-weekly.png">
                                                        <span>Weekly Planner</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                             <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/order_history">
                                                        <img src="<?php echo $assets; ?>images/Group-Order.png">
                                                        <span>Group Order</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                             <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/change_location">
                                                        <img src="<?php echo $assets; ?>images/Change-Location.png">
                                                        <span>Change Location</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                             <li class="nav-item dropdown drop-down-icon">
                                                <div class="sub-list">
                                                    <a class="dropdown-item drop-down-icon" href="<?php echo BASE_URL(); ?>web/home/delivery_address">
                                                        <img src="<?php echo $assets; ?>images/About-US.png">
                                                        <span>About Us</span>
                                                    </a>
                                                </div>                                               
                                            </li>
                                   
                                    
                                        </ul>
                                      </div>
                                    </nav>
                                    
                                </div>                                                                    
                            </div>
                        </div>                            
                        <div class="header-link notification-list last-div">
                            <a class="nav-link waves-effect p-0" href="<?php echo BASE_URL(); ?>web/home/checkout" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo $assets; ?>images/Cart.png" />
                            </a>       
                        </div>              
                    </div>
                </div>
            </div>
        </header>