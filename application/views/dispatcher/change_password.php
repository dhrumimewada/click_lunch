 <!-- Start content -->
 <?php
 //echo "<pre>"; var_dump($_SESSION); 
 $change_pw_link = base_url().'dispatcher-change-password';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
            <div class="col-lg-1">
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <?php echo get_msg(); ?>
            </div>
            <div class="col-lg-1">
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $change_pw_link; ?>">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

                    <div class="card m-b-20">
                        <div class="card-body">

                                <div class="form-group">
                                    <label>Current Password</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('old_password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter current password" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('old_password'); ?>
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('c_password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Enter confirm new password" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('c_password'); ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Reset
                                        </button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div> 

                <div class="col-lg-1">
                </div>

            </div> <!-- end row -->
        </form>

    </div>
</div>
<script src="<?php echo base_url().'assets/js/custom/admin/change_password.js'; ?>"></script>