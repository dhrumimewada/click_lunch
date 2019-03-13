<?php
$cart_link = base_url().'cart';
$image_base_url = base_url().'web-assets/images/';
$img_path = base_url().'web-assets/images/card-icons/';
?>

<!-- Add New Credit Card Modal -->
<div class="modal fade modal-with-logo" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="addCardModalLabelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center position-relative">
                <img src="<?php echo $image_base_url; ?>click-lunch-logo-white.png" width="130" />
            </div>
            <div class="modal-body add-card-block">
                <form id="add-card-form" name="add-card" method="post">
                    <div class="row white-bg modalform ml-0 mr-0">
                        <div class="form-group col-md-12">
                            <label for="card_holder_name" class="required">Card Holder Name</label>
                            <input type="text" class="form-control" id="card_holder_name" name="card_holder_name" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nickname">Nick Name</label>
                            <input type="text" class="form-control" id="nickname" name="nickname"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="card_number" class="required">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="expiry_date" class="required">Expiry Date</label>
                            <input type="text" class="form-control" id="expiry_date" placeholder="MM/YYYY" name="expiry_date" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cvv" class="required">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="required">Select Card Type</label>
                            <div class="select-card row m-0 mt-2 mb-2">
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard1" value="1" checked>
                                    <label class="form-check-label visa" for="selectCard1"></label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard2" value="2">
                                    <label class="form-check-label master-card" for="selectCard2"></label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard3" value="3">
                                    <label class="form-check-label american-express" for="selectCard3"></label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard4" value="4">
                                    <label class="form-check-label diners" for="selectCard4"></label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard5" value="5">
                                    <label class="form-check-label discover" for="selectCard5"></label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="card" id="selectCard6" value="6">
                                    <label class="form-check-label jcb" for="selectCard6"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 p-0 text-center">
                            <button type="submit" name="filterbtn" class="filter-btn transparent-btn" id="filterbtn"><img src="<?php echo $image_base_url; ?>/popup-checked.png"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                                            <input type="button" class="close offer-btn float-right apply-promo" data-dismiss="modal" aria-label="Close" value="Apply" data-id="<?php echo encrypt($value['id']); ?>" data-name="<?php echo $value['promocode']; ?>">  
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
							<form class="coupon-form d-flex align-items-center">
                                <input type="text" name="coupon-code" class="form-control applied-promo" id="couponCode" placeholder="Enter a promocode" value="">
                                <input type="button" name="apply" value="Apply" id="apply-promo" class="check-coupon-btn red-btn" data-name="apply">
							</form>
                            <a href="#offer-pop" class="view-offers" data-toggle="modal">View Offers</a>
						</div>
						<div class="col-md-6" id="deliver">
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
                                   <a href="javascript:void(0)" id="takeout-instead">Take out instead</a>
                                </div>
                            </div>
						</div>
                        <div class="col-md-6" id="takeout" style="display: none;">
                            <div class="delivery-address d-flex justify-content-around">
                                <div class="form-check deliver-now">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption3" value="now">
                                    <label class="form-check-label" for="deliverOption3">Takeout</label>
                                </div>
                                <div class="form-check deliver-later">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption4" value="later">
                                    <label class="form-check-label" for="deliverOption4">Takeout Later</label>
                                </div>
                            </div>
                            <div class="select-time">   
                                <label for="input_starttime">Select Pickup Time</label>                        
                                <input type="text" name="timepicker" class="time_element" placeholder="00:00" />
                            </div>
                            <div class="select-instead">
                                <div class="md-form text-center">
                                   <a href="javascript:void(0)" id="deliver-instead">Deliver Instead</a>
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
                                        <div class="row m-0" style="display: none;" id="promocode-div">
                                            <div class="order-product-title col-9 col-md-9 p-0">Promo Discount</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0 text-success">-
                                                <?php
                                                $promo = 22;
                                                echo '&#36; '.number_format((float)$promo, 2, '.', '');
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
                                            <?php
                                            if(isset($cards) && is_array($cards) && !empty($cards)){
                                            ?>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse show" id="creditCard">
                                                        <div class="card card-body">
                                                            <?php
                                                            foreach ($cards as $key => $value) {
                                                                if($key == 0){
                                                                    $checked = 'checked';
                                                                }else{
                                                                    $checked =  '';
                                                                }
                                                            ?>
                                                            <div class="row m-0 card-option">
                                                                <?php
                                                                if($value['card_type'] == 1){
                                                                    $img_name = 'visa-logo.png';
                                                                }else if($value['card_type'] == 2){
                                                                    $img_name = 'master-card.png';
                                                                }else if($value['card_type'] == 3){
                                                                    $img_name = 'american-express.png';
                                                                }else if($value['card_type'] == 4){
                                                                    $img_name = 'diners.png';
                                                                }else if($value['card_type'] == 5){
                                                                    $img_name = 'discover.png';
                                                                }else if($value['card_type'] == 6){
                                                                    $img_name = 'jcb.png';
                                                                }else{
                                                                    $img_name = '';
                                                                }
                                                                ?>

                                                                <div class="card-logo col-md-2"><img src="<?php echo $img_path.$img_name; ?>" style="object-fit: scale-down;" class="w-100"/></div>
                                                                <div class="card-detail col-md-8">
                                                                    <?php
                                                                    $card_types = array('1' => 'Visa Classic', '2' => 'MasterCard', '3' => 'American Express', '4' => 'Diners Club', '5' => 'Discover', '6' => 'JCB');
                                                                    $my_card_type = $card_types[$value['card_type']];
                                                                    ?>
                                                                    <div class="card-text">
                                                                        <?php echo $my_card_type; ?>
                                                                    </div>
                                                                    <div class="card-number">
                                                                        <?php echo $value['display_number']; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check col-md-2">
                                                                    <input class="form-check-input" type="radio" name="payment_card" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>"  <?php echo $checked; ?> >
                                                                    <label class="form-check-label" for="<?php echo $value['id']; ?>"></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
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
                            <input type="button" name="placeorder" class="small-red-btn placeorder-btn pointer" id="placeorder" value="Place order" data-toggle="modal" data-target="#orderSuccessful">
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script src="<?php echo $assets.'/js/custom/checkout.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
    var add_card_url = "<?php echo base_url().'add-card'; ?>";
    var image_path = "<?php echo $img_path; ?>";

    var get_promocode_data_url = "<?php echo base_url().'get-promocode-data'; ?>";
    var subtotal = "<?php echo $subtotal; ?>";
</script>