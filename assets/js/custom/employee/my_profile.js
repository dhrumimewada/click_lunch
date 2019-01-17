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
            first_name:{
                required: true,
                alpha:true,
                minlength:2,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            last_name:{
                required: true,
                alpha:true,
                minlength:2,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            profile_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 10
            }
        },
        messages: {

            first_name: {
                required: "The first name field is required.",
                alpha: "The first name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            last_name: {
                required: "The last name field is required.",
                alpha: "The last name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            contact_no: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            profile_picture:{
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

$( document ).ready(function() {
    $(document).on('click', '.upload-txt, #blah', function(){
        $('#imgInp').click();
        return false;
    });

    $("#contact_no").inputmask("999 999 9999",{"placeholder": ""});

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

