<?php include('header.php'); ?>

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
							<tr>
								<td><img src="<?php echo $assets; ?>images/cart-dish1.png" width="113" height="114" /></td>
								<td>
									<div class="product-name">
										<span>Fresh Mushrooms</span>
										<span>Customize</span>
									</div>
								</td>
								<td>
									<input type="number" value="1" min="1" max="99" step="1"/>
								</td>
								<td class="product-price">$12.99</td>
								<td class="product-cancel">X</td>
							</tr>
							<tr>
								<td><img src="<?php echo $assets; ?>images/cart-dish2.png" width="113" height="114" /></td>
								<td>
									<div class="product-name">
										<span>Tasty Tomatos Cheese Souse</span>
										<span>Customize</span>
									</div>
								</td>
								<td>
									<input type="number" value="1" min="1" max="99" step="1"/>
								</td>
								<td class="product-price">$12.99</td>
								<td class="product-cancel">X</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td class="total-text">Total:</td>
								<td class="total">$25.98</td>
								<td></td>
							</tr>
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