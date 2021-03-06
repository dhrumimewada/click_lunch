<?php
$cart_link = base_url().'cart';
$image_base_url = base_url().'web-assets/images/';
$img_path = base_url().'web-assets/images/card-icons/';
?>
<style type="text/css" media="screen">
    .place-order-block #weekly .select-time{
        margin-top: 0;
    }
</style>
<!-- Order Successful Modal  -->
<div class="modal fade pop-form" id="orderSuccessful" tabindex="-1" role="dialog" aria-labelledby="orderSuccessful" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pop-img">
            <img src="<?php echo $image_base_url; ?>click-lunch-logo-white.png">
        </div>
       
      </div>
      <div class="modal-body text-center">
            <div class="successful-img">
                <img src="<?php echo $image_base_url; ?>payment-successful.png">
            </div>
            <div class="successful-txt">
                <h6>Order successfully placed</h6>
                <p>Estimated delivery time:- 1hours 05 minutes</p>              
            </div>
      </div>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="close-btn"><img src="<?php echo $image_base_url; ?>popup-checked.png"></span>
        </button>
    </div>
  </div>
</div>

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
                        <div class="pop-form-title">
                            <h4>Offers</h4>
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
					<h3 class="text-with-border-right">Coupon & Delivery </h3>
					<div class="row m-0">
						<div class="col-md-6 text-center coupon-and-offers">
							<form class="coupon-form d-flex align-items-center">
                                <input type="text" name="coupon-code" class="form-control text-uppercase applied-promo" id="couponCode" placeholder="Enter a promocode" autocomplete="off" >
                                <input type="button" name="apply" value="Apply" id="apply-promo" class="check-coupon-btn red-btn" data-name="apply">
							</form>
                            <a href="#offer-pop" class="view-offers" data-toggle="modal">View Offers</a>
						</div>

                        <?php
                        $order_type_data = array_column($cart_contents, 'order_type');
                        $order_type = $order_type_data[0];
                        if (strpos($order_type, 'weekly') !== false){
                            $weekly_array = explode("_",$order_type);
                            $order_type = $weekly_array[0];
                            $order_weekly = 1;
                            $order_weekly_day = $weekly_array[2];
                        }else{
                            $order_weekly = 0;
                            $order_weekly_day = '';
                        }
                        
                        if($order_type == 'delivery' && $order_weekly == 0){
                        ?>
                        <div class="col-md-6" id="deliver">
                            <div class="delivery-address d-flex justify-content-around">
                                <div class="form-check deliver-now">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption1" value="1" checked>
                                    <label class="form-check-label" for="deliverOption1">Deliver Now</label>
                                </div>
                                <div class="form-check deliver-later">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption2" value="2">
                                    <label class="form-check-label" for="deliverOption2">Deliver Later</label>
                                </div>
                            </div>
                            <div class="select-time">
                                <label for="input_starttime">Select Delivery Time</label>
                                <input type="text" name="timepicker" id="deliver_time" class="time_element" placeholder="00:00" />
                            </div>
                        </div>
                        <?php
                        }else if($order_type == 'takeout' && $order_weekly == 0){
                        ?>
                        <div class="col-md-6" id="takeout">
                            <div class="delivery-address d-flex justify-content-around">
                                <div class="form-check deliver-now">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption3" value="3" checked>
                                    <label class="form-check-label" for="deliverOption3">Takeout</label>
                                </div>
                                <div class="form-check deliver-later">
                                    <input class="form-check-input" type="radio" name="deliveroption" id="deliverOption4" value="4">
                                    <label class="form-check-label" for="deliverOption4">Takeout Later</label>
                                </div>
                            </div>
                            <div class="select-time">   
                                <label for="input_starttime">Select Pickup Time</label>                        
                                <input type="text" name="timepicker" id="takeout_time" class="time_element" placeholder="00:00" />
                            </div>
                        </div>
                        <?php
                        }else if($order_weekly == 1){
                        ?>
                        <div class="col-md-6" id="weekly">
                            <div class="select-time">
                                <?php
                                if(ucfirst($order_weekly_day) == date('l')){
                                    $day = 'Today';
                                }else{
                                    $day = ucfirst($order_weekly_day);
                                }
                                ?>
                                <label for="input_starttime">Select <?php echo $order_type; ?> Time For <?php echo $day; ?></label>                        
                                <input type="text" name="timepicker" id="weekly_time" class="time_element" placeholder="00:00" />
                            </div>
                        </div>
                        <?php
                        }
                        ?>
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
                                                    echo '&#36; '.number_format((float)$value['subtotal'], 2, '.', '');
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
                                                $promo_amount = 0;
                                                echo '&#36; <span id="promo_amount">'.number_format((float)$promo_amount, 2, '.', '').'</span>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0" id="delivery-amount-div">
                                            <div class="order-product-title col-9 col-md-9 p-0">Delivery Fee</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+
                                                <?php
                                                //$delivery_amount = ($subtotal * $delivery_fee) / 100;
                                                $delivery_amount = $delivery_fee;
                                                echo '&#36; <span id="delivery_amount">'.number_format((float)$delivery_amount, 2, '.', '').'</span>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">TAX</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+ 
                                                <?php
                                                $tax_amount = ($subtotal * $tax) / 100;
                                                echo '&#36; <span id="tax_amount">'.number_format((float)$tax_amount, 2, '.', '').'</span>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row m-0">
                                            <div class="order-product-title col-9 col-md-9 p-0">Service Charges</div>
                                            <div class="order-product-price col-3 text-right col-md-3 p-0">+
                                                <?php
                                                $service_charge_amount = ($subtotal * $service_charge) / 100;
                                                echo '&#36; <span id="service_charge_amount">'.number_format((float)$service_charge_amount, 2, '.', '').'</span>';
                                                ?>
                                            </div>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="total-amount">
                                        <div class="row m-0">
                                            <div class="order-product-total-amount-title col-9 col-md-9 p-0">Total Amount</div>
                                            <div class="order-product-total-amount col-3 col-md-3 p-0">
                                                <?php
                                                $total = ($subtotal) + $delivery_amount + $tax_amount + $service_charge_amount;
                                                echo '&#36; <span id="total">'.number_format((float)$total, 2, '.', '').'</span>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="payment-mode">
                                    <h4>Select Mode of Payment</h4>
                                    <div class="payment-mode-detail">
                                        <?php
                                        if(isset($payment_apple_pay) && $payment_apple_pay == true){
                                        ?>
                                        <div class="form-check row m-0 apple-pay p-0">
                                            <div class="col-md-10 p-0"><img src="<?php echo base_url().'web-assets/images/apple-play.png'; ?>" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="payment_card" id="applepay" value="applepay" checked data-payment-type="1">
                                            <label class="form-check-label" for="applepay"></label>
                                        </div>
                                        <?php
                                        }
                                        if(isset($payment_google_pay) && $payment_google_pay == true){
                                        ?>

                                        <div class="form-check row m-0 google-pay p-0">
                                            <div class="col-md-10 p-0"><img src="<?php echo base_url().'web-assets/images/google-play.png'; ?>" /></div>
                                            <input class="form-check-input col-md-2 p-0" type="radio" name="payment_card" id="googlepay" value="googlepay" checked data-payment-type="2">
                                            <label class="form-check-label" for="googlepay"></label>
                                        </div>

                                        <?php
                                        }
                                        if(isset($payment_card) && $payment_card == true){
                                        ?>
                                        <div class="credit-card card-payment">
                                            <div class="credit-card-collapse">Credit Card / Debit Card</div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse show" id="creditCard">
                                                        <div class="card card-body">
                                                            <?php
                                                            if(isset($cards) && is_array($cards) && !empty($cards)){
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
                                                                        <input class="form-check-input" type="radio" name="payment_card" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>"  <?php echo $checked; ?> data-payment-type="0">
                                                                        <label class="form-check-label" for="<?php echo $value['id']; ?>"></label>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
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
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-between">
                            <a href="<?php echo $cart_link; ?>"name="backtocart" class="white-btn backtocart-btn" id="backtocart">Back to cart</a>
                            <input type="button" name="placeorder" class="small-red-btn placeorder-btn pointer" id="placeorder" value="Place order">
                        </div>
                        <?php // echo "<pre>"; print_r($_SESSION); ?>
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
    var tax = "<?php echo $tax; ?>";
    var service_charge = "<?php echo $service_charge; ?>";

    var delivery_amount = "<?php echo $delivery_amount; ?>";

    var validate_promocode_url = "<?php echo base_url().'validate-promocode'; ?>";
    var place_order_url = "<?php echo base_url().'place-order'; ?>";
    var order_success_url = "<?php echo base_url().'order-success'; ?>";

    var takeout_delivery_status = "<?php echo $takeout_delivery_status; ?>";
    var weekly_status = "<?php echo $order_weekly; ?>";
    var weekly_day = "<?php echo $order_weekly_day; ?>";
    var weekly_order_type = '<?php if($order_weekly == 1){ echo ($order_type == 'takout')?"6":"5"; } ?>';
</script> 
