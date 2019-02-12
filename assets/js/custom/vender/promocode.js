 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        errorPlacement: function(error, element) {
                if (element.hasClass('filestyle')) {
                    error.appendTo(element.parent());
                }else if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent().parent());
                }
                else if (element.parents('div').hasClass('input-group')) {
                    error.insertAfter(element.parent().parent());
                }
                else{
                    error.insertAfter(element);
                }    
        },
        validClass: "validation-valid-label",
        rules: {
            group:{
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
                greaterThanZero: false,
                validate_no_of_orders:true
            },
            'item[]': {
                validate_item:true
            },
            usage_limit: {
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                digits: true,
                greaterThanZero: true
            },
            promocode: {
                required:true,
                alphacode:true,
                minlength: 3,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            promo_min_order:{
                required: false,
                number: true,
                maxlength:10,
                validate_min_order: function (element) {
                    if(!$("#discount_type").is(':checked')){   
                        return true;          
                    }
                },
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            amount:{
                required: true,
                number: true,
                maxlength:10,
                greaterThanZero:true,
                validate_perc: function (element) {
                    if($("#discount_type").is(':checked')){     
                        return true;          
                    }
                },
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            promo_type:{
                required: true
            },
            'applied_on_products[]':{
                validate_applied_on_products: function (element) {
                    if($("#promo_type").val() == 1){    
                        return true;          
                    }
                }
            },
            max_disc:{
                max_disc_required:true,
                validate_max_disc:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            from_date:{
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            to_date:{
                required: true,
                graterThanFrom: '#from_date',
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },

        messages: {
            group:{
                required: "The group field is required."
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
            },
            'item[]': {
                validate_item: "Please select at least one product/combo."
            },
            usage_limit:{
                required: "The usage limit field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The usage limit should be more than zero."
            },
            promocode: {
                required: "The promocode field is required.",
                alphacode: "The promocode field contain only alphabets and numbers.",
                minlength: jQuery.validator.format("At least {0} character required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            promo_min_order: {
                required: "The minimum order field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                validate_min_order:"The minimum order amount should be more than amount.",
                number: "The minimum order field is invalid."
            },
            amount: {
                required: "The amount field is required.",
                number: "The amount field is invalid.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                greaterThanZero: "The amount field is invalid.",
                validate_perc: "The percentage is invalid"
            },
            promo_type: {
                required: "The promocode type field is required."
            },
            'applied_on_products[]':{
                validate_applied_on_products: "Please select at least one product/combo."
            },
            max_disc:{
                validate_max_disc:"The maximum discount should be less than minimum order amount.",
                max_disc_required: "The maximum discount field is required."
            },
            from_date: {
                required: "The form date field is required."
            },
            to_date: {
                required: "The to date field is required.",
                graterThanFrom: "The to date should be greater than from date."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

 $.validator.addMethod("graterThanFrom", function(value, element, param) {
        var from = $(param).val();
        var from_time = moment(from,'DD-MM-YYYY');
        var to_time = moment(value,'DD-MM-YYYY');
        if(from_time > to_time){
            return false;
        }else{
            return true;
        }     
    });
  $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

  $.validator.addMethod("alphacode", function(value, element) {
        return this.optional(element) || !(/[^a-zA-Z0-9]/.test(value));
    });

  $.validator.addMethod("validate_perc", function(value, element) {
        if(parseFloat(value) <= 100){
            return true;
        }else{
            return false;
        }
    });

  $.validator.addMethod("validate_shop", function(value, element) {
        if($('#group').val() == 5 && value == ''){
            return false;
        }else{
            return true;
        }

    });

  $.validator.addMethod("validate_item", function(value, element) {
        if($('#group').val() == 7 && value == ''){
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

  $.validator.addMethod("validate_applied_on_products", function(value, element) {
        if(value == ''){
            return false;
        }else{
            return true;
        }

    });

  $.validator.addMethod("validate_max_disc", function(value, element) {
        if($('#promo_min_order').val() != '' && $('#discount_type').is(':checked')){
            if(parseFloat($('#promo_min_order').val()) > parseFloat(value)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }

    });

  $.validator.addMethod("validate_min_order", function(value, element) {
        if(!$('#discount_type').is(':checked') && parseFloat($('#amount').val()) > parseFloat(value) && $('#amount').val() != ''){
            return false;
        }else{
            return true;
        }

    });

  $.validator.addMethod("max_disc_required", function(value, element) {
        if($('#discount_type').is(':checked') && value == ''){
            return false;
        }else{
            return true;
        }

    });

 $( document ).ready(function() {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('.datepicker-autoclose').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '-0d',
            autoclose: true,
            todayHighlight: false,
            orientation: "top auto"
        });

    $(".demo3").TouchSpin({
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".demo2").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        prefix: '$',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".demo1").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

    $(".select2").select2();

    if($('#group').val() == 5){
        
        $('#shop-list').removeClass("d-none");
        $('#order-no').addClass("d-none");
        $('#item-list').addClass("d-none");
    }
    if($('#group').val() == 6){
        
        $('#order-no').removeClass("d-none");
        $('#shop-list').addClass("d-none");
        $('#item-list').addClass("d-none");
    }   
    if($('#group').val() == 7){
        if(is_vender){
            $('#item-list').removeClass("d-none");
            $('#shop-list').addClass("d-none");
            $('#order-no').addClass("d-none");
        }else if(is_admin){
            //console.log($('#group').val());
            $('#shop').removeAttr('multiple');
            $('#shop-list').removeClass("d-none");
            $(".select2").select2();
            $('#order-no').addClass("d-none");
            $('#item-list').removeClass("d-none");
            console.log("111");
            // var selected_shop = $('#shop').val();
            // set_products(selected_shop);
        }else{
            
        }
    }   

    $(document).on('change','#group',function(){

        $('#order-no').addClass("d-none");
        $('#shop-list').addClass("d-none");
        $('#item-list').addClass("d-none");
        
        if($(this).val() == 5){

            $('#order-no').addClass("d-none");
            $('#shop-list').removeClass("d-none");
            $(".select2").select2();
        }
        if($(this).val() == 6){
            
            $('#order-no').removeClass("d-none");
            $('#shop-list').addClass("d-none");
        }   
        if($(this).val() == 7){
            if(is_vender){
                $('#item-list').removeClass("d-none");
                $('#order-no').addClass("d-none");
                $('#shop-list').addClass("d-none");
                
            }else if(is_admin){
                $('#shop').removeAttr('multiple');
                $('#shop-list').removeClass("d-none");
                $(".select2").select2();
                $('#order-no').addClass("d-none");
                $('#item-list').addClass("d-none");
            }else{

            }
        }   
   });

    if(is_admin){
        $(document).on('change','#shop',function(){
            var selected_shop = $(this).val();
            set_products(selected_shop);
            
        });
    }

    function set_products(selected_shop) {
        if (typeof selected_shop != "undefined" && selected_shop != null && selected_shop.length > 0){
            $.ajax({
                url: get_product_url,
                type: "POST",
                data:{id:selected_shop},
                success: function (returnData) {
                    returnData = $.parseJSON(returnData);
                    
                    if (typeof returnData != "undefined"){

                        $('#products').find('option').remove().end();

                        $('#item-list').removeClass("d-none");
                        $.each(returnData, function (key, val) {
                            var newOption = new Option(val.name, val.id, false, false);
                            $('#products').append(newOption).trigger('change');
                        });
                        return true;
                    } 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });
        }
    }

    if ($('#discount_type').is(':checked')){
        $('#max-disc').removeClass("d-none");

        $('#amount-type-icon').removeClass("mdi-currency-usd");
        $('#amount-type-icon').addClass("mdi-percent");

    }else{
        $('#max-disc').addClass("d-none");

        $('#amount-type-icon').addClass("mdi-currency-usd");
        $('#amount-type-icon').removeClass("mdi-percent");

    }

    $(document).on('change','#discount_type',function(){
        if ($(this).is(':checked')){
            $('#max-disc').removeClass("d-none");

            $('#amount-type-icon').removeClass("mdi-currency-usd");
            $('#amount-type-icon').addClass("mdi-percent");

        }else{
            $('#max-disc').addClass("d-none");

            $('#amount-type-icon').addClass("mdi-currency-usd");
            $('#amount-type-icon').removeClass("mdi-percent");
        }
    });

    if ($('#promo_type').val() == 1){
        $('#products-list').removeClass("d-none");
    }else{
        $('#products-list').addClass("d-none");
    }
    $(document).on('change','#promo_type',function(){
        if ($(this).val() == 1){
            $('#products-list').removeClass("d-none");
        }else{
            $('#products-list').addClass("d-none");
        }
    });

 });


