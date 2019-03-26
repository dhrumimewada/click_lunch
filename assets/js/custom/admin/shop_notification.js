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
            'shop[]': {
                required:true
            },
            notification_title:{
                required:true
            },
            notification_message:{
                required:true
            }
        },
        messages: {

            'shop[]': {
                required: "Please select at least one restaurant."
            },
            notification_title:{
                required: "The title field is required."
            },
            notification_message:{
                required: "The message field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  $(document).ready(function(){
    $(".select2").select2();

    $(document).on('change','#all',function(){

        if($("#all").is(':checked') ){
            $(".select2 > option").prop("selected","selected");
            $(".select2").trigger("change");
        }else{
            $(".select2").val(null).trigger("change"); 
        }

    });
    
  });