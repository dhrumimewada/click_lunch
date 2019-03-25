<?php
$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
if (isset($shop['profile_picture']) && ($shop['profile_picture'] != '')) {
    if (file_exists($this->config->item("profile_path") . '/'.$shop['profile_picture'])){
        $photo_url = base_url() . $this->config->item("profile_path") . '/'.$shop['profile_picture'];
    }
}
if(isset($shop['cuisine']) && !empty($shop['cuisine'])){
	$cuisines = implode(', ', array_column($shop['cuisine'], 'cuisine_name'));
}else{
	$cuisines = '';
}
?>
<div id="content">
	<div class="restaurant-detail-banner position-relative">
		<img src="<?php echo $photo_url; ?>" class="w-100 shop-h" />
		<div class="restaurant-details">
			<h3><?php echo stripcslashes($shop['shop_name']); ?></h3>
			<div class="address mb-1"><?php echo stripcslashes($shop['address']); ?></div>
			<div class="phone-number mb-1">+1-<?php echo ' '.$shop['contact_no1']; ?></div>
			<div class="d-flex mb-1">
				<div class="delivery">Delivery <?php echo $shop['delivery_time'] ?></div>
				<div class="order-by">Order By <?php echo $shop['order_by_time'] ?></div>
			</div>
			<div class="food-types mb-1">
				<img src="<?php echo $assets; ?>images/tray.png" />
				<?php
				echo $cuisines;
				?>
			</div>
			<div class="timing d-flex mb-1">
				<div class="first-half">11:00 To 15:00</div>
				<div>&nbsp; / &nbsp;</div>
				<div class="second-half">18:30 To 22:30</div>
			</div>
			<div class="rating-block d-flex justify-content-between">
				<div class="rating">
					<img src="<?php echo $assets; ?>images/selected-star.png" width="25" />
					<img src="<?php echo $assets; ?>images/selected-star.png" width="25" />
					<img src="<?php echo $assets; ?>images/selected-star.png" width="25" />
					<img src="<?php echo $assets; ?>images/grey-star.png" width="25" />
					<img src="<?php echo $assets; ?>images/grey-star.png" width="25" />
				</div>
				<div class="distance">0.71mi</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="restaurants-food">
           
			<div class="results col-sm-12">Showing 1-12 of 23 results</div>
			<div class="restaurants-food-list row">
				<?php
				foreach ($item as $key => $value) { 
				
				$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
				if (isset($value['item_picture']) && ($value['item_picture'] != '')) {
				    if (file_exists($this->config->item("item_photo_path") . '/'.$value['item_picture'])){
				        $photo_url = base_url() . $this->config->item("item_photo_path") . '/'.$value['item_picture'];
				    }
				}
				?>
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="food-wrapper">
						<a href="<?php echo BASE_URL().'product/'.$value['short_name']; ?>" class="food-image position-relative">
							<img src="<?php echo $photo_url; ?>" width="371" height="312" />
							<div class="view-details">View Details</div>
						</a>
						<div class="food-details text-center">
							<div class="name"><?php echo $value['name']; ?></div>
							<!-- <div class="food-ratings">
								<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
								<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
								<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
								<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
								<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
							</div> -->
							<div class="food-price-and-add-cart d-flex justify-content-center">
								<label class="food-price">
								<?php
								if($value['offer_price'] != ''){ ?>
									<del class="text-secondary"><?php echo '$'.$value['price']; ?></del>&nbsp;<?php echo '$'.$value['offer_price']; ?>
								<?php
								}else{ ?>
								Only $<?php echo $value['price']; ?>
								<?php
								}
								?>
								
								</label>
								<a href="#" class="add-to-cart">Add to Cart</a>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<nav aria-label="food-pagination" class="d-flex justify-content-center">
			  <ul class="pagination">
			    <li class="page-item disabled previous">
			      <a class="page-link" href="#" tabindex="-1"><img src="<?php echo $assets; ?>images/left-arrow.png" /></a>
			    </li>
			    <li class="page-item active">
			    	<a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
			    </li>
			    <li class="page-item"><a class="page-link" href="#">2</a></li>
			    <li class="page-item"><a class="page-link" href="#">3</a></li>
			    <li class="page-item next">
			      <a class="page-link" href="#"><img src="<?php echo $assets; ?>images/right-arrow.png" /></a>
			    </li>
			  </ul>
			</nav>
		</div>
	</div>
</div>