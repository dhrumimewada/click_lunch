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
            category_name: {
                required:true,
                minlength: 2,
                restrict_quots: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            category_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 10
            }
        },
        messages: {
            category_name: {
                required: "The category name field is required.",
                restrict_quots: "The category name should not contain quotes",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            category_picture:{
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

 $.validator.addMethod("filesize", function(value, element, param) {
        //console.log((element.files[0].size/1024)/1024);
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });
  $.validator.addMethod("restrict_quots", function(value, element) {
        if(value.search(/'|"/g) !== -1){
            return false;
        }else{
            return true;
        }
    });

 
 $( document ).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#category_picture', function() {
        readURL(this);
    });


 });

