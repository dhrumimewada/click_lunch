$( document ).ready(function() {

    update_shops();

        window.onload = function() {

            function initMap(position) {
                latitude = parseFloat(position.coords.latitude);
                longitude = parseFloat(position.coords.longitude);
                //console.log('latitude-'+latitude+' longitude-'+longitude );
                update_shops();
                 
            }
            if (navigator.geolocation){
                navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
                    navigator.geolocation.getCurrentPosition(initMap);
                });
            }

        }

});

$(document).on('click','.list-filter .nav-link',function(){
    cuisine_id = $(this).attr('id');
    update_shops();
});

$(document).on('change','#deliver-fee',function(){

    $("#order-price option:selected").prop('selected', false);
    $("#order-price").val("");
    minimum_order_amount = '';

    delivery_fee = $( "#deliver-fee option:selected" ).val();
    update_shops();
});

$(document).on('click','#filter-pickup',function(){
    if ($('input#filter-pickup').is(':checked')){
        pickup = $('input#filter-pickup').val();
    }else{
        pickup = '';
    }
    update_shops();
});

$(document).on('click','#filter-popular',function(){
    if ($('input#filter-popular').is(':checked')){
        popular = $('input#filter-popular').val();
    }else{
        popular = '';
    }
    
    update_shops();
});

$(document).on('change','#order-price',function(){

    $("#deliver-fee option:selected").prop('selected', false);
    $("#deliver-fee").val("");
    delivery_fee = '';

    minimum_order_amount = $( "#order-price option:selected" ).val();
    update_shops();
});

$(document).on('change','#order-category',function(){
    category = $( "#order-category option:selected" ).val();
    update_shops();
});

$(document).on('change','#review-star1',function(){
    rating = $( "#review-star1 option:selected" ).val();
    update_shops();
});

$(document).on('click','#filter-clear',function(){
    //console.log("clear all");
    $("#deliver-fee option:selected").prop('selected', false);
    $("#deliver-fee").val("");
    delivery_fee = '';

    $("#review-star1 option:selected").prop('selected', false);
    $("#review-star1").val("");
    rating ='';

    $("input#filter-pickup").prop("checked", false);
    pickup = '';
    $("input#filter-popular").prop("checked", false);
    popular = '';

    $("#order-price option:selected").prop('selected', false);
    $("#order-price").val("");
    minimum_order_amount = '';

    $("#order-category option:selected").prop('selected', false);
    $("#order-category").val("");
    category = '';

    $('.home-filter-box .nav-link.all').click();
    cuisine_id = '';

    update_shops();
});

$(document).on('click','.search-cuisine',function(){
    cuisine_id  = $(this).attr('data-id');
    //console.log(cuisine_id);

    $('.home-filter-box .nav-link#'+cuisine_id).click();

    $("#deliver-fee option:selected").prop('selected', false);
    $("#deliver-fee").val("");
    delivery_fee = '';

    $("#review-star1 option:selected").prop('selected', false);
    $("#review-star1").val("");
    rating ='';

    $("input#filter-pickup").prop("checked", false);
    pickup = '';
    $("input#filter-popular").prop("checked", false);
    popular = '';

    $("#order-price option:selected").prop('selected', false);
    $("#order-price").val("");
    minimum_order_amount = '';

    $("#order-category option:selected").prop('selected', false);
    $("#order-category").val("");
    category = '';


    $('html, body').animate({
        scrollTop: $("#offers").offset().top
    }, 500);

    update_shops();
});

$(document).on('click','#find-shops-by-address',function(){

    if($("#latitude").val() == '' || $("#longitude").val() == '' || $("#autocomplete").val() == ''){
        swal(
            'Your address seems wrong',
            'Please select your address from suggestions',
            'warning'
        )
    }else{
        $('.home-filter-box .nav-link.all').click();
        cuisine_id = '';

        $("#deliver-fee option:selected").prop('selected', false);
        $("#deliver-fee").val("");
        delivery_fee = '';

        $("#review-star1 option:selected").prop('selected', false);
        $("#review-star1").val("");
        rating ='';

        $("input#filter-pickup").prop("checked", false);
        pickup = '';
        $("input#filter-popular").prop("checked", false);
        popular = '';

        $("#order-price option:selected").prop('selected', false);
        $("#order-price").val("");
        minimum_order_amount = '';

        $("#order-category option:selected").prop('selected', false);
        $("#order-category").val("");
        category = '';


        $('html, body').animate({
            scrollTop: $("#offers").offset().top
        }, 500);

        latitude = $("#latitude").val();
        longitude = $("#longitude").val();

        update_shops();
    }
});

$(document).on('change','#autocomplete',function(){
    console.log($(this).val());
    $("#latitude").val('');
    $("#longitude").val('');
});

$(document).on('click','.select-type',function(){
    //console.log("Near by");

    var tabpan = $(this).closest('.tab-pane.fade').attr('id');

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
      //console.log(result);

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

                       //window.location = shop_url+reditect_shop_name;
                       if(result == 1){
                            my_str = 'delivery';
                       }else{
                            my_str = 'takeout';
                       }
                       window.open(
                          shop_url+my_str+'/'+tabpan+'/'+reditect_shop_name,
                          '_blank'
                        );

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

    order_type = '';

    $(".overlay").css("display", "block");

       // console.log('cuisine_id '+cuisine_id+' ');
       // console.log('pickup '+pickup+' ');
       // console.log('popular '+popular+' ');
       // console.log('delivery_fee '+delivery_fee+' ');
       // console.log('minimum_order_amount '+minimum_order_amount+' ');
       // console.log('category '+category+' ');
       // console.log('rating '+rating+' ');
       // console.log('latitude '+latitude+' ');
       // console.log('longitude '+longitude+' ');
       //  return false;
        
    $.ajax({
            url: get_shop_data_url,
            type: "POST",
            data:{
                cuisine_id:cuisine_id,
                pickup:pickup,
                popular:popular,
                delivery_fee:delivery_fee,
                minimum_order_amount:minimum_order_amount,
                category:category,
                rating:rating,
                delivery_restaurants:delivery_restaurants,
                pickup_restaurants:pickup_restaurants,
                latitude:latitude,
                longitude:longitude
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){

                    var data_str = '';
                    var data_str_combo = '';
                    var combo_data_available = false;
                    var data_str_new = '';
                    $('#nearby').html('');
                    $('#combo').html('');

                    if(delivery_restaurants == 1){
                        $('#delivery-restaurants').html('');
                        order_type = 'delivery';
                    }
                    if(pickup_restaurants == 1){
                        $('#takeout-restaurants').html('');
                        order_type = 'takeout';
                    }

                    //console.log(returnData.shops);
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
                                if(delivery_restaurants == 1 || pickup_restaurants == 1){
                                    cuisines += '<span data-toggle="tooltip" class="d-inline-block">'+cuisine_val.cuisine_name+'</span>';
                                }else{
                                    cuisines += '<span data-id="'+cuisine_val.cuisine_id+'" data-toggle="tooltip" data-placement="bottom" title="View all '+cuisine_val.cuisine_name+' Restaurants" class="search-cuisine d-inline-block pointer">'+cuisine_val.cuisine_name+'</span>';
                                }
                                
                                if(cuisine_key != total_cuisine){
                                    cuisines += ', ';
                                }
                            });

                            //console.log(val.availibality.day);
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

                            if(delivery_restaurants == 1){
                                redirect_str = '<a href="'+shop_url+'delivery/nearby/'+val.short_name+'" target="_blank" class="txt-red">';
                            }else if(pickup_restaurants == 1){
                                 redirect_str = '<a href="'+shop_url+'takeout/nearby/'+val.short_name+'" target="_blank" class="txt-red">';
                            }else{
                                redirect_str ='<a href="javascript:void(0);" class="select-type txt-red" data-name="'+val.short_name+'" data-shopid="'+val.id+'">';
                            }

                            data_str_new = 
                            '<div class="col-lg-3 px-2">'
                                +'<div class="card">'
                                    // +'<a href="'+shop_url+val.short_name+'">'
                                        +'<div class="restaurant-img position-relative select-type pointer">'
                                            +'<img src="'+profile_picture+'" class="card-img-top" alt="Card image cap">'
                                            +'<div class="rating txt1">Ratings</div>'
                                            +'<div class="rating txt2 txt-red">'+val.rating+'</div>'
                                        +'</div>'
                                        +'<div class="card-body restaurant-body">'
                                            +'<div class="card-title font-md text-center cut-text pointer">'
                                                +redirect_str+shop_name+'</a>'
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
                        data_str = '<div class="no-shops-found w-100 d-block text-center mt-5">No Any Restaurant Found</div>';
                        data_str_combo = '<div class="no-shops-found w-100 d-block text-center mt-5">No Any Combo Restaurant Found</div>';
                    }

                     // console.log(returnData.shops);
                     // return false;

                    $('#nearby').html(data_str);
                    if(delivery_restaurants == 1){
                        $('#delivery-restaurants').html(data_str);
                    }
                    if(pickup_restaurants == 1){
                        $('#takeout-restaurants').html(data_str);
                    }
                    if(combo_data_available ==true){
                        $('#combo').html(data_str_combo);
                    }else{
                        $('#combo').html('<div class="no-shops-found w-100 d-block text-center mt-5">No Any Combo Restaurant Found</div>');
                    }
                    
                    $('[data-toggle="tooltip"]').tooltip();
                    $(".overlay").css("display", "none");
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                return false;
                $(".overlay").css("display", "none");
            }
        });
}