 <!-- Start content -->
<?php
$put_link = base_url().'cuisine-put';
$back = base_url().'cuisine-list';
$photo_url = base_url() . 'assets/images/default/cuisine.jpg';
$photo_defualt_url = base_url() . 'assets/images/default/cuisine.jpg';
 if (isset($cuisine_data->cuisine_picture) && ($cuisine_data->cuisine_picture != '')) {
    if (file_exists($this->config->item("cuisine_photo_path") . '/'.$cuisine_data->cuisine_picture)){
        $photo_url = base_url() . $this->config->item("cuisine_photo_path") . '/'.$cuisine_data->cuisine_picture;
    }
    
}
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Update Cuisine</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>" enctype="multipart/form-data">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

                    <div class="card m-b-20">
                        <div class="card-body">

                                <div class="form-group">
                                    <label class="required">Cuisine Name</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('cuisine_name');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = stripslashes($cuisine_data->cuisine_name);
}
?>
                                        <input type="text" name="cuisine_name" class="form-control" id="cuisine_name" placeholder="Ex: Vegan" value='<?php echo $field_value; ?>'>
                                        <div class="validation-error-label">
                                            <?php echo form_error('cuisine_name'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cuisine Photo</label>
                                    <div>
                                        <?php
$field_value = NULL;
$temp_value = set_value('cuisine_picture');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}  else{
    $field_value = stripslashes($cuisine_data->cuisine_picture);
}
?>
                                        <input type="file" name="cuisine_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="<?php echo $field_value; ?>" id="cuisine_picture">
                                        <div class="validation-error-label">
                                            <?php echo form_error('cuisine_picture'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <img src="<?php echo $photo_url; ?>" class="img-circle profile-avatar small" alt="Cuisine Photo" id="blah" onerror="this.src='<?php echo $photo_defualt_url; ?>'">
                                </div>

                                <input type="hidden" name="cuisine_id" value="<?php echo $cuisine_data->id ?>">

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
<script src="<?php echo base_url().'assets/js/custom/admin/cuisine.js'; ?>"></script>