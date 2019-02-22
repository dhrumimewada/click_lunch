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
            tax: {
                required:true,
                number: true,
                maxlength:10,
                greaterThanZeroEqualTo:true,
                validate_perc:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
            
        },
        messages: {
            tax: {
                required: "The TAX field is required.",
                number: "The TAX field is invalid.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                validate_perc:"The TAX field should be less than 100.00",
                greaterThanZeroEqualTo: "The TAX field is invalid."
            }
            
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  $.validator.addMethod("greaterThanZeroEqualTo", function(value, element) {
        return this.optional(element) || value >= 0;
    });

  $.validator.addMethod("validate_perc", function(value, element) {
        if(parseFloat(value) <= 100){
            return true;
        }else{
            return false;
        }
    });

