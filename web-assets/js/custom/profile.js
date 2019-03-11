 var validator = $(".form-profile").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            if (element.hasClass('upload-img')) {
                    error.appendTo(element.parent());
            }else{
                error.insertAfter(element);
            }     
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
            },
            mobile_number:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            dob:{
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            gender:{
                required: true
            },
            profile_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 2
            }
        },
        messages: {

            username: {
                required: "The full name field is required.",
                alpha: "The full name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            mobile_number: {
                required: "The mobile number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The mobile number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            dob: {
                required: "The date of birth field is required."
            },
            gender: {
                required: "The gender field is required."
            },
            profile_picture:{
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 2MB Maximum"
            }
        },
        submitHandler: function(form) {
           form.submit();
        }
    });

  var validator2 = $(".reset-form").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        validClass: "validation-valid-label",
        rules: {
            old_password: {
                required:true
            },
            new_password:{
                required: true,
                minlength: 6,
                maxlength:50
            },
            confirm_password:{
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {

            old_password: {
                required: "The current password field is required."
            },
            new_password: {
                required: "The new password field is required.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            confirm_password: {
                required: "The confirm new password field is required.",
                equalTo: "Please enter the same password as above."
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
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

$( document ).ready(function() {

	$("#mobile_number").inputmask("999 999 9999",{"placeholder": ""});

	$('.datepicker-autoclose').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '0',
            autoclose: true,
            todayHighlight: false,
            orientation: "top auto"
        });

    $(document).on('click', '.upload-txt, #blah', function(){
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