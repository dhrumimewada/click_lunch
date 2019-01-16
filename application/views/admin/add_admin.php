 <!-- Start content -->
 <?php
 //echo "<pre>"; var_dump($_SESSION); 
 $add_admin_link = base_url().'add_admin';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Admin</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $add_admin_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">
                    <div class="card m-b-20">
                        <div class="card-body row ">
                            <div class="col-12 text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar pointer" alt="User avatar" id="blah" onerror="this.src='https://bootdey.com/img/Content/avatar/avatar6.png'">
                                <input type='file' class="input-file upload-img" name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" />
                                <h4 class="mt-3 pointer upload-txt">Upload Photo</h4>
                            </div>
                            

                        </div>
                    </div>

                    <div class="card m-b-20">
                        <div class="card-body">

                            <div class="col-lg-12 mt-2 mb-1">
                                <h4 class="row mt-0 mb-0 header-title">Admin Information</h4>
                                <hr class="row mt-1 mb-3">
                            </div>
                           
                                <div class="form-group">
                                    <label class="required">Full Name</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('username');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter full name" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('username'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required">Email</label>
                                    <div>
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
                                </div>

                                <div class="form-group">
                                    <label class="required">Password</label>
                                    <div>
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
                                </div>

                                <div class="form-group">
                                    <label class="required">Confirm Password</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('c_password');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Enter confirm password" value="<?php echo $field_value; ?>">
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
                                        <a href="<?php echo base_url().'admin-list'; ?>" class="btn btn-secondary waves-effect m-l-5">
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
<script src="assets/js/custom/admin/add_admin.js"></script>