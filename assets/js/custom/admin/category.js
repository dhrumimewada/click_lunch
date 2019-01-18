 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                    error.insertAfter(element);   
        },
        validClass: "validation-valid-label",
        rules: {
            category_name: {
                required:true,
                minlength: 2,
                maxlength: 50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            category_name: {
                required: "The category name field is required.",
                minlength: jQuery.validator.format("At least {0} character required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
