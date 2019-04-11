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
                                <th>Contact Person</th>
                                <th>Email</th>
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
                                    //echo "<td>" . $value["shop_code"] . "</td>";
                                    if($value["status"] == 1){
                                        $btn_name = 'Active';
                                        $btn_class = 'btn-success';
                                    }else{
                                        $btn_name = 'Deactivate';
                                        $btn_class = 'btn-deactive';
                                    }
                                    if($value["password"] == ''){

                                        $resend_str = "<button type='button' class='btn btn-primary btn-sm waves-effect waves-light resend-mail' title='Resend Activation Mail' data-popup='tooltip'>Resend Mail</button>";
                                        echo "<td class='text-center'><button type='button' class='btn btn-sm btn-yellow waves-effect waves-light pending' title='Pending' data-popup='tooltip' disabled>Pending</button></td>";
                                    }else{
                                        $resend_str = "<button type='button' class='btn btn-primary btn-sm waves-effect waves-light resend-mail-disabled'>Resend Mail</button>";
                                        echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_shop' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    }
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    $disabled = '';

                                    echo "<td class='text-center'>
                                        <a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary btn-sm waves-effect waves-light ". $disabled ."' title='Edit' data-popup='tooltip' > Edit</a>
                                        <button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_vender' title='Delete' data-popup='tooltip'>Delete</button>".$resend_str."
                                        
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
    var vender_list = $('.vender_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [4]}],
    });

    var delete_url = "<?php echo base_url().'vender-delete'; ?>";
    var status_url = "<?php echo base_url().'vender-status'; ?>";
    var resend_mail_url = "<?php echo base_url().'vender-resend-activation-mail/'; ?>";

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
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonColor: '#2E2D4D',
                }).then(
                    function () {

                    $.ajax({
                        url: delete_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            
                            if (typeof returnData != "undefined")
                            {
                                returnData = $.parseJSON(returnData);
                                swal(
                                    'Deleted!',
                                    'Restaurant has been deleted.',
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

        $(document).on('click',".resend-mail", function(){

            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){
                swal.queue([{
                    title: 'Resend Mail to Restaurant',
                    confirmButtonText: 'Yes, Resend it!',
                    confirmButtonColor: '#2E2D4D',
                    text: 'Are you sure you want to resend activation mail?',
                    showLoaderOnConfirm: true,
                    preConfirm: function () {
                        return new Promise(function (resolve) {
                            $.get(resend_mail_url+data_id)
                                .done(function (data) {
                                    data = $.parseJSON(data);
                                    swal.insertQueueStep(data.message);
                                    resolve();
                                })
                        })
                    }
                }]) 
            }    
        });

        $(document).on('click',".resend-mail-disabled", function(){
            swal(
                'Restaurant is already activated',
                'You can not resend account activation mail',
                'warning'
            )
        });

        $(document).on('click',".deactive_shop", function() {

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
                    title: 'Are you sure you want to '+change_status_to+' shop?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonColor: '#2E2D4D',
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

                                if(returnData.is_success == true){
                                    swal(
                                        change_status_to1,
                                        'Shop has been '+change_status_to1,
                                        'success'
                                    )
                                    $this.replaceWith("<button type='button' class='btn "+btn_cls_replace+ " btn-sm waves-effect waves-light deactive_shop' status-id='" +status+ "' title='"+btn_name_replace+"' data-popup='tooltip'>" +btn_name_replace+ "</button>");
                                }else{
                                    swal(
                                        'Something went wrong',
                                        'Server encounter error',
                                        'warning'
                                    )
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
    });
</script>