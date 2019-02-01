 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                console.log("error");
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent().parent());
                }else{
                    error.insertAfter(element);
                }     
        },
        validClass: "validation-valid-label",
        rules: {
            emat_email_subject: {
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            group:{
                required:true
            },
            'email_to[]': {
                required:true
            },
            'shop[]': {
                validate_shop:true
            },
            no_of_orders: {
                normalizer: function (value) {
                    return $.trim(value);
                },
                digits: true,
                greaterThanZero: true,
                validate_no_of_orders:true
            }
        },
        messages: {

            emat_email_subject: {
                required: "The email subject field is required."
            },
            group:{
                required: "The group field is required."
            },
            'email_to[]': {
                required: "Please select at least one option."
            },
            'shop[]': {
                validate_shop: "Please select at least one restaurant."
            },
            no_of_orders:{
                normalizer: function (value) {
                    return $.trim(value);
                },
                digits: "Enter only numeric value",
                greaterThanZero: "The minimum number of orders should be more than zero.",
                validate_no_of_orders: "The minimum number of orders field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

 $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

 $.validator.addMethod("validate_shop", function(value, element) {
        if($('#group').val() == 5 && value == ''){
            return false;
        }else{
            return true;
        }

    });

  $.validator.addMethod("validate_no_of_orders", function(value, element) {
        if($('#group').val() == 6 && value == ''){
            return false;
        }else{
            return true;
        }

    });


 $(document).ready(function(){

        $(".select2").select2();

        $('.summernote').summernote({
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview' ] ]
            ]               
        });

        //$('.note-editing-area .note-editable').html();
       // $('.note-editing-area .note-editable').append(msg);

        $(document).on('submit','form',function(){
            $('#emat_email_message').val($(".note-editing-area .note-editable").html());
        });

       $(document).on('change','#all',function(){

            if($("#all").is(':checked') ){
                $(".select2 > option").prop("selected","selected");
                $(".select2").trigger("change");
            }else{
                $(".select2").val(null).trigger("change"); 
            }

        });

       if($('#group').val() == 5){
            $('#order-no').addClass("d-none");
            $('#shop-list').removeClass("d-none");
        }
        if($('#group').val() == 6){
            
            $('#order-no').removeClass("d-none");
            $('#shop-list').addClass("d-none");
        }   

       $(document).on('change','#group',function(){

            $('#order-no').addClass("d-none");
            $('#shop-list').addClass("d-none");
            
            if($(this).val() == 5){

                $('#order-no').addClass("d-none");
                $('#shop-list').removeClass("d-none");
                $(".select2").select2();
            }
            if($(this).val() == 6){
                
                $('#order-no').removeClass("d-none");
                $('#shop-list').addClass("d-none");
            }   
       });

    });

