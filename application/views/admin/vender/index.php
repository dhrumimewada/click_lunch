<?php
$edit_link = base_url().'vender-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Restaurants</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'vender-add'; ?>">Add New Restaurant</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="vender-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap vender_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Restaurant Name</th>
                                <th>Vender Name</th>
                                <th>Email</th>
                                <th>Restaurant Code</th>
                                <th class='text-center'>Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($vender_list) && !empty($vender_list) && count($vender_list) > 0){
                                foreach ($vender_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["shop_name"]) . "</td>";
                                    echo "<td>" . stripslashes($value["vender_name"]). "</td>";
                                    echo "<td>" . $value["email"] . "</td>";
                                    echo "<td>" . $value["shop_code"] . "</td>";
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactive';
                                        $btn_class = 'btn-deactive';
                                    }
                                    if($value["password"] == ''){
                                        echo "<td class='text-center'><button type='button' class='btn btn-sm btn-yellow waves-effect waves-light pending' title='Pending' data-popup='tooltip'>Pending</button></td>";
                                    }else{
                                        echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_shop' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    }
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    $disabled = '';
                                    if(empty($value["password"])){
                                        echo "<td class='text-center'><button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_vender' title='Delete' data-popup='tooltip'>Delete</button></td>
                                        </td>";
                                    }else{
                                        echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary btn-sm waves-effect waves-light ". $disabled ."' title='Edit' data-popup='tooltip' > Edit</a>
                                        <button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_vender' title='Delete' data-popup='tooltip'>Delete</button></td>
                                        </td>";
                                    }
                                    //echo "<td>".var_dump($value["password"])."</td>";
                                        
                                   
                                    
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
    var vender_list = $('.vender_list').DataTable({
            keys: true,
            "order": [[5, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [6]},{visible: false,targets: [5]}],
    });

    var delete_url = "<?php echo base_url().'vender-delete'; ?>";
    var status_url = "<?php echo base_url().'vender-status'; ?>";

    $(document).ready(function () {

         $(document).on('click',".delete_vender", function(){

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
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    'Deleted!',
                                    'Vender has been deleted.',
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

        $(document).on('click',".deactive_shop", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactive';
                var change_status_to1 = 'Deactived!';
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
                    title: 'Are you sure you want to '+change_status_to+' shop?',
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
                                    'Shop has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_shop' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
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