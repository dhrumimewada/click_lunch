<?php
$add_card_link = base_url().'customer-payment-setting';
$edit_card_link = base_url().'customer-payment-setting/';
$img_path = base_url().'web-assets/images/card-icons/';
$home_link = base_url().'welcome';
?>
<style type="text/css" media="screen">
	label.validation-error-label{
		font-size: 1rem !important;
	}
</style>
<div id="content">
	<div class="add-card-wrapper grey-bg">
		<div class="container">
			<?php echo get_msg(); ?>
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
											$img_name = 'jcb.png';
										}else if($value['card_type'] == 5){
											$img_name = 'diners.png';
										}else if($value['card_type'] == 6){
											$img_name = 'discover.png';
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
									<input type="button" name="cardedit" class="cardedit" value="edit" onclick="location.href = '<?php echo $edit_card_link.encrypt($value['id']); ?>';"/>
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
						<form id="add-card-form" name="add-card" method="post" action="<?php echo $add_card_link; ?>">
							<div class="row m-0">
								<div class="form-group col-md-12">
									<label class="required" for="card_holder_name">Card Holder Name</label>
									<?php
    $field_value = NULL;
    $temp_value = set_value('card_holder_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->card_holder_name)){
    		$field_value = stripcslashes($my_payment_card->card_holder_name);
    	}
    }
    ?>
							    	<input type="text" class="form-control" id="card_holder_name" name="card_holder_name" value="<?php echo $field_value; ?>"/>
							    	<div class="validation-error-label">
	                                    <?php echo form_error('card_holder_name'); ?>
	                                </div>
								</div>
                                <div class="form-group col-md-12">
                                    <label for="nickname">Nick Name</label>
                                    <?php
    $field_value = NULL;
    $temp_value = set_value('nickname');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->nickname)){
    		$field_value = stripcslashes($my_payment_card->nickname);
    	}
    }
    ?>
                                    <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $field_value; ?>"/>
                                    <div class="validation-error-label">
	                                    <?php echo form_error('nickname'); ?>
	                                </div>
                                </div>
								<div class="form-group col-md-12">
									<label class="required" for="card_number">Card Number</label>
									<?php
    $field_value = NULL;
    $temp_value = set_value('card_number');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->card_number)){
    		$field_value = decrypt($my_payment_card->card_number);
    	}
    }
    ?>
							    	<input type="text" class="form-control" id="card_number" value="<?php echo $field_value; ?>" name="card_number"/>
							    	<div class="validation-error-label">
	                                    <?php echo form_error('card_number'); ?>
	                                </div>
								</div>
                                <div class="form-group col-md-6">
                                    <label class="required" for="expiry_date">Expiry Date</label>
                                    <?php
    $field_value = NULL;
    $temp_value = set_value('expiry_date');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->expiry_date)){
    		$field_value = decrypt($my_payment_card->expiry_date);
    	}
    }
    ?>
                                    <input type="text"  class="form-control" id="expiry_date" placeholder="MM/YYYY" value="<?php echo $field_value; ?>" name="expiry_date"/>
                                    <div class="validation-error-label">
	                                    <?php echo form_error('expiry_date'); ?>
	                                </div>
                                </div>
								<div class="form-group col-md-6">
									<label class="required" for="cvv">CVV</label>
									<?php
    $field_value = NULL;
    $temp_value = set_value('cvv');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->cvv)){
    		$field_value = decrypt($my_payment_card->cvv);
    	}
    }
    ?>
							    	<input type="text" class="form-control" id="cvv" value="<?php echo $field_value; ?>" name="cvv"/>
							    	<div class="validation-error-label">
	                                    <?php echo form_error('cvv'); ?>
	                                </div>
								</div>
								<div class="form-group col-md-12">
									<label class="required">Select Card Type</label>
									<div class="select-card row m-0">
										<?php
    $field_value = NULL;
    $temp_value = set_value('card_type');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
    	if(isset($my_payment_card->card_type)){
    		$field_value = $my_payment_card->card_type;
    	}
    }
    ?>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard1" value="1" <?php echo ($field_value == 1)?'checked':''; ?> >
											<label class="form-check-label visa" for="selectCard1"></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard2" value="2" <?php echo ($field_value == 2)?'checked':''; ?> >
											<label class="form-check-label master-card" for="selectCard2"></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard3" value="3" <?php echo ($field_value == 3)?'checked':''; ?> >
											<label class="form-check-label american-express" for="selectCard3"></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard4" value="4" <?php echo ($field_value == 4)?'checked':''; ?> >
											<label class="form-check-label jcb" for="selectCard4"></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard5" value="5" <?php echo ($field_value == 5)?'checked':''; ?> >
											<label class="form-check-label diners" for="selectCard5"></label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="card_type" id="selectCard6" value="6" <?php echo ($field_value == 6)?'checked':''; ?> >
											<label class="form-check-label discover" for="selectCard6"></label>
										</div>
									</div>
									<div class="validation-error-label">
	                                    <?php echo form_error('card_type'); ?>
	                                </div>
								</div>
							</div>
							<?php
							if(isset($my_payment_card->id)){ ?>
								<input type="hidden" name="card_id" value="<?php echo $my_payment_card->id; ?>">
							<?php
							}
							?>
							<div class="add-card-button form-actions d-flex justify-content-center">
								<input type="submit" name="submit" class="add-card-btn small-red-btn" id="addCardBtn" value="Save" />
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
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
	var delete_url = "<?php echo base_url().'payment-card-delete'; ?>";
</script>