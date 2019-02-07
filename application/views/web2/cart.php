<?php include('header.php'); ?>

<div id="content">
	<div class="cart-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="product-detail">
						<div class="categories">Categories: Italian, Special</div>
						<div class="row">
							<div class="col-md-6">
								<div class="product-image-slider">
									<div id="productSlider" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="<?php echo $assets; ?>images/main-dish.png" alt="First slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="<?php echo $assets; ?>images/main-dish.png" alt="Second slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="<?php echo $assets; ?>images/main-dish.png" alt="Third slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="<?php echo $assets; ?>images/main-dish.png" alt="Fourth slide">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="<?php echo $assets; ?>images/main-dish.png" alt="Fifth slide">
											</div>
										</div>
										<ol class="carousel-indicators">
											<li data-target="#productSlider" data-slide-to="0" class="active"><img src="<?php echo $assets; ?>images/sub-dish.png" /></li>
											<li data-target="#productSlider" data-slide-to="1"><img src="<?php echo $assets; ?>images/sub-dish.png" /></li>
											<li data-target="#productSlider" data-slide-to="2"><img src="<?php echo $assets; ?>images/sub-dish.png" /></li>
											<li data-target="#productSlider" data-slide-to="3"><img src="<?php echo $assets; ?>images/sub-dish.png" /></li>
											<li data-target="#productSlider" data-slide-to="4"><img src="<?php echo $assets; ?>images/sub-dish.png" /></li>
										</ol>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<form action="checkout.html">
								<div class="product-description">
									<h3>Fresh Mushrooms</h3>
									<div class="price">$ 12.99</div>
									<!-- <div class="product-ratings">
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/selected-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/grey-star.png" width="15" />
										<img src="<?php echo $assets; ?>images/grey-star.png" width="15" />
									</div> -->
									<div class="about-product">
										<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure</p>
									</div>
									<div class="add-toppings">
										<div class="add-toppings-text">Add Toppings <span>(Choose up to 3)</span></div>
										<table class="table">
											<tbody>
												<tr>
													<td>
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="toppings1" id="chille" value="option1">
															<label class="form-check-label" for="chille">Chille</label>
														</div>
													</td>
													<td>+$5.00</td>
												</tr>
												<tr>
													<td>
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="toppings2" id="anchovies" value="option2" checked>
															<label class="form-check-label" for="anchovies">Anchovies</label>
														</div>
													</td>
													<td>+$2.00</td>
												</tr>
												<tr>
													<td>
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="toppings3" id="rockt" value="option3">
															<label class="form-check-label" for="rockt">Rockt</label>
														</div>
													</td>
													<td>+$3.00</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="add-quantity">
										<div class="quantity">
											<input type="number" value="1" min="1" max="99" step="1" readonly />
											<input type="submit" name="add-to-cart" id="add-to-cart" class="red-btn" value="Add To Cart">
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
	<div class="container">
		<div class="d-flex justify-content-center">
			<div class="mail-subscription-block">
				<div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></div>
				<form class="mail-subscription d-flex align-items-center" id="mailSubscription">
					<input type="email" name="email" class="form-control" id="mailSubscriptionId" placeholder="Enter your e-mail address here" />
					<input type="submit" name="subscribe" value="Subscribe" class="subscribe-btn red-btn" />
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>