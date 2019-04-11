<style type="text/css" media="screen">
   .tab-content>.active{
        display: inline-flex !important;
   }
   .swal2-radio label{
        display: inline-block;
        margin: 0px 40px;
   }
   .swal2-radio span{
        font-size: 20px;
        padding: 0 10px;
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
                                <!-- <form method="post" action="#" class="m-l-15">
                                    <div class="search-div row">
                                        
                                        <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Delivery Address">
                                        
                                        <input type="hidden" class="zipcode" name="zipcode">
                                        <input type="button" name="submit" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                                    </div>
                                </form> -->
                            </div>
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div id="search-div">
                    <div class="m-l-15">
                        <div class="search-div row">
                            
                            <input type="text" name="search-txt" class="search-txt col-lg-6" placeholder="Enter Your Location" onFocus="geolocate()" id="autocomplete">
                            <input type="hidden" id="administrative_area_level_2" name="city">
                            <input type="hidden" id="administrative_area_level_1" name="state">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">

                            <input type="button" id="find-shops-by-address" class="search-btn col-lg-5 float-right" value="Find Restaurant">
                        </div>
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
            <!-- <input type="text" name="search-txt1" class="col-lg-6" placeholder="Enter Your Delivery Address" onFocus="geolocate()" id="autocomplete">
            <input type="hidden" id="administrative_area_level_2" name="city">
            <input type="hidden" id="administrative_area_level_1" name="state"> -->
        </div>
        <div class="home-filter-list">
            <div class="home-filter-box">
                <ul class="nav nav-pills mb-3 list-filter" id="pills-tab" role="tablist">
                    <?php
                    $all_cuisines_url = base_url() . 'web-assets/images/all.png';

                    foreach ($cuisines as $key => $value) {
                        $active = ($value['cuisine_name'] == 'All')?'active all':'';
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
                                <label class="sort-title-ab">SORT :</label>
                                <select class="form-control review-star filter" id="deliver-fee">                                            
                                     <option class="sort-dev" value="" disabled selected > Delivery Fee</option>                                
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
                                         <option selected value=''>All</option>
                                         <option value="1">1</option>
                                         <option value="2">2</option>
                                         <option value="3">3</option>
                                         <option value="4">4</option>                                                                            
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
                                <label class="sort-title-ab">SORT:</label>
                                <select class="form-control review-star filter" id="order-price">
                                    <option value="" disabled selected>$.$$</option>                                                                          
                                     <option value="1" >High</option>
                                     <option value="2" >Low</option>                                                                      
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
                                            <option value="<?php echo $value['id']; ?>" >
                                                <?php 
                                                echo substr($value['category_name'], 0, 12);
                                                if(strlen($value['category_name']) > 12){
                                                    echo '...';
                                                }
                                                ?>
                                                    
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>                                 
                                </select>
                            </div> 
                        </div>
                        <div class="form-check form-check-inline  Pickup-check delivery">
                            <input class="form-check-input filter" type="button" id="filter-clear" value="1" name="filter-clear">
                            <label class="form-check-label" for="filter-clear">Clear All</label>
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
                    <?php //echo "<pre>"; print_r($_SESSION); ?>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active restaurant row mt-4 w-100" id="nearby" role="tabpanel" aria-labelledby="nearby-tab">
                <div class="">
                    Allow Location For Nearby Restaurants 
                </div>
            </div>
            <div class="tab-pane fade restaurant row mt-4 w-100" id="combo" role="tabpanel" aria-labelledby="combo-tab">
                <div class="">
                    Allow Location For Combo Restaurants 
                </div>
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


<?php
$google_key = $this->config->item("google_key");
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_key; ?>&libraries=places&callback=initAutocomplete" async defer></script>
<script type="text/javascript">
var latitude = '<?php echo $_SESSION['lat']; ?>';
var longitude = '<?php echo $_SESSION['long']; ?>';

var get_shop_data_url = "<?php echo base_url().'get-shops-by-filter'; ?>";
var photo_url = '<?php echo base_url() . $this->config->item("profile_path") . '/'; ?>';
var defualt_photo_url = '<?php echo base_url() . 'web-assets/images/logo-3.png'; ?>';

var shop_url = '<?php echo base_url().'restaurant/'; ?>';
var zoom_out_img_url = '<?php echo base_url().'web-assets/images/zoom-in-out.png'; ?>';

var set_order_type_session = "<?php echo base_url().'set-order-type-session'; ?>";

var cuisine_id = '';
var pickup = '';
var popular = '';
var delivery_fee = '';
var minimum_order_amount = '';
var category = '';
var rating = '';

var delivery_restaurants = '';
var pickup_restaurants = '';
$(document).ready(function() {

    $('#wait').show();

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

});
</script>
<script src="<?php echo base_url().'web-assets/js/custom/home.js'; ?>"></script>
<script>

  var placeSearch, autocomplete;

  var componentForm = {

        administrative_area_level_2: 'long_name',
        administrative_area_level_1: 'long_name'
      };



  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
       (document.getElementById('autocomplete')),
        {types: ['(regions)'] });
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    var place = autocomplete.getPlace();

     for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

   if (typeof place.address_components != "undefined" || place.address_components != null){

    $('#latitude').val(place.geometry.location.lat());
    $('#longitude').val(place.geometry.location.lng());

    console.log(place.address_components);

        for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++){
                if (place.address_components[i].types[j] == "postal_code") {
                    $('.zipcode').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "country") {
                    $('.country').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                    $('.state').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_2") {
                    $('.city').val(place.address_components[i].long_name);
                }
            }
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
  }

  function geolocate() {
    $('.loader').show();
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        // console.log(geolocation);
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
     $('.loader').hide();
  }
</script>
