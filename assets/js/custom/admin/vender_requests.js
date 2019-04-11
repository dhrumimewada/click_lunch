 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            console.log("error");
            if (element.parents('div').hasClass('custom-checkbox')) {
                error.appendTo(element.parent().parent().parent());
            }else if (element.hasClass('upload-img')) {
                    error.appendTo(element.parent());
            }else if (element.parents('div').hasClass('input-group')) {
                error.insertAfter(element.parent().parent());
            }else{
                error.insertAfter(element);
            }     
        },
        validClass: "validation-valid-label",
        rules: {
            delivery_charges:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            minimum_mile:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            charges_of_minimum_mile:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            delivery_charges: {
                required: "The delivery charges field is required.",
                number: "The delivery charges field is invalid.",
                greaterThanZeroEqualTo: "The delivery charges field is invalid."
            },
            minimum_mile: {
                required: "The minimum mile field is required.",
                number: "The minimum mile field is invalid.",
                greaterThanZeroEqualTo: "The minimum mile field is invalid."
            },
            charges_of_minimum_mile: {
                required: "The charges of minimum mile field is required.",
                number: "The charges of minimum mile field is invalid.",
                greaterThanZeroEqualTo: "The charges of minimum mile field is invalid."
            }
        },
        submitHandler: function(form) {
            console.log("submit");
            //form.submit();
        }
    });

 $.validator.addMethod("greaterThanZeroEqualTo", function(value, element) {
        return this.optional(element) || value >= 0;
    });