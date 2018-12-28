<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('user/template/header'); ?>

    <body style="background-color: rgba(0, 0, 0, 0.05);">
        <div class="row" style="background-color: green;">
            dsfdsf
        </div>

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

        <div class="row" style="margin-top: 90px;" id="slider-1">
            <div class="col-lg-12">
                <div class="card m-b-20 row">
                    <div class="">

                        <div id="carouselExampleIndicators_1" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators_1" data-slide-to="0" class="active">
                                    <span><b>01</b></span>
                                </li>
                                <li data-target="#carouselExampleIndicators_1" data-slide-to="1">
                                    <span><b>02</b></span>
                                </li>
                                <li data-target="#carouselExampleIndicators_1" data-slide-to="2">
                                    <span><b>03</b></span>
                                </li>
                                <li data-target="#carouselExampleIndicators_1" data-slide-to="3">
                                    <span><b>04</b></span>
                                </li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid w-100 full-slider" src="<?php echo base_url().'assets/files/sliders/slider1.png'; ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="caption-2">Your one stop destination for</div>
                                        <span class="caption-1"><b>delicious foods</b></span>
                                        <form method="post" action="#" class="m-l-15">
                                            <div class="search-div row">
                                                <i class="mdi mdi-map-marker text-danger col-lg-1"></i>
                                                <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                                <input type="submit" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid w-100 full-slider" src="<?php echo base_url().'assets/files/sliders/slider1.png'; ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="caption-2">Your one stop destination for</div>
                                        <span class="caption-1"><b>delicious foods</b></span>
                                        <form method="post" action="#" class="m-l-15">
                                            <div class="search-div row">
                                                <i class="mdi mdi-map-marker text-danger col-lg-1"></i>
                                                <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                                <input type="submit" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid w-100 full-slider" src="<?php echo base_url().'assets/files/sliders/slider1.png'; ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="caption-2">Your one stop destination for</div>
                                        <span class="caption-1"><b>delicious foods</b></span>
                                        <form method="post" action="#" class="m-l-15">
                                            <div class="search-div row">
                                                <i class="mdi mdi-map-marker text-danger col-lg-1"></i>
                                                <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                                <input type="submit" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid w-100 full-slider" src="<?php echo base_url().'assets/files/sliders/slider1.png'; ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="caption-2">Your one stop destination for</div>
                                        <span class="caption-1"><b>delicious foods</b></span>
                                        <form method="post" action="#" class="m-l-15">
                                            <div class="search-div row">
                                                <i class="mdi mdi-map-marker text-danger col-lg-1"></i>
                                                <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                                <input type="submit" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row" id="offers">
            <div class="container">
                <div class="offer-title text-center">
                    <h2><b>Offers and Restaurant</b></h2>
                </div>
                <div class="offer-title2 mt-5">
                    <div class="text-center">
                        <label class="label1 mr-3">Combo Offers</label>
                        <label class="label2 mr-3 active">Nearby Restaurant</label>
                        <label class="fliter mr-3"><i class="mdi mdi-filter-outline"></i></label>
                    </div>
                </div>
                <div class="restaurant row mt-4">
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="position-relative txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4 cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="position-relative txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4 cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <div class="card-title txt-red font-md text-center">Chili's Grill & Bar</div>
                                <b>
                                    <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                    <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                </b>
                                <div class="txt-black font-14 pl-4" id="cusion">
                                    Burger, Maxican
                                </div>
                                <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="features">
            <div class="container p-5">
                <div class="feature-header">
                    <h1 class="text-center m-15 letter-space-1"><b>Lunch should be simple</b></h1>
                    <h6 class="text-center text-uppercase letter-space-2">and that's why we're here.</h6>
                </div>
                <div class="features-div row text-center">
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Time-Is-Money.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Time is Money</strong></h5>
                            <h6 class="feature-txt-2">More "you time" to do what is important</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Easy-To-Use.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Easy to Use</strong></h5>
                            <h6 class="feature-txt-2">The lunch you want in a few simple clicks</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Peace-Of-Mind.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Peace-of-Mind</strong></h5>
                            <h6 class="feature-txt-2">Reliable delivery from the brands you trust</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="slider-2">
            <div class="col-lg-12">
                <div class=row">
                    <div class="card-body bg-cyan">
                        <div id="carouselExampleIndicators" class="carousel slide label-slider p-5 text-center" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner text-white" role="listbox">
                                <div class="carousel-item active">
                                    <div class="d-flex">
                                        <div class="carousel-txt text-uppercase d-flex">
                                            <div class="stats-number">98.3</div>
                                        </div>
                                        <div class="stats-content d-flex">
                                            <div class="stats-first-line">% Lunches delivered</div>
                                            <div class="stats-second-line">Accurately and on-time</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex">
                                        <div class="carousel-txt text-uppercase d-flex">
                                            <div class="stats-number">27</div>
                                        </div>
                                        <div class="stats-content d-flex">
                                            <div class="stats-first-line">Minutes saved</div>
                                            <div class="stats-second-line">Per Foodsby order</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex">
                                        <div class="carousel-txt text-uppercase d-flex">
                                            <div class="stats-number">12</div>
                                        </div>
                                        <div class="stats-content d-flex">
                                            <div class="stats-first-line">Restaurant</div>
                                            <div class="stats-second-line">options per week (avg.)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <div class="row center-xs app-row-new" id="partners">
            <div class="container p-5 text-center">
                <div class="partners-header mb-5">
                    <h1 class="text-center m-15 letter-space-1"><b>Restaurant Partners</b></h1>
                    <h6 class="text-center text-uppercase letter-space-2">your favorite local and national restaurants - now delivering.</h6>
                </div>
                <img src="<?php echo base_url(); ?>/assets/images/home-page/Restaurent-Partner.png" alt="Time is Money">
            </div>
        </div>

        <!-- testimonial slider -->
        <div class="row mb-5 mt-5" id="testimonial-slider">
            <div class="container">
                <div id="qunit"></div>
                <div id="qunit-fixture">
                    <div id="navhere"></div>
                    <ul id="simple" class="row owl-carousel">
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long esta as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" height="100" width="100" alt="" class="testimonial-img">
                            <div class="bg-white text-center">
                                <div class="px-4 pt-80 ln-height-2 h-16 over-f-hidden">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
                                </div>
                                <div class="p-3">
                                    <b><h5 class="txt-red text-uppercase">Lydia brown</h5></b>
                                    <h6 class="text-black-50">L'Enclume</h6>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="row mt-5" id="how-it-work">
            <div class="container p-5">
                <div class="feature-header">
                    <h1 class="text-center m-15 letter-space-1"><b>How it Works</b></h1>
                    <h6 class="text-center text-uppercase letter-space-2">ClickLunch is a lunch delivery service specially for office professionals.</h6>
                </div>
                <div class="how-it-work-div row text-center">
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Order-Online.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Order Online</strong></h5>
                            <h6 class="feature-txt-2">Normal menu prices and $1.99 delivery</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Restaurent-Delivers.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Easy to Use</strong></h5>
                            <h6 class="feature-txt-2">No tipping and no minimums</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-5">
                        <img src="<?php echo base_url(); ?>/assets/images/home-page/Enjoy-Your-Meal.png" alt="Time is Money">
                        <div class="m-4">
                            <h5><strong>Peace-of-Mind</strong></h5>
                            <h6 class="feature-txt-2">We'll notify you when your meal arrives</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row center-xs app-row-new">
            <div class="col-xs-12 col-sm-6 app-text text-left">
                <h1 class="txt-red text-uppercase"><b>order on the go.</b></h1>
                <h4 class="m-0">Get the food you love</h4>
                <h4 class="m-1">with the clicklunch app.</h4>
                <div class="mt-4">
                    <img src="<?php echo base_url(); ?>/assets/images/home-page/Apple-Play-Store.png" alt="Apple Play Store" class="mr-3">
                    <img src="<?php echo base_url(); ?>/assets/images/home-page/Google-Play-Store.png" alt="Google Play Store">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 pt-5 pb-5">
                <img class="app-image" src="<?php echo base_url(); ?>/assets/images/home-page/Mobile.png" alt="Click Lunch">
            </div>
        </div>

        <div class="row mb-70 pt-5">
            <div class="container">
                <div class="col-12 text-center">
                    <h6 class="subscribe-txt font-w-1">Be the lucky winner to get FREE Madang premium meals for one week.</h6>
                    <h6 class="subscribe-txt font-w-1">We are also offer you latest deal in your inbox!</h6>
                    <div class="m-5">
                        <input type="email" class="subscribe-email" name="email" value="" placeholder="Enter your e-mail address here">
                        <input type="submit" class="subscribe-btn" name="submit" value="SUBSCRIBE">
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 footer-links">
                        <div class="font-sm">
                        <a href="#" class="d-inline-flex p-2">Contact Us</a>
                        <a href="#" class="d-inline-flex p-2">Restaurants Partners</a>
                        <a href="#" class="d-inline-flex p-2">Terms of Service</a>
                        <a href="#" class="d-inline-flex p-2">FAQ</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="font-sm">&copy; 2018 - <span class="d-none d-sm-inline-block"> www.<b>ClickLunch</b>.com All rights reserved</span></div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


    </body>
</html>

<script type="text/javascript">
$(document).ready(function() {
var owl = $('#simple');
    owl.owlCarousel({
        loop:true,
        responsiveClass:true,
        nav:true,
        margin:20,
        dots:true,
        items:1,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true
            },
            600:{
                items:2,
                nav:true
            },
            1000:{
                items:3,
                nav:true,
                loop:true
            }
        }
    });

    // owl.on('mousewheel', '.owl-stage', function (e) {
    //     if (e.deltaY>0) {
    //         owl.trigger('next.owl');
    //     } else {
    //         owl.trigger('prev.owl');
    //     }
    //     e.preventDefault();
    // });
             
});
</script>