 <!-- Start content -->
<?php
$put_link = base_url().'highlight-update';
$back = base_url().'highlight-list';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Update Highlight</h4>
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

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>">

            <div class="row">

                <div class="col-lg-1">
                </div>

                <div class="col-lg-10">

                    <div class="card m-b-20">
                        <div class="card-body">

                                <div class="form-group">
                                    <label class="required">Highlight Text1</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('txt1');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = stripslashes($highlight->txt1);
}
?>
                                        <input type="text" name="txt1" class="form-control" id="txt1" placeholder="Ex: 21" value='<?php echo $field_value; ?>'>
                                        <div class="validation-error-label">
                                            <?php echo form_error('txt1'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required">Highlight Text2</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('txt2');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = stripslashes($highlight->txt2);
}
?>
                                        <input type="text" name="txt2" class="form-control" id="txt2" placeholder="Ex: RESTAURANT" value='<?php echo $field_value; ?>'>
                                        <div class="validation-error-label">
                                            <?php echo form_error('txt2'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required">Highlight Text3</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('txt3');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = stripslashes($highlight->txt3);
}
?>
                                        <input type="text" name="txt3" class="form-control" id="txt3" placeholder="Ex: ADDED" value='<?php echo $field_value; ?>'>
                                        <div class="validation-error-label">
                                            <?php echo form_error('txt3'); ?>
                                        </div>
                                        <div class="validation-error-label">
                                            <?php echo form_error('highlight_id'); ?>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="highlight_id" value="<?php echo $highlight->id ?>">

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
<script src="<?php echo base_url().'assets/js/custom/admin/highlight.js'; ?>"></script>