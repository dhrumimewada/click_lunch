 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                 if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }
                else if (element.hasClass('filestyle')) {
                    error.appendTo(element.parent());
                }
                else{
                    error.insertAfter(element);
                }    
        },
        validClass: "validation-valid-label",
        rules: {
            first_name: {
                required:true,
                alpha:true,
                minlength: 2,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            last_name: {
                required:true,
                alpha:true,
                minlength: 2,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            email: {
                required:true,
                emailValidation:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            role: {
                required:true,
                digits:true
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
                minlength: jQuery.validator.format("At least {0} character required")
            },
            last_name: {
                required: "The last name field is required.",
                alpha: "The last name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            email: {
                required: "The email field is required.",
                emailValidation: "The email field is invalid."
            },
            role:{
                required: "The role field is required.",
                digits: "Please select valid role"
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
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

 $( document ).ready(function() {
    $(".select2").select2();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#profile_picture', function() {
        readURL(this);
    });

 });

