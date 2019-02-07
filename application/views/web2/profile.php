<?php include('header.php'); ?>
<div id="content">
	<div class="favourites-order-wrapper order-history-wrapper grey-bg">
		<div class="container">
			<div class="profile-block white-bg">
				<form name="user-profile" id="user-profile" method="post" enctype="multipart/form-data">
					<div class="profile-image">
						<img class="profile-pic" src="<?php echo $assets; ?>images/restaurant-detail-banner.png" />
					</div>
					<div class="profile-detail row m-0">
						<div class="form-group col-md-12">
							<label for="username">Name</label>
						    <input type="text" class="form-control" id="username" value="Santos E. Newton" />
						</div>
						<div class="form-group col-md-6">
							<label for="useremail">Email Id</label>
						    <input type="email" class="form-control" id="useremail" value="santosnewton@gmail.com" />
						</div>
						<div class="form-group col-md-6 num-code">
							<label for="usermobile">Mobile Number</label>
						    <input type="text" class="form-control" id="usermobile" value="847 8574 874" />
                            <span>+1</span>
						</div>
						<div class="form-group col-md-6">
							<label for="userdob">Date of Birth</label>
						    <input type="text"  class="form-control" id="userdob" value="01/30/2019" />
						</div>
						<div class="form-group col-md-6">
							<label for="usergender">Gender</label>
						    <div class="gender delivery-address d-flex row m-0">
						    	<div class="form-check col-md-6">
									<input class="form-check-input" type="radio" name="gender" id="genderRadios1" value="male" checked>
									<label class="form-check-label" for="genderRadios1">Male</label>
								</div>
								<div class="form-check col-md-6">
									<input class="form-check-input" type="radio" name="gender" id="genderRadios2" value="female">
									<label class="form-check-label" for="genderRadios2">Female</label>
								</div>
						    </div>
						</div>
					</div>
					<div class="submit-buttons form-actions d-flex justify-content-center">
						<input type="button" name="resetpass" class="resetpass white-btn" id="resetpass" value="Reset Password"  onclick="location.href = 'reset-password.html';"/>
						<input type="submit" name="save" class="save small-red-btn" id="save" value="Save" />
					</div>
					<div class="form-actions d-flex justify-content-center">
						<a href="<?php echo BASE_URL(); ?>web/home" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
					</div>
				</form>
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
