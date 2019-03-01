<?php
$edit_link = base_url().'processing-update';
?>
<style type="text/css" media="screen">
   .modal h4{
        margin: 0;
   } 
   .modal .btn-danger{
        color: #f9f9f9;
        border-color: #fe3153;
        background-color: #fe3153;
   }
</style>
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

        <!-- The Modal -->
        <div class="modal" id="db-model">
            <div class="modal-dialog">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Assign Order To Delivery Boy (<span class="order-id">CL80</span>)</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-12">
                        <label class="required" for="group">List of Delivery Boys</label>
                        <div>
                            <select class="select2 form-control" data-placeholder="Select Delivery Boy" name="selct_db" id='selct_db'>
                            </select>
                            <div class="text-danger d-none error">Please select delivery boy</div>
                        </div>
                  </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success submit">Assign</button>
                </div>
                
              </div>
            </div>
        </div>

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
    var get_db_url = "<?php echo base_url().'fetch-db'; ?>";
    var set_db_url = "<?php echo base_url().'set-db'; ?>";

    var redirect = '';
    var order_id = '';
    var index_url = "";
</script>