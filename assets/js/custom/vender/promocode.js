 var validator = $(".form-validate").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        errorPlacement: function(error, element) {
                if (element.hasClass('filestyle')) {
                    error.appendTo(element.parent());
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
                        console.log(" checked");      
                        return true;          
                    }
                },
                normalizer: function (value) {
                    return $.trim(value);
                }
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
            promocode: {
                required: "The promocode field is required.",
                alphacode: "The promocode field contain only alphabets and numbers.",
                minlength: jQuery.validator.format("At least {0} character required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            promo_min_order: {
                required: "The minimum order field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                number: "The minimum order field is invalid."
            },
            amount: {
                required: "The amount field is required.",
                number: "The amount field is invalid.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                greaterThanZero: "The amount field is invalid.",
                validate_perc: "The percentage is invalid"
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

    $(".demo2").TouchSpin({
        forcestepdivisibility: 'none',
        max: 1000000000,
        decimals: 2,
        prefix: '$',
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary'
    });

 });


