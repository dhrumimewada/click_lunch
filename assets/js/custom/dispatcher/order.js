$(document).ready(function (){

    $(".select2").select2();
    var row_id = null;
    var order_name = null;
    var prev_db_id = '';
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
                            console.log(returnData);
                            if (typeof returnData != "undefined" && returnData.is_success == true)
                            {
                                
                                if(redirect == '1'){
                                    window.location = index_url;
                                }else{
                                    // increse quantity 
                                    if(status == '2'){

                                        $.ajax({
                                            url: quantity_update_reject_order_url,
                                            type: "POST",
                                            data: { order_id:data_id },
                                            success: function (returnData) {
                                                returnData = $.parseJSON(returnData);
                                                if (typeof returnData != "undefined"){
                                                    if(returnData.is_success == true){
                                                       // console.log('quantity updated');
                                                    }
                                                    //console.log(returnData);
                                                } 
                                            }
                                        });  
   
                                    }
                                    swal(
                                    change_status_to1,
                                        'Order has been '+change_status_to1,
                                        'success'
                                    )
                                    remove_row($this);
                                }
                                
                            }else{
                                swal(
                                        'Something went wrong!',
                                        'Please try again later',
                                        'warning'
                                    )
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            //console.log('error');
                        }
                    });    
                })
            }    
        });

        $(document).on('click',".assign-db", function(){
            $('#selct_db').find('option').remove().end();
            $('#selct_db').attr('disabled', 'disabled');

            $('#db-model .error').addClass("d-none");

            $this = $(this);
            order_name = $this.attr("data-ordername");
            prev_db_id = $this.attr("data-prev-db-id");
            //console.log(prev_db_id);
            //return false;
            if (typeof order_id != "undefined" && order_id != ''){
                row_id = order_id;
            }else{
                row_id = get_dataid($this);
            }
            
            $('.order-id').text(order_name);

            $.ajax({
                url: get_db_url,
                type: "POST",
                success: function (returnData) {
                     //console.log(returnData);
                     if (typeof returnData != "undefined" && returnData != ''){
                        returnData = $.parseJSON(returnData);

                        // console.log('DB');
                        // console.log(returnData);
                        $.each(returnData, function (key, val){
                            var option_text = val.username+ ' ( ' + val.mobile_number + ' )';
                            var newOption = new Option(option_text, val.id, false, false);
                            $('#selct_db').append(newOption).val('').trigger('change');
                        });
                        if(prev_db_id != ''){
                            $('#selct_db option[value="'+prev_db_id+'"]').attr("selected","selected").trigger('change');
                        }
                     }
                     $('#selct_db').removeAttr('disabled');
                    return true;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                   // console.log('error');
                }
            });
        });

        $(document).on('click',"#db-model .submit", function(){
            $this = $(this);
            var db_id = $('#selct_db').val();
            var db_name = $('#selct_db').find('option:selected').text();
            var order_id = row_id;

            // console.log(db_id);
            // console.log(row_id);
            // console.log(db_name);

            // if(typeof prev_db_id == "undefined" || prev_db_id == ''){
            //     console.log("blank");
            // }else{
            //     console.log(prev_db_id);
            // }

            //return false;

            if (order_id !== null && order_id.length > 0 && db_id !== null && db_id.length > 0){

                $.ajax({
                    url: set_db_url,
                    type: "POST",
                    data:{
                        db_id:db_id,
                        order_id:order_id
                    },
                    success: function (returnData) {
                        console.log(db_id);
                        if (typeof returnData != "undefined")
                        {
                            $('#db-model').modal('toggle');
                            swal(
                                'Assigned!',
                                'Order '+order_name+' Has Been Assigned To '+db_name+'.',
                                'success'
                            )

                            if(typeof prev_db_id == "undefined" || prev_db_id == ''){
                                
                                $('tr[data-id="' + row_id + '"] td:last-child .assign-db').replaceWith("<button type='button' class='btn btn-sm btn-yellow waves-effect waves-light assign-db' title='Reassign Delivery Boy' data-popup='tooltip' data-toggle='modal' data-target='#db-model' data-ordername='CL"+order_id+"' data-prev-db-id='"+db_id+"'>Reassign</button>");
                            }else{
                                $('tr[data-id="' + row_id + '"] td:last-child .assign-db').attr('data-prev-db-id', db_id);
                            }

                            
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

        $(document).on('click',"#detail-db-model .submit", function(){
            $this = $(this);
            var db_id = $('#selct_db').val();
            var db_name = $('#selct_db').find('option:selected').text();
            var order_id = row_id;

            // console.log(db_id);
            // console.log(row_id);
            // console.log(db_name);
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
                            $('#detail-db-model').modal('toggle');

                                swal({
                                    title: "Assigned!",
                                    text: 'Order '+order_name+' Has Been Assigned To '+db_name+'.',
                                    type: "success"
                                }).then( function() {
                                        window.location = back_url;
                                });
                            
                        } 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('error');
                    }
                });
            }else{
                $('#detail-db-model .error').removeClass("d-none");
            }
        });
    });