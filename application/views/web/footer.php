<div class="row pt-5 white-bg mr-0 ml-0 justify-content-center">
    <div class="mail-subscription-block">
        <div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></p></div>
        <form class="mail-subscription d-flex align-items-center" id="mailSubscription">
            <input type="email" name="email" class="form-control" id="mailSubscriptionId" placeholder="Enter your e-mail address here" />
            <input type="button" name="subscribe" id="subscribe" value="Subscribe" class="subscribe-btn red-btn" />
        </form>
        <label id="valid" class="validation-error-label text-success" for="mailSubscriptionId">You are subscribed to click lunch. Happy Eating!</label>
        <label id="required-error" class="validation-error-label" for="mailSubscriptionId">The e-mail address field is required.</label>
        <label id="invalid-error" class="validation-error-label" for="mailSubscriptionId">Please enter valid e-mail address.</label>
    </div>
</div>
<footer>
    <div class="d-flex justify-content-center align-items-center pt-4 pb-4">
        <div class="footer-content">
            <div class="footer-menu">
               <ul>
                    <li><a href="<?php echo BASE_URL(); ?>web/home/contact_us">Contact Us</a></li>
                    <li><a href="<?php echo BASE_URL(); ?>web/home/restaurant_partner">Restaurant Partners</a></li>
                    <li><a href="<?php echo BASE_URL(); ?>web/home/terms_of_service">Terms of Service</a></li>
                    <li><a href="<?php echo BASE_URL(); ?>web/home/faq">FAQ</a></li>
                </ul>
            </div>
            <div class="copyright text-center">
                <span>&copy; 2018 - www.<a href="<?php echo BASE_URL(); ?>web/home">ClickLunch</a>.com. All rights reserved</span>
            </div>
        </div>
    </div>
</footer>
<a href="#" id="scroll" class="scroll" style="display: none;"><span></span></a>
<script type="text/javascript">
    $(document).ready(function () {
        $('.validation-error-label').hide();
        var subscribe_url = "<?php echo base_url().'subscribe'; ?>";
        $(document).on('click',"#subscribe", function(){
            
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            $('.validation-error-label').hide();
            var email = $('#mailSubscriptionId').val().trim();

            if(email == ''){
                $('#required-error').show();
            }else if(!re.test(email)){
                $('#invalid-error').show();
            }else{
                $(this).prop("disabled", true);
                $.ajax({
                    url: subscribe_url,
                    type: "POST",
                    data:{email:email},
                    success: function (returnData) {
                        if (typeof returnData != "undefined" && returnData == true){
                            $('#subscribe').prop("disabled", false);
                            $('#valid').show();
                        } 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('error');
                    },
                    complete: function () {
                        $(this).prop("disabled", false);
                    }
                });    
            }
        });

        $(window).scroll(function(){ 
            if ($(this).scrollTop() > 100) { 
                $('#scroll').fadeIn(); 
            } else { 
                $('#scroll').fadeOut(); 
            } 
        }); 
        $('#scroll').click(function(){ 
            $("html, body").animate({ scrollTop: 0 }, 600); 
            return false; 
        }); 
        
    });
</script>