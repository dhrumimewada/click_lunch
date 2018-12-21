<?php
$edit_link = base_url().'promocode-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Promocode</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'promocode-add'; ?>">Add New Promocode</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="promocode-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap promocode_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Promocode</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th class='text-center'>Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($promocode_list) && !empty($promocode_list) && count($promocode_list) > 0){
                                foreach ($promocode_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);
                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["promocode"]) . "</td>";

                                    if($value["discount_type"] == 1){
                                        $discount_type = 'Percentage';
                                    }else{
                                        $discount_type = 'Flat';
                                    }

                                    echo "<td>" . $value["amount"] . "</td>";
                                    echo "<td>" . $discount_type . "</td>";

                                    $from_date_ts = strtotime($value["from_date"]);
                                    $from_date = date("j M, Y", $from_date_ts);
                                    echo "<td data-order='" . $from_date_ts . "'>" . $from_date . "</td>";

                                    $to_date_ts = strtotime($value["to_date"]);
                                    $to_date = date("j M, Y", $to_date_ts);
                                    echo "<td data-order='" . $to_date_ts . "'>" . $to_date . "</td>";

                                    
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactive';
                                        $btn_class = 'btn-deactive';
                                    }
                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_promocode' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary btn-sm waves-effect waves-light title='Edit' data-popup='tooltip' > Edit</a>
                                        <button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_promocode' title='Delete' data-popup='tooltip'>Delete</button></td>
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
    var promocode_list = $('.promocode_list').DataTable({
            keys: true,
            "order": [[6, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [7]},{visible: false,targets: [6]}],
    });

    var delete_url = "<?php echo base_url().'promocode-delete'; ?>";
    var status_url = "<?php echo base_url().'promocode-status'; ?>";

    $(document).ready(function () {

         $(document).on('click',".delete_promocode", function(){

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
                                    'promocode has been deleted.',
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

        $(document).on('click',".deactive_promocode", function() {

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
                    title: 'Are you sure you want to '+change_status_to+' promocode?',
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
                                    'promocode has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_promocode' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
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