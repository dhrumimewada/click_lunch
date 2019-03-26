<?php
$edit_link = base_url().'email-update';
$to_customer_link = base_url().'custom-email-customer';
$push_to_customer_link = base_url().'custom-push-customer';
$push_to_shop_link = base_url().'custom-push-restaurant';
$to_restaurant_link = base_url().'custom-email-restaurant';
$to_deliveryboy_link = base_url().'custom-email-deliveryboy';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Email Templates</h4>
                    <div class="state-information d-none d-sm-block">
                        <div class="btn-group ml-1 mo-mb-2">
                            <button type="button" class="btn btn-bg btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Send Email
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo $to_customer_link; ?>">Email to Customers</a>
                                <a class="dropdown-item" href="<?php echo $to_restaurant_link; ?>">Email to Restaurants</a>
                                <a class="dropdown-item" href="<?php echo $to_deliveryboy_link; ?>">Email to DeliveryBoys</a>
                            </div>
                        </div>
                        <div class="btn-group ml-1 mo-mb-2">
                            <button type="button" class="btn btn-bg btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Send Push Notification
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo $push_to_customer_link; ?>">Notification to Customers</a>
                                <a class="dropdown-item" href="<?php echo $push_to_shop_link; ?>">Notification to Restaurants</a>
                            </div>
                        </div>
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
                        <table class="table table-hover dt-responsive nowrap template_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    echo "<td class='text-center'><a href='".$edit_link."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a></td>";
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