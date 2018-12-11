 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            console.log("error");
            if (element.parents('div').hasClass('custom-checkbox')) {
                error.appendTo(element.parent().parent());
            }else{
                error.insertAfter(element);
            }     
        },
        validClass: "validation-valid-label",
        rules: {
            shop_name: {
                required:true,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            vender_name: {
                required:true,
                alpha:true,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no1:{
                required: false,
                digits: true,
                greaterThanZero:true,
                minlength: 10,
                maxlength: 15,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            contact_no2:{
                required: false,
                digits: true,
                greaterThanZero:true,
                minlength: 10,
                maxlength: 15,
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
            website: {
                required:false,
                valid_url:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            tax_number: {
                valid_taxno:true
            },
            'payment_mode[]': {
                required:false
            },
            profile_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 10
            }
        },
        messages: {

            shop_name: {
                required: "The shop name field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            vender_name: {
                required: "The owner name field is required.",
                alpha:"The owner name field contain only alphabets and space.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            contact_no1: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} digit allowed")
            },
            contact_no2: {
                required: "The alternate contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The alternate contact number field is invalid.",
                minlength: jQuery.validator.format("At least {0} digit required"),
                maxlength: jQuery.validator.format("Maximum {0} digit allowed")
            },
            address: {
                required: "The address field is required."
            },
            website: {
                required:"The website field is required.",
                valid_url:"The website field is invalid."
            },
            tax_number:{
                valid_taxno:"The tax number field is invalid."
            },
            'payment_mode[]': {
                required: "Please select at least one payment mode."
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
    $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });
    $.validator.addMethod("valid_url", function(value, element) {
        return this.optional(element) || /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/.test(value);
    });
    $.validator.addMethod("valid_taxno", function(value, element) {
        return this.optional(element) || (value.indexOf('_') < 0);
    });
    $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

$( document ).ready(function() {

    $(".tax-mask").inputmask({"mask": "999-99-9999"});

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