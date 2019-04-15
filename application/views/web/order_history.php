<?php
$home_link = base_url().'welcome';
$img_link = base_url().'web-assets/images/';
$prof_base_url = base_url() . $this->config->item("profile_path") . '/';
$order_detail_url = base_url().'order-success/';
?>

<!-- Filter Modal -->
<div class="modal fade modal-with-logo" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabelLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content pt-4 pb-4">
			<div class="modal-header justify-content-center position-relative">
				<img src="<?php echo $img_link; ?>click-lunch-logo-white.png" width="130" />
			</div>
			<div class="modal-body">
				<form class="filter-block" id="filterBlock">
					<div class="row white-bg modalform m-0">
						<div class="filter-by-date">
							<h3>Ordered Date</h3>
							<div class="form-group">
								<input type="text" class="form-control" id="order_date" name="order_date" value="" placeholder="DD/MM/YYYY" autocomplete="off"/>
							</div>
						</div>
						<div class="filter-by-cuisines">
							<h3>Cuisines</h3>
							<div class="form-group">
								<input type="text" name="filterSearch" class="filter-search form-control" id="filterSearch" placeholder="Search..." />
							</div>
							<div class="filter-items text-left">

							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12 p-0 text-center">
							<button type="button" name="filterbtn" class="filter-btn transparent-btn pointer" id="filterbtn"><img src="<?php echo $img_link; ?>popup-checked.png"></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div class="favourites-order-wrapper order-history-wrapper grey-bg">
		<div class="container">

			<div class="favourites-order-block white-bg">
				<?php
				//echo $prof_base_url;
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
							<div class="order-id"><strong>Order CRN: </strong> <a href="<?php echo $order_detail_url.$value['id']; ?>"><?php echo 'CL'.$value['id']; ?></a></div>
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
							<div class="favourite text-warning">
								<i class="mdi <?php echo $class; ?> mdi-24px pointer" data-status="<?php echo $value['favourite']; ?>" data-id="<?php echo $value['id']; ?>"></i>
							</div>
							<div class="favourite-order-type">
								<span class="delivered order-type">
								<?php
								if($value['order_status'] == 0){
									$str = 'Pending';
								}elseif($value['order_status'] == 1){
									$str = 'Accepted by Restaurant';
								}elseif($value['order_status'] == 2){
									$str = 'Cancelled by Restaurant';
								}elseif($value['order_status'] == 3){
									$str = 'Accepted by Restaurant';
								}elseif($value['order_status'] == 4){
									$str = 'Delivery Boy Assigned';
								}elseif($value['order_status'] == 5){
									$str = 'Picked';
								}elseif($value['order_status'] == 6){
									$str = 'Delivered';
								}elseif($value['order_status'] == 7){
									$str = 'Cancelled';
								}else{
									$str = 'Fail';
								}
								echo $str;
								?>
								</span>
							</div>
						</div>
					</div>
					<?php
					}
					?>


				</div>
				<?php echo $links; ?>
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
<script type="text/javascript" charset="utf-8" async defer>
	var add_favourite_url = "<?php echo base_url().'favourite-status-update'; ?>";
	var get_cuisines_url = "<?php echo base_url().'get-cuisine'; ?>";
	var get_order_history_url = "<?php echo base_url().'get-order-history-filtered'; ?>";

	var img_base_url = "<?php echo $prof_base_url; ?>";
	var order_detail_url = "<?php echo $order_detail_url; ?>";
	var default_shop_picture = "<?php echo $img_link.'click-lunch.png'; ?>";

	var selected_cuisines = [];
	var selected_order_date = '';
	//console.log(img_base_url);
</script>
<script src="<?php echo $assets.'/js/custom/order_history.js'; ?>"></script>