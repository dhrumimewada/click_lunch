<?php $assets = $this->config->item('website_assest'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<body style="background-color: rgba(0, 0, 0, 0.05);">
    <div id="wrapper">
        <?php include 'top_bar.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <?php include $main_content.'.php'; ?>
        <?php include 'footer.php'; ?>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
</body>
</html>