<?php
$edit_link = base_url().'employee-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Employees</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url().'employee-add'; ?>">Add New employee</a>
                    </div>
                </div>
                <?php echo get_msg();  ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="employee-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap employee_list table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class='text-center'>Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($employee_list) && !empty($employee_list) && count($employee_list) > 0){
                                foreach ($employee_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);
                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["first_name"].' '.$value["last_name"]) . "</td>";
                                    echo "<td>" . stripslashes($value["email"]) . "</td>";
                                    echo "<td>" . $value["role_name"] . "</td>";
                                    
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                    }else{
                                        $btn_name = 'Deactive';
                                    }
                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn btn-outline-primary waves-effect waves-light deactive_employee' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary waves-effect waves-light title='Edit' data-popup='tooltip' > Edit</a>
                                        <button type='button' class='btn btn-outline-primary waves-effect waves-light delete_employee' title='Delete' data-popup='tooltip'>Delete</button></td>
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
    var employee_list = $('.employee_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [4]}],
    });

    var delete_url = "<?php echo base_url().'employee-delete'; ?>";
    var status_url = "<?php echo base_url().'employee-status'; ?>";

    $(document).ready(function () {

         $(document).on('click',".delete_employee", function() {
            
            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null){

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
                                    'Employee has been deleted.',
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


        $(document).on('click',".deactive_employee", function() {
            $this = $(this);
            var data_id = get_dataid($this);
            var parent = $(this).parent();

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactive';
                var change_status_to1 = 'Deactived!';
                var btn_name_replace = 'Deactive';
                var status = '0';
            }else{
                var change_status_to = 'active';
                var change_status_to1 = 'Activated!';
                var btn_name_replace = 'Active';
                var status = '1';
            }
            if (typeof data_id != "undefined" && data_id != null){
                console.log(data_id);
                swal({
                    title: 'Are you sure you want to '+change_status_to+' employee?',
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
                                    'Employee has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn btn-outline-primary waves-effect waves-light deactive_employee' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
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