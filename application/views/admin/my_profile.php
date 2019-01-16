 <!-- Start content -->
 <?php
 //echo "<pre>"; print_r($_SESSION); 
 $update_link = base_url().'my-profile';

 if (isset($user_data->profile_picture) && ($user_data->profile_picture != '')) {
    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$user_data->profile_picture;
} else {
    $prof_url = 'https://bootdey.com/img/Content/avatar/avatar3.png';
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
                            <div class="col-12 text-center">

                                <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar pointer" alt="User avatar" id="blah"  onerror="this.src='https://bootdey.com/img/Content/avatar/avatar3.png'">

                                <input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" class="input-file upload-img"/>
                                <h4 class="mt-3"><span class="pointer upload-txt">Upload Photo</span></h4>

                            </div>

                        </div>
                    </div>

                    <div class="card m-b-20">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Update Info</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                            </div>
                           
                                <div class="form-group">
                                    <label class="required" for="username">Full Name</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('username');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = $user_data->username;
}
?>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter full name" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('username'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <div>
                                        <input type="text" disabled name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $user_data->email; ?>">
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
<script src="assets/js/custom/admin/my_profile.js"></script>