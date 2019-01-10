 <!-- Start content -->
 <style type="text/css" media="screen">
.btn-sm{
    font-size: unset;
    width: unset;
    border-radius: unset;
} 
 </style>
 <link rel="stylesheet" href="<?php echo base_url() . 'plugins/summernote/summernote-bs4.css'; ?>">
 <?php
 $put_link = base_url().'custom-email-customer-send';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Send email to <?php echo $to; ?>(s)</h4>
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

                            
                            <div class="row">
                                <div class="form-group col-10">
                                    <label class="required">Email To</label>
                                    <div>
                                        <select class="select2 form-control" data-placeholder="Select <?php echo $to; ?>" name="email_to[]" multiple>
                                                <?php 
                                                
                                                foreach ($to_list as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    $option_name = ($to == 'customer')?$value['username']:$value['shop_name'];
                                                    echo "<option value='".$value['id']."' ".$selected.">".$option_name."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div class="validation-error-label">
                                            <?php echo form_error('email_to[]'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label class="">Select All</label>
                                    <div>
                                        <input type="checkbox" switch="none" id="all" value="1" name="all" <?php echo $checked; ?> >
                                        <label class="mb-0 mt-1" for="all" data-on-label="All" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required">Email Subject</label>
                                <div>
                                <?php
$field_value = NULL;
$temp_value = set_value('emat_email_subject');
if (isset($temp_value) && !empty($temp_value)) {
$field_value = $temp_value;
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

                            <input type="hidden" name="to_type" value="<?php echo $to; ?>">
                       
                            

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


    $(document).ready(function(){

        $(".select2").select2();

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

       $(document).on('change','#all',function(){

            if($("#all").is(':checked') ){
                $(".select2 > option").prop("selected","selected");
                $(".select2").trigger("change");
            }else{
                $(".select2").val(null).trigger("change"); 
            }

        });
    });
</script>