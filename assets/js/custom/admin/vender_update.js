 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            console.log("error");
            if (element.parents('div').hasClass('custom-checkbox')) {
                error.appendTo(element.parent().parent().parent());
            }else if (element.hasClass('upload-img')) {
                    error.appendTo(element.parent());
            }else if (element.parents('div').hasClass('input-group')) {
                error.insertAfter(element.parent().parent());
            }else{
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
            email: {
                required:true,
                emailValidation:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            vender_name: {
                required:true,
                alpha:true,
                maxlength:50,
                minlength:3,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            address: {
                required:true,
                maxlength:255,
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
                maxlength:6,
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
            contact_no1:{
                required: false,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no2:{
                required: false,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            website: {
                required:false,
                valid_url:true,
                maxlength: 2083,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            tax_number: {
                required:true,
                valid_taxno:true
            },
            'payment_mode[]': {
                required:true
            },
            delivery_charges:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            minimum_mile:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            charges_of_minimum_mile:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            profile_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 2
            }
        },
        messages: {

            shop_name: {
                required: "The restaurant name field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            email: {
                required: "The email field is required.",
                emailValidation: "The email field is invalid."
            },
            vender_name: {
                required: "The contact person name field is required.",
                alpha:"The contact person name field contain only alphabets and space.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            address: {
                required: "The street field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
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
            longitude: {
                required: "The longitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            contact_no1: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            contact_no2: {
                required: "The alternate contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The alternate contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            website: {
                required:"The website field is required.",
                valid_url:"The website field is invalid.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            tax_number:{
                required: "The tax id field is required.",
                valid_taxno:"The tax id field is invalid."
            },
            delivery_charges: {
                required: "The delivery charges field is required.",
                number: "The delivery charges field is invalid.",
                greaterThanZeroEqualTo: "The delivery charges field is invalid."
            },
            minimum_mile: {
                required: "The minimum mile field is required.",
                number: "The minimum mile field is invalid.",
                greaterThanZeroEqualTo: "The minimum mile field is invalid."
            },
            charges_of_minimum_mile: {
                required: "The charges of minimum mile field is required.",
                number: "The charges of minimum mile field is invalid.",
                greaterThanZeroEqualTo: "The charges of minimum mile field is invalid."
            },
            'payment_mode[]': {
                required: "Please select at least one payment mode."
            },
            profile_picture:{
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 2MB Maximum"
            }
        },
        submitHandler: function(form) {

            if($('#latitude').val() == '' || $('#longitude').val() == ''){
                swal(
                    'Your restaurant address seems wrong',
                    'Please select address from google suggestion',
                    'warning'
                )
            }else{
                form.submit();
            }
            
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });
    $.validator.addMethod("greaterThanZeroEqualTo", function(value, element) {
        return this.optional(element) || value >= 0;
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

    $(".tax-mask").inputmask("999-99-9999",{"placeholder": ""});
    $("#contact_no1, #contact_no2").inputmask("999 999 9999",{"placeholder": ""});
    $("#zipcode").inputmask("999999",{"placeholder": ""});

    $(document).on('click', '.upload-txt, #blah', function(){
        $('#imgInp').click();
        $('#blah').attr('src', 'https://bootdey.com/img/Content/avatar/avatar6.png');
        return false;
    });

    $(".demo3").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".demo2").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        prefix: '$',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#imgInp', function() {
        readURL(this);
    });

    
 });