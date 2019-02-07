<?php include('header.php'); ?>


    
<!-- start form -->
<div class="container-fluid grey-bg">
	<div class="form-content ">
    <div class="container content-form">
        <div class="row ">
        	<h3>Register Your Restaurant</h3>
            <div class="col-md-12 form-border">
             <form class="submit-form mt-5">
                
                <div class="form-group">
                    <input type="text" class="form-control input-border" placeholder="Restaurant Name" value="" />
                </div>
                
            </div>
            <div class="col-md-6 form-border">
                <div class="form-group">
                    <input type="email" class="form-control input-border" placeholder="Email Address" value="" />
                </div>
            </div>
            <div class="col-md-6 form-border">
                <div class="form-group">
                    <input type="text" class="form-control input-border" placeholder="Phone Number" value="" />
                </div>
            </div>
		         <div class="col-md-12 form-border res-add">
		         	  <div class="form-group">
		   				 <textarea class="form-control input-border " id="exampleFormControlTextarea1" rows="3" placeholder="Restaurant Address"></textarea>
		 			 </div>
		         </div>
		          <div class="col-md-12 form-border res-add">
		         	  <div class="form-group">
		   				 <textarea  class="form-control input-border" id="exampleFormControlTextarea2" rows="3" placeholder="Your Message"></textarea>
		 			 </div>
		         </div>
             
        				
 				<div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
 					<button type="button" class="small-red-btn">Submit</button>
 				</div>
 			</form>

                <div class="join-network">
                    <div class="join-network-box">
                        <div class="join-network-title">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>WHY JOIN THE NETWORK?</h3>
                                    <p>ClickLunch makes lunch easy and convenient for business professionals. Employees order online each morning, and restaurants prepare and deliver meals in bulk.</p>
                                    <b>CLICKLUNCH SOLVES YOUR RESTAURANT’S NEEDS BY PROVIDING…</b>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="network-list">
                                    <div class="network-img">
                                        <img src="<?php echo $assets; ?>images/image001.png" alt="">
                                    </div>
                                    <div class="network-txt">
                                        <h5>CONSISTENT NEW SALES</h5>
                                        <p>ClickLunch generates consistent orders before your doors ever open, bringing you new business on a daily basis.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="network-list">
                                    <div class="network-img">
                                        <img src="<?php echo $assets; ?>images/image002.png" alt="">
                                    </div>
                                    <div class="network-txt">
                                        <h5>CLICKLUNCH -FUNDED DAILY MARKETING</h5>
                                        <p>On average, ClickLunch markets your brand to a targeted audience of more than 1,250 business professionals each day.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="network-list">
                                    <div class="network-img">
                                        <img src="<?php echo $assets; ?>images/image003.png" alt="">
                                    </div>
                                    <div class="network-txt">
                                        <h5>EASY OPERATIONS & DAILY SUPPORT</h5>
                                        <p>Orders are handled when your kitchen has excess capacity, and we provide a dedicated Support team to assist with daily operations.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="network-list">
                                    <div class="network-img">
                                        <img src="<?php echo $assets; ?>images/image004.png" alt="">
                                    </div>
                                    <div class="network-txt">
                                        <h5>PROFITABLE DELIVERY</h5>
                                        <p>The combination of our low fee and high sales volume makes ClickLunch the most <i><b> profitable delivery solution </b></i> in the industry.</p>
                                        <!-- <ol>
                                            <li>On the delivery location page,  add a title “Add your office location”  above the form</li>
                                            <li>Why I can see “Order History”,  “Payment Methods” and Contact Information without logging into my account on the website?</li>
                                            <li> Add a facebook and google registration for the mobile app registration.</li>
                                        </ol> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 				<div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
 					<a href="<?php echo BASE_URL(); ?>web/home" class="white-btn">BACK TO HOME</a>
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

<!--end of form  -->

<?php include('footer.php'); ?>

<script type="text/javascript">
	$("input[type='number']").inputSpinner();
</script>