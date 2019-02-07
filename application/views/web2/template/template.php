<?php $assets = $this->config->item('website_assest'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<body>
    <div id="wrapper">
        <?php include 'top_bar.php'; ?>
        <?php include 'slider.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="">
            <?php include $main_content.'.php'; ?>
            <?php include 'footer.php'; ?>
        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
</body>
</html>