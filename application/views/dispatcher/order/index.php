<?php
$edit_link = base_url().'processing-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">New Orders</h4>
                </div>
                <?php echo get_msg();  ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap table-hover" id="new-order-list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Restaurant Name</th>
                                <th>Order Amount</th>
                                <th>Order Date Time</th>
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
<script src="<?php echo base_url() . 'assets/js/custom/dispatcher/order.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
    var order_status_update_url = "<?php echo base_url().'order-status-update'; ?>";
    var redirect = '';
    var order_id = '';
    var index_url = "";
</script>