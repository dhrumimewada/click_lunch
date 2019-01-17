 <!-- Start content -->
 <?php
 $post_link = base_url().'delivery-boy-save';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Delivery Boy</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $post_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">
                    <div class="card m-b-20">
                        <div class="card-body">
                            
                            <div class="row m-b-20">
                                <div class="col-12 text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="img-circle profile-avatar" alt="User avatar" id="blah" onerror="this.src='https://bootdey.com/img/Content/avatar/avatar3.png'" >

                                    <input type='file' name="profile_picture" id="imgInp" accept="image/*" style="visibility:hidden; position: absolute;" class="input-file upload-img"/>
                                    <h4 class="mt-3 pointer upload-txt">Upload Photo</h4>
                                </div>
                             </div>


                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="username" class="required">Full Name</label>
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
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="email">Email</label>
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
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
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
                                </div>

                                <div class="col-lg-6">
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
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobile_number" class="required">Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('mobile_number');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="mobile_number" name="mobile_number" class="form-control" id="mobile_number" placeholder="XXX XXX XXXX" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('mobile_number'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="autocomplete">Street</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input id="autocomplete" placeholder="Enter street" onFocus="geolocate()" class="form-control" type="text" value="<?php echo $field_value; ?>" name="address" >
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city" class="required">City</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('city');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
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

                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group m-b-0">
                                        <div>
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="<?php echo base_url().'delivery-boy-list'; ?>" class="btn btn-secondary waves-effect m-l-5">
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
<script src="<?php echo base_url().'assets/js/custom/dispatcher/delivery_boy.js'; ?>"></script>
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