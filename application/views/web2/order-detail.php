<?php include('header.php'); ?>

<div id="content">
	<div class="place-order-wrapper grey-bg">
		<div class="container">
			<div class="order-detail">
				<div class="order-top-title">
					<div class="row top-heading">
						<div class="col-sm-6">
							<div class="order-top-left">
								<strong>ORDER CRN</strong>
								<p>123456</p>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="order-top-right">
								<strong>ORDER DATE</strong>
								<p>25 Nov, 2018 at 8.30 PM</p>
							</div>
						</div>
					</div>	
					<div class="order-detail-list">
						<div class="row">
							<div class="col-md-7 order-list-right">
								<div class="restarant-detail">
									<div class="restarant-img">
										 <img src="<?php echo $assets; ?>images/click-lunch.png" width="120">									 									 
									</div>
									<div class="restarant-img-star">
										<img src="<?php echo $assets; ?>images/selected-star.png">
										<img src="<?php echo $assets; ?>images/selected-star.png">
										<img src="<?php echo $assets; ?>images/selected-star.png">
										<img src="<?php echo $assets; ?>images/grey-star.png">
										<img src="<?php echo $assets; ?>images/grey-star.png">
									</div>
									<div class="restarant-name"> 
									 	<h6>Conrad chicago Restarant</h6>
									</div>
								</div>
								<div class="order-item">
									<table>
										<tbody class="table-list">
											<tr>
												<th>JR. Chiken Burger</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>Goat Cheese chorizo roll21</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>JR. Chiken Burger</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>Goat Cheese chorizo roll21</th>
												<td>$56.00</td>
											</tr>
										</tbody>
									</table>
									<table>
										<tbody class="list-tax">
											<tr>
												<th>service fee</th>
												<td>$5.00</td>
											</tr>
											<tr>
												<th>Tax</th>
												<td>$10.00</td>
											</tr>
											<tr>
												<th>Discount</th>
												<td>$5.00</td>
											</tr>
											<tr>
												<th class="list-total">total</th>
												<td class="list-total">$234.00</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="delivery-address">
									<strong>delivery address</strong>
									<p>N. Michigan ave Chicago, IL 60602</p>
								</div>		
							</div>	
							<div class="col-md-5 d-flex justify-content-center align-items-center">
								<div class="capcha-img">
									<img src="<?php echo $assets; ?>images/qr-code-wikimedia-commons.png">
								</div>
							</div>					
						</div>
					</div>											
				</div>	
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo BASE_URL(); ?>web/home" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
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
							<button type="submit" name="new-add-btn" class="new-add-btn transparent-btn" id="new-add-btn"><img src="<?php echo $assets; ?>images/add.png"></button>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
