<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/header');
$register_link = base_url()."register";
?>

<body>
    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">

                <h3 class="text-center m-0">
                    <a href="index.html" class="logo logo-admin"><img src="assets/images/logo.png" height="30" alt="logo"></a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Free Register</h4>
                    <p class="text-muted text-center">Get your free fonik account now.</p>

                    <form class="form-horizontal m-t-30 form-validate" method="post" action="<?php echo $register_link; ?>">

                        <div class="form-group">
                            <label for="useremail">Email</label>
                            <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">
                            <div class="validation-error-label">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                            <div class="validation-error-label">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                            <div class="validation-error-label">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <input class="btn btn-primary w-md waves-effect waves-light" name="register" type="submit" value="Register">
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <p class="font-14 text-muted mb-0">By registering you agree to the Lexa <a href="#" class="text-primary">Terms of Use</a></p>
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

    <script src="assets/js/custom/register.js"></script>

</body>

</html>