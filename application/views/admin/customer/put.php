 <!-- Start content -->
<?php
$put_link = base_url().'customer-update/'.$id;
$prof_defualt_url = 'https://bootdey.com/img/Content/avatar/avatar3.png';
if (isset($customer_detail->profile_picture) && ($customer_detail->profile_picture != '')) {
    $prof_url = base_url() . $this->config->item("customer_profile_path") . '/'.$customer_detail->profile_picture;
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
                    <h4 class="page-title">Update Customer</h4>
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

                                <div class="col-lg-12">
                                    <div class=" m-b-20">
                                        <div class=" row ">
                                            <div class="col-lg-4">
                                            </div>
                                            <div class="col-lg-4 text-center">
                                            <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar" alt="Shop Image" id="blah" onerror="this.src='<?php echo $prof_defualt_url; ?>'">
                                            <i class="mdi mdi-camera"></i>
                                            <input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" />
                                            <input type="hidden" name="old_profile_picture" value="<?php echo $customer_detail->profile_picture; ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="customer_id" value="<?php echo $customer_detail->id; ?>">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Full Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('full_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($customer_detail->full_name);
    }
    ?>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter full name" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('full_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $customer_detail->email; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $customer_detail->contact_no;
    }
    ?>
                                            <input type="number" name="contact_no" class="form-control" id="contact_no" placeholder="Enter contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Address</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $customer_detail->address;
    }
    ?>
                                            <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" class="form-control" type="text" value="<?php echo $field_value; ?>" name="address">
                                            <input type="hidden" id="administrative_area_level_2" name="city">
                                            <input type="hidden" id="administrative_area_level_1" name="state">
                                            <div class="validation-error-label">
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group m-b-0">
                                        <div>
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="<?php echo base_url().'customer-list'; ?>" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
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
<script src="<?php echo base_url().'assets/js/custom/admin/customer.js'; ?>"></script>
