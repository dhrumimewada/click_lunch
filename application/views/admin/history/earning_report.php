<?php// var_dump($_SESSION); ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Earning Detail</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="admin-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap earnind_detail" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Restaurant</th>
                                <th>Total Earning</th>
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
<script type="text/javascript">

    var earnind_detail = $('.earnind_detail').DataTable({
            keys: true,
            "order": [[2, "desc"]],
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],
            'iDisplayLength': 10
    });
</script>