<?php
$home_link = base_url().'welcome';
?>
<div id="content">
	<div class="place-order-wrapper grey-bg">
		<div class="container">
			
			<div class="order-detail">
				<?php
				if(isset($order) && is_array($order) && !empty($order)){
				?>
				<div class="order-top-title">
					<div class="row top-heading">
						<div class="col-sm-6">
							<div class="order-top-left">
								<strong>ORDER CRN</strong>
								<p>CL<?php echo $order['id']; ?></p>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="order-top-right">
								<strong>ORDER DATE</strong>
								<p>
									<?php
									$created_date_ts = strtotime($order["created_at"]);
                                    $created_date = date("j M, Y H:i A", $created_date_ts);
                                    echo $created_date;
									?>
								</p>
							</div>
						</div>
					</div>	
					<div class="order-detail-list">
						<div class="row">
							<div class="col-md-7 order-list-right">
								<div class="restarant-detail">
									<div class="">
										 <img src="<?php echo base_url().'assets/files/profile_pictures/'.$order['profile_picture']; ?>" width="120" class="restarant-img">									 									 
									</div>
									<div class="restarant-img-star">
										<?php
										$grey_star_url = base_url().'web-assets/images/grey-star.png';
										$full_star_url = base_url().'web-assets/images/selected-star.png';
										$half_star_url = base_url().'web-assets/images/half-star.png';
										$starNumber = $order["rating"];
										for($x = 1; $x <= $starNumber; $x++) {
									        echo '<img src="'.$full_star_url.'">';
									    }
									    if (strpos($starNumber,'.')) {
									        echo '<img src="'.$half_star_url.'">';
									        $x++;
									    }
									    while ($x<=5) {
									    	echo '<img src="'.$grey_star_url.'">';
									        $x++;
									    }

										?>
									</div>
									<div class="restarant-name"> 
									 	<h6><?php echo $order['shop_name']; ?></h6>
									</div>
								</div>
								<div class="order-item">
									<table>
										<tbody class="table-list">
											<?php
											foreach ($order['products'] as $key => $value) {
											?>
											<tr>
												<th><?php echo $value['name']; ?></th>
												<td>&#36;<?php echo $value['total_product_price']; ?></td>
											</tr>
											<?php
											}
											?>
										</tbody>
									</table>
									<table>
										<tbody class="list-tax">
											<tr>
												<th>Subtotal</th>
												<td>&#36;<?php echo $order['subtotal']; ?></td>
											</tr>
											<?php
											if(isset($order['promo_amount']) && $order['promo_amount'] != ''){
												?>
											<tr>
												<th>Promo Amount</th>
												<td class="text-success">- &#36;<?php echo $order['promo_amount']; ?></td>
											</tr>
											<?php
											}
											?>
											
											<tr>
												<th>TAX</th>
												<td>&#36;<?php echo $order['tax_amount']; ?></td>
											</tr>
											<tr>
												<th>Service Charge</th>
												<td>&#36;<?php echo $order['service_charge_amount']; ?></td>
											</tr>
											<tr>
												<th>Delivery Charge</th>
												<td>&#36;<?php echo $order['delivery_charges']; ?></td>
											</tr>
											<tr>
												<th class="list-total">Total</th>
												<td class="list-total">&#36;<?php echo $order['total']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="delivery-address">
									<strong>Delivery address</strong>
									<p><?php echo $order['delivery_address']; ?></p>
								</div>		
							</div>	
							<div class="col-md-5 d-flex justify-content-center align-items-center">
								<div class="capcha-img">
									<img src="<?php echo base_url().'assets/files/QR_codes/'.$order["QR_code"]; ?>">
								</div>
							</div>					
						</div>
					</div>											
				</div>	
				<?php
				}else{
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>Order detail not found.</div>
				<?php
				}
				?>
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo $home_link; ?>"name="backtocart" class="white-btn backtocart-btn" id="backtocart">Back to Home</a>
				</div>			
			</div>
		</div>
	</div>
</div>