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
            username:{
                required: true,
                alpha:true,
                minlength:3,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            username: {
                required: "The full name field is required.",
                alpha: "The full name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });

$( document ).ready(function() {


    $(document).on('click', '.mdi-camera', function(){
        $('#imgInp').click();
        return false;
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#imgInp', function() {
        readURL(this);
    });
 });

