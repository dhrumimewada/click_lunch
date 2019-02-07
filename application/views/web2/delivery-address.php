<?php include('header.php'); ?>

<div id="content">
	<div class="delivery-address-wrapper grey-bg">
		<div class="container">
			<div class="delivery-address-block white-bg">
				<div class="select-delivery-address-wrapper">
					<div class="select-delivery-address-block">
						<div class="row m-0">
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio" value="address1" checked>
										<label class="form-check-label" for="deliveryAddressRadio">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio1" value="address2">
										<label class="form-check-label" for="deliveryAddressRadio1">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio2" value="address2">
										<label class="form-check-label" for="deliveryAddressRadio2">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio3" value="address3">
										<label class="form-check-label" for="deliveryAddressRadio3">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio4" value="address4">
										<label class="form-check-label" for="deliveryAddressRadio4">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio5" value="address5">
										<label class="form-check-label" for="deliveryAddressRadio5">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio6" value="address6">
										<label class="form-check-label" for="deliveryAddressRadio6">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio7" value="address7">
										<label class="form-check-label" for="deliveryAddressRadio7">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio8" value="address8">
										<label class="form-check-label" for="deliveryAddressRadio8">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio9" value="address9">
										<label class="form-check-label" for="deliveryAddressRadio9">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio10" value="address10">
										<label class="form-check-label" for="deliveryAddressRadio10">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio11" value="address11">
										<label class="form-check-label" for="deliveryAddressRadio11">29 Stonybrook Lane<br> Sulphur, LA 70663</label>
									</div>
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

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>