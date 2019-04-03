 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        errorPlacement: function(error, element) {
                error.insertAfter(element);
        },
        validClass: "validation-valid-label",
        rules: {
            house_no: {
                required:true,
                maxlength:250,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            street: {
                required:true,
                maxlength:250,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            city: {
                required:true,
                maxlength:250,
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
            nickname: {
                required:false,
                maxlength:250,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            address_type: {
                required:true
            }
        },

        messages: {
            house_no: {
                required: "The house/office number field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            street: {
                required: "The street field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            city: {
                required: "The city field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            zipcode: {
                required: "The zipcode field is required.",
                digits: "Enter only numeric value",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            nickname: {
                required: "The nick name field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            address_type: {
                required: "The address type field is required.",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


 $( document ).ready(function() {
     $("#zipcode").inputmask("99999",{"placeholder": ""});
 });    