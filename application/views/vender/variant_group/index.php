<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Variant Groups</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url().'variant-group-add'; ?>">Add New Variant Group</a>
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
                        <table class="table table-bordered dt-responsive nowrap variant_group_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Variant Group Name</th>
                                <th>Selection</th>
                                <th>Availability</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($variant_group_list) && !empty($variant_group_list) && count($variant_group_list) > 0){
                                foreach ($variant_group_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    $selection = ($value["selection"] == 1)?'Multiple':'Single';
                                    $availability = ($value["availability"] == 1)?'Required':'Optional';

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["name"]) . "</td>";
                                    echo "<td>" . $selection . "</td>";
                                    echo "<td>" . $availability . "</td>";
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    echo "<td class='text-center'><button type='button' class='btn btn-outline-primary waves-effect waves-light delete_variant_group' title='Delete' data-popup='tooltip'>Delete</button></td>
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
    var variant_group_list = $('.variant_group_list').DataTable({
            keys: true,
            "order": [[3, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [4]},{visible: false,targets: [3]}],
    });

    var delete_url = "<?php echo base_url().'variant-group-delete'; ?>";

    $(document).ready(function () {

         $(document).on('click',".delete_variant_group", function(){

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
                                    'Variant group has been deleted.',
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