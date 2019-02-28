$(document).ready(function (){

    $(".select2").select2();

        $(document).on('click',".update-status", function() {

            $this = $(this);

            if(order_id != ''){
                var data_id = order_id;
            }else{
                var data_id = get_dataid($this);
            }
            var status = $this.attr("status-id");
            // console.log(data_id);
            // return false;
            if(status == '1'){
                var change_status_to = 'accept';
                var change_status_to1 = 'Accepted!';
            }else{
                var change_status_to = 'reject';
                var change_status_to1 = 'Rejected!';
            }

            if (data_id !== null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to '+change_status_to+' order?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Yes'
                }).then(
                    function () {

                    $.ajax({
                        url: order_status_update_url,
                        type: "POST",
                        data:{
                            id:data_id,
                            status:status
                            },
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            if (typeof returnData != "undefined")
                            {
                                
                                if(redirect == '1'){
                                    window.location = index_url;
                                }else{
                                    swal(
                                    change_status_to1,
                                        'Order has been '+change_status_to1,
                                        'success'
                                    )
                                    remove_row($this);
                                }
                                
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        }
                    });    
                })
            }    
        });

        $(document).on('click',".assign-db", function(){
            $.ajax({
                url: get_db_url,
                type: "POST",
                success: function (returnData) {

                    returnData = $.parseJSON(returnData);
                    
                     if (typeof returnData != "undefined" && returnData != ''){
                        console.log(returnData);
                     }
                    // {
                        
                    //     if(redirect == '1'){
                    //         window.location = index_url;
                    //     }else{
                    //         swal(
                    //         change_status_to1,
                    //             'Order has been '+change_status_to1,
                    //             'success'
                    //         )
                    //         remove_row($this);
                    //     }
                        
                    // } 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });
        });
    });