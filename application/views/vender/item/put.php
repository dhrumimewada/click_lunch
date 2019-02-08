 <!-- Start content -->
<style type="text/css">
    .bootstrap-touchspin .validation-error-label{
        margin-top: 0;
    }
</style>
 <?php
 $put_link = base_url().'item-update';
 $back = base_url().'item-list';
 $prof_url = base_url() . 'assets/images/default/cuisine.jpg';
 $prof_defualt_url = base_url() . 'assets/images/default/cuisine.jpg';
 if (isset($item_data->item_picture) && ($item_data->item_picture != '')) {
    $prof_url = base_url() . $this->config->item("item_photo_path") . '/'.$item_data->item_picture;
}
$item_type = ($item_data->is_combo == 1)?'Combo':'Product';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Update <?php echo $item_type; ?></h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo get_msg(); ?>
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title"><?php echo $item_type; ?> Information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required"><?php echo $item_type; ?> Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($item_data->name);
    }
    if($item_type == 'Combo'){
        $placeholder = 'Ex: Indian Thali';  
    }else{
        $placeholder = 'Ex: Pan Cake';  
    }
    ?>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $placeholder; ?>" value='<?php echo $field_value; ?>'>
                                            <div class="validation-error-label">
                                                <?php echo form_error('name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required"><?php echo $item_type; ?> Cuisine</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('cuisine_id');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $item_data->cuisine_id;
    }
    ?>
                                            <select class="select2 form-control" data-placeholder="Select cuisine" name="cuisine_id">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($cuisines_data as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$value['id']."' ".$selected.">".$value['cuisine_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('cuisine_id'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required"><?php echo $item_type; ?> Category</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('category_id');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $item_data->category_id;
    }
    ?>
                                            <select class="select2 form-control" data-placeholder="Select category" name="category_id">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($category_data as $key => $value) {
                                                    $selected = '';
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$value['id']."' ".$selected.">".$value['category_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('category_id'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-t-30 item">
                                            <?php
    $checked = '';
    $field_value = NULL;
    $temp_value = set_value('inventory_status');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value; 
    } else{
        $field_value = $item_data->inventory_status;
    } 
    if($field_value == 1){
        $checked = 'checked';
    }
    
    ?>
                                        <span class="ml-5">
                                        <input type="checkbox" switch="none" id="inventory_status" value="1" name="inventory_status" <?php echo $checked; ?> >
                                        <label class="mb-0 mt-1" for="inventory_status" data-on-label="Inventory" data-off-label="Off" title="Inventory"></label>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required"><?php echo $item_type; ?> Price</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('price');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } else{
        $field_value = $item_data->price;
    }
    if($item_type == 'Combo'){
        $placeholder = 'Enter combo price';
    }else{
        $placeholder = 'Enter product price';
    }
    ?>
                                            <input type="text" name="price" class="form-control demo2" placeholder="<?php echo $placeholder; ?>" value="<?php echo $field_value; ?>" id="price">

                                            <div class="validation-error-label">
                                                <?php echo form_error('price'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class=""><?php echo $item_type; ?> Offer Price</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('offer_price');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }  else{
        $field_value = $item_data->offer_price;
    }
    ?>
                                            <input type="text" name="offer_price" class="form-control demo2" id="offer_price" placeholder="Enter offer price" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('offer_price'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class=""><?php echo $item_type; ?> Quantity</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('quantity');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $item_data->quantity;
    } 
    ?>
                                            <input type="text" name="quantity" class="form-control demo3" id="quantity" placeholder="Enter item quantity" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('quantity'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?php echo $item_type; ?> Photo</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('item_picture');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } else{
        $field_value = $item_data->item_picture;
    } 
    ?>
                                            <input type="file" name="item_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="" id="item_picture">
                                            <div class="validation-error-label">
                                                <?php echo form_error('item_picture'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('item_description');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } else{
        $field_value = stripslashes($item_data->item_description);
    } 
    if($item_type == 'Combo'){
        $placeholder = 'Ex: Small katoris (bowls) full of dishes of rice, dal, sabzi, curries and curd.';  
    }else{
        $placeholder = 'Ex: Capsicum, fresh tomatoes, paneer and red paprika.';  
    }
    ?>
                                            <textarea name="item_description" rows="4" class="form-control" data-buttonname="btn-secondary" placeholder="<?php echo $placeholder; ?>"><?php echo $field_value; ?></textarea>
                                            <div class="validation-error-label">
                                                <?php echo form_error('item_description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <a href="<?php echo $prof_url; ?>" class="image-popup-no-margins">
                                            <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar small" alt="User avatar" id="blah" onerror="this.src='<?php echo $prof_defualt_url; ?>'">
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title"><?php echo $item_type; ?> Variants</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                            </div>
                            <div id="variants">
                                <?php if(!empty($item_variant_data)) {
                                    foreach ($item_variant_data as $key => $value) {  ?>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="required">Variant Group</label>
                                                <div>
                                                <select class="form-control select2 variant_group" data-placeholder="Select variant group" name="variant_group[]">
                                                    <option selected disabled></option>
                                                    <?php
                                                    foreach ($variant_groups as $key1 => $value1) {
                                                        $selected = '';
                                                        if($value1['id'] == $value['variant_group_id']){
                                                            $selected = 'selected';
                                                        }
                                                        echo "<option ".$selected." value='".$value1['id']."'>".$value1['name']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="required">Variant Name</label>
                                                <div>
                                                <input type="text" name="variant_name[]" class="form-control variant_name" placeholder="Ex: Small" value="<?php echo $value['name']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Variant Price</label>
                                                <div>
                                                <input type="text" name="variant_price[]" class="form-control demo2"  placeholder="Ex: 66.50" value="<?php echo $value['price']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label>Remove</label>
                                                <div>
                                                <label name="add_variant" class="btn btn-danger waves-effect waves-light remove-btn remove"><i class="ion-close-round"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                 } ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" name="add_variant" class="btn btn-primary waves-effect waves-light" id="add_variant">
                                            Add Variant
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="item_type" value="<?php echo $item_type; ?>">

                            <input type="hidden" name="item_id" value="<?php echo $item_data->id; ?>">

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
            </div> <!-- end row -->
        </form>

    </div>
</div>
<script type="text/javascript">
    var variant_groups = jQuery.parseJSON('<?php echo json_encode($variant_groups); ?>');
</script>
<script src="<?php echo base_url().'assets/js/custom/vender/item_post.js'; ?>"></script>