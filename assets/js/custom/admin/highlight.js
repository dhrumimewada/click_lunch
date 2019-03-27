 var validator = $(".form-validate1").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                    error.insertAfter(element);   
        },
        validClass: "validation-valid-label",
        rules: {
            txt1: {
                required:true,
                maxlength: 8,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            txt2: {
                required:true,
                maxlength: 255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            txt3: {
                required:true,
                maxlength: 255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            highlight_id: {
                required:true
            }
        },
        messages: {
            txt1: {
                required: "The highlight text1 field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            txt2: {
                required: "The highlight text2 field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            txt3: {
                required: "The highlight text3 field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            highlight_id:{
                required: "The highlight id field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
