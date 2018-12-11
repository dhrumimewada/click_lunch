<?php// var_dump($_SESSION); ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Admin List</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url().'add_admin' ?>">Add New Admin</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="admin-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap admin_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($admin_list) && !empty($admin_list) && count($admin_list) > 0){
                                foreach ($admin_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . $value["username"] . "</td>";
                                    echo "<td>" . $value["email"] . "</td>";
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                    }else{
                                        $btn_name = 'Deactive';
                                    }
                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn btn-outline-primary waves-effect waves-light deactive_user' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button>
                                        <button type='button' class='btn btn-outline-primary waves-effect waves-light delete_user' title='Delete' data-popup='tooltip'>Delete</button></td>";
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

    var delete_user_id = null;
    var delete_user_row = null;
    var delete_table_select = null;
    var delete_url = "<?php echo base_url().'delete-admin'; ?>";
    var status_url = "<?php echo base_url().'status-admin'; ?>";

    var admin_list = $('.admin_list').DataTable({
            keys: true,
            "order": [[2, "desc"]],
            'iDisplayLength': 10
    });
    $(document).ready(function () {

        $(document).on('click',".delete_user", function(){

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
                                    'Admin has been deleted.',
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

        $(document).on('click',".deactive_user", function(){

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactive';
                var change_status_to1 = 'deactived!';
                var btn_name_replace = 'Deactive';
                var status = '0';
            }else{
                var change_status_to = 'active';
                var change_status_to1 = 'activated!';
                var btn_name_replace = 'Active';
                var status = '1';
            }

            if (data_id !== null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to '+change_status_to+' admin?',
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
                                    'Admin has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn btn-outline-primary waves-effect waves-light deactive_user' status-id='" +status+ "' title='"+btn_name_replace+"' >" +btn_name_replace+ "</button>");

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