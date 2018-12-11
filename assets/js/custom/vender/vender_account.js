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
            tag_line: {
                maxlength:70,
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
                valid_taxno:true
            },
            contact_no1:{
                required: true,
                digits: true,
                greaterThanZero:true,
                minlength: 10,
                maxlength: 15,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no2:{
                digits: true,
                greaterThanZero:true,
                minlength: 10,
                maxlength: 15,
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
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
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
                accept: "image/jpg, image/jpeg, image/png, application/pdf",
                filesize: 10
            }
        },
        messages: {

            shop_name: {
                required: "The shop title field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed.")
            },
            tag_line: {
                maxlength: jQuery.validator.format("Maximum {0} characters allowed.")
            },
            vender_name: {
                required: "The owner name field is required.",
                alpha:"The owner name field contain only alphabets and space.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed.")
            },
            tax_number:{
                valid_taxno:"The tax number field is invalid."
            },
            contact_no1: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} digit allowed.")
            },
            contact_no2: {
                digits: "Enter only numeric value",
                greaterThanZero: "The alternate contact number field is invalid.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} digit allowed.")
            },
            address: {
                required: "The address field is required."
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
                greaterThanZeroEqualTo: "The minimum order field is invalid.",
            },
            delivery_charges: {
                required: "The delivery charges field is required.",
                number: "The delivery charges field is invalid.",
                greaterThanZeroEqualTo: "The delivery charges field is invalid.",
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
                accept: "Accepted file formats: jpg, jpeg, png, pdf",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {

            if(validate_store_time()){
               // console.log('true');
                form.submit();
            }else{
                $(".validation-availibality").append('<label class="validation-error-label" style="">The shop availability time field is invalid.</label>');
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

    $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

$( document ).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
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


    $(".select2").select2();
    $(".tax-mask").inputmask({"mask": "999-99-9999"});
    var dt = new Date();
    $.each(available_time, function(k, v) {
        $('.from_time').append($("<option>" , { text: v, value: v }));
        $('.to_time').append($("<option>" , { text: v, value: v }));
    });

    var from_time_option = from_time_selected.toString();
    var to_time_option = to_time_selected.toString();

    $('.from_time option[value="'+from_time_option+'"]').attr('selected', 'selected');
    $('.to_time option[value="'+to_time_option+'"]').attr('selected', 'selected');

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

    //console.log(place.address_components);

    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }


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

