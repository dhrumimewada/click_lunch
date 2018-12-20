 <!-- Start content -->
 <?php
 $put_link = base_url().'vender-update/'.$id;
 // Explode payment mode

 $payment_mode = array();
 $payment_mode = explode(",",$vender_detail->payment_mode);
$prof_defualt_url = 'https://bootdey.com/img/Content/avatar/avatar3.png';
if (isset($vender_detail->profile_picture) && ($vender_detail->profile_picture != '')) {
    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$vender_detail->profile_picture;
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
                    <h4 class="page-title">Update Restaurant</h4>
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
                                            <input type="hidden" name="old_profile_picture" value="<?php echo $vender_detail->profile_picture; ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Basic Info</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Shop Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('shop_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->shop_name);
    }
    ?>
                                            <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="Enter shop name" value='<?php echo $field_value; ?>'>
                                            <input type="hidden" name="shop_id" value="<?php echo $vender_detail->id; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('shop_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Email</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('email');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->email;
    }
    ?>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter shop email" value="<?php echo $field_value; ?>" readonly>
                                            <div class="validation-error-label">
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Owner Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('vender_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->vender_name);
    }
    ?>
                                            <input type="vender_name" name="vender_name" class="form-control" id="vender_name" placeholder="Enter owner name" value='<?php echo $field_value; ?>'>
                                            <div class="validation-error-label">
                                                <?php echo form_error('vender_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Code</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('shop_code');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->shop_code);
    }
    ?>
                                            <input type="text" name="shop_code" class="form-control disabled" id="shop_code" placeholder="Enter shop code" readonly value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('shop_code'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="loader" style="display: none;"></div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Contact information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no1');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $vender_detail->contact_no1;
    }
    ?>
                                            <input type="text" name="contact_no1" class="form-control" id="contact_no1" placeholder="Enter contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no1'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Alternate Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no2');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->contact_no2;
    }
    ?>
                                            <input type="text" name="contact_no2" class="form-control" id="contact_no2" placeholder="Enter alternate contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no2'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Location</h4>
                                    <hr class="mt-1 mb-3">
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Address/Landmark</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->address);
    }
    ?>
                                            <input id="autocomplete" placeholder="Enter address or landmark" onFocus="geolocate()" class="form-control" type="text" value='<?php echo $field_value; ?>' name="address">
                                            <input type="hidden" id="administrative_area_level_2" name="city">
                                            <input type="hidden" id="administrative_area_level_1" name="state">
                                            <div class="validation-error-label">
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('city');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->city;
    }
    ?>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" readonly value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('state');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->state;
    }
    ?>
                                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter state" readonly value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('state'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Shop Information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Website</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('website');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = stripslashes($vender_detail->website);
    }
    ?>
                                            <input type="text" name="website" class="form-control" id="website" placeholder="Enter shop website" value='<?php echo $field_value; ?>'>
                                            <div class="validation-error-label">
                                                <?php echo form_error('website'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>TAX Number/GST</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('tax_number');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->tax_number;
    }
    ?>
                                            <input type="text" name="tax_number" class="form-control tax-mask" id="tax_number" placeholder="Enter TAX number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('tax_number'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Payment</label>
                                        <div class="d-block mt-2">
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("0", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("0", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline" value="0" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline">Card</label>
                                            </div>
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("1", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("1", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline1" value="1" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline1">Apple Pay</label>
                                            </div>
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("2", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("2", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline2" value="2" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline2">Google Pay</label>
                                            </div>
                                        </div>
                                        <div class="validation-error-label">
                                            <?php echo form_error('payment_mode[]'); ?>
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
                                            <a href="<?php echo base_url().'vender-list'; ?>" class="btn btn-secondary waves-effect m-l-5">
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
<script src="<?php echo base_url().'assets/js/custom/admin/vender_update.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>

<script>

  var placeSearch, autocomplete;

  var componentForm = {

        administrative_area_level_2: 'long_name',
        administrative_area_level_1: 'long_name'
      };

  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
       (document.getElementById('autocomplete')),
        {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    var place = autocomplete.getPlace();

     for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    console.log(place.address_components);

    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  function geolocate() {
    $('.loader').show();
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
     $('.loader').hide();
  }
</script>
<?php
$google_key = $this->config->item("google_key");
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_key; ?>&libraries=places&callback=initAutocomplete" async defer></script>