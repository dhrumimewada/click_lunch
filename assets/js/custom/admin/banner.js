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
            title: {
                required:true,
                minlength: 2,
                maxlength: 50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            sub_title: {
                required:true,
                minlength: 2,
                maxlength: 50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            banner_picture:{
                required:false,
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 2
            },
            highlight0[]:{
                required:true
            }
        },
        messages: {
            title: {
                required: "The title field is required.",
                minlength: jQuery.validator.format("At least {0} character required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            sub_title: {
                required: "The subtitle field is required.",
                minlength: jQuery.validator.format("At least {0} character required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            banner_picture:{
                required: "The image field is required.",
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {
            //console.log(validate_image());
            if(validate_image()){
                form.submit();
            }else{
               $(".validation-error-image").append('<label class="validation-error-label" style="">Accepted minimum image resolution: 1920*900</label>');
            }      
        }
    });

 $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });

 function validate_image() {
    var return_val = false;
    var theImage = new Image();
    theImage.src = $('#copy-img').attr('src');

    var return_val = theImage.onload = function() {
        if(theImage.height < 900 || theImage.width < 1920){
            return false;
            console.log('H'+theImage.height);
            console.log('W'+theImage.width); 
        }else{
            return true;
        }
    }();
    return return_val;
 }

 $( document ).ready(function() {

    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
                $(".image-popup-no-margins").attr("href", e.target.result);
                $("#copy-img").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#banner_picture', function() {
        readURL(this);
    });


 });

