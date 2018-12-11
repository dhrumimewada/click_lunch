<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/header');
$login_link = base_url()."login-admin";
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
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to Fonik.</p>

                        <form class="form-horizontal m-t-30 form-validate" method="post" action="<?php echo $login_link; ?>">

                            <div class="form-group">
                                <label for="email">email</label>
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

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <?php
$field_value = NULL;
$temp_value = set_value('password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('password'); ?>
                                </div>
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        <div class="m-t-40 text-center">
            <p>Already have an account ? <a href="pages-login.html" class="text-primary"> Login </a> </p>
            <p>© 2018 Lexa. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
        </div>
    </div>

    <script src="assets/js/custom/admin/admin_login.js"></script>

</body>

</html>