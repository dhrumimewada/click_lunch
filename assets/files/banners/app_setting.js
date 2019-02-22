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
            appname_1: {
                required:true,
                version_valid: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            appname_2: {
                required:true,
                version_valid: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            appname_3: {
                required:true,
                version_valid: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            appname_4: {
                required:true,
                version_valid: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            appname_5: {
                required:true,
                version_valid: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
            
        },
        messages: {
            appname_1: {
                required: "The app version field is required.",
                version_valid: "The app version field is invalid.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            appname_2: {
                required: "The app version field is required.",
                version_valid: "The app version field is invalid.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            appname_3: {
                required: "The app version field is required.",
                version_valid: "The app version field is invalid.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            appname_4: {
                required: "The app version field is required.",
                version_valid: "The app version field is invalid.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            appname_5: {
                required: "The app version field is required.",
                version_valid: "The app version field is invalid.",
                minlength: jQuery.validator.format("At least {0} character required")
            }
            
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("version_valid", function(value, element) {
        return this.optional(element) || value == value.match(/^[0-9.]+$/);
    });


