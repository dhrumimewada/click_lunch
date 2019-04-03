<?php
$edit_link = base_url().'vender-request-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Popular Location Requests</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="vendor-request-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap request_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Request By</th>
                                <th>Location</th>
                                <th>Zip Code</th>
                                <th>Location Type</th>
                                <th>Created date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                            if (isset($requests) && !empty($requests) && count($requests) > 0){
                                foreach ($requests as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . ucfirst(stripslashes($value["username"])) . "</td>";
                                    echo "<td>" . stripslashes($value["house_no"]).", ".stripslashes($value["street"]).", ".stripslashes($value["city"]) . "</td>";

                                    echo "<td>" . $value["zipcode"] . "</td>";
                                    echo "<td>" .  ucwords($address_type[$value["address_type"]]) . "</td>";

                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><button type='button' class='btn btn-primary btn-sm waves-effect waves-light accept_request' title='Accept' data-popup='tooltip'>Accept</button><button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_request' title='Delete' data-popup='tooltip'>Delete</button></td>";

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
<script src="<?php echo base_url() . 'assets/js/custom/dynamic_datatable.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/js/custom/custom.js'; ?>"></script>

<script type="text/javascript">

    var request_list = $('.request_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [4]}],
    });

    var delete_url = "<?php echo base_url().'location-request-delete'; ?>";
    var accept_url = "<?php echo base_url().'location-request-accept'; ?>";

    $(document).ready(function () {

        $(document).on('click',".delete_request", function(){

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
                                    'Location request has been deleted.',
                                    'success'
                                )
                                remove_row($this);
                            } 
                        }
                    });    
                })
            }    
        });

        $(document).on('click',".accept_request", function(){

            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to accept?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, accept it!'
                }).then(
                    function () {

                    $.ajax({
                        url: accept_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            if (typeof returnData != "undefined"){
                                console.log(returnData);
                                if(returnData.is_success == true){
                                    swal(
                                        'Accepted!',
                                        returnData.message,
                                        'success'
                                    )
                                    remove_row($this);
                                }else{
                                   swal(
                                        'Error!',
                                        returnData.message,
                                        'danger'
                                    ) 
                                }
                                
                            } 
                        }
                    });    
                })
            }    
        });

    });
</script>