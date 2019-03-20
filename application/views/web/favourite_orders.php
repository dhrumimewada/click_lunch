<?php
$img_link = base_url().'web-assets/images/';
$order_detail_url = base_url().'order-success/';
?>
<div id="content">
	<div class="favourites-order-wrapper grey-bg">
		<div class="container">
			<div class="favourites-order-block white-bg">
				<h3>Favourites</h3>
				<div class="favourites-order-list">
					<?php
					if(isset($order) && is_array($order) && !empty($order)){
						foreach ($order as $key => $value){
							if (isset($value['shop_picture']) && ($value['shop_picture'] != '')) {
							    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$value['shop_picture'];
							} else {
							    $prof_url = $img_link.'click-lunch.png';
							}
							?>
							<div class="favourites-order row m-0 align-items-center justify-content-between">
								<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
									<img src="<?php echo $prof_url; ?>" class="site-logo" />
								</div>
								<div class="favourites-order-detail col-lg-8 col-md-7 p-0">
									<div class="order-name">
										<?php echo $value['shop_name']; ?>
									</div>
									<div class="order-id">
										<strong>Order Id: </strong>
										<a href="<?php echo $order_detail_url.$value['id']; ?>">CL<?php echo $value['id']; ?></a>
									</div>
									<div class="order-address">
										<?php echo $value['shop_address']; ?>
									</div>
									<div class="ordered-at">
										<strong>Ordered at:</strong>
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
								<div class="reorder-block col-md-2 text-center d-flex justify-content-md-end">
									<a href="#" class="reorder">Reorder</a>
								</div>
							</div>
							<?php
						}
					}else{
						echo '<div class="m-2 text-center">No any favourite order found</div>';
					}
					?>
				</div>
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo BASE_URL(); ?>welcome" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
				</div>
			</div>
		</div>
	</div>
</div>