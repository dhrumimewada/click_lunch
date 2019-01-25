<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Popular Locations</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'popular-location-add'; ?>">Add New Popular Location</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="popular_location-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap popular_location_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Zipcode</th>
                                <th>Location Type</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($popular_location_list) && !empty($popular_location_list) && count($popular_location_list) > 0){
                                foreach ($popular_location_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);
                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["house_no"]).", ".stripslashes($value["street"]).", ".stripslashes($value["city"]) . "</td>";

                                    echo "<td>" . $value["zipcode"] . "</td>";
                                    echo "<td>" .  ucwords($address_type[$value["address_type"]]) . "</td>";
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_popular_location' title='Delete' data-popup='tooltip'>Delete</button></td>";
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
    var popular_location_list = $('.popular_location_list').DataTable({
            keys: true,
            "order": [[3, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [4]},{visible: false,targets: [3]}],
    });

    var delete_url = "<?php echo base_url().'popular-location-delete'; ?>";

    $(document).ready(function () {

         $(document).on('click',".delete_popular_location", function(){

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
                                    'Popular location has been deleted.',
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
    });
</script>