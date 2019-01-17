<?php
$edit_link = base_url().'delivery-boy-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Delivery Boys</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'delivery-boy-add'; ?>">Add New Delivery Boy</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="delivery_boy-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap delivery_boy_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th class='text-center'>Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($delivery_boy_list) && !empty($delivery_boy_list) && count($delivery_boy_list) > 0){
                                foreach ($delivery_boy_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["username"]) . "</td>";
                                    echo "<td>" . $value["email"] . "</td>";
                                    echo "<td>" . stripslashes($value["address"]) . "</td>";
                                    // echo "<td>" . $value["contact_no"] . "</td>";
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactivate';
                                        $btn_class = 'btn-deactive';
                                    }

                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_delivery_boy' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";

                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary btn-sm waves-effect waves-light' title='Edit' data-popup='tooltip' > Edit</a></td>";
                                    
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
    var delivery_boy_list = $('.delivery_boy_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [4]}],
    });

    var status_url = "<?php echo base_url().'delivery-boy-status'; ?>";

    $(document).ready(function () {

        $(document).on('click',".deactive_delivery_boy", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactivate';
                var change_status_to1 = 'Deactivated!';
                var btn_name_replace = 'Deactivate';
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
                                    'delivery boy has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_delivery_boy' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
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