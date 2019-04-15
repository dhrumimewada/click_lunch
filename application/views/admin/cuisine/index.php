<?php
$edit_link = base_url().'cuisine-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Cuisines</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'cuisine-add'; ?>">Add New Cuisine</a>
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
                        <table class="table table-hover dt-responsive nowrap cuisine_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Status</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($cuisine_list) && !empty($cuisine_list) && count($cuisine_list) > 0){
                                foreach ($cuisine_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["cuisine_name"]) . "</td>";

                                   if($value["is_active"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactivated';
                                        $btn_class = 'btn-deactive';
                                    }

                                    $disabled = '';
                                    if($value["cuisine_name"] == 'All'){
                                        $disabled = 'disabled';
                                    }
                                    echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." waves-effect waves-light btn-sm deactive_cuisine' status-id='" . $value["is_active"] . "' title='".$btn_name."' data-popup='tooltip' ". $disabled ." >" . $btn_name . "</button></td>";


                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a><button type='button' class='btn btn-danger waves-effect waves-light btn-sm delete_cuisine' title='Delete' data-popup='tooltip' ". $disabled .">Delete</button></td>";
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
    var cuisine_list = $('.cuisine_list').DataTable({
            keys: true,
            "order": [[2, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [3]},{visible: false,targets: [2]}],
    });

    var delete_url = "<?php echo base_url().'cuisine-delete'; ?>";
    var status_url = "<?php echo base_url().'cuisine-status'; ?>";

      $(document).ready(function () {

        $(document).on('click',".delete_cuisine", function(){

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
                                if(returnData.is_success == false){
                                    swal(
                                        'Warning!',
                                        'Product(s) already exists for this cuisine',
                                        'warning'
                                    )
                                }else{
                                    swal(
                                        'Deleted!',
                                        'Cuisine has been deleted.',
                                        'success'
                                    )
                                    remove_row($this);
                                } 
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

        $(document).on('click',".deactive_cuisine", function() {

            $this = $(this);
            var data_id = get_dataid($this);

            if($this.attr("status-id") == '1'){
                var change_status_to = 'deactivate';
                var change_status_to1 = 'Deactivated!';
                var btn_name_replace = 'Deactivate';
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
                    title: 'Are you sure you want to '+change_status_to+' cuisine?',
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
                                    'Cuisine has been '+change_status_to1,
                                    'success'
                                )
                                $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_cuisine' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                
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