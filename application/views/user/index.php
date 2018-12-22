<!DOCTYPE html>
<html lang="en">
<?php
$this->load->view('template/header');
?>
<body>
	<div id="wrapper">
		<?php $this->load->view('template/top_bar'); ?>

		<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">

            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Promocode</h4>
                                <div class="state-information d-none d-sm-block">
                                    <a class="btn btn-primary waves-effect waves-light btn-bg" href="">Add New Promocode</a>
                                </div>
                            </div>
                            <?php echo get_msg(); ?>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- end row -->
            
            <?php $this->load->view('template/footer'); ?>
        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

	</div>
	<!-- END wrapper -->
</body>
</html>