 <!-- Start content -->
 <style type="text/css" media="screen">
     
 </style>
 <?php
 $post_link = base_url().'banner-add';
 $back = base_url().'banner-list';
 $photo_url = base_url() . 'assets/images/default/cuisine.jpg';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Banner</h4>
                </div>
            </div>
            <div class="col-lg-1">
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <?php echo get_msg(); ?>
            </div>
            <div class="col-lg-1">
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $post_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

                    <div class="card m-b-20">
                        <div class="card-body">

                                <div class="form-group">
                                    <label class="required" for="title">Title</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('title');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required" for="sub_title">Subtitle</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('sub_title');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Enter subtitle" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('sub_title'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="banner_picture" class="required">Image</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('banner_picture');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="file" name="banner_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="" id="banner_picture">
                                        <div class="validation-error-label">
                                            <?php echo form_error('banner_picture'); ?>
                                        </div>
                                        <div class="validation-error-image">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="<?php echo $photo_url; ?>" class="image-popup-no-margins">
                                        <img src="<?php echo $photo_url; ?>" class="img-circle profile-avatar small" alt="Banner Photo" id="blah" onerror="this.src='<?php echo $photo_url; ?>'">
                                    </a>
                                </div>

                                <img src="<?php echo $photo_url; ?>" alt="" id="copy-img" onerror="this.src='<?php echo $photo_defualt_url; ?>'" class="d-none">


                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="<?php echo $back; ?>" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </a>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div> 

                <div class="col-lg-1">
                </div>

            </div> <!-- end row -->
        </form>

    </div>
</div>
<script src="<?php echo base_url().'assets/js/custom/admin/banner.js'; ?>"></script>