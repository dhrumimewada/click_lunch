<?php include('header.php'); ?>   

<div id="content">
	<div class="place-order-wrapper grey-bg">
		<div class="container">
			<div class="place-order-block white-bg">
				<div class="coupon-delivery">
					<h3 class="text-with-border-right">Coupon & Delivery</h3>
					<div class="row m-0">
						<div class="col-md-6 text-center coupon-and-offers">
							<form class="coupon-form d-flex align-items-center" id="coupon">
								<input type="text" name="coupon-code" class="form-control" id="couponCode" placeholder="Enter a coupon code">
								<input type="submit" name="check-coupon" value="Apply" class="check-coupon-btn red-btn">
							</form>
							<a href="#offer-pop" class="view-offers" data-toggle="modal">View Offers</a>
						</div>
						<div class="col-md-6">
							<div class="delivery-address d-flex justify-content-around">
								<div class="form-check deliver-now">
									<input class="form-check-input" type="radio" name="deliveroption" id="deliverOption1" value="now" checked>
									<label class="form-check-label" for="deliverOption1">Deliver Now</label>
								</div>
								<div class="form-check deliver-later">
									<input class="form-check-input" type="radio" name="deliveroption" id="deliverOption2" value="later">
									<label class="form-check-label" for="deliverOption2">Deliver Later</label>
								</div>
							</div>
							<div class="select-time">
                                <label for="input_starttime">Select Delivery Time</label>
                                <input type="text" name="timepicker" class="time_element" placeholder="00:00" />
								</div>
                                <div class="select-instead">
                                    <div class="md-form text-center">
                                       <a href="<?php echo BASE_URL(); ?>web/home/place_order_takeout">Take out instead</a>
                                    </div>
                                </div>
							</div>
                            
						</div>
					</div>
                        <div class="confirm-order">
                    <h3 class="text-with-border-right">Confirm Your Order</h3>
                    <form name="payment-method" class="payment-method" id="paymentMethod">
                        <div class="row m-0">
                            <div class="col-md-6">
                                <div class="confirm-order-detail">
                                    <div class="header row m-0">
                                        <div class="header-title col-7 col-md-7 p-0">Item</div>
                                        <div class="header-title qty-txt col-2 col-md-2 p-0">Qty</div>
                                        <div class="header-title rate-txt col-3 col-md-3 p-0">Total</div>
                                        
                                    </div>
                                    <div class="confirm-order-detail-box">                                       
                                        <div class="confirm-order-list">
                                            <div class="row m-0">
                                                <div class="order-product-title col-7 col-md-7 p-0">Blue Cheese Dressing</div>
                                                <div class="order-product-qty col-2 text-right col-md-2 p-0">1</div>
                                                <div class="order-product-price col-3 text-right col-md-3 p-0">$ 60.25</div>                                                
                                            </div>
                                            <div class="row m-0">
                                                <div class="order-product-title col-7 col-md-7 p-0">Mint Raita</div>
                                                <div class="order-product-qty col-2 text-right col-md-2 p-0">3</div>
                                                <div class="order-product-price col-3 text-right col-md-3 p-0">$ 10.10</div>                                                
                                            </div>
                                            <div class="row m-0">
                                                <div class="order-product-title col-7 col-md-7 p-0">Ice Cream Cake</div>
                                                <div class="order-product-qty col-2 text-right col-md-2 p-0">1</div>
                                                <div class="order-product-price col-3 text-right col-md-3 p-0">$ 20.25</div>                                                
                                            </div>
                                            <div class="row m-0">
                                                <div class="order-product-title col-7 col-md-7 p-0">Lobster Roll</div>
                                                <div class="order-product-qty col-2 text-right col-md-2 p-0">2</div>
                                                <div class="order-product-price col-3 text-right col-md-3 p-0">$ 10</div>                                                
                                            </div>
                                        </div>
                                       <div class="confirm-order-final-list">
                                    
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Sub Total</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">$ 100.60</div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Delivery Fee</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">$ 5.00</div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">TAX</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+ $ 20</div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Service Charges</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0"><span>$20</span><span>00</span></div>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="total-amount">
                                        <div class="row m-0">
                                            <div class="order-product-total-amount-title col-9 col-md-9 p-0">Total Amount</div>
                                            <div class="order-product-total-amount col-3 col-md-3 p-0">$ 326.8</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="payment-mode">
                                    <h4>Select Mode of Payment</h4>
                                    <div class="payment-mode-detail">
                                        <div class="form-check row m-0 apple-pay p-0">
                                            <div class="col-md-10 p-0"><img src="<?php echo $assets; ?>images/apple-play.png" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="pay" id="applepay" value="applepay">
                                            <label class="form-check-label" for="applepay"></label>
                                        </div>

                                        <div class="form-check row m-0 google-pay p-0">
                                            <div class="col-md-10 p-0"><img src="<?php echo $assets; ?>images/google-play.png" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="pay" id="googlepay" value="googlepay">
                                            <label class="form-check-label" for="googlepay"></label>
                                        </div>
                                        <!-- <div class="debit-card card-payment">
                                            <a class="debit-card-collapse" data-toggle="collapse" href="#debitCard" role="button" aria-expanded="false" aria-controls="debitCard">Debit Card</a>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse" id="debitCard">
                                                        <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer laanderson cred nesciunt sapiente ea proident.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="credit-card card-payment">
                                            <div class="credit-card-collapse">Credit Card / Debit Card</div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse show" id="creditCard">
                                                        <div class="card card-body">
                                                            <div class="row m-0 card-option">
                                                                <div class="card-logo col-md-2"><img src="<?php echo $assets; ?>images/visa-logo.png" /></div>
                                                                <div class="card-detail col-md-8">
                                                                    <div class="card-text">Visa Classic</div>
                                                                    <div class="card-number">XXXX XXXX XXXX 3459</div>
                                                                </div>
                                                                <div class="form-check col-md-2">
                                                                    <input class="form-check-input" type="radio" name="pay" id="visacard" value="visa" checked>
                                                                    <label class="form-check-label" for="visacard"></label>
                                                                </div>
                                                            </div>
                                                            <div class="row m-0 card-option">
                                                                <div class="card-logo col-md-2"><img src="<?php echo $assets; ?>images/master-card.png" /></div>
                                                                <div class="card-detail col-md-8">
                                                                    <div class="card-text">Master Card</div>
                                                                    <div class="card-number">XXXX XXXX XXXX 5489</div>
                                                                </div>
                                                                <div class="form-check col-md-2">
                                                                    <input class="form-check-input" type="radio" name="pay" id="mastercard" value="master">
                                                                    <label class="form-check-label" for="mastercard"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="add-new-card-popup">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addCardModal">Add New Credit Card / Debit Card</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-between">
                            <input type="button" name="backtocart" class="white-btn backtocart-btn" id="backtocart" value="Back to cart" onclick="location.href = 'reset-password.html';">
                            <input type="button" name="placeorder" class="small-red-btn placeorder-btn" id="placeorder" value="Place order" data-toggle="modal" data-target="#orderSuccessful">
                        </div>
                    </form>
                </div>
				</div>
			
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

<!-- Add New Credit Card Modal -->
<div class="modal fade modal-with-logo" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="addCardModalLabelLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content pt-4 pb-4">
			<div class="modal-header justify-content-center position-relative">
				<img src="<?php echo $assets; ?>images/click-lunch-logo-white.png" width="130" />
			</div>
			<div class="modal-body add-card-block">
				<form id="add-card-form" name="add-card">
					<div class="row white-bg modalform ml-0 mr-0">
						<div class="form-group col-md-12">
							<label for="cardHolderName">Card Holder Name</label>
					    	<input type="text" class="form-control" id="cardHolderName" />
						</div>
                        <div class="form-group col-md-12">
                            <label for="nickName">Nick Name</label>
                            <input type="text" class="form-control" id="nickName" />
                        </div>
						<div class="form-group col-md-12">
							<label for="cardNumber">Card Number</label>
					    	<input type="text" class="form-control" id="cardNumber" />
						</div>
						<div class="form-group col-md-6">
							 <label for="expiryDate">Expiry Date</label>
                             <input type="text"  class="form-control" id="expiryDate" placeholder="MM/YY" />
						</div>
						<div class="form-group col-md-6">
							<label for="cvv">CVV</label>
					    	<input type="text" class="form-control" id="cvv" />
						</div>
						<div class="form-group col-md-12">
							<label>Select Card Type</label>
							<div class="select-card row m-0">
								<div class="form-check col-md-4">
									<input class="form-check-input" type="radio" name="card" id="selectCard1" value="visa" checked>
									<label class="form-check-label visa" for="selectCard1"></label>
								</div>
								<div class="form-check col-md-4">
									<input class="form-check-input" type="radio" name="card" id="selectCard2" value="mastercard">
									<label class="form-check-label master-card" for="selectCard2"></label>
								</div>
								<div class="form-check col-md-4">
									<input class="form-check-input" type="radio" name="card" id="selectCard3" value="americanexpress">
									<label class="form-check-label american-express" for="selectCard3"></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 text-center">
							<button type="submit" name="filterbtn" class="filter-btn transparent-btn" id="filterbtn"><img src="<?php echo $assets; ?>images/popup-checked.png"></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Order Successful Modal  -->
<div class="modal fade pop-form" id="orderSuccessful" tabindex="-1" role="dialog" aria-labelledby="orderSuccessful" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pop-img">
        	<img src="<?php echo $assets; ?>images/click-lunch-logo-white.png">
        </div>
       
      </div>
      <div class="modal-body text-center">
     		<div class="successful-img">
     			<img src="<?php echo $assets; ?>images/payment-successful.png">
     		</div>
     		<div class="successful-txt">
     			<h6>your order successfull</h6>
     			<p>estimated delivery time:- 1hours 05 minutes</p>     			
     		</div>
      </div>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="location.href = 'order-detail.html';">
          <span aria-hidden="true" class="close-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></span>
        </button>
    </div>
  </div>
</div>

<!-- view offer -->
<div class="modal fade pop-form" id="offer-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content offer-pop-box">
        <div class="pop-img">
            <img src="<?php echo $assets; ?>images/click-lunch-logo-white.png">
        </div>
      <div class="modal-body no-padding">
            <div class="pop-add-form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pop-form-title"><h4>Offers</h4>
                        </div>
                    </div>                              
                </div>
                <div class="select-promocode">                 
                    <div class="select-promocode-box">
                        <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div> 
                         <div class="offer-list">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label" for="filteritem1">SHOPHOME25</label>                                                             
                                        <span>Use Promocode SHOPHOME25 To Get 25% Cashback* On Total Order Value (Max Cashback Rs.5000).</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 close">
                                    <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close"  value="Apply">  
                                </div>
                            </div>
                        </div>   
                                      
                    </div>
                </div>
                
            </div>
      </div>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="close-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></span>
        </button>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
	// $('#input_starttime').pickatime({});
</script>