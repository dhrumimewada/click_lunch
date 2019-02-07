<?php include('header.php'); ?>

<!-- start form -->

<div id="content">
	<div class="grey-bg">
		<div class="form-content">
    		<div class="container content-form p-4 pl-5 pr-5 pb-4">
        		<form class="submit-form mt-5 delivery-address-form">
        			<div class="row">
			            <div class="col-md-12 form-border">
			                <div class="form-group">
			                    <input type="text" class="form-control input-border" placeholder="House/ Office Number " value="" />
			                </div>
			            </div>
			            <div class="col-md-6 form-border">
			                <div class="form-group">
			                    <input type="text" class="form-control input-border" placeholder="Street/ Locality " value="" />
			                </div>
			            </div>
			            <div class="col-md-6 form-border">
			                <div class="form-group">
			                    <input type="text" class="form-control input-border" placeholder="City" value="" />
			                </div>
			            </div>
			            <div class="col-md-6 form-border">
			                <div class="form-group">
			                    <input type="text" class="form-control input-border" placeholder="Zip Code" value="" />
			                </div>
			            </div>
			            <div class="col-md-6 form-border">
			                <div class="form-group">
			                    <input type="text" class="form-control input-border" placeholder="Any delivery instruction" value="" />
			                </div>
			            </div>
            			<div class="col-md-12 add-new-address-block">
            				<label>Address Type</label>
            				<div class="form-check form-check-inline">
				  				<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
				  				<label class="form-check-label" for="inlineRadio1">Office</label>
			  				</div>
			  
						  <div class="form-check form-check-inline">
			  					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
			 					<label class="form-check-label" for="inlineRadio2">Home</label>
						  </div>
						  <div class="form-check form-check-inline">
			  					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option2">
			 					<label class="form-check-label" for="inlineRadio3">Other</label>
						  </div>
            			</div>
		 				<div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
		 					<button type="button" class="small-red-btn" data-toggle="modal" data-target="#thankyou">Save</button>
		 				</div>
		 			</div>
				</form>
 				<div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
 					<a href="<?php echo BASE_URL(); ?>web/home" class="white-btn">BACK TO HOME</a>
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

<!--end of form  -->

<?php include('footer.php'); ?>
<div class="modal fade pop-form" id="thankyou" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content thank-u-pop">
        <div class="pop-img">
        	<img src="<?php echo $assets; ?>images/click-lunch-logo-white.png">
        </div>
      <div class="modal-body col-sm-12 d-flex justify-content-center align-items-center">
     		<div class="successful-txt">
     			<h6>thank you</h6>
     			<p>for add new delivery address.</p>     			
     		</div>
      </div>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="close-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></span>
        </button>
    </div>
  </div>
</div>


<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>