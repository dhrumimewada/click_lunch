<?php include('header.php'); ?>



<div id="content">
	<div class="add-card-wrapper grey-bg">
		<div class="container">
			<div class="add-card-block white-bg">
				<div class="row m-0">
					<div class="col-md-6">
						<div class="card-list">
							<div class="card-block">
								<div class="card-details row m-0">
									<div class="col-md-12 col-lg-1"></div>
									<div class="col-md-12 col-lg-3">
										<img src="<?php echo $assets; ?>images/visa-logo.png" />
										<div class="card-expiry-date">Ex - 22/18</div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="card-number">XXXX XXXX XXXX 3459</div>
									</div>
								</div>
								<div class="card-buttons d-flex justify-content-center">
									<input type="button" name="cardedit" id="cardedit" value="edit" />
									<input type="button" name="carddelete" id="carddelete" value="delete" />
								</div>
							</div>
							<div class="card-block">
								<div class="card-details row m-0">
									<div class="col-md-12 col-lg-1"></div>
									<div class="col-md-12 col-lg-3">
										<img src="<?php echo $assets; ?>images/master-card.png" />
										<div class="card-expiry-date">Ex - 22/18</div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="card-number">XXXX XXXX XXXX 3459</div>
									</div>
								</div>
								<div class="card-buttons d-flex justify-content-center">
									<input type="button" name="cardedit" id="cardedit" value="edit" />
									<input type="button" name="carddelete" id="carddelete" value="delete" />
								</div>
							</div>
							<div class="card-block">
								<div class="card-details row m-0">
									<div class="col-md-12 col-lg-1"></div>
									<div class="col-md-12 col-lg-3">
										<img src="<?php echo $assets; ?>images/american-express.png" />
										<div class="card-expiry-date">Ex - 22/18</div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="card-number">XXXX XXXX XXXX 3459</div>
									</div>
								</div>
								<div class="card-buttons d-flex justify-content-center">
									<input type="button" name="cardedit" id="cardedit" value="edit" />
									<input type="button" name="carddelete" id="carddelete" value="delete" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<form id="add-card-form" name="add-card">
							<div class="row m-0">
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
								<!-- <div class="form-group col-md-6">
									<label for="expiryDate">Expiry Date</label>
							    	<input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" />
								</div> -->
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
							<div class="add-card-button form-actions d-flex justify-content-center">
								<input type="button" name="add-card-btn" class="add-card-btn small-red-btn" id="addCardBtn" value="Save" />
							</div>
						</form>
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
	// $('#input_starttime').pickatime({});
</script>