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
            password:{
                required: true,
                minlength: 6,
                maxlength:50
            },
            cpassword:{
                required: true,
                equalTo: "#password"
            }
        },
        messages: {

            password: {
                required: "The password field is required.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            cpassword: {
                required: "The confirm password field is required.",
                equalTo: "Please enter the same password as above."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

