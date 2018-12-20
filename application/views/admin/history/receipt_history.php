<style type="text/css" media="screen">
.btn-sm{
    font-size: unset; 
    width: unset;
}  
</style>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Receipt History</h4>
                    <div class="state-information d-none d-sm-block">
                        <div class="btn-group mo-mb-2">
                            <button class="btn btn-white btn-sm dropdown-toggle selected-g-type" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Monthly
                            </button>
                            <div class="dropdown-menu">
                                <label class="dropdown-item monthly">Monthly</label>
                                <label class="dropdown-item yearly">Yearly</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body">

                        <div id="chart-with-area-monthly" class="ct-chart ct-golden-section"></div>
                        <div id="chart-with-area-yearly" class="ct-chart ct-golden-section"></div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'plugins/chartist/js/chartist.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'plugins/chartist/js/chartist-plugin-tooltip.min.js'; ?>"></script>

<script src="<?php echo base_url().'assets/js/custom/admin/receipt_history.js'; ?>"></script>
