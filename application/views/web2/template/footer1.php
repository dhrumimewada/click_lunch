
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

<div class="modal fade pop-form" id="address-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content thank-u-pop">
        <div class="pop-img">
            <img src="<?php echo $assets; ?>images/click-lunch-logo-white.png">
        </div>
      <div class="modal-body no-padding">
            <div class="pop-add-form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pop-form-title"><h4>Address</h4>
                        </div>
                    </div>
                    <div class="add-new-address-block">
                        <div class="row m-0">
                            
                        
                          <div class="form-check form-check-inline">                            
                                <input class="form-check-input" type="radio" name="locationRadioOptions" id="locationRadio1" value="currentlocation">
                                <label class="form-check-label" for="locationRadio1">current location </label>
                          </div>
                          
                          <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="locationRadioOptions" id="locationRadio2" value="preferredlocation">
                                <label class="form-check-label" for="locationRadio2">preferred location</label>
                          </div>

                        <div class="address-edit">
                                <a href="#"><img src="<?php echo $assets; ?>images/edit.png"></a>
                        </div>

                          </div>
                    </div>                  
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pop-form-title"><h4>cuisines</h4>
                        </div>                  
                        <div class="filter-items dishe-list">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem1" checked>
                                    <label class="form-check-label" for="filteritem1">American Dishes</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem2" checked>
                                    <label class="form-check-label" for="filteritem2">Pizza</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem3">
                                    <label class="form-check-label" for="filteritem3">Mexican</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem4">
                                    <label class="form-check-label" for="filteritem4">Chinese</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem5" checked>
                                    <label class="form-check-label" for="filteritem5">American Dishes</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="filteritem6" checked>
                                    <label class="form-check-label" for="filteritem6">Pizza</label>
                                </div>
                            </div>
                    </div>          
                </div>
            </div>
      </div>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="close-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></span>
        </button>
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
                                    <input type="email" class="form-control" id="forget_email" placeholder="E-mail">
                                </div>
                            </div>
                        </div>                               
                        <div class="row">                                   
                            <div class="col-sm-6 forgot-btn">
                                <input type="submit" name="register" class="register red-btn" id="pass-submit-btn" value="Submit">
                            </div>
                        </div>                            
                       
                    </form>
                    </div>
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
                                    <label for="loginUsername">Username</label>
                                    <input type="text" class="form-control" id="login_username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" class="form-control" id="login_password">
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

    <!-- Register Modal -->
    <div class="modal fade" id="registerFormModal" tabindex="-1" role="dialog" aria-labelledby="registerFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content pt-4 pb-4">
                <div class="modal-header justify-content-center position-relative">
                    <h5 class="modal-title" id="registerFormModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="register-form" id="register-form">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="registerUsername">Username</label>
                                    <input type="text" class="form-control" id="register_username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="registerEmail">E-mail</label>
                                    <input type="email" class="form-control" id="register_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="registerPassword">Password</label>
                                    <input type="password" class="form-control" id="register_password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="registerConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="register_confpassword">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="acceptTerms">
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

</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

if($('#simple').length)
{    
    var owl = $('#simple');
        owl.owlCarousel({
            loop:true,
            responsiveClass:true,
            nav:true,
            margin:20,
            dots:true,
            items:1,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    loop:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true
                }
            }
        });       
}

});





</script>
