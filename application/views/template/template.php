<!DOCTYPE html>
<html lang="en">
<?php
$this->load->view('template/header');
?>
<body>
	<div id="wrapper">
		<?php $this->load->view('template/top_bar'); ?>
		<?php $this->load->view('template/sidebar'); ?>

		<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <?php $this->load->view($main_content); ?>
            <?php $this->load->view('template/footer'); ?>
        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

	</div>
	<!-- END wrapper -->
</body>
</html>