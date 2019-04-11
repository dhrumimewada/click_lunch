 var validator = $(".form-validate").validate({

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
            full_name:{
                required: true,
                alpha:true,
                minlength:3,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            address:{
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            city: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            state: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            country: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            zipcode: {
                required:true,
                digits: true,
                maxlength:6,
                minlength:5,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            latitude: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            longitude: {
                required:true,
                maxlength:255,
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

            full_name: {
                required: "The full name field is required.",
                alpha: "The full name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            address:{
                required: "The street field is required."
            },
            city: {
                required: "The city field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            state: {
                required: "The state field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            country: {
                required: "The country field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            zipcode: {
                required: "The zip code field is required.",
                digits: "Enter only numeric value",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            latitude: {
                required: "The latitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            longitude: {
                required: "The longitude field is required.",
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
    $("#zipcode").inputmask("999999",{"placeholder": ""});

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

