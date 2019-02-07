<?php include('header.php'); ?>



<div id="content">
	<div class="delivery-restaurant-wrapper grey-bg">
		<div class="container">
			<div class="delivery-restaurant-day">
                <ul>
                    <li><a class="active" href="#">Today</a></li>
                    <li><a href="#">Monday</a></li>
                    <li><a href="#">Tuesday</a></li>
                    <li><a href="#">Wednesday</a></li>
                    <li><a href="#">Thursday</a></li>
                    <li><a href="#">Friday</a></li>
                    <li><a href="#">Saturday</a></li>
                </ul>
                <div class="day-filter">
                    <a href="#address-pop"  data-toggle="modal" ><img src="<?php echo $assets; ?>images/filter.png"></a>
                </div>
                <div class="modal fade pop-form" id="address-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content thank-u-pop">
                        <div class="pop-img">
                            <img src="<?php echo $assets; ?>images/click-lunch-logo-white.png">
                        </div>
                        <div class="modal-body no-padding">
                        <form>                       
                            <div class="pop-add-form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pop-form-title"><h4>Address</h4>
                                        </div>
                                    </div>
                                    <div class="add-new-address-block">
                                        <div class="row m-0">
                                            
                                        
                                          <div class="form-check form-check-inline ">                            
                                                <input class="form-check-input" type="radio" name="locationRadioOptions" id="locationRadio1" value="currentlocation" checked>
                                                <label class="form-check-label" for="locationRadio1">current location </label>
                                          </div>
                                          
                                          <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="locationRadioOptions" id="locationRadio2" value="preferredlocation">
                                                <label class="form-check-label" for="locationRadio2">preferred location</label>
                                          </div>

                                          <div class="address-edit">
                                              <a href="#"><img src="<?php echo $assets; ?>images/edit.png"></a>
                                          </div>

                                          </div>
                                    </div>                  
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pop-form-title"><h4>Select Delivery Time</h4></div>
                                    </div>
                                    <div class="add-new-address-block deliver-address">
                                        <div class="row m-0">                                   
                                          <div class="form-check form-check-inline">                            
                                                <input type="text" name="timepicker" class="time_element" placeholder="00:00" />                                                
                                          </div>
                                        </div>
                                    </div>                  
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pop-form-title"><h4>cuisines</h4>
                                        </div>                  
                                        <div class="filter-items dishe-list">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem1" checked>
                                                    <label class="form-check-label" for="filteritem1">American Dishes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem2" checked>
                                                    <label class="form-check-label" for="filteritem2">Pizza</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem3">
                                                    <label class="form-check-label" for="filteritem3">Mexican</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem4">
                                                    <label class="form-check-label" for="filteritem4">Chinese</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem5" checked>
                                                    <label class="form-check-label" for="filteritem5">American Dishes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="filteritem6" checked>
                                                    <label class="form-check-label" for="filteritem6">Pizza</label>
                                                </div>
                                            </div>
                                    </div>          
                                </div>
                            </div>
                        </form>
                        </div>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="close-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></span>
                        </button>
                    </div>
                  </div>
                </div>
            </div>
            
			<div class="restaurant row mt-4">
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                            <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&amp;crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&amp;crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                           <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/555a01584ae7cee5d6c3288c1ec67ba8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/782292fdf7327e4d450d79b2c2db4301.jpg?fit=around%7C640%3A640&amp;crop=640%3A640%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/a64a1a5a18a4ddcd36ba65d8ce64ed4c.jpg?fit=around%7C800%3A442&amp;crop=800%3A442%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 px-2">
                        <div class="card">
                            <div class="restaurant-img position-relative">
                                <img class="card-img-top" src="https://b.zmtcdn.com/data/pictures/7/18882467/32ab199fc3cf963b6177515306462ec8.jpg?fit=around%7C800%3A533&amp;crop=800%3A533%3B%2A%2C%2A" alt="Card image cap">
                                <div class="rating txt1">Ratings</div>
                                <div class="rating txt2 txt-red">4.2</div>
                            </div>
                             <div class="card-body restaurant-body">
                                <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail">
                                    <div class="card-title txt-red font-md text-center">Chili's Grill &amp; Bar</div>
                                    <b>
                                        <div class="d-inline-block txt-black font-small">Delivery 11:40 PM</div>
                                        <div class="d-inline-block txt-black float-right font-small">Order by 11:40 PM</div>
                                    </b>
                                    <div class="position-relative txt-black font-14 pl-4 cusion">
                                        Burger, Maxican
                                    </div>
                                    <div class="card-text txt-black font-11">11:00am to 15:00pm / 18:30am to 22:30am</div>
                                    <div class="text-right txt-black mt-1"><b>0.71mi</b></div>
                                </a>
                            </div>
                             <div class="restaurant-hover">
                                <div class="restaurant-hover-list">
                                    <div class="restaurant-hover-img like">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/favourite-deselect.png"></a>
                                    </div>
                                     <div class="restaurant-hover-img">
                                        <a href="<?php echo BASE_URL(); ?>web/home/restaurant_detail"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="restaurant-list">
                <ul>
                    <li><a href="#"></a></li>
                    <li><a class="active" href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
		</div>
	</div>
	<div class="container">
		<div class="d-flex justify-content-center">
			<div class="mail-subscription-block">
				<div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></div>
				<form class="mail-subscription d-flex align-items-center" id="mailSubscription">
					<input type="email" name="email" class="form-control" id="mailSubscriptionId" placeholder="Enter your e-mail address here" />
					<input type="submit" name="subscribe" value="Subscribe" class="subscribe-btn red-btn" />
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
	// $('#input_starttime').pickatime({});
</script>