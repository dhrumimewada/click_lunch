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
            email: {
                required:true,
                emailValidation:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            email: {
                required: "The email field is required.",
                emailValidation: "The email field is invalid."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });

