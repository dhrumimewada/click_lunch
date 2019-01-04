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
                                        <label class="required">Promocode</label>
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
                                        <label class="">Minimum Order</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('promo_min_order');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = floatval($temp_value);
    } 
    ?>
                                            <input type="number" name="promo_min_order" class="form-control demo2" id="promo_min_order" placeholder="Ex: 20.00" value="<?php echo $field_value; ?>" >
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
                                            <label class="required">Amount</label>
                                            <div>
                                            <?php
        $field_value = NULL;
        $temp_value = set_value('amount');
        if (isset($temp_value) && !empty($temp_value)) {
            $field_value = floatval($temp_value);
        } 
        ?>
                                                <input type="text" name="amount" class="form-control" id="amount" placeholder="Ex: 20.00" value="<?php echo $field_value; ?>">
                                                <div class="validation-error-label">
                                                    <?php echo form_error('amount'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="required">Type</label>
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
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="required">Form Date</label>
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
                                            <label class="required">To Date</label>
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
<script src="<?php echo base_url().'assets/js/custom/vender/promocode.js'; ?>"></script>