 var validator = $("#add-card-form").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            if (element.hasClass('form-check-input')) {
                    error.appendTo(element.parent().parent().parent());
            }else{
                error.insertAfter(element);
            }     
        },
        validClass: "validation-valid-label",
        rules: {
            card_holder_name:{
                required: true,
                alpha:true,
                minlength:3,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            nickname:{
                required: false,
                alpha:false,
                minlength:3,
                maxlength:50,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            card_number:{
                required: true,
                digits: true,
                greaterThanZero:true,
                minlength: 13,
                maxlength: 16,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            expiry_date:{
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            cvv:{
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 4,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            card_type:{
                required: true
            }
        },
        messages: {

            card_holder_name: {
                required: "The card holder name field is required.",
                alpha: "The card holder name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            nickname: {
                required: "The nick name field is required.",
                alpha: "The nick name field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            card_number: {
                required: "The card number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The card number field is invalid.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            expiry_date: {
                required: "The expiry date field is required."
            },
            cvv: {
                required: "The cvv field is required.",
                digits: "Enter only numeric value",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            card_type:{
                required: "The card type field is required."
            }
        },
        submitHandler: function(form) {
           form.submit();
        }
    });

 $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

$(document).ready(function (){

    $(document).on('keyup',"#card_number", function(){
        if($(this).val() != ''){
            var type_card = GetCardType($(this).val());
            $("#"+type_card).prop("checked", true);
        }
        
    });

	$(document).on('click',".card-buttons .delete", function(){
		$this = $(this);
		var data_id = $(this).data("id");
		var card_lock = $(this).closest(".card-block");
		if (typeof data_id != "undefined" && data_id != null){
			swal({
                    title: 'Are you sure you want to delete?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(
                    function () {

                    $.ajax({
                        url: delete_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);

                            if (typeof returnData != "undefined")
                            {
                                swal(
                                        'Deleted!',
                                        'Payment card has been deleted.',
                                        'success'
                                    );

                                card_lock.remove();
                                if(returnData.empty == true){
                                	$('.empty').removeClass('d-none');
                                }
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        }
                    });    
                })
		}
	});

	$("#cvv").inputmask("9999",{"placeholder": ""});
	$("#card_number").inputmask("9999999999999999",{"placeholder": ""});
});

function GetCardType(number)
{
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return 1;

    // Mastercard 
    // Updated for Mastercard 2017 BINs expansion
     if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number)) 
        return 2;

    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return 3;

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return 6;

    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return 5;

    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return 5;

    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return 4;

    return 7;
}