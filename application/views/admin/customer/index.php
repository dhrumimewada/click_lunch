<?php
$edit_link = base_url().'customer-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Customers</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg d-none" href="<?php echo base_url().'customer-add'; ?>">Add New Customer</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="customer-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap customer_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
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

<script type="text/javascript">


    var delete_url = "<?php echo base_url().'customer-delete'; ?>";
    var status_url = "<?php echo base_url().'customer-status'; ?>";

    $(document).ready(function () {

        // $(document).on('click',".delete_customer", function(){

        //     $this = $(this);
        //     var data_id = get_dataid($this);

        //     if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

        //         swal({
        //             title: 'Are you sure you want to delete?',
        //             type: 'warning',
        //             showCancelButton: true,
        //             confirmButtonClass: 'btn btn-success',
        //             cancelButtonClass: 'btn btn-danger m-l-10',
        //             confirmButtonText: 'Yes, delete it!'
        //         }).then(
        //             function () {

        //             $.ajax({
        //                 url: delete_url,
        //                 type: "POST",
        //                 data:{id:data_id},
        //                 success: function (returnData) {
        //                     returnData = $.parseJSON(returnData);
        //                     if (typeof returnData != "undefined")
        //                     {
        //                         swal(
        //                             'Deleted!',
        //                             'Customer has been deleted.',
        //                             'success'
        //                         )
        //                         remove_row($this);
        //                     } 
        //                 },
        //                 error: function (xhr, ajaxOptions, thrownError) {
        //                     console.log('error');
        //                 },
        //                 complete: function () {
        //                     $(this).removeAttr("disabled");
        //                 }
        //             });    
        //         })
        //     }    
        // });

        $(document).on('click',".deactive_customer", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactivate';
                var change_status_to1 = 'Deactivated!';
                var btn_name_replace = 'Deactive';
                var btn_cls_replace = 'btn-deactive';
                var status = '2';
            }else{
                var change_status_to = 'active';
                var change_status_to1 = 'Activated!';
                var btn_name_replace = 'Active';
                var btn_cls_replace = 'btn-success';
                var status = '1';
            }

            if (data_id !== null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to '+change_status_to+'?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes'
                }).then(
                    function () {

                    $.ajax({
                        url: status_url,
                        type: "POST",
                        data:{
                            id:data_id,
                            status:status
                            },
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    change_status_to1,
                                    'Customer has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_customer' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        },
                        complete: function () {
                            $(this).removeAttr("disabled");
                        }
                    });    
                })
            }    
        });
    });
</script>