<?php
$edit_link = base_url().'email-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Email Templates</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="admin-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap template_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Email Type</th>
                                <th>Email Subject</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($template_list) && !empty($template_list) && count($template_list) > 0){
                                foreach ($template_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . $value["emat_email_name"] . "</td>";
                                    echo "<td>" . $value["emat_email_subject"] . "</td>";
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
                                    echo "<td class='text-center'><a href='".$edit_link."/".$id."' class='btn btn-outline-primary waves-effect waves-light' title='Edit' data-popup='tooltip' > Edit</a></td>";
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
<script type="text/javascript">
    var template_list = $('.template_list').DataTable({
            keys: true,
            "order": [[2, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [3]}],
    });
</script>