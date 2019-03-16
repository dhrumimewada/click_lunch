<?php
$home_link = base_url().'welcome';
?>
<div id="content">
	<div class="place-order-wrapper grey-bg">
		<div class="container">
			<div class="order-detail">
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
											<tr>
												<th>JR. Chiken Burger</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>Goat Cheese chorizo roll21</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>JR. Chiken Burger</th>
												<td>$56.00</td>
											</tr>
											<tr>
												<th>Goat Cheese chorizo roll21</th>
												<td>$56.00</td>
											</tr>
										</tbody>
									</table>
									<table>
										<tbody class="list-tax">
											<tr>
												<th>service fee</th>
												<td>&#36;5.00</td>
											</tr>
											<tr>
												<th>Tax</th>
												<td>$10.00</td>
											</tr>
											<tr>
												<th>Discount</th>
												<td>$5.00</td>
											</tr>
											<tr>
												<th class="list-total">total</th>
												<td class="list-total">$234.00</td>
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
				<div class="form-actions d-flex justify-content-center">
					<a href="<?php echo $home_link; ?>"name="backtocart" class="white-btn backtocart-btn" id="backtocart">Back to Home</a>
				</div>			
			</div>
		</div>
	</div>
</div>