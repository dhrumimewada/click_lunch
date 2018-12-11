 <!-- Start content -->
 <?php
 $post_link = base_url().'employee-add';
 $back = base_url().'employee-list';
$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Employee</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $post_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

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
                                        <label class="required">Email</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Account activation mail will send on this email address"></i>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('email');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Role</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Privileges of account will be assigned based on role"></i>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('role');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
        $selected = '';
    } 
    ?>
                                            <select class="select2 form-control" data-placeholder="Select any role" name="role">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($role_data as $key => $value) {
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$value['id']."' ".$selected.">".$value['role_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('role'); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('profile_picture');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="file" name="profile_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="" id="profile_picture">
                                            <div class="validation-error-label">
                                                <?php echo form_error('profile_picture'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <img src="<?php echo $photo_url; ?>" class="img-circle profile-avatar small" alt="Employee Profile Picture" id="blah" onerror="this.src='<?php echo $photo_url; ?>'">
                                    </div>
                                </div>
                            </div>


                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="<?php echo $back; ?>" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </a>
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
<script src="<?php echo base_url().'assets/js/custom/vender/employee.js'; ?>"></script>