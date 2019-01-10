<?php
$edit_link = base_url().'inventory-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Inventory</h4>
                </div>
                <?php echo get_msg();  ?>
            </div>
        </div>
        <!-- end row -->

        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Update Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="mdi mdi-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="required">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity" value="<?php  ?>" min="0">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="required">Notify Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock" placeholder="Enter notify stock" value="<?php  ?>" min="0">
                            </div>
                        </div>
                        <input type="hidden" name="item-id" value="" id="item-id">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light" id="save_inventory">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap inventory_list table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Cuisine</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Notify Stock</th>
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
<script type="text/javascript" charset="utf-8" async defer>
    var quantity_stock_update_url = "<?php echo base_url().'inventory-update'; ?>";

    $(document).ready(function () {

        //Ajax
        var data_id = '';
        $(document).on('click',".quantity-stock-update", function(){
            $this = $(this);

            var quantity = $(this).attr("data-quantity");
            var stock = $(this).attr("data-stock");
            data_id = get_dataid($this);

            $('#quantity').val(quantity);
            $('#stock').val(stock);
            $('#item-id').val(data_id);
            
        });

        $(document).on('click',"#save_inventory", function()  {

            // console.log($('#quantity').val());
            // console.log($('#stock').val());
            //console.log($('#item-id').val());
            //console.log(quantity_stock_update_url);

            var quantity_data = $('#quantity').val();
            var stock_data = $('#stock').val();
            var item_id = $('#item-id').val();

            $.ajax({
                    url: quantity_stock_update_url,
                    type: "POST",
                    data:{
                        id:item_id,
                        stock:stock_data,
                        quantity:quantity_data
                        },
                    success: function (returnData) {
                        returnData = $.parseJSON(returnData);
                        if (typeof returnData != "undefined"){

                            var $row = $('tr[data-id="' + data_id + '"]');
                            $row.find(".label-quantity").text(quantity_data);
                            $row.find(".label-notify-stock").text(stock_data);

                            $('#myModal').modal('toggle');
                            swal(
                                    'Inventory',
                                    'Inventory has been updated',
                                    'success'
                                )
                        }
                        //console.log(returnData);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('error');
                    },
                    complete: function () {
                        $(this).removeAttr("disabled");
                    }
                });    
        });
    });
    
</script>