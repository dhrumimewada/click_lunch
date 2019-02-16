<?php
$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
if (isset($item['item_data']['item_picture']) && ($item['item_data']['item_picture'] != '')) {
    if (file_exists($this->config->item("item_photo_path") . '/'.$item['item_data']['item_picture'])){
        $photo_url = base_url() . $this->config->item("item_photo_path") . '/'.$item['item_data']['item_picture'];
    }
}
$add_to_cart_link = base_url()."add-to-cart";
//$add_to_cart_link = "#";
?>
<style type="text/css" media="screen">
	del{
		color: #ef7a6d;
	}
</style>
<div id="content">
	<div class="cart-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="product-detail">
						<div class="categories">Category: <?php echo $item['item_data']['category_name']; ?></div>
						<div class="row">
							<div class="col-md-6">
								<img class="d-block w-100 item-photo object-cover" src="<?php echo $photo_url; ?>" alt="First slide">
							</div>
							<div class="col-md-6">
								<form action="<?php echo $add_to_cart_link; ?>" method="post" id="form-item">
								<input type="hidden" name="shop_id" value="<?php echo $item['item_data']['shop_id']; ?>">
								<div class="product-description">
									<h3><?php echo $item['item_data']['name']; ?></h3>
									<div class="price">
										<?php
										if($item['item_data']['offer_price'] != ''){
											echo "<del>$ ".$item['item_data']['price']."</del>&nbsp;&nbsp;$ ".$item['item_data']['offer_price'];
										}else{
											echo "$ ".$item['item_data']['price'];
										}
										?>
									</div>
									<!-- <div class="product-ratings">
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/grey-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/grey-star.png" width="15" />
									</div> -->
									<div class="about-product item-desc-overflow">
										<p><?php echo $item['item_data']['item_description']; ?></p>
									</div>
									<div class="toppings-div mb-2">
										<?php
										foreach ($item['group_data'] as $key => $value) {
										?>

										<div class="add-toppings">
											<div class="add-toppings-text">
												<?php
												echo $value['name']; 
												if($value['selection'] == 1){
													$varient_count = count($value['items']);
													$selection_txt = '(Choose up to '.$varient_count.')';
												}else{
													$selection_txt = "(Select one of any)";
												}
												?>
												<span><?php echo $selection_txt; ?></span>
											</div>

											<?php
											if(is_array($value['items']) && !empty($value['items'])){
												 $availability = ($value['availability'] == 1)?'required':'';
											?>
											<table class="table">
												<?php
												foreach ($value['items'] as $key1 => $value1) {
												?>
												<tr>
													<td>
														<div class="form-check">
															<?php if($value['selection'] == 1){ ?>
																<input class="form-check-input <?php echo $availability; ?>" type="checkbox" name="group[<?php echo $value['id']; ?>]['selection'][]" id="<?php echo $value1['id']; ?>" value="<?php echo $value1['id']; ?>">
																<label class="form-check-label" for="<?php echo $value1['id']; ?>"><?php echo ucfirst($value1['name']); ?></label>
															<?php } else{ ?>
																<input class="form-check-input <?php echo $availability; ?>" type="radio" name="group[<?php echo $value['id']; ?>]['selection'][]" id="<?php echo $value1['id']; ?>" value="<?php echo $value1['id']; ?>">
																<label class="form-check-label" for="<?php echo $value1['id']; ?>"><?php echo ucfirst($value1['name']); ?></label>
															<?php }?>
														</div>
													</td>
													<td>+$<?php echo $value1['price']; ?></td>
												</tr>
												<?php
												}
												?>
											</table>
											<?php
											}
											?>
										</div>

										<?php
										}
										?>
									</div>
									<div class="add-quantity">
										<div class="quantity">
											<input type="number" value="1" min="1" max="500" step="1" name="quantity" readonly />
											<input type="button" name="add-to-cart" id="add-to-cart" class="red-btn" value="Add To Cart">
										</div>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="related-product-custom-text">Top Related Products</div>
					<div class="related-product-block">
						<div class="related-product-list">
							<div class="related-product col-md-12">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="related-product-image"><img src="<?php echo $assets; ?>images/side-menu-dish.png" width="66" height="66" /></div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="related-product-detail">
											<div class="related-product-title"><a href="<?php echo BASE_URL(); ?>web/home/cart">Tasty Tomatos Cheese Souse</a></div>
											<!-- <div class="product-ratings">
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
											</div> -->
											<div class="price">$ 12.99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="related-product col-md-12">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="related-product-image"><img src="<?php echo $assets; ?>images/side-menu-dish.png" width="66" height="66" /></div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="related-product-detail">
											<div class="related-product-title"><a href="<?php echo BASE_URL(); ?>web/home/cart">Tasty Potatoes Cheese Fish</a></div>
											<!-- <div class="product-ratings">
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
											</div> -->
											<div class="price">$ 34.75</div>
										</div>
									</div>
								</div>
							</div>
							<div class="related-product col-md-12">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="related-product-image"><img src="<?php echo $assets; ?>images/side-menu-dish.png" width="66" height="66" /></div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="related-product-detail">
											<div class="related-product-title"><a href="<?php echo BASE_URL(); ?>web/home/cart">Tasty Tomatos Cheese Souse</a></div>
											<!-- <div class="product-ratings">
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
											</div> -->
											<div class="price">$ 92.00</div>
										</div>
									</div>
								</div>
							</div>
							<div class="related-product col-md-12">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="related-product-image"><img src="<?php echo $assets; ?>images/side-menu-dish.png" width="66" height="66" /></div>
									</div>
									<div class="col-md-12 col-lg-8">
										<div class="related-product-detail">
											<div class="related-product-title"><a href="<?php echo BASE_URL(); ?>web/home/cart">Tasty Potatoes Cheese Fish</a></div>
											<!-- <div class="product-ratings">
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/selected-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
												<img src="<?php echo $assets; ?>images/grey-star.png" width="12" />
											</div> -->
											<div class="price">$ 3.25</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>
<?php $assets = $this->config->item('website_assest'); ?>
<script src="<?php echo $assets.'/js/custom/item_detail.js'; ?>"></script>