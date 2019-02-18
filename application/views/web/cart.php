<?php
$prof_url = base_url() . 'assets/images/default/cuisine.jpg';
?>
<div id="content">
	<div class="checkout-wrapper grey-bg">
		<div class="container">
			<div class="checkout-block white-bg">
				<form >
				<div class="product-list table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($cart_contents) && is_array($cart_contents) && !empty($cart_contents)){
								foreach ($cart_contents as $key => $value){

									if (isset($value['picture']) && ($value['picture'] != '')){
										if (file_exists($this->config->item("item_photo_path") . '/'.$value['picture'])){
											$prof_url = base_url() . $this->config->item("item_photo_path") . '/'.$value['picture'];
										}
										
									}
							?>


							<tr>
								<td><img src="<?php echo $prof_url; ?>" width="113" height="114" /></td>
								<td>
									<div class="product-name">
										<span><?php echo $value['name']; ?></span>
										<?php if(isset($value['group_data']) && is_array($value['group_data']) && !empty($value['group_data'])){ ?>
										<span>Customize</span>
										<?php
										} else{
										?>
										<span></span>
										<?php } ?>
									</div>
								</td>
								<td>
									<input type="number" value="<?php echo $value['qty']; ?>" min="1" max="99" step="1"/>
								</td>
								<td class="product-price">&#36;<?php echo $value['price']; ?></td>
								<td class="product-cancel"><i class="mdi mdi-close mdi-24px pointer"></i></td>
							</tr>

							<?php

								}
							}else{
							?>
							<tr>
								<td colspan="5" class="text-center p-3">Your cart is empty!</td>
							</tr>
							<?php
							}
							if(isset($cart_total) && ($cart_total != '') && !empty($cart_total)){
							?>

							<tr>
								<td></td>
								<td></td>
								<td class="total-text">Total:</td>
								<td class="total">&#36;<?php echo $cart_total; ?></td>
								<td></td>
							</tr>

							<?php
							}
							?>
							
						</tbody>
					</table>
				</div>
				<div class="additional-recommendation-wrapper text-center">
					<h3 class="text-with-border-right">Additional Recommendation</h3>
					<div class="additional-recommendation-list text-left">
						<div class="row m-0">
							<div class="col-md-4">
								<div class="additional-recommendation">
									<div class="additional-rec-image"><img src="<?php echo $assets; ?>images/dishwide1.png" width="343" height="136" /></div>
									<div class="additional-rec-detail">
										<div class="rec-product-name">Home Fries</div>
										<div class="rec-product-desc d-flex justify-content-between">
											<div class="rec-product-price">$ 50.00</div>
											<div class="rec-product-quantity"><input type="number" value="1" min="1" max="99" step="1"/></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="additional-recommendation">
									<div class="additional-rec-image"><img src="<?php echo $assets; ?>images/dishwide2.png" width="343" height="136" /></div>
									<div class="additional-rec-detail">
										<div class="rec-product-name">Mashed Potato</div>
										<div class="rec-product-desc d-flex justify-content-between">
											<div class="rec-product-price">$ 50.00</div>
											<div class="rec-product-quantity"><input type="number" value="1" min="1" max="99" step="1"/></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="additional-recommendation">
									<div class="additional-rec-image"><img src="<?php echo $assets; ?>images/dishwide1.png" width="343" height="136" /></div>
									<div class="additional-rec-detail">
										<div class="rec-product-name">Home Fries</div>
										<div class="rec-product-desc d-flex justify-content-between">
											<div class="rec-product-price">$ 50.00</div>
											<div class="rec-product-quantity"><input type="number" value="1" min="1" max="99" step="1"/></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="select-delivery-address-wrapper text-center">
					<h3 class="text-with-border-right">Select Delivery Address</h3>
					<div class="select-delivery-address-block text-left">
						<div class="row m-0">
							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#addNewAddressModal" class="delivery-address text-center d-flex justify-content-center align-items-center">
									<div class="new-address">
										<img src="<?php echo $assets; ?>images/add.png" class="d-block mx-auto mb-1" />
										<span>Add New Address</span>
									</div>
								</a>
							</div>
							<div class="col-md-4">
								<a href="<?php echo BASE_URL(); ?>web/home/delivery_address" class="delivery-address text-center d-flex justify-content-center align-items-center">
									<span>Choose from one of our<br> existing delivery location</span>
								</a>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio" value="address1" checked>
										<label class="form-check-label" for="deliveryAddressRadio">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions d-flex justify-content-between">
					<input type="button" name="continue-shopping" class="white-btn continue-shopping-btn" id="continue-shopping-btn" value="Continue Shopping" onclick="location.href = 'takeout-restaurant.html';">
					<input type="button" name="checkout" class="small-red-btn checkout-btn" id="checkout-btn" value="Checkout" onclick="location.href = 'place-order.html';">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Add New Address Modal -->
<div class="modal fade modal-with-logo" id="addNewAddressModal" tabindex="-1" role="dialog" aria-labelledby="addNewAddressModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content pt-4 pb-4">
			<div class="modal-header justify-content-center position-relative">
				<img src="<?php echo $assets; ?>images/click-lunch-logo-white.png" width="130" />
			</div>
			<div class="modal-body">
				<form class="add-new-address-block" id="addNewAddress">
					<div class="row white-bg modalform">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="housernum" placeholder="House/Office Number">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" class="form-control" id="street" placeholder="Street/Locality">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="city" placeholder="City">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="zipcode" placeholder="Zip Code">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="deliveryInstruction" placeholder="Any delivery instructions">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nickname" placeholder="Nickname">
							</div>
						</div>
						<div class="col-md-12">
							<label>Address Type</label>
							<div class="row m-0 d-flex">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="addresstype" id="addressType1" value="office" checked>
									<label class="form-check-label" for="addressType1">Office</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="addresstype" id="addressType2" value="home">
									<label class="form-check-label" for="addressType2">Home</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="addresstype" id="addressType3" value="other">
									<label class="form-check-label" for="addressType3">Other</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12 p-0 text-center">
							<button type="submit" name="new-add-btn" class="new-add-btn transparent-btn" id="new-add-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>