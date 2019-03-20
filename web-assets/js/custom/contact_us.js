 var validator = $(".contact-form").validate({

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
            name: {
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
            subject: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            message: {
                required:true,
                maxlength:1000,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            name: {
                required: "The full name field is required.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            email: {
                required: "The e-mail field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                emailValidation: "The e-mail field must contain a valid email address."
            },
            subject: {
                required: "The subject field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            message: {
                required: "The message field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            contact_no: {
                required: "The phone number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The phone number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

$( document ).ready(function() {
    $("#contact_no").inputmask("999 999 9999",{"placeholder": ""});
});