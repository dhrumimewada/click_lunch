 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents('div').hasClass('input-group')) {
                    error.insertAfter(element.parent().parent());
                }else if (element.hasClass('upload-img')) {
                    error.appendTo(element.parent());
                }
                else{
                    error.insertAfter(element);
                }    
                
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
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            password:{
                required: true,
                minlength: 6
            },
            c_password:{
                required: true,
                equalTo: "#password"
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
            address: {
                required:true,
                maxlength: 255,
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
                filesize: 10
            }
        },
        messages: {

            email: {
                required: "The email field is required.",
                emailValidation: "The email field is invalid."
            },
            username: {
                required: "The full name field is required.",
                alpha: "The full name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            password: {
                required: "The password field is required.",
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            c_password: {
                required: "The confirm password field is required.",
                equalTo: "Please enter the same password."
            },
            mobile_number: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            address: {
                required: "The address field is required.",
                maxlength: jQuery.validator.format("Maximum {0} digit allowed")
            },
            dob: {
                required: "The date of birth field is required."
            },
            gender: {
                required: "The gender field is required."
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

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

$( document ).ready(function() {
    $(document).on('click', '.upload-txt, #blah', function(){
        $('#imgInp').click();
        $('#blah').attr('src', 'https://bootdey.com/img/Content/avatar/avatar6.png');
        return false;
    });

    $("#mobile_number").inputmask("999 999 9999",{"placeholder": ""});

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

    $('.datepicker-autoclose').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '-18y',
            autoclose: true,
            todayHighlight: false
        });

    $(".select2").select2();

 });

