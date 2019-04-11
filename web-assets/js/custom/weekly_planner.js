$( document ).ready(function() {

    // update_shops();

    // if (typeof latitude !== 'undefined' && latitude != '' && typeof longitude !== 'undefined' && longitude != ''){

    // }else{

    //     window.onload = function() {

    //         function initMap(position) {
    //             latitude = parseFloat(position.coords.latitude);
    //             longitude = parseFloat(position.coords.longitude);
    //             update_shops();
                 
    //         }
    //         if (navigator.geolocation){
    //             navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
    //                 navigator.geolocation.getCurrentPosition(initMap);
    //             });
    //         }

    //     }
    // }

});

$(document).on('click','.select-type',function(){
    console.log("Near by");

     var reditect_shop_name = $(this).attr('data-name');
     var reditect_shop_id = $(this).attr('data-shopid');
    // console.log(reditect_shop_name);
    // return false;

    var inputOptions = new Promise(function(resolve) {
    resolve({
          '1': 'Delivery',
          '2': 'Takeout'
        });
    });

    swal({
      title: 'Select Order Type',
      input: 'radio',
      confirmButtonColor: '#ff0000',
      showCancelButton: true,
      inputOptions: inputOptions,
      inputValidator: function(result) {
        return new Promise(function(resolve, reject) {
          if (result) {
            resolve();
          } else {
            reject('You need to select any type!');
          }
        });
      }
    }).then(function(result) {
      console.log(result);

        $.ajax({
            url: set_order_type_session,
            type: "POST",
            data:{
                order_type:result,
                shopid:reditect_shop_id
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    if(returnData.is_success == true){

                       window.location = shop_url+reditect_shop_name;

                    }else{

                       swal(
                            'Sevice not available',
                            returnData.message,
                            'warning'
                        )
                        return false;

                    }
                }
                
            },
            error: function (xhr, ajaxOptions, thrownError){
                return false;
            }
        });

    })

});

function update_shops() {


        console.log('latitude '+latitude+' ');
        console.log('longitude '+longitude+' ');
      return false;
    $.ajax({
            url: get_shop_data_url,
            type: "POST",
            data:{
                latitude:latitude,
                longitude:longitude
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){

                    var data_str = '';
                    var data_str_combo = '';
                    var data_str_new = '';
                    $('#nearby').html('');
                    $('#combo').html('');

                   // console.log(returnData.shops);
                    if (typeof returnData.shops !== 'undefined' && returnData.shops.length > 0){
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

                            //console.log(val.availibality.day);
                            var time = '';
                            // if(val.availibality.is_closed == 1){
                            //     time = 'TODAY CLOSED';
                            // }else if(val.availibality.full_day == 1){
                            //     time = 'FULL DAY OPEN';
                            // }else if(val.availibality.from_time != '' && val.availibality.to_time != ''){
                            //     time = val.availibality.from_time + ' to ' + val.availibality.to_time;
                            // }else{
                            //     time = ' ';
                            // }

                            redirect_str ='<a href="javascript:void(0);" class="select-type" data-name="'+val.short_name+'" data-shopid="'+val.id+'">';

                            data_str_new = 
                            '<div class="col-lg-3 px-2">'
                                +'<div class="card">'
                                    // +'<a href="'+shop_url+val.short_name+'">'
                                    +redirect_str
                                        +'<div class="restaurant-img position-relative">'
                                            +'<img src="'+profile_picture+'" class="card-img-top" alt="Card image cap">'
                                            +'<div class="rating txt1">Ratings</div>'
                                            +'<div class="rating txt2 txt-red">'+val.rating+'</div>'
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
                                                    // +'<a href="'+shop_url+val.short_name+'">'
                                                    +redirect_str
                                                        +'<img src="'+zoom_out_img_url+'">'
                                                    +'</a>'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>'
                                    +'</a>'
                                +'</div>'
                            +'</div>';

                            data_str += data_str_new;

                            if(val.combo_available == true){
                                data_str_combo += data_str_new ;
                                combo_data_available = true;
                            }
                            
                        });


                    }else{
                        //console.log('No shops found');
                        data_str = '<div class="text-muted no-shops-found"><div class="d-block">No any restaurant found</div></div>';
                    }

                     // console.log(returnData.shops);
                     // return false;

                    $('#nearby').html(data_str);
                    
                    $('[data-toggle="tooltip"]').tooltip();
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                return false;
            }
        });
}