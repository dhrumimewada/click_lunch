<!-- Start content -->
<?php
$put_link = base_url().'dispatcher-profile';

$prof_url = $prof_defualt_url = 'https://bootdey.com/img/Content/avatar/avatar6.png';

if (isset($dispatcher_detail->profile_picture) && ($dispatcher_detail->profile_picture != '')) {
    $prof_url = base_url() . $this->config->item("profile_path") . '/'.$dispatcher_detail->profile_picture;
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
                        <div class="card-body row text-center">

                            <div class="col-12 text-center">
                                <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar" alt="User avatar" id="blah" onerror="this.src='<?php echo $prof_defualt_url; ?>'" >

                                <input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" class="input-file upload-img"/>
                                <h4 class="mt-3 pointer upload-txt">Upload Photo</h4>

                            </div>

                        </div>
                    </div>

                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="full_name" class="required">Full Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('full_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->full_name);
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
                                        <?php 
                                        $field_value = stripslashes($dispatcher_detail->email);
                                        ?>
                                            <label name="email" class="form-control" value=""><?php echo $field_value; ?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="contact_no">Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->contact_no);
    }
    ?>
                                            <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="XXX XXX XXXX" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address" class="required">Street</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->address);
    }
    ?>
                                            <input id="autocomplete" placeholder="Enter street" onFocus="geolocate()" class="form-control" type="text" value="<?php echo $field_value; ?>" name="address">
                                            <input type="hidden" id="administrative_area_level_2" name="city">
                                            <input type="hidden" id="administrative_area_level_1" name="state">
                                            
                                            <div class="validation-error-label">
                                                <?php echo form_error('address'); ?>
                                            </div>
                                            <div class="validation-error-label">
                                                <?php echo form_error('latitude'); ?>
                                            </div>
                                            <div class="validation-error-label">
                                                <?php echo form_error('longitude'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city" class="required">City</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('city');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->city);
    }
    ?>
                                            <input type="text" name="city" class="form-control city" id="city" value="<?php echo $field_value; ?>" placeholder="Enter city">
                                            <div class="validation-error-label">
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state" class="required">State</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('state');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->state);
    }
    ?>
                                            <input type="text" name="state" class="form-control state" id="state" value="<?php echo $field_value; ?>" placeholder="Enter state">
                                            <div class="validation-error-label">
                                                <?php echo form_error('state'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="country" class="required">Country</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('country');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->country);
    }
    ?>
                                            <input type="text" name="country" class="form-control country" id="country" value="<?php echo $field_value; ?>" placeholder="Enter country">
                                            <div class="validation-error-label">
                                                <?php echo form_error('country'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="zipcode" class="required">Zip Code</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('zipcode');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($dispatcher_detail->zip_code);
    }
    ?>
                                            <input type="text" name="zipcode" class="form-control zipcode" id="zipcode" value="<?php echo $field_value; ?>" placeholder="XXXXX">
                                            <div class="validation-error-label">
                                                <?php echo form_error('zipcode'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="latitude" id="latitude" value="<?php echo $dispatcher_detail->latitude; ?>">
                            <input type="hidden" name="longitude" id="longitude" value="<?php echo $dispatcher_detail->longitude; ?>">

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
<script src="assets/js/custom/dispatcher/my_profile.js"></script>
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
        {types: ['geocode'] , componentRestrictions: {country: "us"} });
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    var place = autocomplete.getPlace();

     for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

   if (typeof place.address_components != "undefined" || place.address_components != null){

    $('#latitude').val(place.geometry.location.lat());
    $('#longitude').val(place.geometry.location.lng());

    console.log(place.address_components);

        for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++){
                if (place.address_components[i].types[j] == "postal_code") {
                    $('.zipcode').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "country") {
                    $('.country').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                    $('.state').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_2") {
                    $('.city').val(place.address_components[i].long_name);
                }
            }
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
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

        // console.log(geolocation);
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