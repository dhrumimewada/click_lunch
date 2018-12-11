 var validator = $(".form-validate").validate({

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
            emat_email_subject: {
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            emat_email_subject: {
                required: "The email subject field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

