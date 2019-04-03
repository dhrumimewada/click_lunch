<?php
$prof_url = base_url() . 'assets/images/default/cuisine.jpg';
$assets = $this->config->item('website_assest');
$d_none = 'd-none';
$add_address_link = base_url()."customer-add-address";

if(isset($_SESSION['shop_short_name']) && $_SESSION['shop_short_name'] != ''){
	$url = base_url().'restaurant/'.$_SESSION['shop_short_name'];
}
?>
<!-- model -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="customize-item-modal">
    <div class="modal-dialog modal-dialog-centered my-modal">
        <div class="modal-content">

        	<form method="post" accept-charset="utf-8" id="form-varient">
	            <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Modal Heading</h4>
		          <i class="mdi mdi-close mdi-24px close" data-dismiss="modal"></i>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="varient-headings text-center pt-2 pr-1 pl-1">
		        	<!-- Group of haeder -->
		    	</div>
		    	<div class="mt-1 p-2 text-center bg-danger text-white position-absolute w-100 error-item" style="z-index: 1;">
		    		You must select at least 1 Upgrade
		    	</div>
		        <div class="modal-body table-responsive">
		        	<!-- options of group -->
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger w-100" id="form-varient-btn">
		          	<span class="float-left">&#36;<span class="total-item-price">100.00</span></span>
		          	<span class="float-right">UPDATE ITEM</span>
		          
		      	</button>
		        </div>

	        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- model end -->


<!-- model -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="customize-recommendation-item-modal">
    <div class="modal-dialog modal-dialog-centered my-modal">
        <div class="modal-content">

        	<form method="post" accept-charset="utf-8" id="form-recommendation-varient">
	            
		        <div class="modal-header">
		          <h4 class="modal-title">Modal Heading</h4>
		          <i class="mdi mdi-close mdi-24px close" data-dismiss="modal"></i>
		        </div>
		        
		        
		        <div class="varient-headings text-center pt-2 pr-1 pl-1">
		        	
		    	</div>
		    	<div class="mt-1 p-2 text-center bg-danger text-white position-absolute w-100 error-item" style="z-index: 1;">
		    		You must select at least 1 Upgrade
		    	</div>
		        <div class="modal-body table-responsive">
		        	
		        </div>
		        
		        
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger w-100" id="form-recommendation-varient-btn" data-itemid=''>
		          	<span class="float-left">&#36;<span class="total-item-price">100.00</span></span>
		          	<span class="float-right">UPDATE ITEM</span>
		      	</button>
		        </div>

	        </form>
        </div>
    </div>
</div>


<div id="content">
	<div class="checkout-wrapper grey-bg">
		<div class="container">
			<?php echo get_msg(); ?>
			<div class="checkout-block white-bg">
				<form >
				<div class="product-list table-responsive">
					<table class="table" id="cart-table">
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
								<td><img src="<?php echo $prof_url; ?>" width="113" height="114" class="object-cover"/></td>
								<td>
									<div class="product-name">
										<span><?php echo $value['name']; ?></span>
										<?php 
										$product_price_with_varient = '&#36;'.$value['item_price'];
										if($value['varient_price'] != '' && $value['varient_price'] > 0){
											$product_price_with_varient = "&#36;".$value['item_price'] ." + &#36;". $value['varient_price'];
										} 
										?>
										<span class="light-gray-txt"><?php echo $product_price_with_varient; ?></span>
										<?php if(isset($value['group_data']) && is_array($value['group_data']) && !empty($value['group_data'])){ ?>
										<span class="pointer customize d-inline-block" data-id="<?php echo $value['rowid']; ?>">Customize</span>
										<?php
										} else{
										?>
										<span></span>
										<?php } ?>
									</div>
								</td>
								<td class="quatity-update">
									<input type="number" value="<?php echo $value['qty']; ?>" min="1" max="99" step="1" data-id="<?php echo $value['rowid']; ?>" />
								</td>
								<?php
								$product_price = $value['price'] * $value['qty'];
								$product_price = number_format((float)$product_price, 2, '.', '');
								?>
								<td class="product-price">&#36;<?php echo $product_price; ?></td>
								<td class="product-cancel"><i class="mdi mdi-close mdi-24px pointer" id="<?php echo $value['rowid']; ?>" data-price="<?php echo $product_price; ?>"></i></td>
							</tr>

							<?php

								}
							}else{
								$d_none = "";
							}
							?>
							<tr class="<?php echo $d_none; ?>" id="empty-cart">
								<td colspan="5" class="text-center p-3">
									<img src="<?php echo $assets.'/images/empty-cart.png'; ?>" alt="" class="d-block mx-auto mb-3 mt-2">
									<div class="font-weight-light light-gray-txt">
										<div class="d-block">Your cart is empty.</div>
										<div class="d-block">Add an item to begin.</div>
									</div>
								</td>
							</tr>
							<?php
							if(isset($cart_total) && ($cart_total != '') && !empty($cart_total)){
							?>

							<tr>
								<td></td>
								<td></td>
								<td class="total-text">Total:</td>
								<?php
								$cart_total = number_format((float)$cart_total, 2, '.', '');
								?>
								<td class="total">&#36;<span class="total_cart_amount"><?php echo $cart_total; ?><span></td>
								<td></td>
							</tr>

							<?php
							}
							?>
							
						</tbody>
					</table>
				</div>

				<?php
				if(isset($additional_recommendation) && is_array($additional_recommendation) && !empty($additional_recommendation)){
				?>
				<div class="additional-recommendation-wrapper text-center">
					<h3 class="text-with-border-right">Additional Recommendation</h3>
					<div class="additional-recommendation-list text-left">
						<div class="row m-0">
							<?php
							foreach ($additional_recommendation as $key => $value) {
								$prof_url = base_url() . 'web-assets/images/logo-3.png';
								if (isset($value['item_picture']) && ($value['item_picture'] != '')){
									if (file_exists($this->config->item("item_photo_path") . '/'.$value['item_picture'])){
										$prof_url = base_url() . $this->config->item("item_photo_path") . '/'.$value['item_picture'];
									}
									
								}

							?>
							<div class="col-md-4">
								<div class="additional-recommendation">
									<div class="additional-rec-image"><img src="<?php echo $prof_url; ?>" width="343" height="150" /></div>
									<div class="additional-rec-detail">
										<div class="rec-product-name cut-text"><?php echo $value['name']; ?></div>
										<div class="rec-product-desc d-flex justify-content-between">
											<?php
											if($value['offer_price'] == ''){
												$price_string = '&#36; '.$value['price'];
											}else{
												$price_string = '<strike class="text-muted">&#36;'.$value['price'].'</strike> &#36;'.$value['offer_price'];
											}
											?>
											<div class="rec-product-price"><?php echo $price_string; ?></div>
											<span class='btn btn-danger recommendation-add' id="<?php echo $value['id']; ?>">Add</span>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<?php
				}
				?>
				<div class="select-delivery-address-wrapper text-center">
					<h3 class="text-with-border-right">Select Delivery Address</h3>
					<div class="select-delivery-address-block text-left">
						<div class="row m-0">
							<div class="col-md-4">
								<span class="delivery-address add-delivery-address text-center d-flex justify-content-center align-items-center pointer">
									<div class="new-address">
										<img src="<?php echo $assets; ?>images/add.png" class="d-block mx-auto mb-1" />
										<span>Add New Address</span>
									</div>
								</span>
							</div>
							<div class="col-md-4">
								<span class="delivery-address choose-address text-center d-flex justify-content-center align-items-center pointer">
									<span>Choose from one of<br> existing delivery location</span>
								</span>
							</div>
							<?php
							if(isset($default_address) && is_array($default_address) && !empty($default_address)){
								$this->session->set_userdata('delivery_address_id', encrypt($default_address['id']));
							?>
							<div class="col-md-4">
								<div class="delivery-address d-flex align-items-center choose-address">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="address" id="deliveryAddressRadio" value="address1" checked>
										<label class="form-check-label" for="deliveryAddressRadio">
											<?php 
											echo $default_address['house_no'].', '.$default_address['street'].', <br>'.$default_address['city'].', '.$default_address['zipcode'];
											?>
										</label>
									</div>
								</div>
							</div>
							<?php
							}
							?>
							
						</div>
					</div>
				</div>
				<div class="form-actions d-flex justify-content-between">
					<a href="<?php echo $url; ?>" name="continue-shopping" class="white-btn continue-shopping-btn pointer" id="continue-shopping-btn">Continue Shopping</a>
					<input type="button" name="checkout" class="small-red-btn checkout-btn pointer" id="checkout-btn" value="Checkout">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<?php
include 'add_address_modal.php';
?>
<script type="text/javascript">
	$("input[type='number']").inputSpinner();
	var delete_url = "<?php echo base_url().'cart-item-delete'; ?>";
	var customize_url = "<?php echo base_url().'get-cart-item-data'; ?>";
	var customize_cart_item_url = "<?php echo base_url().'update-cart-item-data'; ?>";
	var update_quantity_url = "<?php echo base_url().'update-quantity'; ?>";

	var logged_in = "<?php echo $this->auth->is_logged_in() ?>";
	var is_customer = "<?php echo $this->auth->is_customer(); ?>";
	var choose_address = "<?php echo base_url().'choose-address'; ?>";

	var defualt_delivery_address_id = "<?php echo $_SESSION['delivery_address_id']; ?>";
	var cart_contents_data = '<?php echo (empty($this->cart->contents()))?'':'1'; ?>';

	var customize_recommendation_url = "<?php echo base_url().'get-recommendation-item-data'; ?>";
	var add_recommended_item_cart_url = "<?php echo base_url().'add-recommended-item-cart'; ?>";

	var add_direct_to_cart_url = "<?php echo base_url().'add-direct-recommended-item-cart'; ?>";
	var checkout_url = "<?php echo base_url().'checkout'; ?>";
	console.log(defualt_delivery_address_id);
	console.log(cart_contents_data);
</script>
<script src="<?php echo $assets.'/js/custom/cart.js'; ?>"></script>
