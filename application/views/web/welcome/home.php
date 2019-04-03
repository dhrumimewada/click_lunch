<style type="text/css" media="screen">
   .tab-content>.active{
        display: inline-flex !important;
   } 
</style>
<!-- SLider Start-->
<?php
if(isset($banner_list) && !empty($banner_list)){
?>
<div class="row mr-0 ml-0 mb-5"  id="slider-1">
    <div class="col-lg-12">
        <div class="card m-b-20 row">
            <div class="home-banner">

                <div id="carouselExampleIndicators_1" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        foreach ($banner_list as $key => $value){
                            $active = ($key == 0)?"active":"";
                        ?>
                        <li data-target="#carouselExampleIndicators_1" data-slide-to="<?php echo $key; ?>" class="<?php echo $active; ?>">
                            <span><b></b></span>
                        </li>
                        <?php
                        }
                        ?>
                    </ol>


                    <div class="carousel-inner" role="listbox">
                        <?php
                        $photo_url = base_url() . 'assets/images/default/cuisine.jpg';
                        foreach ($banner_list as $key => $value) {
                            $active = ($key == 0)?'active':'';

                            if (isset($value['banner_picture']) && ($value['banner_picture'] != '')) {
                                if (file_exists($this->config->item("banner_photo_path") . '/'.$value['banner_picture'])){
                                    $photo_url = base_url() . $this->config->item("banner_photo_path") . '/'.$value['banner_picture'];
                                }
                            }
                        ?>

                        <div class="carousel-item <?php echo $active; ?>">
                            <img class="d-block img-fluid w-100 full-slider" src="<?php echo $photo_url; ?>" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="caption-2">
                                    <?php echo $value['sub_title']; ?>
                                </div>
                                <span class="caption-1"><b>
                                    <?php echo $value['title']; ?>
                                </b></span>
                                <form method="post" action="#" class="m-l-15">
                                    <div class="search-div row">
                                        
                                        <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                        <input type="submit" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="social-links">
                    <ul>
                        <li>
                            <div class="socil-img">
                                <a href="https://www.facebook.com/click2lunch/" target="_blank">
                                <img class="normal-img" src="<?php echo $assets; ?>images/Facebook.png">
                                <img class="hover-img" src="<?php echo $assets; ?>images/Facebook-D.png">
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="socil-img"><a href="https://www.instagram.com/clicklunch24/" target="_blank">
                                <img class="normal-img" src="<?php echo $assets; ?>images/Instagram.png">
                                <img class="hover-img" src="<?php echo $assets; ?>images/Instagram-d.png">
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="socil-img"><a href="https://twitter.com/click_lunch" target="_blank">
                                <img class="normal-img" src="<?php echo $assets; ?>images/Twitter.png">
                                <img class="hover-img" src="<?php echo $assets; ?>images/Twitter-D.png">
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="social-links social-lins-mobile">
                    <ul>
                        <li>
                            <div class="socil-img">
                                <a class="fb-icon" href="https://accounts.Facebook.com/signin"></a>
                                <a class="fb-icon-hover" href="https://accounts.Facebook.com/signin"></a>
                            </div>
                        </li>
                          <li>
                            <div class="socil-img">
                                <a class="ig-icon" href="https://www.instagram.com/accounts/login/"></a>
                                <a class="ig-icon-hover" href="https://www.instagram.com/accounts/login/"></a>
                            </div>
                        </li>
                          <li>
                            <div class="socil-img">
                                <a class="tw-icon" href="https://twitter.com/login"></a>
                                <a class="tw-icon-hover" href="https://twitter.com/login"></a>
                            </div>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<?php
}
?>
<!-- Slider End -->

<div class="row mr-0 ml-0 mb-5  grey-bg" id="offers">
    <div class="container">
        <div class="offer-title text-center">
            <h2><b>Discover Restaurants by Popular Cuisine</b></h2>
        </div>
        <div class="home-filter-list">
            <div class="home-filter-box">
                <ul class="nav nav-pills mb-3 list-filter" id="pills-tab" role="tablist">
                    <?php
                    $all_cuisines_url = base_url() . 'web-assets/images/all.png';

                    foreach ($cuisines as $key => $value) {
                        $active = ($value['cuisine_name'] == 'All')?'active':'';
                        $photo_url = base_url() . 'web-assets/images/all.png';
                        if (isset($value['cuisine_picture']) && ($value['cuisine_picture'] != '')) {
                            if (file_exists($this->config->item("cuisine_photo_path") . '/'.$value['cuisine_picture'])){
                                $photo_url = base_url() . $this->config->item("cuisine_photo_path") . '/'.$value['cuisine_picture'];
                            }
                        }
                        $id = ($value['cuisine_name'] == 'All')?'':$value['id'];
                    ?>
                        <li class="nav-item">                            
                            <a class="nav-link <?php echo $active; ?>" id="<?php echo $id; ?>" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="true"><img src="<?php echo $photo_url; ?>"><?php echo $value['cuisine_name']; ?></a>
                        </li>   
                    <?php
                    }
                    ?>

                </ul>                   
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pizza-list" role="tabpanel">
                    <div class="list-filter-detail">                      
                        <div class="dropdown delivery review-star ">                          
                            <div class="form-group">
                                <label class="sort-title-ab">Sort :</label>
                                <select class="form-control review-star filter" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected hidden > Delivery Fee</option>                                
                                     <option value="1">Sort By High</option>
                                     <option value="2">Sort By Low</option>                                                                      
                                </select>
                            </div>                           
                        </div>  

                        <div class="dropdown delivery review-star">                          
                              <div class="form-group">
                                        <label  for="#review-star1" class="review-title">Over</label>
                                        <label  for="#review-star1" class="review-icon"><img src="<?php echo $assets; ?>images/bookmark-star.png"></label>
                                    <select class="form-control review-star filter" id="review-star1">                                     
                                         <option selected value='' >All</option>
                                         <option value="1" >1</option>
                                         <option value="1.50" >1.5</option>
                                         <option value="2" >2</option>
                                         <option value="2.50" >2.5</option>
                                         <option value="3" >3</option>
                                         <option value="3.50" >3.5</option>
                                         <option value="4" >4</option>     
                                         <option value="4.50" >4.5</option>     
                                         <option value="5" >5</option>                                   
                                         <option value="5.50" >5.5</option>                                   
                                    </select>
                                </div>                           
                        </div>                        
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input filter" type="checkbox" id="filter-pickup" value="1" name="filter-pickup">
                            <label class="form-check-label" for="filter-pickup">Pickup</label>
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input filter" type="checkbox" id="filter-popular" value="1" name="filter-popular">
                            <label class="form-check-label" for="filter-popular">Popular</label>
                        </div>
                        <!-- <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input" type="checkbox" id="Vegetarian1" value="option1" name="Pickup">
                            <label class="form-check-label" for="Vegetarian1">Vegetarian</label>
                        </div> -->
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-star filter" id="order-price">
                                    <option value="" disabled selected hidden>$.$$</option>                                                                          
                                     <option value="1" >Sort By High</option>
                                     <option value="2" >Sort By Low</option>                                                                      
                                </select>
                            </div> 
                        </div>  
                        <div class="dropdown delivery review-star">                          
                            <div class="form-group">
                                <select class="form-control review-sta filter" id="order-category">
                                    <option value="" disabled selected hidden>Category</option>
                                    <?php
                                    if(isset($category) && !empty($category)){
                                        foreach ($category as $key => $value) {
                                    ?>
                                            <option value="<?php echo $value['id']; ?>" ><?php echo $value['category_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>                                 
                                </select>
                            </div> 
                        </div>  
                    </div> 
                </div>
            </div>
        </div> 
        <div class="offer-title2 mt-5">
            <ul class="nav nav-tabs justify-content-center border-bottom-0" id="home-tabs" role="tablist">
                <li class="nav-item mr-3">
                    <a class="nav-link" id="combo-tab" data-toggle="tab" href="#combo" role="tab" aria-controls="combo" aria-selected="false">Combo Offers</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link active" id="nearby-tab" data-toggle="tab" href="#nearby" role="tab" aria-controls="nearby" aria-selected="true">Nearby Restaurant</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active restaurant row mt-4 w-100" id="nearby" role="tabpanel" aria-labelledby="nearby-tab">
                <?php
                if(isset($shops) && !empty($shops)){
                    foreach ($shops as $key => $value){
                        $photo_url = base_url() . 'web-assets/images/logo-3.png';
                        if (isset($value['profile_picture']) && ($value['profile_picture'] != '')) {
                            if (file_exists($this->config->item("profile_path") . '/'.$value['profile_picture'])){
                                $photo_url = base_url() . $this->config->item("profile_path") . '/'.$value['profile_picture'];
                            }
                        }
                        ?>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <a href="<?php echo BASE_URL().'restaurant/'.$value['short_name']; ?>">
                                <div class="restaurant-img position-relative">
                                    <img class="card-img-top" src="<?php echo $photo_url; ?>" alt="Card image cap">
                                    <div class="rating txt1">Ratings</div>
                                    <div class="rating txt2 txt-red">4.2</div>
                                </div>
                                <div class="card-body restaurant-body">
                                        <div class="card-title txt-red font-md text-center cut-text">
                                            <?php echo stripcslashes($value['shop_name']); ?>
                                        </div>
                                        <b>
                                            <div class="d-inline-block txt-black font-small">Delivery <?php echo $value['delivery_time']; ?></div>
                                            <div class="d-inline-block txt-black float-right font-small">Order by <?php echo $value['order_by_time']; ?></div>
                                        </b>
                                        <?php
                                        if(isset($value['cuisine']) && $value['cuisine'] != ''){
                                        ?>
                                        <div class="position-relative txt-black font-14 pl-4 cusion cut-text">
                                            <?php
                                            $total = count($value['cuisine']) - 1;
                                            foreach ($value['cuisine'] as $key1 => $value1) {
                                                echo '<span data-id="'.$value1['cuisine_id'].'" data-toggle="tooltip" data-placement="bottom" title="View all '.$value1['cuisine_name'].' Restaurants" class="search-cuisine d-inline-block pointer">'.$value1['cuisine_name'].'</span>';
                                                if($key1 != $total){
                                                    echo ', ';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="card-text txt-black font-11">
                                            <?php
                                            if($value['availibality']['is_closed'] == 1){
                                                echo $time = 'TODAY CLOSED';
                                            }else if($value['availibality']['full_day'] == 1){
                                                echo $time = 'FULL DAY OPEN';
                                            }else if($value['availibality']['from_time'] != '' && $value['availibality']['to_time'] != ''){
                                                echo $time = $value['availibality']['from_time'].' to '.$value['availibality']['to_time'];
                                            }else{
                                                echo '&nbsp;';
                                            }
                                            ?>
                                        </div>
                                        <!-- <div class="text-right txt-black mt-1"><b>0.71mi</b></div> -->
                                </div>
                                <div class="restaurant-hover">
                                    <div class="restaurant-hover-list">
                                         <div class="restaurant-hover-img">
                                            <a href="<?php echo BASE_URL().'restaurant/'.$value['short_name']; ?>"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php
                    }
                }else{
                ?>
                <div class="text-muted no-shops-found">
                    No any restaurant found
                </div>
                <?php
                }
                ?>
            </div>
            <div class="tab-pane fade restaurant row mt-4" id="combo" role="tabpanel" aria-labelledby="combo-tab">
                <?php
                if(isset($combo_shops) && !empty($combo_shops)){
                    foreach ($combo_shops as $key => $value){
                        $photo_url = base_url() . 'web-assets/images/logo-3.png';
                        if (isset($value['profile_picture']) && ($value['profile_picture'] != '')) {
                            if (file_exists($this->config->item("profile_path") . '/'.$value['profile_picture'])){
                                $photo_url = base_url() . $this->config->item("profile_path") . '/'.$value['profile_picture'];
                            }
                        }
                        ?>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <a href="<?php echo BASE_URL().'restaurant/'.$value['short_name']; ?>">
                                <div class="restaurant-img position-relative">
                                    <img class="card-img-top" src="<?php echo $photo_url; ?>" alt="Card image cap">
                                    <div class="rating txt1">Ratings</div>
                                    <div class="rating txt2 txt-red">4.2</div>
                                </div>
                                <div class="card-body restaurant-body">
                                        <div class="card-title txt-red font-md text-center cut-text">
                                            <?php echo stripcslashes($value['shop_name']); ?>
                                        </div>
                                        <b>
                                            <div class="d-inline-block txt-black font-small">Delivery <?php echo $value['delivery_time']; ?></div>
                                            <div class="d-inline-block txt-black float-right font-small">Order by <?php echo $value['order_by_time']; ?></div>
                                        </b>
                                        <?php
                                        if(isset($value['cuisine']) && $value['cuisine'] != ''){
                                        ?>
                                        <div class="position-relative txt-black font-14 pl-4 cusion cut-text">
                                            <?php
                                            $total = count($value['cuisine']) - 1;
                                            foreach ($value['cuisine'] as $key1 => $value1) {
                                                echo '<span data-id="'.$value1['cuisine_id'].'" data-toggle="tooltip" data-placement="bottom" title="View all '.$value1['cuisine_name'].' Restaurants" class="search-cuisine d-inline-block pointer">'.$value1['cuisine_name'].'</span>';
                                                if($key1 != $total){
                                                    echo ', ';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="card-text txt-black font-11">
                                            <?php
                                            if($value['availibality']['is_closed'] == 1){
                                                echo $time = 'TODAY CLOSED';
                                            }else if($value['availibality']['full_day'] == 1){
                                                echo $time = 'FULL DAY OPEN';
                                            }else if($value['availibality']['from_time'] != '' && $value['availibality']['to_time'] != ''){
                                                echo $time = $value['availibality']['from_time'].' to '.$value['availibality']['to_time'];
                                            }else{
                                                echo '&nbsp;';
                                            }
                                            ?>
                                        </div>
                                        <!-- <div class="text-right txt-black mt-1"><b>0.71mi</b></div> -->
                                </div>
                                <div class="restaurant-hover">
                                    <div class="restaurant-hover-list">
                                         <div class="restaurant-hover-img">
                                            <a href="<?php echo BASE_URL().'restaurant/'.$value['short_name']; ?>"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php
                    }
                }else{
                ?>
                <div class="text-muted no-shops-found">
                    No any combo restaurant found
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row mr-0 ml-0" id="features">
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

<div class="row mr-0 ml-0" id="slider-2">
    <div class="col-lg-12 p-0">
        <div class=row">
            <div class="card-body bg-cyan">
                <div id="carouselExampleIndicators" class="carousel slide label-slider p-5 text-center" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner text-white" role="listbox">
                        <?php
                        foreach ($highlight as $key => $value) {
                            $active = ($key == 0)?'active':'';
                        ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <div class="d-flex justify-content-center">
                                <div class="carousel-txt text-uppercase d-flex">
                                    <div class="stats-number"><?php echo $value['txt1'] ?></div>
                                </div>
                                <div class="stats-content d-flex">
                                    <div class="stats-first-line"><?php echo $value['txt2'] ?></div>
                                    <div class="stats-second-line"><?php echo $value['txt3'] ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
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
        <img src="<?php echo base_url(); ?>/assets/images/home-page/Restaurent-Partner.png" alt="Time is Money" class="w-100">
    </div>
</div>

<!-- testimonial slider -->
<div class="row mb-5 mt-5 ml-0 mr-0" id="testimonial-slider">
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

<div class="row mt-5 mr-0 ml-0" id="how-it-work">
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
            <a href="https://www.apple.com/in/ios/app-store/"><img src="<?php echo base_url(); ?>/assets/images/home-page/Apple-Play-Store.png" alt="Apple Play Store" class="mr-3"></a>
            <a href="https://play.google.com/store?hl=en"><img src="<?php echo base_url(); ?>/assets/images/home-page/Google-Play-Store.png" alt="Google Play Store"></a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 pt-5 pb-5">
        <img class="app-image" src="<?php echo base_url(); ?>/assets/images/home-page/Mobile.png" alt="Click Lunch">
    </div>
</div>
<script type="text/javascript">
var latitude = '<?php echo $_SESSION['lat']; ?>';
var longitude = '<?php echo $_SESSION['long']; ?>';

var get_shop_data_url = "<?php echo base_url().'get-shops-by-filter'; ?>";
var photo_url = '<?php echo base_url() . $this->config->item("profile_path") . '/'; ?>';
var defualt_photo_url = '<?php echo base_url() . 'web-assets/images/logo-3.png'; ?>';

var shop_url = '<?php echo base_url().'restaurant/'; ?>';
var zoom_out_img_url = '<?php echo base_url().'web-assets/images/zoom-in-out.png'; ?>';

var cuisine_id = '';
var pickup = '';
var popular = '';
var delivery_fee = '';
var minimum_order_amount = '';
var category = '';
var rating = '';
$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();
    
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
// if (latitude == '' || longitude == ''){

//     window.onload = function() {

//         function initMap(position) {
//              var latitude = parseFloat(position.coords.latitude);
//              var longitude = parseFloat(position.coords.longitude);
//              console.log('js fetch' + latitude+' ** '+longitude);
//         }
//         if (navigator.geolocation){
//             navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
//                 navigator.geolocation.getCurrentPosition(initMap);
//             });
//         }

//     }
// }else{
//     console.log('php lat long fetch'+ latitude +' - '+longitude);
// }
    
//     var get_shops_url = "<?php // echo base_url().'get-shops'; ?>";

// if (latitude !== '' || longitude !== ''){
//     $.ajax({
//         url: get_shops_url,
//         type: "POST",
//         data:{
//             latitude:latitude,
//             longitude:longitude
//             },
//         success: function (returnData) {
//             if (typeof returnData != "undefined"){
//                 returnData = $.parseJSON(returnData);
//                 console.log(returnData);
//             }
//         },
//         error: function (xhr, ajaxOptions, thrownError) {
//             console.log('error');
//         }
//     });
// }else{
//     console.log("blank");
// }
     

});
</script>
<script src="<?php echo base_url().'web-assets/js/custom/home.js'; ?>"></script>
