<?php
$photo_url = base_url() . 'web-assets/images/banner.jpg';
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
				<div class="delivery">Delivery <?php echo $shop['delivery_time']; ?></div>
				<div class="order-by">Order By <?php echo $shop['order_by_time']; ?></div>
			</div>
			<div class="food-types mb-1">
				<img src="<?php echo $assets; ?>images/tray.png" />
				<?php
				echo $cuisines;
				?>
			</div>
			<div class="timing d-flex mb-1">
				<?php
				$data = '<table>';
				foreach ($shop['all_working_time'] as $key => $value) {
					$data .= '<tr>';
					if($shop['availibality']['day'] == $value['day']){
						$day = '<b>Today<b>';
					}else{
						$day = $value['day'];
					}
					if($value['is_closed'] == 1){
						$data .= '<td>'.$day.' :&nbsp;</td><td>Closed</td>';
					}else if($value['full_day'] == 1){
						$data .= '<td>'.$day.' :&nbsp;</td><td>Full day open</td>';
					}else if($shop['availibality']['from_time'] != ''){
						$data .= '<td>'.$day.' :&nbsp;</td><td>'.$shop["availibality"]['from_time'].' to '.$shop['availibality']['to_time'].'</td>';
					}else{
						$data .= '<td>'.$day.' :&nbsp;</td><td>NA</td>';
					}
					$data .= '</tr>';
				}
				$data .= '</table>';
				?>
				<span class="pointer" data-toggle="popover" title="Open Hours" data-content="<?php echo $data; ?>"  data-trigger="hover" data-html="true"> 
				<?php
				if($shop['availibality']['is_closed'] == 1){
					echo "Closed";
				}else if($shop['availibality']['full_day'] == 1){
					echo "24 Hours Open";
				}else if($shop['availibality']['from_time'] != '' && $shop['availibality']['to_time'] != ''){
					echo $shop["availibality"]['from_time'].' to '.$shop['availibality']['to_time'];
				}else{
					echo "Working time not available";
				}
				?>
				</span>
			</div>
			<div class="rating-block d-flex justify-content-between">
				<div class="rating">
					<?php
					    for($x=1;$x<=$shop['rating'];$x++) {
					    ?>
					       <img src="<?php echo $assets; ?>images/selected-star.png" width="25" />
					    <?php
					    }
					    if (strpos($shop['rating'],'.') && $shop['rating'] != 0) {
					    ?>
					        <img src="<?php echo $assets; ?>images/half-star.png" width="25" />
					    <?php
					        $x++;
					    }
					    while ($x<=5) {
					   	?>
					        <img src="<?php echo $assets; ?>images/grey-star.png" width="25" />
					    <?php
					        $x++;
					    }
					?>
				</div>
				<!-- <div class="distance">0.71mi</div> -->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="restaurants-food">

           	<div class="mt-5 mb-5">
           		<?php
           		$combo_active = $all_active = '';
           		if($tab_pan == 'combo'){
           			$combo_active = 'active';
           		}else{
           			$all_active = 'active';
           		}
           		?>
	            <ul class="nav nav-tabs justify-content-center border-bottom-0" id="home-tabs" role="tablist">
	            	<li class="nav-item mr-3">
	                    <a class="nav-link <?php echo $all_active; ?>" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All Products</a>
	                </li>
	                <li class="nav-item mr-3">
	                    <a class="nav-link <?php echo $combo_active; ?>" id="combo-tab" data-toggle="tab" href="#combo" role="tab" aria-controls="combo" aria-selected="false">Combo Products</a>
	                </li>
	                
	            </ul>
	        </div>
	        <div class="tab-content">
	        	<?php
           		$combo_show = $all_show = '';
           		if($tab_pan == 'combo'){
           			$combo_show = 'show active';
           		}else{
           			$all_show = 'show active';
           		}
           		?>
	            <div class="tab-pane fade <?php echo $all_show; ?> restaurant row mt-4 w-100" id="all" role="tabpanel" aria-labelledby="all-tab">
	                <div class="restaurants-food-list row">
						<?php
						$combo = array();
						if(isset($item) && !empty($item)){
							foreach ($item as $key => $value) { 
								if($value['is_combo'] == 1){
									$combo[$key] = $value;
								}
								
								$photo_url = base_url() . 'web-assets/images/logo-3.png';
								if (isset($value['item_picture']) && ($value['item_picture'] != '')) {
								    if (file_exists($this->config->item("item_photo_path") . '/'.$value['item_picture'])){
								        $photo_url = base_url() . $this->config->item("item_photo_path") . '/'.$value['item_picture'];
								    }
								}
								?>
								<div class="col-sm-6 col-md-6 col-lg-4">
									<div class="food-wrapper">
										<a href="<?php echo BASE_URL().'product/'.$order_type.'/'.$value['short_name']; ?>" class="food-image position-relative">
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
												<a href="<?php echo BASE_URL().'product/'.$order_type.'/'.$value['short_name']; ?>" class="add-to-cart">Add to Cart</a>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						}else{
						?>
						<div class="mt-1 mb-5 text-center w-100 no-product-found">No any products found</div>
						<?php
						}
						?>
					</div>
	            </div>
	            <div class="tab-pane fade <?php echo $combo_show; ?> restaurant row mt-4 w-100" id="combo" role="tabpanel" aria-labelledby="combo-tab">
	                <div class="restaurants-food-list row">
	                	<?php
						if(isset($combo) && !empty($combo)){
							foreach ($combo as $key => $value) { 
								
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
						}else{
						?>
						<div class="mt-1 mb-5 text-center w-100 no-product-found">No any combo products found</div>
						<?php
						}
						?>
	                </div>
	            </div>
	        </div>
			<!-- <nav aria-label="food-pagination" class="d-flex justify-content-center">
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
			</nav> -->
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
	$(document).ready(function(){
	  $('[data-toggle="popover"]').popover(); 
	});
</script>