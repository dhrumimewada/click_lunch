$(document).on('click','.nav-link',function(){
	cuisine_id = $(this).attr('id');
	update_shops();
});

$(document).on('click','.filter',function(){
	if ($('input#filter-pickup').is(':checked')){
		pickup = $('input#filter-pickup').val();
		console.log(pickup);
	}else{
		pickup = '';
	}

	if ($('input#filter-popular').is(':checked')){
		popular = $('input#filter-popular').val();
		console.log(popular);
	}else{
		popular = '';
	}
	update_shops();
});

function update_shops() {
	$.ajax({
            url: get_shop_data_url,
            type: "POST",
            data:{
                cuisine_id:cuisine_id,
                pickup:pickup,
                popular:popular
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                	if (typeof returnData.shops !== 'undefined' && returnData.shops.length > 0){
                		var data_str = '';
                		$('#nearby').html('');
                		 console.log(returnData.shops);
                		$.each(returnData.shops, function (key, val){

                			if(val.profile_picture == ''){
                				var profile_picture = defualt_photo_url;
                			}else{
                				var profile_picture = photo_url+val.profile_picture;
                			}

                			var shop_name = val.shop_name.replace(/\\/g, "");
                			var cuisines = '';
                			var total_cuisine = val.cuisine.length - 1;
                			$.each(val.cuisine, function (cuisine_key, cuisine_val){
                				cuisines += '<span data-id="'+cuisine_val.cuisine_id+'" data-toggle="tooltip" data-placement="bottom" title="View all '+cuisine_val.cuisine_name+' Restaurants" class="search-cuisine d-inline-block pointer">'+cuisine_val.cuisine_name+'</span>';
                				if(cuisine_key != total_cuisine){
                					cuisines += ', ';
                				}
                			});

                			console.log(val.availibality.day);
                			var time = '';
                			if(val.availibality.is_closed == 1){
                				time = 'TODAY CLOSED';
                			}else if(val.availibality.full_day == 1){
                				time = 'FULL DAY OPEN';
                			}else if(val.availibality.from_time != '' && val.availibality.to_time != ''){
                				time = val.availibality.from_time + ' to ' + val.availibality.to_time;
                			}else{
                				time = ' ';
                			}

                			data_str += 
                			'<div class="col-lg-3 px-2">'
                				+'<div class="card">'
                					+'<a href="'+shop_url+val.short_name+'">'
                						+'<div class="restaurant-img position-relative">'
                							+'<img src="'+profile_picture+'" class="card-img-top" alt="Card image cap">'
                							+'<div class="rating txt1">Ratings</div>'
                							+'<div class="rating txt2 txt-red">4.2</div>'
                						+'</div>'
                						+'<div class="card-body restaurant-body">'
                							+'<div class="card-title txt-red font-md text-center cut-text">'
                								+shop_name
                							+'</div>'
                							+'<b>'
                								+'<div class="d-inline-block txt-black font-small">'
                									+'Delivery '+val.delivery_time
                								+'</div>'
                								+'<div class="d-inline-block txt-black font-small float-right">'
                									+'Order by '+val.order_by_time
                								+'</div>'
                							+'</b>'
                							+'<div class="position-relative txt-black font-14 pl-4 cusion cut-text">'
                								+cuisines
                							+'</div>'
                							+'<div class="card-text txt-black font-11">'
                								+time
                							+'</div>'
                						+'</div>'
                						+'<div class="restaurant-hover">'
                							+'<div class="restaurant-hover-list">'
                								+'<div class="restaurant-hover-img pointer">'
                									+'<a href="'+shop_url+val.short_name+'">'
                										+'<img src="'+zoom_out_img_url+'">'
                									+'</a>'
                								+'</div>'
                							+'</div>'
                						+'</div>'
                					+'</a>'
                				+'</div>'
                			+'</div>';
                		});


                		$('#nearby').html(data_str);
                		$('[data-toggle="tooltip"]').tooltip();
                	}else{
                		console.log('No shops found');
                	}
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                return false;
            }
        });
}