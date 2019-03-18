<?php
$home_link = base_url().'welcome';
$img_link = base_url().'web-assets/images/';
?>
<div id="content">
	<div class="favourites-order-wrapper order-history-wrapper grey-bg">
		<div class="container">

			<div class="favourites-order-block white-bg">
				<?php
				if(isset($order) && is_array($order) && !empty($order)){
				?>
				<div class="filter-block">
					<h3>Order History</h3>
					<a class="filter" href="javascript:void(0)" data-toggle="modal" data-target="#filterModal"><img src="<?php echo $img_link; ?>filter.png" /></a>
				</div>
				<div class="favourites-order-list">
					<?php
					foreach ($order as $key => $value) {
							if (isset($value['shop_picture']) && ($value['shop_picture'] != '')) {
							    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$value['shop_picture'];
							} else {
							    $prof_url = $img_link.'click-lunch.png';
							}
					?>

					<div class="favourites-order row m-0 align-items-center justify-content-between">
						<div class="col-md-2 text-center d-flex justify-content-center align-items-center"><img src="<?php echo $prof_url; ?>" class="site-logo" /></div>
						<div class="favourites-order-detail col-lg-8 col-md-7 p-0">
							<div class="order-name">
								<?php echo $value['shop_name']; ?>
							</div>
							<div class="order-id"><strong>Order CRN: </strong> <a href="order-detail.html"><?php echo 'CL'.$value['id']; ?></a></div>
							<div class="order-address">
								<?php echo $value['shop_address']; ?>
							</div>
							<div class="ordered-at"><strong>Ordered at:</strong>
								<?php
									$created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y H:i A", $created_date_ts);
                                    echo $created_date;
								?>
							</div>
							<div class="order-type-and-total d-flex">
								<div class="type">
									<strong>Type:</strong>
									<span>
										<?php
										if($value['order_type'] == 1){
											$str = 'Deliver Now';
										}elseif($value['order_type'] == 2){
											$str = 'Deliver Later';
										}elseif($value['order_type'] == 3){
											$str = 'Takout Now';
										}elseif($value['order_type'] == 4){
											$str = 'Takout Later';
										}else{
											$str = 'Weekly';
										}
										echo $str;
										?>
									</span>
								</div>
								<div class="total">
									<strong>Total:</strong>
									<span>&#36;<?php echo $value['total']; ?></span>
								</div>

							</div>
						</div>
						<?php
						if($value['favourite'] == 0){
							$class = 'mdi-heart-outline';
						}else{
							$class = 'mdi-heart';
						}
						?>
						<div class="reorder-block col-md-2 text-center d-flex flex-wrap justify-content-md-end align-items-center">
							<div class="favourite-reorder"><a href="cart.html" class="reorder">Reorder</a></div>
							<div class="favourite text-warning"><i class="mdi <?php echo $class; ?> mdi-24px pointer"></i></div>
							<div class="favourite-order-type"><span class="delivered order-type">Delivered</span></div>
						</div>
					</div>
					<?php
					}
					?>
				</div>
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo $home_link; ?>"name="backtocart" class="white-btn backtocart-btn" id="backtocart">Back to Home</a>
				</div>
				<?php
				}else{
				?>
				<h4 class="text-center">No any order history found</h4>	
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>