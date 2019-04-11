 var validator = $(".partner-form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            console.log("error");
            error.insertAfter(element);
        },
        validClass: "validation-valid-label",
        rules: {
            shop_name: {
                required:true,
                minlength:2,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            vender_name: {
                required:true,
                minlength:2,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            email: {
                required:true,
                maxlength:255,
                emailValidation:true,
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
            message: {
                required:false,
                maxlength:1000,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            mobile_number:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 15,
                maxlength: 15,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            shop_name: {
                required: "The restaurant name field is required.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            vender_name: {
                required: "The full name field is required.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            email: {
                required: "The email address field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                emailValidation: "The email address field must contain a valid email address."
            },
            address: {
                required: "The restaurant address field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            message: {
                required: "The message field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            mobile_number: {
                required: "The phone number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The phone number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            }
        },
        submitHandler: function(form) {
            if(($("#latitude").val() == '') || ($("#longitude").val() == '') ||($("#zipcode").val() == '') ||($("#country").val() == '') ||($("#administrative_area_level_2").val() == '') ||($("#administrative_area_level_1").val() == '') )
            {
                swal(
                    'Your address seems wrong',
                    'Please select your address from suggestions',
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
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

$( document ).ready(function() {
    $("#mobile_number").inputmask("+1 999 999 9999",{"placeholder": ""});
});

$(document).on('change','#autocomplete',function(){
    console.log($(this).val());
    $("#latitude").val('');
    $("#longitude").val('');
    $("#zipcode").val('');
    $("#country").val('');
    $("#administrative_area_level_2").val('');
    $("#administrative_area_level_1").val('');
});