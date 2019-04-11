$(document).on('click','.product-cancel .mdi-close',function(){
	$this = $(this);
	var data_id = $(this).attr('id');
    var total_cart_amount = $('.total_cart_amount').text();
    var product_amount = $(this).attr('data-price');
    //console.log('total_cart_amount' + total_cart_amount);
	if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){
		$.ajax({
                url: delete_url,
                type: "POST",
                data:{id:data_id},
                success: function (returnData) {
                	//console.log(returnData);
                    returnData = $.parseJSON(returnData);
                    if (typeof returnData != "undefined"){
                        if(returnData.is_success == true){
                            var total = total_cart_amount - product_amount;
                            $('.total_cart_amount').text(Number(total).toFixed(2));

                            $this.closest("tr").remove();
                            rowCount = $('#cart-table tr').length;
                            if(rowCount == 3){
                                $('#cart-table tr:last').remove();
                                $('#empty-cart').removeClass("d-none");
                            } 
                        }else{

                        }
                        $('.cart-icon .dot').text(returnData.total_cart_items);
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
                    //console.log('quantity updated');
                    location.reload();
                }else{
                    //console.log('quantity updation fail');
                    location.reload();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //console.log('error');
            }
        });
    }else{
        //console.log('cart_id not found');
    }

});

$(document).on('click','#form-varient-btn',function(){
    //console.log($('#form-varient').serializeArray());

    var error = false;
    var error_group_name = ''
    $.each(total_required_groups, function (key, val){
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
        //console.log(row_id);

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
                        //console.log("succ");
                        $('#customize-item-modal').modal('toggle');
                        $("#customize-item-modal .varient-headings").empty();
                        $("#customize-item-modal .modal-body").empty();
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

$(document).on('click','#form-recommendation-varient-btn',function(){
    //console.log($('#form-varient').serializeArray());

    var error = false;
    var error_group_name = ''
    $.each(total_required_groups, function (key, val){
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

        var form_data = $('#form-recommendation-varient').serializeArray();

        if (typeof form_data != "undefined" && form_data != null && form_data.length > 0){

            var recommended_item_id = $('#form-recommendation-varient-btn').data('itemid');
             // console.log(form_data);
             // return false;

            $.ajax({
                url: add_recommended_item_cart_url,
                type: "POST",
                data:{
                    form_data:form_data,
                    id:recommended_item_id
                },
                success: function (returnData) {
                    //returnData = $.parseJSON(returnData);
                    //console.log(returnData);
                    if (typeof returnData != "undefined" && returnData == '1'){
                        //console.log("succ");
                        $('#customize-recommendation-item-modal').modal('toggle');
                        location.reload();
                    } 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //console.log('error');
                }
            });   
        }    

    }
});

var total_required_groups = [];
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
                        total_required_groups = [];

                		returnData = $.parseJSON(returnData);
                        //console.log(returnData);

                        $('#customize-item-modal .modal-title').text('Customize '+returnData.cart_contents.name);
                        $('#customize-item-modal .total-item-price').text(Number(returnData.cart_contents.item_price).toFixed(2));

                        var group_str = '&nbsp;|&nbsp;';
                        var table_group_str = '';

                        $.each(returnData.item_variants, function (key, val){

                            group_str += '<div class="d-inline-block pointer"> <a href="#addon" class="light-gray-txt ">'+val.name+'</a> </div>&nbsp;|&nbsp;';

                            if(val.availability == 1){
                                var optional = '<span class="light-gray-txt text-danger">&nbsp;(required)</span>';
                                var required = 'required';
                                total_required_groups.push(val.id);
                            }else{
                                var optional = '<span class="light-gray-txt">&nbsp;(optional)</span>';
                                var required = '';
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
                                                '<input class="form-check-input '+required+'" type="checkbox" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
                                                +'<label class="form-check-label" for="'+val1.id+'">'+val1.name +'</label>';
                                }else{

                                    table_group_str +=
                                                '<input class="form-check-input '+required+'" type="radio" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
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
                    //console.log('error');
                }
            });
	}
});

$(document).on('click','.recommendation-add',function(){
    recommendation_id = $(this).attr('id')
    // console.log(recommendation_id);
    // return false;
    if (typeof recommendation_id != "undefined" && recommendation_id != null && recommendation_id.length > 0){
        $.ajax({
                url: customize_recommendation_url,
                type: "POST",
                data:{id:recommendation_id},
                success: function (returnData) {
                    if (typeof returnData != "undefined" && returnData != ''){

                        $("#form-recommendation-varient .varient-headings").empty();
                        $("#form-recommendation-varient .modal-body").empty();

                        total_required_groups = [];
                        returnData = $.parseJSON(returnData);

                        if( typeof returnData.item_variants != 'undefined' && returnData.item_variants.length > 0){
                            
                        }else{
                            window.location = add_direct_to_cart_url+'/'+recommendation_id;

                            //console.log('add direct to cart');
                            return true;
                        }
                          //console.log(returnData.item_variants);
                         // return false;

                        $('#customize-recommendation-item-modal .modal-title').text('Customize '+returnData.cart_contents.name);
                        $('#customize-recommendation-item-modal .total-item-price').text(Number(returnData.cart_contents.price).toFixed(2));

                        var group_str = '&nbsp;|&nbsp;';
                        var table_group_str = '';

                        $.each(returnData.item_variants, function (key, val){

                            group_str += '<div class="d-inline-block pointer"> <a href="#addon" class="light-gray-txt ">'+val.name+'</a> </div>&nbsp;|&nbsp;';

                            if(val.availability == 1){
                                var optional = '<span class="light-gray-txt text-danger">&nbsp;(required)</span>';
                                var required = 'required';
                                total_required_groups.push(val.id);
                            }else{
                                var optional = '<span class="light-gray-txt">&nbsp;(optional)</span>';
                                var required = '';
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
                                                '<input class="form-check-input '+required+'" type="checkbox" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
                                                +'<label class="form-check-label" for="'+val1.id+'">'+val1.name +'</label>';
                                }else{

                                    table_group_str +=
                                                '<input class="form-check-input '+required+'" type="radio" name="group['+val.id+'][]" id="'+val1.id+'" value="'+val1.id+'" data-groupname="'+val.name+'">'
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

                    
                        $("#form-recommendation-varient .varient-headings").append(group_str);
                        $("#form-recommendation-varient .modal-body").append(table_group_str);

                        $.each(returnData.variants, function (variant_key, variant_val){
                            $('#'+variant_val).attr('checked',true);
                        });


                        $('.error-item').hide();
                        $('#form-recommendation-varient-btn').attr("data-itemid",returnData.cart_contents.id); 
                        $('#customize-recommendation-item-modal').modal('show');
                        
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

    $(document).on('click','.add-delivery-address',function(){
        if(logged_in && is_customer){
            $('#addNewAddressModal').modal('show');
        }else{
            $('#loginFormModal').modal('show');
        }
    });

    $(document).on('click','.choose-address',function(){
        if(logged_in && is_customer){
            
            window.location = choose_address;
        }else{
            $('#loginFormModal').modal('show');
        }
    });

    $(document).on('click','#checkout-btn',function(){
        
        if(logged_in && is_customer && (cart_contents_data == '1')){
            if((cart_order_type == 'delivery') && ((defualt_delivery_address_id == '') || (defualt_delivery_address_id == null)))
            {
                swal(
                        'Please select delivery address',
                        'You have to set delivery address for checkout',
                        'warning'
                    )
            }else{
                window.location.href = checkout_url;
            }
            
        }else{
            if(cart_contents_data != '1'){
                swal(
                        'Your cart is empty!',
                        'Add an item to begin',
                        'warning'
                    )
            }else if((cart_order_type == 'delivery') && (defualt_delivery_address_id == '' || defualt_delivery_address_id == null)){
                swal(
                        'Please select delivery address',
                        'You have to set delivery address for checkout',
                        'warning'
                    )
            }else{
                swal(
                        'Please login / register',
                        'You have to login for checkout',
                        'warning'
                    )
            }
        }
    });

 });
