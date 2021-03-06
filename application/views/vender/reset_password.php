<!DOCTYPE html>
<html lang="en">
<!-- Account Activation set password -->
<?php
$this->load->view('template/header');
 if($user_type == 'employee'){
    $setpw_link = base_url()."employee-reset-password";
 }elseif ($user_type == 'vender') {
    $setpw_link = base_url()."vender-reset-password";
 }elseif ($user_type == 'customer') {
    $setpw_link = base_url()."customer-reset-password";
 }else{
    $setpw_link = '#';
 }
?>

<body>
    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card">
                <div class="card-body">
                    <?php echo get_msg(); //print_r($_REQUEST); ?>
                    <h3 class="text-center m-0">
                        <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url().'assets/images/click-lunch.png'; ?>" height="100" alt="logo"></a>
                    </h3>
                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome !</h4>
                        <p class="text-muted text-center">Set password to continue to Click Lunch.</p>

                        <form class="form-horizontal m-t-30 form-validate" method="post" action="<?php echo $setpw_link; ?>">

                            <div class="form-group">
                                <label for="password">Password</label>
                                <?php
$field_value = NULL;
$temp_value = set_value('password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('password'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <?php
$field_value = NULL;
$temp_value = set_value('cpassword');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Enter confirm password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('cpassword'); ?>
                                </div>
                            </div>

                            <input type="hidden" name="token" value="<?php echo $token; ?>">

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="submit">Set Password</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        <div class="m-t-40 text-center">
            <p>© 2018 Lexa. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
        </div>
    </div>

    <script src="<?php echo base_url().'assets/js/custom/admin/setpassword_vender.js'; ?>"></script>

</body>

</html>