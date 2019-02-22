$(document).on('click','.product-cancel .mdi-close',function(){
	$this = $(this);
	var data_id = $(this).attr('id');
    var total_cart_amount = $('.total_cart_amount').text();
    var product_amount = $(this).attr('data-price');
    console.log('total_cart_amount' + total_cart_amount);
	if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){
		$.ajax({
                url: delete_url,
                type: "POST",
                data:{id:data_id},
                success: function (returnData) {
                	//console.log(returnData);
                  	if(returnData == 1){
                        var total = total_cart_amount - product_amount;
                        $('.total_cart_amount').text(Number(total).toFixed(2));

                  		$this.closest("tr").remove();
                  		rowCount = $('#cart-table tr').length;
                  		if(rowCount == 3){
                  			$('#cart-table tr:last').remove();
                  			$('#empty-cart').removeClass("d-none");
                  		}
                  	}
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                },
                complete: function () {
                    $this.removeAttr("disabled");
                }
            });
	}else{
        console.log('data_id not found');
    }
});

$(document).on('click','.quatity-update .input-group-prepend, .quatity-update .input-group-append',function(){
    var quantity  = $(this).closest(".quatity-update").find('input:first').val();
    var cart_id = $(this).parent().siblings().attr('data-id');
    var minus_plus = $(this).find("strong").text();
    var minus_plus_val = 0;
    if(minus_plus == '+'){
        minus_plus_val = 1;
    }


    if (typeof cart_id != "undefined" && cart_id != null && cart_id.length > 0){
        $.ajax({
            url: update_quantity_url,
            type: "POST",
            data:{
                cart_id:cart_id,
                minus_plus:minus_plus_val
            },
            success: function (returnData) {
                if(returnData == 'true'){
                    console.log('quantity updated');
                    location.reload();
                }else{
                    console.log('quantity updation fail');
                    location.reload();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('error');
            }
        });
    }else{
        console.log('cart_id not found');
    }

});

$(document).on('click','#form-varient-btn',function(){
    //console.log($('#form-varient').serializeArray());

    var error = false;
    var error_group_name = ''
    $.each(total_groups, function (key, val){
        if($("input[name='group["+val+"][]']:checked").length == 0){
            error = true;
            error_group_name = $("input[name='group["+val+"][]']").attr("data-groupname");
        }
    });

    if(error == true){
        $('.error-item').text('You Must Select At Least 1 '+error_group_name);
        $('.error-item').show();
        $('.error-item').delay(3000).hide(0);
    }else{

        var form_data = $('#form-varient').serializeArray();
        console.log(row_id);

        if (typeof form_data != "undefined" && form_data != null && form_data.length > 0){

            $.ajax({
                url: customize_cart_item_url,
                type: "POST",
                data:{
                    form_data:form_data,
                    row_id:row_id
                },
                success: function (returnData) {
                    //console.log(returnData);
                    if (typeof returnData != "undefined" && returnData == 'true'){
                        console.log("succ");
                        $('#customize-item-modal').modal('toggle');
                        location.reload();
                    } 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });   
        }    

    }

    
});

var total_groups = [];
var row_id = ''
$(document).on('click','.customize',function(){
	row_id = $(this).data("id");
    // console.log(row_id);
    // return false;
	if (typeof row_id != "undefined" && row_id != null && row_id.length > 0){
		$.ajax({
                url: customize_url,
                type: "POST",
                data:{id:row_id},
                success: function (returnData) {
                	if (typeof returnData != "undefined" && returnData != ''){

                        $(".varient-headings").empty();
                        $(".modal-body").empty();
                        total_groups = [];

                		returnData = $.parseJSON(returnData);

                        $('#customize-item-modal .modal-title').text('Customize '+returnData.cart_contents.name);
                        $('#customize-item-modal .total-item-price').text(Number(returnData.cart_contents.price).toFixed(2));

                        var group_str = '&nbsp;|&nbsp;';
                        var table_group_str = '';

                        $.each(returnData.item_variants, function (key, val){

                            total_groups.push(val.id);
                            group_str += '<div class="d-inline-block pointer"> <a href="#addon" class="light-gray-txt ">'+val.name+'</a> </div>&nbsp;|&nbsp;';

                            if(val.availability == 1){
                                var optional = '<span class="light-gray-txt text-danger">&nbsp;(required)</span>';
                            }else{
                                var optional = '<span class="light-gray-txt">&nbsp;(optional)</span>';
                            }

                            table_group_str +=
                            '<table class="w-100 mt-4">'
                                +'<thead><tr>'
                                    +'<th colspan="2"><h5><b>'+val.name+'</b>'+optional+'</h5></th>'
                                +'</tr></thead>'
                                +'<tbody class="add-toppings">';

                            
                            $.each(val.items, function (key1, val1){

                                table_group_str +=
                                    '<tr>'
                                        +'<td>'
                                            +'<div class="form-check pb-1">';

                                if(val.selection == 1){

                                    table_group_str +=
                                                '<input class="form-check-input" type="checkbox" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
                                                +'<label class="form-check-label" for="'+val1.id+'">'+val1.name +'</label>';
                                }else{

                                    table_group_str +=
                                                '<input class="form-check-input" type="radio" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
                                                +'<label class="form-check-label" for="'+val1.id+'">'+val1.name+'</label>';
                                }

                                var price = Number(val1.price).toFixed(2);

                                if(price == '0.00'){
                                    var price = '';
                                }else{
                                    var price = '+ &#36;'+price;
                                }

                                table_group_str +=
                                            '</div>'
                                        +'</td>'
                                        +'<td>'
                                            +'<div class="text-right pr-1 price" data-id="'+val1.price+'">'+price+'</div>'
                                        +'</td>'
                                    +'</tr>';

                            });

                                table_group_str +=
                                '</tbody>'
                            +'</table>';
                        });

                    
                        $(".varient-headings").append(group_str);
                        $(".modal-body").append(table_group_str);

                        $.each(returnData.variants, function (variant_key, variant_val){
                            $('#'+variant_val).attr('checked',true);
                        });


                        $('.error-item').hide();
                        $('#customize-item-modal').modal('show');
                        //console.log(returnData);
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });
	}
});

 $( document ).ready(function() {
    $('.quatity-update .form-control').attr('readonly', true);
 });
