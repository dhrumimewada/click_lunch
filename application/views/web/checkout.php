<?php
$cart_link = base_url().'cart';
$image_base_url = base_url().'web-assets/images/';
?>

<!-- view offer -->
<div class="modal fade pop-form" id="offer-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content offer-pop-box">
        <div class="pop-img">
            <img src="<?php echo $image_base_url; ?>click-lunch-logo-white.png">
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
                        <?php
                        if(isset($promocodes) && is_array($promocodes) && !empty($promocodes)){
                            foreach ($promocodes as $key => $value) {
                                ?>
                                <div class="offer-list">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <label class="form-check-label" for="filteritem1">
                                                    <?php echo $value['promocode']; ?>
                                                </label>                                                             
                                                <span><?php echo $value['description']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 close">
                                            <input type="button" class="close offer-btn  float-right" data-dismiss="modal" aria-label="Close" value="Apply">  
                                        </div>
                                    </div>
                                </div> 
                        <?php
                            }
                        }else{
                        ?>
                        <div class="row">
                            <div class="col-12 text-center">
                                No offers available
                            </div>
                        </div>
                        <?php   
                        }
                        ?>
                        
                                      
                    </div>
                </div>
                
            </div>
      </div>
    </div>
  </div>
</div>

<div id="content">
	<div class="place-order-wrapper grey-bg">
		<div class="container">
			<div class="place-order-block white-bg">
				<div class="coupon-delivery">
					<h3 class="text-with-border-right">Coupon & Delivery</h3>
					<div class="row m-0">
						<div class="col-md-6 text-center coupon-and-offers">
							<form class="coupon-form d-flex align-items-center" id="coupon">
								<input type="text" name="coupon-code" class="form-control" id="couponCode" placeholder="Enter a coupon code" value="TASTY50">
                                <input type="submit" name="check-coupon" value="Apply" class="check-coupon-btn red-btn">
								<!-- <input type="submit" name="check-coupon" value="Remove" class="check-coupon-btn red-btn"> -->
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
                                       <a href="place-order-takeout.html">Take out instead</a>
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
                                            <?php
                                            $subtotal = 0;
                                            foreach ($cart_contents as $key => $value) {
                                                $subtotal += $value['subtotal'];
                                            ?>
                                            <div class="row m-0">
                                                <div class="order-product-title col-7 col-md-7 p-0">
                                                    <?php
                                                    echo $value['name'];
                                                    ?>
                                                </div>
                                                <div class="order-product-qty col-2 text-right col-md-2 p-0">
                                                    <?php
                                                    echo $value['qty'];
                                                    ?>
                                                </div>
                                                <div class="order-product-price col-3 text-right col-md-3 p-0">
                                                    <?php
                                                    echo '&#36; '.number_format((float)$value['price'], 2, '.', '');
                                                    ?>
                                                </div>                                                
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                       <div class="confirm-order-final-list">
                                    
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Sub Total</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">
                                                <?php
                                                echo '&#36; '.number_format((float)$subtotal, 2, '.', '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Promo Discount</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">-
                                                <?php
                                                echo '&#36; '.number_format((float)$subtotal, 2, '.', '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Delivery Fee</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+
                                                <?php
                                                $delivery_amount = ($subtotal * $delivery_fee) / 100;
                                                echo '&#36; '.number_format((float)$delivery_amount, 2, '.', '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">TAX</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+ 
                                                <?php
                                                $tax_amount = ($subtotal * $tax) / 100;
                                                echo '&#36; '.number_format((float)$tax_amount, 2, '.', '');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Service Charges</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+
                                                <?php
                                                $service_charge_amount = ($subtotal * $service_charge) / 100;
                                                echo '&#36; '.number_format((float)$service_charge_amount, 2, '.', '');
                                                ?>
                                            </div>
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
                                            <div class="col-md-10 p-0"><img src="<?php echo base_url().'web-assets/images/apple-play.png'; ?>" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="pay" id="applepay" value="applepay">
                                            <label class="form-check-label" for="applepay"></label>
                                        </div>

                                        <div class="form-check row m-0 google-pay p-0">
                                            <div class="col-md-10 p-0"><img src="<?php echo base_url().'web-assets/images/google-play.png'; ?>" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="pay" id="googlepay" value="googlepay">
                                            <label class="form-check-label" for="googlepay"></label>
                                        </div>

                                        <div class="credit-card card-payment">
                                            <div class="credit-card-collapse">Credit Card / Debit Card</div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse show" id="creditCard">
                                                        <div class="card card-body">
                                                            <div class="row m-0 card-option">
                                                                <div class="card-logo col-md-2"><img src="images/visa-logo.png" /></div>
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
                                                                <div class="card-logo col-md-2"><img src="images/master-card.png" /></div>
                                                                <div class="card-detail col-md-8">
                                                                    <div class="card-text">Master Card</div>
                                                                    <div class="card-number">XXXX XXXX XXXX 5489</div>
                                                                </div>
                                                                <div class="form-check col-md-2">
                                                                    <input class="form-check-input" type="radio" name="pay" id="mastercard" value="master">
                                                                    <label class="form-check-label" for="mastercard"></label>
                                                                </div>
                                                            </div>
                                                            <div class="row m-0 card-option">
                                                                <div class="card-logo col-md-2"><img src="images/master-card.png" /></div>
                                                                <div class="card-detail col-md-8">
                                                                    <div class="card-text">Master Card</div>
                                                                    <div class="card-number">XXXX XXXX XXXX 5489</div>
                                                                </div>
                                                                <div class="form-check col-md-2">
                                                                    <input class="form-check-input" type="radio" name="pay" id="mastercard" value="master">
                                                                    <label class="form-check-label" for="mastercard"></label>
                                                                </div>
                                                            </div>
                                                            <div class="row m-0 card-option">
                                                                <div class="card-logo col-md-2"><img src="images/master-card.png" /></div>
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
                            <a href="<?php echo $cart_link; ?>"name="backtocart" class="white-btn backtocart-btn" id="backtocart">Back to cart</a>
                            <input type="button" name="placeorder" class="small-red-btn placeorder-btn" id="placeorder" value="Place order" data-toggle="modal" data-target="#orderSuccessful">
                        </div>
                    </form>
                </div>
				</div>
			
			</div>
		</div>
	</div>
</div>