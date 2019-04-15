<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?php echo $table_title; ?></h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="customer-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap <?php echo $table_name; ?>" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Order Amount</th>
                                <th>Order Placed On</th>
                                <th>Order Should be Deliver by</th>
                                <th>Order Should be Deliver by - Order by</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'assets/js/custom/dynamic_datatable.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/js/custom/custom.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).on('click',".update-status", function() {

        var delete_url = "<?php echo base_url().'vender-order-status-update'; ?>";

        $this = $(this);
        var data_id = get_dataid($this);
    
        if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

            if($this.attr("status-id") == '8'){
                var change_status_to = 'cancel';
                var change_status_to1 = 'Cancelled';
                var btn_name_replace = 'Deactivate';
                var btn_cls_replace = 'btn-deactive';
                var status = '8';
            }else{
                var change_status_to = 'complete';
                var change_status_to1 = 'Completed';
                var btn_name_replace = 'Active';
                var btn_cls_replace = 'btn-success';
                var status = '6';
            }

            swal({
                title: 'Are you sure you want to '+change_status_to+'?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                confirmButtonText: 'Yes, '+change_status_to+' it!'
            }).then(
                function () {

                $(".overlay").css("display", "block");

                $.ajax({
                    url: delete_url,
                    type: "POST",
                    data:{
                        id:data_id,
                        status:status
                        },
                    success: function (returnData) {
                        returnData = $.parseJSON(returnData);
                        if (typeof returnData != "undefined")
                        {
                            $(".overlay").css("display", "none");

                            if(returnData.is_success == true){
                                console.log(returnData);
                                swal(
                                    change_status_to1+'!',
                                    'Order CL'+data_id+' has been '+change_status_to1,
                                    'success'
                                )
                                remove_row($this);

                            }else{
                                swal(
                                    'Something went wrong',
                                    returnData.message+' Please try again later',
                                    'warning'
                                )
                            }
                        } 
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('error');
                        $(".overlay").css("display", "none");
                    },
                    complete: function () {
                        $this.removeAttr("disabled");
                        $(".overlay").css("display", "none");
                    }
                });    
            })
        }    
    });
</script>