 <!-- Start content -->
 <?php
 $post_link = base_url().'variant-group-add';
 $back = base_url().'variant-group-list';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Variant Group</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $post_link; ?>">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

                    <div class="card m-b-20">
                        <div class="card-body">

                                <div class="form-group">
                                    <label class="required">Variant Group Name</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('name');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
?>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Ex: Size" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row item small-f">
                                    <div class="col-lg-6">
                                        <label>Selection</label>
                                        <div class="form-group">
                                            <?php
    $checked = '';
    $field_value = NULL;
    $temp_value = set_value('selection');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    if($field_value == 1){
        $checked = 'checked';
    }
    ?>
                                            <span class="ml-2">
                                            <input type="checkbox" switch="none" id="selection" value="1" name="selection" <?php echo $checked; ?> >
                                            <label class="mb-0 mt-1" for="selection" data-on-label="Multiple" data-off-label="Single"></label>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Availability</label>
                                        <div class="form-group">
                                            <?php
    $checked = '';
    $field_value = NULL;
    $temp_value = set_value('availability');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    if($field_value == 1){
        $checked = 'checked';
    }
    ?>
                                            <span class="ml-2">
                                            <input type="checkbox" switch="none" id="availability" value="1" name="availability" <?php echo $checked; ?> >
                                            <label class="mb-0 mt-1" for="availability" data-on-label="Required" data-off-label="optional"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                

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
<script src="<?php echo base_url().'assets/js/custom/vender/variant_group.js'; ?>"></script>