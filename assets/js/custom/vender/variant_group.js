 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                if (element.hasClass('filestyle')) {
                    error.appendTo(element.parent());
                }
                else{
                    error.insertAfter(element);
                }    
        },
        validClass: "validation-valid-label",
        rules: {
            name: {
                required:true,
                minlength: 3,
                restrict_quots: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            name: {
                required: "The variant group name field is required.",
                minlength: jQuery.validator.format("At least {0} character required"),
                restrict_quots: "The category name should not contain quotes"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
$.validator.addMethod("restrict_quots", function(value, element) {
        if(value.search(/'|"/g) !== -1){
            return false;
        }else{
            return true;
        }
    });

