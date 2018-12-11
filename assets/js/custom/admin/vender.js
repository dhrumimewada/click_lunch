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
            shop_name: {
                required:true,
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
            vender_name: {
                required:true,
                alpha:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            address: {
                required:true,
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

            shop_name: {
                required: "The shop name field is required."
            },
            email: {
                required: "The shop email field is required.",
                emailValidation: "The shop email field is invalid."
            },
            vender_name: {
                required: "The owner name field is required.",
                alpha:"The owner name field contain only alphabets and space."
            },
            address: {
                required: "The address field is required."
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
    $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
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