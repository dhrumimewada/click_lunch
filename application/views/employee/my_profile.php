<!-- Start content -->
<?php
$put_link = base_url().'employee-profile';

$prof_url = 'https://bootdey.com/img/Content/avatar/avatar6.png';

if (isset($employee_detail->profile_picture) && ($employee_detail->profile_picture != '')) {
    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$employee_detail->profile_picture;
}
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">My Profile</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $update_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">
                    <div class="card m-b-20">
                        <div class="card-body row ">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4 text-center">
                            <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar" alt="User avatar" id="blah">
                            <i class="mdi mdi-camera"></i>
                            </div>
                            <div class="col-lg-4">
                                <input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" />
                            </div>
                        </div>
                    </div>

                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">First Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('first_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($employee_detail->first_name);
    }
    ?>
                                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter first name" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('first_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Last Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('last_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($employee_detail->last_name);
    }
    ?>
                                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('last_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div>
                                        <?php 
                                        $field_value = stripslashes($employee_detail->email);
                                        ?>
                                            <label name="email" class="form-control" value=""><?php echo $field_value; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($employee_detail->contact_no);
    }
    ?>
                                            <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Name</label>
                                        <div>
                                        <?php 
                                        $field_value = stripslashes($employee_detail->shop_name);
                                        ?>
                                            <label name="shop_name" class="form-control" value=""><?php echo $field_value; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <div>
                                        <?php 
                                        $field_value = $employee_detail->role_name;
                                        ?>
                                            <label name="role_name" class="form-control" value=""><?php echo $field_value; ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
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
<script src="assets/js/custom/employee/my_profile.js"></script>
