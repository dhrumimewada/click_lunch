<?php
$set_delivery_address = base_url()."customer-set-address";
$back = base_url()."cart";

// if(isset($_SESSION['delivery_address_id']) && $_SESSION['delivery_address_id'] != ''){
// 	$defult = decrypt($_SESSION['delivery_address_id']);
// }
?>
<div id="content">
	<div class="delivery-address-wrapper grey-bg">
		<div class="container">
			<div class="delivery-address-block white-bg">
				<div class="select-delivery-address-wrapper">
					<div class="row">
						<h4 class="d-inline-block col-lg-6">Your & Popular Addresses</h4>
						<div class="d-inline-block col-lg-6 text-right">
	                        <a class="btn btn-danger" href="<?php echo $back; ?>">Back</a>
	                    </div>
					</div>
					<hr>
					<form action="<?php echo $set_delivery_address; ?>" method="post" accept-charset="utf-8">
					
						<div class="select-delivery-address-block">
							<?php
							if(isset($customer_addresses) && is_array($customer_addresses) && !empty($customer_addresses)){
							?>
							<div class="row m-0">
								<?php
									foreach ($customer_addresses as $key => $value) {
										$checked = '';
										if($default == $value['id']){
											$checked = 'checked';
										}
									?>

										<div class="col-md-4">
											<div class="delivery-address d-flex align-items-center" data-id="<?php echo encrypt($value['id']); ?>">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="address" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" <?php echo $checked; ?> >
													<label class="form-check-label" for="<?php echo $value['id']; ?>">
														<?php echo $value['house_no'].', '.$value['street'].', <br>'.$value['city'].', '.$value['zipcode']; ?>
													</label>
												</div>
											</div>
										</div>

									<?php	
									}
									?>
							</div>
							<hr>
							<?php 
							}

							if(isset($admin_addresses) && is_array($admin_addresses) && !empty($admin_addresses)){
							?>
							<div class="row m-0">
								<?php
									foreach ($admin_addresses as $key => $value) { 
										// if($default == $value['id']){
										// 	$checked = 'checked';
										// }
									?>

										<div class="col-md-4">
											<div class="delivery-address d-flex align-items-center" data-id="<?php echo encrypt($value['id']); ?>">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="address" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" >
													<label class="form-check-label" for="<?php echo $value['id']; ?>">
														<?php echo $value['house_no'].', '.$value['street'].', <br>'.$value['city'].', '.$value['zipcode']; ?>
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
					<a href="index.html" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
	var my_delievry_address = "<?php echo base_url().'my-delievry-address'; ?>";
	 $( document ).ready(function() {
	 	$(document).on('click','.delivery-address',function(){
	 		var address_id = $(this).data("id");
	 		console.log(address_id);
	 		window.location = my_delievry_address+'/'+address_id;
	 	});
	 });
</script>