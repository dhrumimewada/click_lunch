 <!-- Start content -->
 <style type="text/css" media="screen">
.btn-sm{
    font-size: unset;
    width: unset;
    border-radius: unset;
} 
 </style>
 <?php
 if($is_admin){
     $put_link = base_url().'custom-push-customer';
 }else{
     $put_link = base_url().'vender-custom-email-customer';
 }
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Send notification to Customer(s)</h4>
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
                                <div class="form-group col-12">
                                    <label class="required" for="group">Group of Customers</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('group');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}
?>
                                        <select class="select2 form-control" data-placeholder="Select group" name="group" id='group'>
                                            <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($group as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $key){
                                                        $selected = 'selected';
                                                    }
                                                    
                                                    echo "<option value='".$key."' ".$selected.">".$value."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div class="validation-error-label">
                                            <?php echo form_error('group'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-none" id="shop-list">
                                <div class="form-group col-12">
                                    <label class="required" for="shop">Restaurant's List</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('shop[]');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}
?>
                                        <select class="select2 form-control" data-placeholder="Select restaurant" name="shop[]" id="shop" multiple>
                                                <?php 
                                                
                                                foreach ($shop_list as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    
                                                    echo "<option value='".$value['id']."' ".$selected.">".stripslashes($value['shop_name'])."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div class="validation-error-label">
                                            <?php echo form_error('shop[]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="order-no" class="d-none">
                                <div class="form-group">
                                    <label class="required">Minimum Number of Orders</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('no_of_orders');
if (isset($temp_value) && !empty($temp_value)) {
$field_value = $temp_value;
}
?>
                                        <input type="text" name="no_of_orders" class="form-control" id="no_of_orders" placeholder="Ex: 5" value="<?php echo $field_value; ?>">
                                        <div class="validation-error-label">
                                            <?php echo form_error('no_of_orders'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none" id="item-list">
                                <div class="form-group">
                                    <label class="required" for="products">Product & Combo's List</label>
                                    <div>
                                    <?php
$field_value = NULL;
$temp_value = set_value('item[]');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
}
?>
                                        <select class="select2 form-control" data-placeholder="Select Product/Combo" name="item[]" id="products" multiple>
                                                <?php 
                                                
                                                foreach ($item_list as $key => $value) {
                                                    $selected = '';
                                                    if (in_array($value['id'], array_column($promocode_products, 'product_id'))){
                                                        $selected = 'selected';
                                                    }

                                                    echo "<option value='".$value['id']."' ".$selected.">".$value['name']."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div class="validation-error-label">
                                            <?php echo form_error('item[]'); ?>
                                        </div>
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
                                    <?php if($is_admin){ ?>
                                    <a href="<?php echo base_url().'email-list';  ?>" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </a>
                                    <?php } ?>
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