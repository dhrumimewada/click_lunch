var promocode_applied = '';
var order_placed = false;
var order_id = '';
$(document).on('click','.apply-promo',function(){

	// Apply Promocode from modal
	$this = $(this);
	var data_id = $(this).data('id');
	var data_name = $(this).data('name');

	$('.applied-promo').val(data_name);
	$('.applied-promo').attr('readonly', true);

	$("#apply-promo").prop('value', 'Remove');
	$(".view-offers").hide();

	$('#apply-promo').attr('data-name', 'remove');
	console.log("Promocode applied!");
	$("#promocode-div").show();

    apply_promocode(data_name);


});

$(document).on('click','#apply-promo',function(){
	$this = $(this);
	var data_name = $(this).attr('data-name');

    if($('.applied-promo').val() == ''){
        swal(
            'Promocode field is empty!',
            'Please enter promocode to apply',
            'warning'
        )
        return false;
    }
	// Remove Promocode
	if(data_name == 'remove'){
		console.log("Promocode removed!1");

        var tax_amount = (parseFloat(subtotal) * parseFloat(tax)) / 100;
        $('#tax_amount').text(Number(tax_amount).toFixed(2));

        var service_charge_amount = (parseFloat(subtotal) * parseFloat(service_charge)) / 100;
        $('#service_charge_amount').text(Number(service_charge_amount).toFixed(2));

        var total = parseFloat(subtotal) + parseFloat(delivery_amount) + parseFloat(tax_amount) + parseFloat(service_charge_amount);
        $('#total').text(Number(total).toFixed(2));

		$('#apply-promo').attr('data-name', 'apply');
		$(".view-offers").show();
		$("#apply-promo").prop('value', 'Apply');
		$('.applied-promo').attr('readonly', false);
		$('.applied-promo').val('');

		$("#promocode-div").hide();

	}else{
		console.log("Promocode applied!1");
        var abc = validate_promocode($('.applied-promo').val());
		// validate & apply promocode
	}
});

function validate_promocode(data_name) {
    $(".overlay").css("display", "block");
    $.ajax({
            url: validate_promocode_url,
            type: "POST",
            data:{
                promocode:data_name
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    if(returnData.is_success){

                        $('.applied-promo').val(data_name);
                        $('.applied-promo').attr('readonly', true);

                        $("#apply-promo").prop('value', 'Remove');
                        $(".view-offers").hide();

                        $('#apply-promo').attr('data-name', 'remove');
                        console.log("Promocode applied!");
                        $("#promocode-div").show();

                        apply_promocode($('.applied-promo').val());
                        $(".overlay").css("display", "none");

                    }else{
                        $(".overlay").css("display", "none");
                       swal(
                            'Promocode '+$('.applied-promo').val().toUpperCase()+' is invalid!',
                            'Please try another one',
                            'warning'
                        )
                       return false;
                    }
                }
                
            },
            error: function (xhr, ajaxOptions, thrownError){
                $(".overlay").css("display", "none");
                return false;
            }
        });

    
}
function apply_promocode(data_name) {
    $(".overlay").css("display", "block");
    $.ajax({
            url: get_promocode_data_url,
            type: "POST",
            data:{
                promocode:data_name
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);

                if (typeof returnData != "undefined"){
                    var promo_amount = Number(returnData.promo_amount).toFixed(2);
                    $('#promo_amount').text(promo_amount);

                    var new_sub_total = parseFloat(subtotal) - parseFloat(promo_amount);
                    var tax_amount = (parseFloat(new_sub_total) * parseFloat(tax)) / 100;
                    $('#tax_amount').text(Number(tax_amount).toFixed(2));

                    var service_charge_amount = (parseFloat(new_sub_total) * parseFloat(service_charge)) / 100;
                    $('#service_charge_amount').text(Number(service_charge_amount).toFixed(2));

                    var total = parseFloat(new_sub_total) + parseFloat(delivery_amount) + parseFloat(tax_amount) + parseFloat(service_charge_amount);
                    $('#total').text(Number(total).toFixed(2));
                    promocode_applied = data_name;

                    swal(
                        'Promocode applied',
                        'Promocode '+data_name.toUpperCase()+' is applied successfully',
                        'success'
                    )

                    $(".overlay").css("display", "none");

                    return true;
                }
                
            }
        });
}

$(document).on('click','#takeout-instead',function(){
	$("#takeout").show();
	$("#deliver").hide();
	$(".select-time").hide();
	$("#deliverOption3").prop("checked", true);

    $("#delivery-amount-div").hide();
});
$(document).on('click','#deliver-instead',function(){
	$("#takeout").hide();
	$("#deliver").show();
	$(".select-time").hide();
	$("#deliverOption1").prop("checked", true);

    $("#delivery-amount-div").show();
});
$(document).on('click','.deliver-now',function(){
	$(".select-time").hide();
});
$(document).on('click','.deliver-later',function(){
	$(".select-time").show();
});

$(document).on('click','#orderSuccessful .close-btn',function(){
    if(order_placed == true){
        window.location.href = order_success_url+'/'+order_id;
    }
});

$(document).on('hidden.bs.modal','#orderSuccessful',function(){
    if(order_placed == true){
        window.location.href = order_success_url+'/'+order_id;
    }
});

$(document).on('click','#placeorder',function(){
    // console.log($('#weekly_time').val());
    // return false;
    if($("input[name='deliveroption']:checked")){
        if( (($("input[name='deliveroption']:checked").val() == 2) && ($('#deliver_time').val() == '')) ||  (($("input[name='deliveroption']:checked").val() == 4) && ($('#takeout_time').val() == '')) ){
            swal(
                'Please select delivery or takeout time',
                'Order time is required',
                'warning'
            )
            return false;
        }else if(weekly_status == 1 && $('#weekly_time').val() == ''){
            swal(
                'Please select order time',
                'Order time is required',
                'warning'
            )
            return false;
        }else{

            $(".overlay").css("display", "block");

            if($("input[name='deliveroption']:checked").val() == 2){
                var later_time =  $('#deliver_time').val();
            }else if($("input[name='deliveroption']:checked").val() == 4){
                var later_time =  $('#takeout_time').val();
            }else if(weekly_status == 1){
                var later_time =  $('#weekly_time').val();
            }else{
                var later_time = '';
            }

            if(later_time != ''){
                
                var today = new Date();
                
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if (dd < 10) {
                  dd = '0' + dd;
                } 
                if (mm < 10) {
                  mm = '0' + mm;
                } 
                var my_date = mm + '/' + dd + '/' + yyyy;
                var my_date2 = my_date+' '+later_time;
                var later_time_obj = my_date2.toString();
                var later_obj = Date.parse(later_time_obj);
                var today_plus_30min = today.getTime() + (30 * 60000);

                // console.log(later_obj);
                // console.log(today.getTime() + (30 * 60000));

                if(later_obj <= today_plus_30min){
                    $(".overlay").css("display", "none");
                    swal(
                        'Deliver/takeout time invalid',
                        'Please select deliver/takout now if you want order into 30 min from now or select time later from 30 mins now',
                        'warning'
                    )
                    return false;
                }
            }

            if(weekly_status == 1){
                var order_type = weekly_order_type;
            }else{
                var order_type =  $("input[name='deliveroption']:checked").val();
            }
            
            var payment_type = $("input[name='payment_card']:checked").attr('data-payment-type');
            var card_id = '';
            if(payment_type == 0){
                card_id = $("input[name='payment_card']:checked").val();
            }

            console.log('order_type'+order_type+' ');
            console.log('weekly_status'+weekly_status+' ');
            console.log('weekly_day'+weekly_day+' ');
            console.log('later_time'+later_time+' ');
            console.log('promocode_applied'+promocode_applied+' ');
            console.log('payment_type'+payment_type+'   ');
            console.log('card_id'+card_id+' ');
            console.log('delivery_amount'+delivery_amount+' ');
            console.log('tax'+tax+' ');
            console.log('service_charge'+service_charge+'   ');
             // return false;

            $.ajax({
                url: place_order_url,
                type: "POST",
                data:{
                    later_time:later_time,
                    order_type:order_type,
                    weekly_status:weekly_status,
                    schedule_day:weekly_day,
                    promocode:promocode_applied,
                    payment_type:payment_type,
                    card_id:card_id,
                    delivery_amount:delivery_amount,
                    tax:tax,
                    service_charge:service_charge
                },
                success: function (returnData) {
                    returnData = $.parseJSON(returnData);
                     console.log(returnData);
                    // return false;
                    if (typeof returnData != "undefined"){
                        if(returnData.is_success == false){
                            $(".overlay").css("display", "none");
                            swal(
                                'Please update your cart',
                                returnData.message,
                                'warning'
                            )
                            return false;
                        }else{
                            $(".overlay").css("display", "none");
                            console.log("checkout");
                            $('#orderSuccessful').modal('show');
                            order_placed = true;
                            order_id = returnData.order_id;
                            return true;
                        }
                        
                    }
                }
            });
        }
        
    }else{
        $(".overlay").css("display", "none");
        swal(
            'Please select delivery or takeout',
            'Order type is required',
            'warning'
        )
       return false;
    }
});

$( document ).ready(function(){

    if(takeout_delivery_status == 2){
        $('#deliver').hide();
        $('#takeout').show();
    }

    if(weekly_status == 1){
        $("#weekly .select-time").show();
    }

	$("#cvv").inputmask("9999",{"placeholder": ""});
	$("#card_number").inputmask("9999999999999999999",{"placeholder": ""});

	$(".time_element").timepicki({

       	// show_meridian:false,
        min_hour_value:1,
        max_hour_value:12,
        step_size_minutes:15,
        overflow_minutes:true,
        increase_direction:'up',
        disable_keyboard_mobile: true
        
    });

});

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
                maxlength: 19,
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
           //form.submit();
           console.log("SUBMIT");
           validate_card();
        }
    });

 $.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || value > 0;
    });

 function validate_card() {

 	var card_holder_name = $('#card_holder_name').val();
 	var nickname = $('#nickname').val();
 	var card_number = $('#card_number').val();
 	var expiry_date = $('#expiry_date').val();
 	var cvv = $('#cvv').val();
 	var card_type = $("input[name=card]:checked").val();
 	// console.log(card_type);
 	// return false;
 	$.ajax({
            url: add_card_url,
            type: "POST",
            data:{
                card_holder_name:card_holder_name,
                nickname:nickname,
                card_number:card_number,
                expiry_date:expiry_date,
                cvv:cvv,
                card_type:card_type
            },
            success: function (returnData) {
                
                console.log(returnData);
                if (typeof returnData != "undefined"){
                	returnData = $.parseJSON(returnData);
                	if(returnData.is_success == true){

                		card_number_slice = card_number.slice(-4);
                		var card_types = new Array();
						card_types['1'] = 'Visa Classic';
						card_types['2'] = 'MasterCard';
						card_types['3'] = 'American Express';
						card_types['4'] = 'Diners Club';
						card_types['5'] = 'Discover';
						card_types['6'] = 'JCB';

						var img_name = '';
						if(card_type == 1){
                            img_name = 'visa-logo.png';
                        }else if(card_type == 2){
                            img_name = 'master-card.png';
                        }else if(card_type == 3){
                            img_name = 'american-express.png';
                        }else if(card_type == 4){
                            img_name = 'diners.png';
                        }else if(card_type == 5){
                            img_name = 'discover.png';
                        }else if(card_type == 6){
                            img_name = 'jcb.png';
                        }else{
                            
                        }

                		var add_div =
                			'<div class="row m-0 card-option">'
                				+'<div class="card-logo col-md-2">'
                					+'<img src="'+image_path+img_name+'" style="object-fit: scale-down;" class="w-100"/>'
                				+'</div>'
                				+'<div class="card-detail col-md-8">'
                					+'<div class="card-text">'
                						+card_types[card_type]
                					+'</div>'
                					+'<div class="card-number">'
                						+'XXXX XXXX XXXX '+card_number_slice
                					+'</div>'
                				+'</div>'
                				+'<div class="form-check col-md-2">'
                					+'<input class="form-check-input" type="radio" name="payment_card" id="'+returnData.id+'" value="'+returnData.id+'" checked>'
                					+'<label class="form-check-label" for="'+returnData.id+'"></label>'
                				+'</div>'
                			+'</div>';

                		$('.card.card-body').prepend(add_div);
                		// Add div in cards 
	                    swal({
						    title: "Added",
						    text: returnData.message,
						    type: "success"
						 }).then(function(){
						 	$('#addCardModal').modal('hide');
                            $('#add-card-form').trigger( "reset" );
						 });

                	}else{
                		swal(
	                        'Warning',
	                        returnData.message,
	                        'warning'
	                    )
                	}
                } 
            }
        });   

 }
