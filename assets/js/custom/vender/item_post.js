 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                if (element.parents('div').hasClass('custom-checkbox')) {
                    error.appendTo(element.parent().parent());
                }
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible') || element.hasClass('filestyle')) {
                    error.appendTo(element.parent());
                }
                else if (element.parents('div').hasClass('bootstrap-touchspin')) {
                    error.insertAfter(element.parent().parent());
                }
                else{
                    error.insertAfter(element);
                }       
        },
        validClass: "validation-valid-label",
        rules: {
            name: {
                required:true,
                minlength: 2,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            cuisine_id: {
                required:true
            },
            price:{
                required: true,
                number: true,
                greaterThanZero:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            offer_price:{
                number: true,
                lessThanPrice: "#price",
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            quantity:{
                required: true,
                number: true,
                greaterThanZeroEqualTo:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            item_picture:{
                accept: "image/jpg, image/jpeg, image/png",
                filesize: 10
                //checkold: "#old_picture"
            },
            item_description:{
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            name: {
                required: "The product name field is required.",
                minlength: jQuery.validator.format("At least {0} character required")
            },
            cuisine_id: {
                required:"The product cuisine field is required."
            },
            price: {
                required: "The product price field is required.",
                number: "The product price field is invalid.",
                greaterThanZero: "The product price field is invalid."
            },
            offer_price: {
                required: "The product offer price field is required.",
                number: "The product offer price field is invalid.",
                lessThanPrice: "The product offer price should be less than actual price."
            },
            quantity: {
                required: "The product quantity field is required.",
                number: "The product quantity field is invalid.",
                greaterThanZeroEqualTo: "The product quantity field is invalid."
            },
            item_picture:{
                //checkold: "The item photo field is required.",
                accept: "Accepted image formats: jpg, jpeg, png",
                filesize: "File size limit executed: 10MB Maximum"
            }
        },
        submitHandler: function(form) {
            if(validate_varient()){
                form.submit();
            }else{
                 console.log('form false');
            }   
        }
    });

 $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || ((element.files[0].size/1024)/1024 <= param);
    });
 $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });
 $.validator.addMethod("greaterThanZeroEqualTo", function(value, element) {
        return this.optional(element) || value >= 0;
    });
 $.validator.addMethod("lessThanPrice", function(value, element, param) {
        if(value != ''){
            if(parseFloat(value) < parseFloat($(param).val())){
                return true;
            }else{
                return false;
            }  
        }
        return true;
    });

 $.validator.addMethod("checkold", function(value, element, param) {
        var old_picture = $(param);
        if(old_picture.length == 0){
            if(value == ''){
                return false;
            }
        }
        return true;
    });

$( document ).ready(function() {
    $(".select2").select2();

    $(".demo2").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        prefix: '$',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".demo3").TouchSpin({
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
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

    $(document).on('change', '#item_picture', function() {
        readURL(this);
    });



    $(document).on('click','.remove-btn',function(){
        $(this).closest(".row").remove();
    });

    var str = '';
    $.each(variant_groups, function(k, v) {
        str += '<option value='+v.id+'>'+v.name+'</option>';
    });

    $(document).on('click','#add_variant',function(){
        var variant_row = 
                        '<div class="row">'+
                            '<div class="col-lg-4">'+
                                '<div class="form-group">'+
                                    '<label class="required">Variant Group</label>'+
                                    '<div>'+
                                    '<select class="form-control select2 variant_group" data-placeholder="Select variant group" name="variant_group[]">'+
                                        '<option selected disabled></option>'+
                                        str+
                                    '</select>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-lg-4">'+
                                '<div class="form-group">'+
                                    '<label class="required">Variant Name</label>'+
                                    '<div>'+
                                    '<input type="text" name="variant_name[]" class="form-control variant_name" placeholder="Ex: Small">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-lg-3">'+
                                '<div class="form-group">'+
                                    '<label class="required">Variant Price</label>'+
                                    '<div>'+
                                    '<input type="text" name="variant_price[]" class="form-control demo2"  placeholder="Ex: 66.50">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-lg-1">'+
                                '<div class="form-group">'+
                                    '<label>Remove</label>'+
                                    '<div>'+
                                    '<label name="add_variant" class="btn btn-danger waves-effect waves-light remove-btn remove"><i class="ion-close-round"></i></label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

        $('#variants').append(variant_row);

        $(".select2").select2();
        
        $(".demo2").TouchSpin({
            forcestepdivisibility: 'none',
            max: 1000000000,
            decimals: 2,
            prefix: '$',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });
    });

});

function validate_varient() {
    var flag = true;
    $('[name*="variant_group[]"]').each(function (){
        if($(this).find(":selected").val() == ''){
            $(this).parent().after('<label class="validation-error-label">The variant group field is required.</label>');
            flag = false;
        }
    });
    $('[name*="variant_name[]"]').each(function (){
        if($(this).val().trim() == ''){
            $(this).after('<label class="validation-error-label">The variant name field is required.</label>');
            flag = false;
        }
    });
    $('[name*="variant_price[]"]').each(function (){
        if(($(this).val().trim() == '') || (Number($(this).val()) <= 0)){
            $(this).parent().parent().after('<label class="validation-error-label">The variant price field is required.</label>');
            flag = false;
        }
    });
    return flag;
}
