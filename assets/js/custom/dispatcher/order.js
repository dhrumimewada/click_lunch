$(document).ready(function (){

    $(".select2").select2();
    var row_id = null;
    var this_row = null;
    var order_name = null;
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
            $('#selct_db').find('option').remove().end();
            $('#selct_db').attr('disabled', 'disabled');


            $this = $(this);
            row_id = get_dataid($this);
            this_row = $this;

            order_name = $this.attr("data-ordername");

            $.ajax({
                url: get_db_url,
                type: "POST",
                success: function (returnData) {
                     console.log(returnData);
                     if (typeof returnData != "undefined" && returnData != ''){
                        returnData = $.parseJSON(returnData);

                        // console.log('DB');
                        // console.log(returnData);
                        $.each(returnData, function (key, val){
                            var newOption = new Option(val.username, val.id, false, false);
                            $('#selct_db').append(newOption).val('').trigger('change');
                        });
                     }
                     $('#selct_db').removeAttr('disabled');
                    return true;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('error');
                }
            });
        });

        $(document).on('click',"#db-model .submit", function(){
            $this = $(this);
            var db_id = $('#selct_db').val();
            var db_name = $('#selct_db').find('option:selected').text();
            var order_id = row_id;

            console.log(db_id);
            console.log(row_id);
            console.log(db_name);
            if (order_id !== null && order_id.length > 0 && db_id !== null && db_id.length > 0){

                $.ajax({
                    url: set_db_url,
                    type: "POST",
                    data:{
                        db_id:db_id,
                        order_id:order_id
                    },
                    success: function (returnData) {
                        console.log(returnData);
                        if (typeof returnData != "undefined")
                        {
                            $('#db-model').modal('toggle');
                            remove_row(this_row);
                            swal(
                                'Assigned!',
                                'Order '+order_name+' Has Been Assigned To '+db_name+'.',
                                'success'
                            )

                            
                        } 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('error');
                    }
                });
            }else{
                $('#db-model .error').removeClass("d-none");
            }
        });
    });