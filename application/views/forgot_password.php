<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/header');
$forgot_link = '#';
$vender_login_link = '#';


 if($user_type == 'employee'){

    $forgot_link = base_url()."employee-forgot-password";
    $vender_login_link = base_url() . "login-employee";

 }elseif ($user_type == 'vender') {

    $forgot_link = base_url()."vender-forgot-password";
    $vender_login_link = base_url() . "login-vender";

 }else{
 }

?>

<body>
    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card">
                <div class="card-body">
                    <?php echo get_msg(); ?>
                    <h3 class="text-center m-0">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/click-lunch.png" height="80" alt="logo"></a>
                    </h3>
                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Forgot Password</h4>
                        <p class="text-muted text-center">We can help you, please enter your email address</p>

                        <form class="form-horizontal m-t-30 form-validate" method="post" action="<?php echo $forgot_link; ?>">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <?php
$field_value = NULL;
$temp_value = set_value('email');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('email'); ?>
                                </div>
                            </div>

                          
                            <input type="hidden" value="<?php echo $user_type; ?>" name="user_type">

                            <div class="form-group row m-t-20">
                                <div class="col-6 m-t-10">
                                    <a href="<?php echo $vender_login_link; ?>" class="text-muted"><i class="mdi mdi-arrow-left"></i> Back to login</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="submit">Send Reset Link</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        <div class="m-t-40 text-center">
            <p>&#169; 2018 Click lunch - Crafted with <i class="mdi mdi-heart text-danger"></i> by Excellent WebWorld</p>
        </div>
    </div>

    <script src="assets/js/custom/forgot_password.js"></script>

</body>

</html>