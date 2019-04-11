$(document).on('click','#add-to-cart',function(){
    var groups = [];
    var error = false;
    var error_str = 'Please Choose At Least One ';
    // Get all required checkboxes
    $.each($('.required:checkbox'), function (key, val){
        if(!groups.includes($(val).attr("name"))){
            groups.push($(val).attr("name"));
        }
    });
    // Get all required radios
    $.each($('.required:radio'), function (key, val){
        if(!groups.includes($(val).attr("name"))){
            groups.push($(val).attr("name"));
        }
    });
    // for each for required groups
    $.each(groups, function (key, val){
        // if group select elelemts length is 0 - genrate error
        if($("input[name='"+val+"']:checked").length == 0){
            error_str += $("input[name='"+val+"']").first().closest('table').siblings().children().html();
            error = true;
            return false;
        } 
    });
    if(error == true){
        swal(
                'Required',
                error_str,
                'warning'
            )
    }else{

        // console.log(shop_id);
        // return false;

        $.ajax({
            url: check_cart_url,
            type: "POST",
            data:{
                order_type:order_type,
                shop_id:shop_id
            },
            success: function (returnData) {
                returnData = $.parseJSON(returnData);
                if (typeof returnData != "undefined"){
                    console.log(returnData);
                    if(returnData.is_success == true){
                        if(returnData.diff_order_type == 0){
                            $('#form-item').submit();
                            return true;
                        }else{
                            swal({
                                  title: "Cart will be cleared",
                                  text: "Are you sure you want to continue?",
                                  type: "warning",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn btn-success',
                                  cancelButtonClass: 'btn btn-danger m-l-10',
                                  confirmButtonText: 'Yes'
                                }).then(
                                    function () {
                                        console.log('cart updating');
                                        $('#form-item').submit();
                                    }
                                )
                        }
                    }else{

                       swal(
                            'Server encounter error',
                            'Please try again later',
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
    }
    
});


