$(document).on('click','.select-type',function(){
    console.log("Weekly");

     var reditect_shop_name = $(this).attr('data-name');
     var reditect_shop_id = $(this).attr('data-shopid');
     var reditect_day = $(this).attr('data-day');
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
                            my_str = 'delivery_weekly_'+reditect_day;
                       }else{
                            my_str = 'takeout_weekly_'+reditect_day;
                       }
                       window.open(
                          shop_url+my_str+'/nearby/'+reditect_shop_name,
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
