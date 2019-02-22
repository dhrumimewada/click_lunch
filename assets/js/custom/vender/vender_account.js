 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            //console.log("error");
            if (element.parents('div').hasClass('custom-checkbox')) {
                error.appendTo(element.parent().parent());
            }
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible') || element.hasClass('filestyle')) {
                error.appendTo(element.parent());
            }
            else if (element.parents('div').hasClass('input-group')) {
                error.insertAfter(element.parent().parent());
            }
            else{
                error.insertAfter(element);
            }     
        },
        validClass: "validation-valid-label",
        rules: {
            shop_name: {
                required:true,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            vender_name: {
                required:true,
                alpha:true,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            tax_number: {
                required:true,
                valid_taxno:true
            },
            contact_no1:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no2:{
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            address: {
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            city: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            state: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            country: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            zipcode: {
                required:true,
                digits: true,
                maxlength:5,
                minlength:5,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            latitude: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            longitude: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            delivery_morning_from:{
                required: true
            },
            delivery_morning_to:{
                required: true,
                validate_hour_to_time:"#delivery_morning_from"
            },
            delivery_evening_from:{
                required: true
            },
            delivery_evening_to:{
                required: true,
                validate_hour_to_time:"#delivery_evening_from"
            },
            order_by_time:{
                required: true
            },
            delivery_time:{
                required: true,
                validate_hour_to_time:"#order_by_time"
            },
            'cuisines[]': {
                required:true
            },
            website: {
                valid_url:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            min_order:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            delivery_charges:{
                required: false,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            service_charge:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                validate_perc:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            facebook_link: {
                valid_url:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            twitter_link: {
                valid_url:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            pinterest_link: {
                valid_url:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            'payment_mode[]': {
                required:true
            },
            about: {
                required:true,
                minlength: 150,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            profile_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 10
            },
            broacher:{
                accept: "application/pdf",
                filesize: 10
            }
        },
        messages: {

            shop_name: {
                required: "The restaurant title field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed.")
            },
            vender_name: {
                required: "The contact person field is required.",
                alpha:"The contact person field contain only alphabets and space.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed.")
            },
            tax_number:{
                required: "The tax id field is required.",
                valid_taxno:"The tax id field is invalid."
            },
            contact_no1: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            contact_no2: {
                digits: "Enter only numeric value",
                greaterThanZero: "The alternate contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            address: {
                required: "The street field is required."
            },
            city: {
                required: "The city field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            state: {
                required: "The state field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            country: {
                required: "The country field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            zipcode: {
                required: "The zip code field is required.",
                digits: "Enter only numeric value",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            latitude: {
                required: "The latitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            delivery_morning_from:{
                required: "The morning from time field is required."
            },
            delivery_morning_to:{
                required: "The morning to time field is required.",
                validate_hour_to_time: "To time should be more than from time"
            },
            delivery_evening_from:{
                required: "The evening from time field is required."
            },
            delivery_evening_to:{
                required: "The evening to time field is required.",
                validate_hour_to_time: "To time should be more than from time"
            },
            order_by_time:{
                required: "The order by time field is required."
            },
            delivery_time:{
                required: "The delivery time field is required.",
                validate_hour_to_time: "Delivery time should be more than order by time"
            },
            longitude: {
                required: "The longitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            'cuisines[]': {
                required: "Please select at least one cuisine."
            },
            website: {
                required:"The website field is required.",
                valid_url:"The website field is invalid."
            },
            min_order: {
                required: "The minimum order field is required.",
                number: "The minimum order field is invalid.",
                greaterThanZeroEqualTo: "The minimum order field is invalid."
            },
            delivery_charges: {
                required: "The delivery charges field is required.",
                number: "The delivery charges field is invalid.",
                greaterThanZeroEqualTo: "The delivery charges field is invalid."
            },
            service_charge: {
                required: "The service charges field is required.",
                number: "The service charges field is invalid.",
                validate_perc:"The service charges field is invalid.",
                greaterThanZeroEqualTo: "The service charges field is invalid."
            },
            facebook_link: {
                valid_url: "The website field is invalid."
            },
            twitter_link: {
                valid_url: "The website field is invalid."
            },
            pinterest_link: {
                valid_url: "The website field is invalid."
            },
            'payment_mode[]': {
                required: "Please select at least one payment mode."
            },
            about: {
                required: "The description field is required.",
                minlength: jQuery.validator.format("At least {0} digit required")
            },
            profile_picture:{
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 10MB Maximum"
            },
            broacher:{
                accept: "Accepted file formats: pdf",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {

            if(validate_store_time()){
               // console.log('true');
                form.submit();
            }else{
                $(".validation-availibality").append('<label class="validation-error-label" style="">The restaurant availability time field is invalid.</label>');
            }      
           
        }
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("greaterThanZeroEqualTo", function(value, element) {
        return this.optional(element) || value >= 0;
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });
    $.validator.addMethod("valid_url", function(value, element) {
        return this.optional(element) || /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/.test(value);
    });
    $.validator.addMethod("valid_taxno", function(value, element) {
        return this.optional(element) || (value.indexOf('_') < 0);
    });

    $.validator.addMethod("validate_perc", function(value, element) {
        if(parseFloat(value) <= 100 && parseFloat(value) >= 0){
            return true;
        }else{
            return false;
        }
    });

    $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

    $.validator.addMethod("validate_hour_to_time", function(value, element,param) {
        
        var from_t = $(param).val();
        var hour_from = '01/01/2011 '+from_t.toString();
        var hour_to = '01/01/2011 '+value.toString();

        return (Date.parse(hour_to) > Date.parse(hour_from));
    });

$( document ).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
                $(".image-popup-no-margins").attr("href", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#profile_picture', function() {
        readURL(this);
    });

    $(".demo2").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        prefix: '$',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".demo3").TouchSpin({
        forcestepdivisibility: 'none',
        max: 100,
        decimals: 2,
        postfix: '%',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });


    $(".select2").select2();
    $(".tax-mask").inputmask({"mask": "999-99-9999"});

    $("#contact_no1, #contact_no2").inputmask("999 999 9999",{"placeholder": ""});

    $("#zip_code").inputmask("99999",{"placeholder": ""});

    var dt = new Date();
    $.each(available_time, function(k, v) {
        $('.from_time').append($("<option>" , { text: v, value: v }));
        $('.to_time').append($("<option>" , { text: v, value: v }));
    });

    $.each(available_time, function(k, v) {
        $('.hours_from_time').append($("<option>" , { text: v, value: v }));
        $('.hours_to_time').append($("<option>" , { text: v, value: v }));
    });

    // Hours Delivery- Start
    var delivery_morning_from_option = delivery_morning_from.toString();
    var delivery_morning_to_option = delivery_morning_to.toString();

    $('#delivery_morning_from option[value="'+delivery_morning_from_option+'"]').attr('selected', 'selected');
    $('#delivery_morning_to option[value="'+delivery_morning_to_option+'"]').attr('selected', 'selected');

    var delivery_evening_from_option = delivery_evening_from.toString();
    var delivery_evening_to_option = delivery_evening_to.toString();

    $('#delivery_evening_from option[value="'+delivery_evening_from_option+'"]').attr('selected', 'selected');
    $('#delivery_evening_to option[value="'+delivery_evening_to_option+'"]').attr('selected', 'selected');
    // hours Delivery - End

    // Delivery - Order by hours - start
    var delivery_time_option = delivery_time.toString();
    var order_by_time_option = order_by_time.toString();

    $('#delivery_time option[value="'+delivery_time_option+'"]').attr('selected', 'selected');
    $('#order_by_time option[value="'+order_by_time_option+'"]').attr('selected', 'selected');
    // Delivery - Order by - End

    // Shop working Hours - start
    var from_time_option = from_time_selected.toString();
    var to_time_option = to_time_selected.toString();

    $('.from_time option[value="'+from_time_option+'"]').attr('selected', 'selected');
    $('.to_time option[value="'+to_time_option+'"]').attr('selected', 'selected');
    // Shop working Hours - start

    //select from-to time as DB stored
    $.each(shop_availibality, function(k, v) {
         $('tr').each(function(){
            var day = v.day+'[]';
            //console.log(k);
            if($(this).find('#open_'+k).attr('name') == day){
                if(v.is_closed == '0' && v.full_day == '0'){
                    $(this).find('.from_td .from_time option[value="'+v.from_time+'"]').attr('selected', 'selected');
                    $(this).find('.to_td .to_time option[value="'+v.to_time+'"]').attr('selected', 'selected');
                }
                
            }
         });
    });


    $(document).on('click','.fullday',function(){

        if ($(this).is(':checked')){
           $(this).closest('tr').find('.from_td').empty();
           $(this).closest('tr').find('.to_td').empty();
           $(this).closest('tr').find('.from_td').html('<div class="text-center">24 Hours Open</div>');
        }else{

            $(this).closest('tr').find('.from_td').empty();
            $(this).closest('tr').find('.to_td').empty();

            var dataday =  $(this).closest('tr').data("day");

            $(this).closest('tr').find('.from_td').html('<select class="form-control select2 from_time" name="'+dataday+'[]"><option disabled >Select Time</option></select>');
            $(this).closest('tr').find('.to_td').html('<select class="form-control select2 to_time" name="'+dataday+'[]"><option disabled >Select Time</option></select>');

            var this_div = $(this);

            $.each(available_time, function(k, v) {
                this_div.closest('tr').find('.from_time').append($("<option>" , { text: v, value: v }));
                this_div.closest('tr').find('.to_time').append($("<option>" , { text: v, value: v }));
            });

            $('.from_time option[value="'+from_time_option+'"]').attr('selected', 'selected');
            $('.to_time option[value="'+to_time_option+'"]').attr('selected', 'selected');

            $(".select2").select2();
        }
    });

    $(document).on('click','.open',function(){

        if (!$(this).is(':checked')){
           $(this).closest('tr').find('.from_td').empty();
           $(this).closest('tr').find('.to_td').empty();
           $(this).closest('tr').find('.fullday_td').empty();
           $(this).closest('tr').find('.from_td').html('<div class="text-center">CLOSED</div>');
        }else{

            var dataid =  $(this).closest('tr').data("id");
            var dataday =  $(this).closest('tr').data("day");

            $(this).closest('tr').find('.from_td').empty();
            $(this).closest('tr').find('.to_td').empty();

            $(this).closest('tr').find('.from_td').html('<select class="form-control select2 from_time" name="'+dataday+'[]"><option disabled >Select Time</option></select>');
            $(this).closest('tr').find('.to_td').html('<select class="form-control select2 to_time" name="'+dataday+'[]"><option disabled >Select Time</option></select>');

            $(this).closest('tr').find('.fullday_td').html('<input type="checkbox" id="fullday_'+dataid+'" switch="none" class="fullday" value="fullday" name="'+dataday+'[]"><label class="mb-0 mt-1" for="fullday_'+dataid+'" data-on-label="Fullday" data-off-label="Custom"></label>');

            var this_div = $(this);

            $.each(available_time, function(k, v) {
                this_div.closest('tr').find('.from_time').append($("<option>" , { text: v, value: v }));
                this_div.closest('tr').find('.to_time').append($("<option>" , { text: v, value: v }));
            });

            $('.from_time option[value="'+from_time_option+'"]').attr('selected', 'selected');
            $('.to_time option[value="'+to_time_option+'"]').attr('selected', 'selected');

            $(".select2").select2();
        }
    });

 });

    function validate_store_time(){
        var return_val = true;
        $( ".from_time" ).each(function( index ) {
            var from = "11/24/2014 "+ $(this).val();
            var to = "11/24/2014 "+ $(this).closest('tr').find('.to_time').val();

            var fromDate = new Date(from).getTime();
            var toDate = new Date(to).getTime();

            if(fromDate >= toDate){
                return_val =  false;
              }
        });
        return return_val;
    }

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
