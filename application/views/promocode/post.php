 <!-- Start content -->
 <style type="text/css">
     .validation-error-label{
        margin-top: 0;
     }
 </style>
 <?php
 $post_link = base_url().'promocode-add';
 $back = base_url().'promocode-list';

 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Promocode</h4>
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
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

                                <div class="col-lg-6 d-none" id="shop-list">
                                    <div class="form-group">
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
                                                        
                                                        echo "<option value='".$value['id']."' ".$selected.">".$value['shop_name']."</option>";
                                                    }
                                                    ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('shop[]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="order-no" class="col-lg-6 d-none">
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
                                            <input type="text" name="no_of_orders" class="form-control demo3" id="no_of_orders" placeholder="Ex: 5" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('no_of_orders'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 d-none" id="item-list">
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
                                                        if($field_value == $value['id']){
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
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="promocode">Promocode</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('promocode');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="promocode" class="form-control" id="promocode" placeholder="Ex: SAVE20" value="<?php echo $field_value; ?>" style="text-transform:uppercase">
                                            <div class="validation-error-label">
                                                <?php echo form_error('promocode'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="" for="promo_min_order">Minimum Order Amount</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('promo_min_order');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="number" name="promo_min_order" class="form-control demo2" id="promo_min_order" placeholder="Ex: 100.00" value="<?php echo $field_value; ?>" >
                                            <div class="validation-error-label">
                                                <?php echo form_error('promo_min_order'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="amount">Discount Amount</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('amount');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <div class="input-group">
                                                <input type="text" name="amount" class="form-control" id="amount" placeholder="Ex: 40.00" value="<?php echo $field_value; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-percent" id="amount-type-icon"></i></span>
                                                </div>
                                            </div>
                                            <div class="validation-error-label">
                                                <?php echo form_error('amount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="required" for="">Type</label>
                                        <div>
                                        <?php
$checked = '';
$field_value = NULL;
$temp_value = set_value('discount_type');
if (isset($temp_value) && !empty($temp_value)) {
    $field_value = $temp_value;
} 
if($field_value == 1){
    $checked = 'checked';
}
?>
                                        <input type="checkbox" switch="none" id="discount_type" value="1" name="discount_type" <?php echo $checked; ?> >
                                        <label class="mb-0 mt-1" for="discount_type" data-on-label="%" data-off-label="$"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5" id="max-disc">
                                    <div class="form-group">
                                        <label class="required" for="max_disc">Maximum Discount</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('max_disc');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="number" name="max_disc" class="form-control demo2" id="max_disc" placeholder="Ex: 50.00" value="<?php echo $field_value; ?>" >
                                            <div class="validation-error-label">
                                                <?php echo form_error('max_disc'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <?php
                                if(!$is_admin){ ?>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="promo_type">Promocode Type</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('promo_type');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <select class="select2 form-control" data-placeholder="Select promocode type" name="promo_type" id='promo_type'>
                                                <option selected disabled></option>
                                                    <?php 
                                                    
                                                    foreach ($promo_type as $key => $value) {
                                                        $selected = '';
                                                        if($field_value == $key){
                                                            $selected = 'selected';
                                                        }
                                                        
                                                        echo "<option value='".$key."' ".$selected.">".$value."</option>";
                                                    }
                                                    ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('promo_type'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="usage_limit">Usage Limit</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('usage_limit');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" name="usage_limit" class="form-control demo3" id="usage_limit" placeholder="Ex: 3" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('usage_limit'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if(1){ ?>
                            <div class="row d-none" id="products-list">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required" for="products">Promocode Applied On These Products/Combos</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('applied_on_products[]');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <select class="select2 form-control" data-placeholder="Select Products/Combos" name="applied_on_products[]" id="applied_on_products" multiple>
                                                    <?php 
                                                    
                                                    foreach ($item_list as $key => $value) {
                                                        $selected = '';
                                                        // if($field_value == $value['id']){
                                                        //     $selected = 'selected';
                                                        // }
                                                        if (in_array($value['id'], array_column($items, 'id'))){
                                                            $selected = 'selected';
                                                        }
                                                        
                                                        echo "<option value='".$value['id']."' ".$selected.">".$value['name']."</option>";
                                                    }
                                                    ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('applied_on_products[]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="from_date">From Date</label>
                                        <div>
                                            <div class="input-group">
                                                <?php
    $field_value = NULL;
    $temp_value = set_value('from_date');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="dd-mm-yyyy" name="from_date" id="from_date" autocomplete="off" value="<?php echo $field_value; ?>"> 
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="validation-error-label">
                                                <?php echo form_error('from_date'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="to_date">To Date</label>
                                        <div>
                                            <div class="input-group">
                                                <?php
    $field_value = NULL;
    $temp_value = set_value('to_date');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="dd-mm-yyyy" name="to_date" id="to_date" autocomplete="off" value="<?php echo $field_value; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="validation-error-label">
                                                <?php echo form_error('to_date'); ?>
                                            </div>
                                        </div>
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

<script>
    var mindate = "<?php echo date('d-m-Y'); ?>";
</script>
<script src="<?php echo base_url().'assets/js/custom/vender/promocode.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
    var is_admin = '<?php echo $is_admin; ?>';
    var is_vender = '<?php echo $is_vender; ?>';
    var selected_group = '';
    var selected_shop = '';
    var group_shop_items ='';
    var get_product_url = '<?php echo base_url().'get-products'; ?>';
</script>