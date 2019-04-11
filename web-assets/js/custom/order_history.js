$( document ).ready(function(){

	$('#order_date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	});

	

	$(document).on('click',".mdi-heart-outline , .mdi-heart", function(){
		$this = $(this);
		var data_status = $this.attr('data-status');
		var data_id = $this.attr('data-id');

		var status = 1;
		if(data_status == 1){
			status = 0;
			var remove_class = 'mdi-heart';
			var add_class = 'mdi-heart-outline';
		}else{
			var add_class = 'mdi-heart';
			var remove_class = 'mdi-heart-outline';
		}
		$.ajax({
            url: add_favourite_url,
            type: "POST",
            data:{
            	id:data_id,
            	status:status,
            },
            success: function (returnData) {
            	
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    if(returnData.is_success == true){
                    	//console.log(returnData);
                    	$this.removeClass(remove_class);
                    	$this.addClass(add_class);
                    	$this.attr('data-status', status);
                    }
                }
            }
        });
	});

	$(document).on('click',".filter", function(){
		get_cuisines();
		$('#order_date').val(selected_order_date);
	});

	$(document).on('keyup',"#filterSearch", function(e){
		var txt = $('#filterSearch').val();
		if(txt == ''){
			get_cuisines();
		}else{
			get_cuisines(txt);
		}
	});

	$(document).on('click',"#filterbtn", function(){

		$(".overlay").css("display", "block");

		var ids = [];
		selected_cuisines = [];
		$('.cuisines:checkbox:checked').each(function() {
		   ids.push(this.value); 
		   selected_cuisines.push(this.value); 
		});
		var order_date = $('#order_date').val();
		selected_order_date = order_date;
		//console.log(order_date);

		$.ajax({
            url: get_order_history_url,
            type: "POST",
            data:{
            	cuisines:ids,
            	date:order_date
            },
            success: function (returnData) {
            	
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    if(returnData.is_success == true){
                    	//console.log(returnData);
                    	//return false;
                    	$('.favourites-order-list').html('');
                    	$('.pagination').html('');
                    	var data_str = '';
                    	if (typeof returnData.filter_data !== 'undefined' && returnData.filter_data.length > 0){
                    		$.each(returnData.filter_data, function (key, val){
                    			if(val.shop_picture == ''){
                    				var shop_picture = default_shop_picture;
                    			}else{
                    				var shop_picture = img_base_url+val.shop_picture;
                    			}

                    			 var date1 = Date.parse(val.created_at);
                    			 var date = new Date(date1);
                    			 var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    			 var d = date.getDate();
                    			 var m = strArray[date.getMonth()];
                    			 var y = date.getFullYear();
                    			 var h = addZero(date.getHours());
                    			 var min = addZero(date.getMinutes());
                    			 var ampm = (h >= 12) ? "PM" : "AM";

                    			var order_date = d + ' ' + m + ', ' + y + ' ' + h + ':' + min + ' ' + ampm;

                    			var str = '';
                    			if(val.order_type == 1){
									str = 'Deliver Now';
								}else if(val.order_type == 2){
									str = 'Deliver Later';
								}else if(val.order_type == 3){
									str = 'Takout Now';
								}else if(val.order_type == 4){
									str = 'Takout Later';
								}else{
									str = 'Weekly';
								}

								if(val.favourite == 0){
									var favourite_class = 'mdi-heart-outline';
								}else{
									var favourite_class = 'mdi-heart';
								}

								var order_status ='';
								if(val.order_status == 0 || 1 || 3){
									order_status = 'Pending';
								}else if(val.order_status == 2){
									order_status = 'Cancelled';
								}else if(val.order_status == 4){
									order_status = 'Accepted';
								}else if(val.order_status == 5){
									order_status = 'Picked';
								}else if(val.order_status == 6){
									order_status = 'Delivered';
								}else{
									order_status = 'Fail';
								}

	                    		data_str += 
	                    		'<div class="favourites-order row m-0 align-items-center justify-content-between">'
	                    			+'<div class="col-md-2 text-center d-flex justify-content-center align-items-center">'
	                    				+'<img src="'+shop_picture+'" class="site-logo">'
	                    			+'</div>'
	                    			+'<div class="favourites-order-detail col-lg-8 col-md-7 p-0">'
	                    				+'<div class="order-name">'
	                    				+val.shop_name
	                    				+'</div>'
	                    				+'<div class="order-id"><strong>Order CRN: </strong><a href="'+order_detail_url+val.id+'">CL'+val.id+'</a>'
	                    				+'</div>'
	                    				+'<div class="order-address">'+val.shop_address+'</div>'
	                    				+'<div class="ordered-at">'
	                    				+'<strong>Ordered at: </strong>'
	                    				+order_date
	                    				+'</div>'
	                    				+'<div class="order-type-and-total d-flex">'
	                    					+'<div class="type">'
	                    					+'<strong>Type: </strong>'
	                    					+'<span>'+str+'</span>'
	                    					+'</div>'
	                    					+'<div class="total">'
	                    						+'<strong>Total:</strong>'
	                    						+'<span> $'+val.total+'</span>'
	                    					+'</div>'
	                    				+'</div>'
	                    			+'</div>'
	                    			+'<div class="reorder-block col-md-2 text-center d-flex flex-wrap justify-content-md-end align-items-center">'
	                    				+'<div class="favourite-reorder"><a href="cart.html" class="reorder">Reorder</a></div>'
	                    				+'<div class="favourite text-warning">'
	                    					+'<i class="mdi '+favourite_class+' mdi-24px pointer" data-status="'+val.favourite+'" data-id="'+val.id+'"></i>'
	                    				+'</div>'
	                    				+'<div class="favourite-order-type"><span class="delivered order-type">'+order_status+'</span></div>'
	                    			+'</div>'
	                    		+'</div>';
	                    	});
                    	}else{
                    		data_str = 'No orders';
                    	}
                    	
                    	$('.favourites-order-list').html(data_str);
                    	$('#filterModal').modal('hide');
                    	console.log(selected_cuisines);
                    	$(".overlay").css("display", "none");
                    }
                }
            }
      	});
	});
});

function get_cuisines(str) {
	$.ajax({
            url: get_cuisines_url,
            type: "POST",
            data:{str:str},
            success: function (returnData) {
            	
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    if(returnData.is_success == true){
                    	//console.log(returnData);
                    	$('.filter-items').html('');
                    	var data_str = '';
                    	$.each(returnData.data, function (key, val){
                    		var checked = 'checked';
                    		if (typeof selected_cuisines !== 'undefined' && selected_cuisines.length > 0){
                    			$.each(selected_cuisines, function (key1, val1){
                    				if(val.id == val1){
                    					checked = 'checked';
                    					return false;
                    				}else{
                    					checked = '';
                    				}
                    			});
                    		}
                    		data_str += 
                    			'<div class="form-check">'
									+'<input type="checkbox" class="form-check-input cuisines" id="'+val.id+'" value="'+val.id+'" '+checked+'>'
								    +'<label class="form-check-label pointer" for="'+val.id+'">'+val.cuisine_name+'</label>'
								+'</div>';
                    	});

                    	$('.filter-items').html(data_str);
                    	
                    }
                }
            }
      	});
}

function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}
	