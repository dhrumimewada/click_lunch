<?php
$set_delivery_address = base_url()."change-location";
$back = base_url()."cart";
$home_link = base_url().'welcome';
?>
<div id="content">
	<div class="delivery-address-wrapper grey-bg">
		<div class="container">
			<?php echo get_msg(); ?>
			<div class="delivery-address-block white-bg">
				<div class="select-delivery-address-wrapper">
					<div class="row">
						<h4 class="d-inline-block col-lg-6">Your Locations</h4>
					</div>
					<hr>
					<form action="<?php echo $set_delivery_address; ?>" method="post" accept-charset="utf-8" id="customer-set-default-address-form">
					
						<div class="select-delivery-address-block">
							<?php
							if(isset($customer_addresses) && is_array($customer_addresses) && !empty($customer_addresses)){
							?>
							<div class="row m-0">
								<?php
									foreach ($customer_addresses as $key => $value) {
										$checked = '';
										if($value['default_address'] == 1){
											$checked = 'checked';
										}
									?>

										<div class="col-md-4">
											<div class="delivery-address d-flex align-items-center" data-id="<?php echo encrypt($value['id']); ?>">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="address" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" <?php echo $checked; ?> >
													<label class="form-check-label" for="<?php echo $value['id']; ?>">
														<?php
														echo $value['house_no'].', '.$value['street'].', <br>'.$value['city'].', '.$value['zipcode'].' ';
														if($value['address_type'] == 1){
															echo "<span class='badge badge-primary'>Office</span>";
														}else if($value['address_type'] == 2){
															echo "<span class='badge badge-success'>Office Buliding</span>";
														}else if($value['address_type'] == 3){
															echo "<span class='badge badge-info'>Home</span>";
														}else{
															echo "<span class='badge badge-secondary'>Other</span>";
														}
														?>
													</label>
												</div>
											</div>
										</div>

									<?php	
									}
									?>
							</div>
							<?php 
							}
							?>
						</div>
					</form>
				</div>
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo $home_link; ?>" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
	var my_delievry_address = "<?php echo base_url().'my-delievry-address'; ?>";
	 $( document ).ready(function() {
	 	$(document).on('click','.delivery-address div',function(){
	 		$('#customer-set-default-address-form').submit();
	 	});
	 });
</script>