 <!-- Start content -->
 <link rel="stylesheet" href="<?php echo base_url() . 'plugins/summernote/summernote-bs4.css'; ?>">
 <?php
 $put_link = base_url().'email-save';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Update Email Template</h4>
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
                <?php echo get_msg();?>
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
                                    <label class="required">Email Subject</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('emat_email_subject');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}else{
    $field_value = $template_detail->emat_email_subject;
}
?>
                                        <input type="text" name="emat_email_subject" class="form-control" id="emat_email_subject" placeholder="Enter email subject" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('emat_email_subject'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="required">Email Message</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('emat_email_message');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} else{
    $field_value = $template_detail->emat_email_message;
}
?>
                                        <input type="hidden" name="emat_email_message" class="form-control" id="emat_email_message">
                                        <div class="summernote">
                                            <?php   echo $field_value; ?>
                                        </div>
                                        <div class="validation-error-label">
                                            <?php echo form_error('emat_email_message'); ?>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="emat_email_type" value="<?php echo $template_detail->emat_email_type; ?>">
                           
                                

                                <div class="form-group m-b-0">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <a href="<?php echo base_url().'email-list';  ?>" class="btn btn-secondary waves-effect m-l-5">
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
<script src="<?php echo base_url() . 'plugins/summernote/summernote-bs4.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/custom/admin/email_template.js'; ?>"></script>
<script>
    var msg = '<?php echo $template_detail->emat_email_message; ?>';

    $(document).ready(function(){

        $('.summernote').summernote({
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing
        });

        //$('.note-editing-area .note-editable').html();
       // $('.note-editing-area .note-editable').append(msg);

        $(document).on('submit','form',function(){
            $('#emat_email_message').val($(".note-editing-area .note-editable").html());
        });
    });
</script>