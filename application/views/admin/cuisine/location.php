<?php
$edit_link = base_url().'cuisine-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Location</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="admin-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Address</label>
                                        <div>

                                            <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" class="form-control" type="text" name="address">
                                            <input type="hidden" id="administrative_area_level_2" name="city">
                                            <input type="hidden" id="administrative_area_level_1" name="state">
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
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

  // console.log(place.address_components);
   if (typeof place.address_components != "undefined" || place.address_components != null){
        for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++){
                if (place.address_components[i].types[j] == "postal_code") {
                 // console.log(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "country") {
                  //console.log(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                    //state
                  //console.log(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_2") {
                    //city
                  console.log(place.address_components[i].long_name);
                }
            }
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                $('#addressType').value = val;
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
