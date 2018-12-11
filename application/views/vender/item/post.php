 <!-- Start content -->
 <style type="text/css">
     .bootstrap-touchspin .validation-error-label{
        margin-top: 0;
     }
 </style>
 <?php
 $post_link = base_url().'item-add';
 $back = base_url().'item-list';
    $prof_url = base_url() . 'assets/images/default/cuisine.jpg';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Product</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo get_msg(); ?>
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $post_link; ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Product Information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Product Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Ex: Pan Cake" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Product Cuisine</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('cuisine_id');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
        $selected = '';
    } 
    ?>
                                            <select class="select2 form-control" data-placeholder="Select cuisine" name="cuisine_id">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($cuisines_data as $key => $value) {
                                                    if($field_value == $value['id']){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$value['id']."' ".$selected.">".stripslashes($value['cuisine_name'])."</option>";
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
                                        <label class="required">Product Price</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('price');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="price" class="form-control demo2" placeholder="Enter item price" value="<?php echo $field_value; ?>" id="price">

                                            <div class="validation-error-label">
                                                <?php echo form_error('price'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Product Offer Price</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('offer_price');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="offer_price" class="form-control demo2" id="offer_price" placeholder="Enter item offer price" value="<?php echo $field_value; ?>">
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
                                        <label class="required">Product Quantity</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('quantity');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
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
                                    <div class="form-group m-t-30 item">
                                            <?php
    $checked = '';
    $field_value = NULL;
    $temp_value = set_value('is_combo');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    if($field_value == 1){
        $checked = 'checked';
    }
    ?>
                                        <span class="ml-5">
                                        <input type="checkbox" switch="none" id="is_combo" value="1" name="is_combo" <?php echo $checked; ?> >
                                        <label class="mb-0 mt-1" for="is_combo" data-on-label="Combo" data-off-label="Single"></label>
                                        </span>
                                        <?php
    $checked = '';
    $field_value = NULL;
    $temp_value = set_value('is_nonveg');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    if($field_value == 1){
        $checked = 'checked';
    }
    ?>
                                        <span class="ml-5">
                                        <input type="checkbox" switch="none" id="is_nonveg" value="1" name="is_nonveg" <?php echo $checked; ?> >
                                        <label class="mb-0 mt-1" for="is_nonveg" data-on-label="Nonveg" data-off-label="Veg"></label>
                                        </span>
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
    } 
    ?>
                                            <textarea name="item_description" rows="8" class="form-control" data-buttonname="btn-secondary" placeholder="Ex: Capsicum, fresh tomatoes, paneer and red paprika."><?php echo $field_value; ?></textarea>
                                            <div class="validation-error-label">
                                                <?php echo form_error('item_description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Product Photo</label>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('item_picture');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="file" name="item_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="<?php echo $field_value; ?>" id="item_picture">
                                            <div class="validation-error-label">
                                                <?php echo form_error('item_picture'); ?>
                                            </div>
                                        </div>
                                        <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar small" alt="User avatar" id="blah" onerror="this.src='<?php echo $prof_url; ?>'">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Product Variants</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                            </div>
                            <div id="variants">
                                <!-- Dynmaic  -->
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