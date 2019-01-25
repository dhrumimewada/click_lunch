<?php
 $post_link = base_url().'popular-location-add';
 $back = base_url().'popular-location-list';
 ?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="page-title-box">
                    <h4 class="page-title">Add New Popular Location</h4>
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
                                        <label class="required" for="house_no">House/Office Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('house_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="house_no" class="form-control" id="house_no" placeholder="Ex: 1, One Canada Square" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('house_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="street">Street</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('street');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = floatval($temp_value);
    } 
    ?>
                                            <input type="text" name="street" class="form-control" id="street" placeholder="Ex: Canary Wharf" value="<?php echo $field_value; ?>" >
                                            <div class="validation-error-label">
                                                <?php echo form_error('street'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="city">City</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('city');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="Ex: London" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required" for="zipcode">Zipcode</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('zipcode');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = floatval($temp_value);
    } 
    ?>
                                            <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Ex: 78701" value="<?php echo $field_value; ?>" >
                                            <div class="validation-error-label">
                                                <?php echo form_error('zipcode'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="" for="nickname">Nick Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('nickname');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <input type="text" name="nickname" class="form-control" id="nickname" placeholder="Ex: Canary Wharf Tower" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('nickname'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required"><?php echo $item_type; ?> Address Type</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('address_type');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
        $selected = '';
    } 
    ?>
                                            <select class="select2 form-control" data-placeholder="Select address type" name="address_type">
                                                <option selected disabled></option>
                                                <?php 
                                                
                                                foreach ($address_type as $key => $value) {
                                                    if($field_value == $key){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$key."' ".$selected.">".stripslashes(ucwords($value))."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('address_type'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="" for="delivery_instruction">Delivery Instruction</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('delivery_instruction');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    } 
    ?>
                                            <textarea name="delivery_instruction" class="form-control" id="delivery_instruction" placeholder="Enter delivery instruction"><?php echo $field_value; ?></textarea>
                                            <div class="validation-error-label">
                                                <?php echo form_error('delivery_instruction'); ?>
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
<script src="<?php echo base_url().'assets/js/custom/admin/popular_location.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>