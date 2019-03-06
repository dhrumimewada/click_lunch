<div class="row pt-5 white-bg mr-0 ml-0 justify-content-center">
    <div class="mail-subscription-block">
        <div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></p>
        </div>
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

<?php $register_link = base_url().'register'; ?>
<style type="text/css" media="screen">
 .form-check-input.validation-error-label{
    position: absolute;
    margin-top: .3rem !important;
    margin-left: -1.25rem;
 }
</style>
<!-- Register Modal -->
<div class="modal fade" id="registerFormModal" tabindex="-1" role="dialog" aria-labelledby="registerFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content pt-3 pb-4">
            <div class="modal-header justify-content-center position-relative">
                <h5 class="modal-title" id="registerFormModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="register-form" id="register-form" action="<?php echo $register_link; ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="registerUsername">Username</label>
                                <input type="text" class="form-control" id="register_username" name="register_username" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="registerEmail">E-mail</label>
                                <input type="text" class="form-control" id="register_email" name="register_email" autocomplete="off">
                                <span class="validation-email">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="register_password">Password</label>
                                <input type="password" class="form-control" id="register_password" name="register_password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="register_confpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="register_confpassword" name="register_confpassword" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="register_number">Mobile Number</label>
                                <input type="text" class="form-control" id="register_number" name="register_number">
                                <span class="validation-number" autocomplete="off">
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="register_dob">Date Of Birth</label>
                                <input type="text" class="form-control datepicker-autoclose" id="register_dob" name="register_dob" width="276" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="register_gender">Gender</label>
                                <select class="form-control" id="register_gender" name="register_gender">
                                    <option selected disabled>Select gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="acceptTerms" name="acceptTerms">
                                <label class="form-check-label grey" for="acceptTerms">I agree to the Terms of Use and to receive emails.</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="register" class="register red-btn" id="register-btn" value="Register">
                        </div>
                    </div>
                    <div class="row signin-custom-text justify-content-center">
                        <span>or join with</span>
                    </div>
                    <div class="signin-with-social-account row">
                        <div class="col-sm-6">
                            <a href="https://accounts.Facebook.com/" class="facebook-account blue-btn">Facebook</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="https://accounts.google.com/signin" class="google-account orange-btn">Google</a>
                        </div>
                    </div>
                    <div class="already-have-account text-center mt-4">
                        <span class="grey">I already have an account <a id="dialog-login" href="javascript:void(0)" data-toggle="modal" data-target="#loginFormModal" class="font-weight-bold">Login</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginFormModal" tabindex="-1" role="dialog" aria-labelledby="loginFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content pt-sm-4 pb-sm-4">
            <div class="modal-header justify-content-center position-relative">
                <h5 class="modal-title" id="loginFormModalLabel">Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="login-form" id="login-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="login_email">E-mail</label>
                                <input type="text" class="form-control" id="login_email" name="login_email" autocomplete="off">
                                <span class="validation-login-email">
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="login_password">Password</label>
                                <input type="password" class="form-control" id="login_password" name="login_password" autocomplete="off">
                                <span class="validation-login-password">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="register-form-direction">
                                <div class="register-form-link">No account? <a id="dialog-register" href="javascript:void(0)" data-toggle="modal" data-target="#registerFormModal">Register</a></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="forgot-password d-flex align-items-center justify-content-between">
                                <a  id="dialog-forgot" href="javascript:void(0)" data-toggle="modal" data-target="#forgotFormModal">Forgot password?</a>
                                <input type="submit" name="login" class="login red-btn" id="login-btn" value="Log in">
                            </div>
                        </div>
                    </div>
                    <div class="row signin-custom-text justify-content-center">
                        <span>or sign in with</span>
                    </div>
                    <div class="signin-with-social-account row">
                        <div class="col-sm-6">
                            <a href="https://accounts.Facebook.com/" class="facebook-account blue-btn">Facebook</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="https://accounts.google.com/signin" class="google-account orange-btn">Google</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- forgot-password model -->
<div class="modal fade" id="forgotFormModal" tabindex="-1" role="dialog" aria-labelledby="loginFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content pt-sm-4 pb-sm-4 border-0">
            <div class="modal-header justify-content-center position-relative">
                <h5 class="modal-title" id="loginFormModalLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="faq-inner forgot-inner">                  
                   <form class="forgot-form" id="forgot-form">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">                                          
                                <input type="text" class="form-control" id="forgot_email" placeholder="Enter your e-mail" autocomplete="off" name='forgot_email'>
                                <span class="validation-forgot-email">
                                </span>
                            </div>
                        </div>
                    </div>                               
                    <div class="row">                                   
                        <div class="col-sm-6 forgot-btn">
                            <input type="submit" name="submit" class="register red-btn" id="pass-submit-btn" value="Send Mail">
                        </div>
                    </div>                            
                   
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" id="scroll" class="scroll" style="display: none;"><span></span></a>
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;z-index: 9999;"><img src='<?php echo base_url()."assets/images/loader.gif"; ?>' width="100" height="100" />

<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script src="<?php echo base_url().'web-assets/js/custom/register.js'; ?>"></script>
<script src="<?php echo base_url().'web-assets/js/custom/login.js'; ?>"></script>
<script src="<?php echo base_url().'web-assets/js/custom/forgot_password.js'; ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        // Register _ Start
        // Register _ end
        $('.mail-subscription-block .validation-error-label').hide();
        var subscribe_url = "<?php echo base_url().'subscribe'; ?>";
        $(document).on('click',"#subscribe", function(){
            
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            $('.mail-subscription-block .validation-error-label').hide();
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