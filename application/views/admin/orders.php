<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?php echo $table_title; ?></h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="customer-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap <?php echo $table_name; ?>" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Restaurant Name</th>
                                <th>Order Amount</th>
                                <th>Order Type</th>
                                <th>Place Order Date Time</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'assets/js/custom/dynamic_datatable.js'; ?>"></script>