 <!-- Start content -->
<?php
$put_link = base_url().'employee-put';
$back = base_url().'employee-list';

$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
$defualt_url = base_url() . 'assets/images/default/cuisine.jpg';
 if (isset($employee_data->profile_picture) && ($employee_data->profile_picture != '')) {
    if (file_exists($this->config->item("profile_path") . '/'.$employee_data->profile_picture)){
        $photo_url = base_url() . $this->config->item("profile_path") . '/'.$employee_data->profile_picture;
    } 
}
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Update Employee </h4>
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
                <?php echo get_msg();?>
            </div>
            <div class="col-lg-1">
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>" enctype="multipart/form-data">

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
    } else{
        $field_value = stripslashes($employee_data->first_name);
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
    else{
        $field_value = stripslashes($employee_data->last_name);
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
    $field_value = stripslashes($employee_data->email);
    ?>
                                            <input type="text" disabled name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $field_value; ?>">
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
    } else{
        $field_value = $employee_data->role;
    }
    ?>
                                            <select class="select2 form-control" data-placeholder="Select any role" name="role">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($role_data as $key => $value) {
                                                    $selected = '';
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
    } else{
        $field_value = stripslashes($category_data->profile_picture);
    }
    ?>
                                            <input type="file" name="profile_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" id="profile_picture" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('profile_picture'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <img src="<?php echo $photo_url; ?>" class="img-circle profile-avatar small" alt="Employee Profile Picture" id="blah" onerror="this.src='<?php echo $defualt_url; ?>'">
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="employee_id" value="<?php echo $employee_data->id ?>">

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