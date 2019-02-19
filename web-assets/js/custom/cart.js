$(document).on('click','.product-cancel',function(){
	$this = $(this);
	var data_id = $(this).attr('id');
	if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){
		$.ajax({
                url: delete_url,
                type: "POST",
                data:{id:data_id},
                success: function (returnData) {
                	console.log(returnData);
                  	if(returnData == 1){

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
	}
});

$(document).on('click','.customize',function(){
	var row_id = $(this).data("id");
	if (typeof row_id != "undefined" && row_id != null && row_id.length > 0){
		$.ajax({
                url: customize_url,
                type: "POST",
                data:{id:row_id},
                success: function (returnData) {
                	if (typeof returnData != "undefined" && returnData != ''){

                		returnData = $.parseJSON(returnData);
                		$('#customize-item-modal .modal-title').text('Customize '+returnData.cart_contents.name);
                		$('#customize-item-modal .total-item-price').text(Number(returnData.cart_contents.price).toFixed(2));

                		var group_str = '&nbsp;|&nbsp;';
                		var table_group_str = '';

                		$.each(returnData.item_variants, function (key, val){
                			group_str += '<div class="d-inline-block pointer"> <a href="#addon" class="light-gray-txt ">'+val.name+'</a> </div>&nbsp;|&nbsp;';

                			if(val.availability == 1){
                				var optional = '<span class="light-gray-txt text-danger">&nbsp;(required)</span>';
                			}else{
                				var optional = '<span class="light-gray-txt">&nbsp;(optional)</span>';
                			}

                			table_group_str +=
                			'<table class="w-100 mt-3">'
                				+'<thead><tr>'
                					+'<th colspan="2"><h5><b>'+val.name+'</b>'+optional+'</h5></th>'
                				+'</tr></thead>'
                				+'<tbody class="add-toppings">';

                			var checked = '';
                			$.each(val.items, function (key1, val1){

                				$.each(returnData.cart_contents.group_data, function (key2, val2){
                					//console.log(val.id);
                					if(key2 == val.id){

                						$.each(val2, function (key3, val3){
                							
                							$.each(val3, function (key4, val4){
                								if(val4 == val1.id){
                									checked = 'checked';
                								}
                							});
                						})
                					}

                				});

                				table_group_str +=
                					'<tr>'
                						+'<td>'
                							+'<div class="form-check pb-1">';

                				if(val.selection == 1){
                					table_group_str +=
                								'<input class="form-check-input" type="checkbox" name="group[]" id="'+val1.name+'" value="1" '+checked+'>'
                								+'<label class="form-check-label" for="'+val1.name+'">'+val1.name + checked +'</label>';
                				}else{
                					table_group_str +=
                								'<input class="form-check-input" type="radio" name="'+val.name+'" id="'+val1.name+'" value="'+val.name+'" '+checked+'>'
                								+'<label class="form-check-label" for="'+val1.name+'">'+val1.name+checked+'</label>';
                				}

                				var price = Number(val1.price).toFixed(2);
                				if(price == '0.00'){
                					var price = '';
                				}else{
                					var price = '+ $'+price;
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

                		$('#customize-item-modal').modal('show');
                		console.log(returnData);
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });
	}
});
