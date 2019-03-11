<?php
$home_link = base_url().'welcome';
$update_link = base_url().'contact-info';
$reset_pw_link = base_url().'reset-password';

$name = str_replace(' ', '+', stripslashes($customer['username']));
$prof_defualt_url = $prof_url = 'https://ui-avatars.com/api/?size=200&name='.$name.'&background=fff&color=D3D3D3';
if (isset($customer['profile_picture']) && ($customer['profile_picture'] != '')) {
    $prof_url = base_url() . $this->config->item("customer_profile_path") . '/'.$customer['profile_picture'];
}
?>
<style type="text/css" media="screen">
	label.validation-error-label{
		font-size: 1rem !important;
	}
</style>
<div id="content">
	<div class="favourites-order-wrapper order-history-wrapper grey-bg">
		<div class="container">
			<div class="profile-block white-bg">
				<?php echo get_msg(); ?>
				<form class="form-profile" method="post" enctype="multipart/form-data" action="<?php echo $update_link; ?>">
					<div class="profile-image text-center">
						<img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar pointer" alt="Customer Image" id="blah" onerror="this.src='<?php echo $prof_defualt_url; ?>'">
						<input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;"   class="input-file upload-img"/>
                        <input type="hidden" name="old_profile_picture" value="<?php echo $prof_url; ?>">
                        <h4 class="mt-3"><span class="pointer upload-txt">Upload Photo</span></h4>
					</div>
					<div class="profile-detail row m-0">
						<div class="form-group col-md-12">
							<label class="required" for="username">Full Name</label>
							<?php
    $field_value = NULL;
    $temp_value = set_value('username');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($customer['username']);
    }
    ?>
						    <input type="text" class="form-control" id="username" name="username" value="<?php echo $field_value; ?>" />
						    <div class="validation-error-label">
                                <?php echo form_error('username'); ?>
                            </div>
						</div>
						<div class="form-group col-md-6">
							<label for="email">Email Id</label>
						    <input type="text" class="form-control" id="email" name="email" value="<?php echo stripslashes($customer['email']); ?>" readonly/>
						    <div class="validation-error-label">
                                <?php echo form_error('email'); ?>
                            </div>
						</div>
						<div class="form-group col-md-6 num-code">
							<label class="required" for="mobile_number">Mobile Number</label>
							<?php
    $field_value = NULL;
    $temp_value = set_value('mobile_number');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $customer['mobile_number'];
    }
    ?>
						    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $field_value; ?>" />
                            
                            <div class="validation-error-label">
                                <?php echo form_error('mobile_number'); ?>
                            </div>
						</div>
						<div class="form-group col-md-6">
							<label class="required" for="dob">Date of Birth</label>
							<?php
    $field_value = NULL;
    $temp_value = set_value('dob');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $dob = date('Y-m-d', strtotime($customer['dob']));
        $field_value = date("d-m-Y", strtotime($dob));
    }
    ?>
						    <input type="text" class="form-control datepicker-autoclose" id="dob" name="dob" value="<?php echo $field_value; ?>" />
						    <div class="validation-error-label">
                                <?php echo form_error('dob'); ?>
                            </div>
						</div>
						<div class="form-group col-md-6">
							<label class="required" for="usergender">Gender</label>
						    <div class="gender delivery-address d-flex row m-0">
						    	<?php
    $field_value = NULL;
    $temp_value = set_value('gender');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $customer['gender'];
    }
    ?>
						    	<div class="form-check col-md-6">
									<input class="form-check-input" type="radio" name="gender" id="genderRadios1" value="0" <?php echo ($field_value == 0)?'checked':'' ?>>
									<label class="form-check-label" for="genderRadios1">Male</label>
								</div>
								<div class="form-check col-md-6">
									<input class="form-check-input" type="radio" name="gender" id="genderRadios2" value="1" <?php echo ($field_value == 1)?'checked':'' ?>>
									<label class="form-check-label" for="genderRadios2">Female</label>
								</div>
						    </div>
						    <div class="validation-error-label">
                                <?php echo form_error('gender'); ?>
                            </div>
						</div>
					</div>
					<div class="submit-buttons form-actions d-flex justify-content-center">
						<a href="<?php echo $reset_pw_link; ?>" class="resetpass white-btn">Reset Password</a>
						<input type="submit" name="submit" class="save small-red-btn" id="save" value="Save" />
					</div>
					<div class="form-actions d-flex justify-content-center">
						<a href="<?php echo $home_link; ?>" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'web-assets/js/custom/profile.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>