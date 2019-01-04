<?php
$edit_link = base_url().'item-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Products</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg mr-2" href="<?php echo base_url().'item-add'; ?>">Add New Product</a>
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'combo-add'; ?>">Add New Combo</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="item-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap item_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Cuisine</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class='text-center'>Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($item_list) && !empty($item_list) && count($item_list) > 0){
                                foreach ($item_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);
                                    $combo = ($value["is_combo"] == 1)?'Combo':'Single';

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["name"]) . "</td>";
                                    echo "<td>" . stripslashes($value["cuisine_name"]) . "</td>";

                                    echo "<td>" . $combo . "</td>";

                                    if($value["offer_price"] != ''){
                                        echo "<td data-order='" . $value["offer_price"] . "'><s class='text-muted'>&#36;&nbsp;" . $value["price"]. "</s>&nbsp;&nbsp;&#36; ". $value["offer_price"] ."</td>";
                                    }else{
                                        echo "<td  data-order='" . $value["price"] . "'>&#36; " . $value["price"]. "</td>";
                                    }
                                    
                                    
                                    echo "<td>" . $value["quantity"] . "</td>";
                                    
                                    if($value["is_active"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactive';
                                        $btn_class = 'btn-deactive';
                                    }
                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_item' status-id='" . $value["is_active"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary  waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a>
                                        <button type='button' class='btn btn-danger waves-effect waves-light btn-sm delete_item' title='Delete' data-popup='tooltip'>Delete</button></td>
                                        </td>";
                                    echo '</tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'assets/js/custom/custom.js'; ?>"></script>
<script type="text/javascript">
    var item_list = $('.item_list').DataTable({
            keys: true,
            "order": [[6, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [7]},{visible: false,targets: [6]}],
    });

    var delete_url = "<?php echo base_url().'item-delete'; ?>";
    var status_url = "<?php echo base_url().'item-status'; ?>";

    $(document).ready(function () {

        $(document).on('click',".delete_item", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to delete?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(
                    function () {

                    $.ajax({
                        url: delete_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            console.log(returnData);
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    'Deleted!',
                                    'Item has been deleted.',
                                    'success'
                                )
                                remove_row($this);
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

        $(document).on('click',".deactive_item", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactive';
                var change_status_to1 = 'Deactived!';
                var btn_name_replace = 'Deactive';
                var btn_cls_replace = 'btn-deactive';
                var status = '0';
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
                    cancelButtonClass: 'btn btn-deactive m-l-10',
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
                                    'Item has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " waves-effect waves-light btn-sm deactive_item' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        },
                        complete: function () {
                            $(this).removeAttr("disabled");
                            $(this).blur();
                        }
                    });    
                })
            }    
        });
    });
</script>