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
            },
            username:{
                required: true,
                alpha:true,
                minlength:3,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            password:{
                required: true,
                minlength: 6
            }
        },
        messages: {

            email: {
                required: "The email field is required.",
                emailValidation: "The email field is invalid."
            },
            username: {
                required: "The username field is required.",
                alpha: "The username field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            password: {
                required: "The password field is required.",
                minlength: jQuery.validator.format("At least {0} characters required")
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });

$( document ).ready(function() {
     //console.log("register");
 });

