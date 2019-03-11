<?php
$img_path = base_url().'web-assets/images/card-icons/';
$home_link = base_url().'welcome';
?>
<div id="content">
	<div class="add-card-wrapper grey-bg">
		<div class="container">
			<div class="add-card-block white-bg">
				<div class="row m-0">
					<div class="col-md-6">
						<div class="card-list h-100">
							<div class="card-block">
								<?php
								if(isset($payment_cards) && is_array($payment_cards) && !empty($payment_cards)){
									foreach ($payment_cards as $key => $value) {
								?>

								<div class="card-details row m-0">
									<div class="col-md-12 col-lg-1"></div>
									<div class="col-md-12 col-lg-3 text-center p-0">
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
										<img src="<?php echo $img_path.$img_name; ?>" />
										<div class="card-expiry-date">Ex - 
											<?php echo decrypt($value['expiry_date']); ?>
										</div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="card-number">
											<?php echo $value['display_number']; ?>
										</div>
									</div>
								</div>
								<div class="card-buttons d-flex justify-content-center">
									<input type="button" name="cardedit" class="cardedit" value="edit" data-id="<?php echo $value['id']; ?>"/>
									<input type="button" name="carddelete" class="carddelete delete" value="delete" data-id="<?php echo $value['id']; ?>"/>
								</div>

								<?php

									}
								}else{
								?>
								<div class="text-center">No any payment card added.</div>
								<?php
								}
								?>
							</div>
							<div class="text-center d-none empty">No any payment card added.</div>
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
					<a href="<?php echo $home_link; ?>" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'web-assets/js/custom/payment_setting.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
	var delete_url = "<?php echo base_url().'payment-card-delete'; ?>";
</script>