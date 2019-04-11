 <!-- Start content -->
 <style type="text/css" media="screen">
.btn-sm{
    font-size: unset;
    width: unset;
    border-radius: unset;
} 
 </style>
<?php
$put_link = base_url().'custom-push-deliveryboy';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Send notification to Delivery Boy(s)</h4>
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
                                    <label class="required" for="delivery_boy">Delivery Boy's List</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('delivery_boy[]');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}
?>
                                        <select class="select2 form-control" data-placeholder="Select delivery boy(s)" name="delivery_boy[]" id="delivery_boy" multiple>
                                                <?php 
                                                
                                                foreach ($delivery_boy_list as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    
                                                    echo "<option value='".$value['id']."' ".$selected.">".stripslashes($value['username'])."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div class="validation-error-label">
                                            <?php echo form_error('delivery_boy[]'); ?>
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
                                <label class="required" for="notification_title">Notification Title</label>
                                <div>
                                <?php
$field_value = NULL;
$temp_value = set_value('notification_title');
if (isset($temp_value) && !empty($temp_value)) {
$field_value = $temp_value;
}
?>
                                    <input type="text" name="notification_title" class="form-control" id="notification_title" placeholder="Enter notification title" value="<?php echo $field_value; ?>">
                                    <div class="validation-error-label">
                                        <?php echo form_error('notification_title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required" for="notification_message">Notification Message</label>
                                <div>
                                <?php
$field_value = NULL;
$temp_value = set_value('notification_message');
if (isset($temp_value) && !empty($temp_value)) {
$field_value = $temp_value;
} 
?>
                                    <textarea name="notification_message" class="form-control" id="notification_message" placeholder="Enter notification message"><?php echo $field_value; ?></textarea>
                                    <div class="validation-error-label">
                                        <?php echo form_error('notification_message'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                        Send
                                    </button>
                                    <?php
                                    if($is_admin){
                                    ?>
                                    <a href="<?php echo base_url().'email-list';  ?>" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </a>
                                    <?php
                                    }
                                    ?>
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
<script src="<?php echo base_url().'assets/js/custom/admin/shop_notification.js'; ?>"></script>