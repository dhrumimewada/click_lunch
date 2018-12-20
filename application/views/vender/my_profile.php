<!-- Start content -->
 <style type="text/css">
     .validation-error-label{
        margin-top: 0;
     }
 </style>
<?php
$put_link = base_url().'vender-profile';

// get from to time
$from_time = DateTime::createFromFormat('H:i',$this->config->item("start_time"));
$to_time = DateTime::createFromFormat('H:i',$this->config->item("end_time"));

$from_time_selected = DateTime::createFromFormat('H:i',$this->config->item("start_time_defualt"));
$to_time_selected = DateTime::createFromFormat('H:i',$this->config->item("end_time_defualt"));

$from_time_selected = $from_time_selected->format('h:i A');
$to_time_selected = $to_time_selected->format('h:i A');

for($j = $from_time; $j <= $to_time;){
    $available_time[] = $j->format('h:i A');
    $j->add(new DateInterval('PT30M'));
}
// Explode payment mode
$payment_mode = array();
$payment_mode = explode(",",$vender_detail->payment_mode);
$prof_url  = base_url() . 'assets/images/default/cuisine.jpg';
$prof_defualt_url  = base_url() . 'assets/images/default/cuisine.jpg';
$brochure_url = '#';

if (isset($vender_detail->profile_picture) && ($vender_detail->profile_picture != '')) {
    if (file_exists($this->config->item("profile_path") . '/'.$vender_detail->profile_picture)){
        $prof_url = base_url() . $this->config->item("profile_path") . '/'.$vender_detail->profile_picture;
    }    
}
if (isset($vender_detail->broacher) && ($vender_detail->broacher != '')) {
    if (file_exists($this->config->item("brochure_path") . '/'.$vender_detail->broacher)){
        $brochure_url = base_url() . $this->config->item("brochure_path") . '/'.$vender_detail->broacher;
    }
}

// echo '<pre>';
// print_r($shop_availibality);

 ?>
<div class="content" id="vender-profile">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Update Restaurant Profile</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo get_msg();
                // echo '<pre>';
                //  print_r($vender_cuisine_detail);

                ?>
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Basic Info</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Shop Title</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Put your shop title here and tell the name of your bussiness to the world"></i>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('shop_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->shop_name);
    }
    ?>
                                            <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="Ex: Staple and Fancy Restro" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('shop_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tagline</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('tag_line');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->tag_line);
    }
    ?>
                                            <input type="text" name="tag_line" class="form-control" id="tag_line" placeholder="Ex: Best Express Maxican Grill" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('tag_line'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Email</label>
                                        <div>
                                        <?php
    $field_value = $vender_detail->email;
    ?>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter shop email" value="<?php echo $field_value; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Code</label>
                                        <div>
                                        <?php
    $field_value = stripslashes($vender_detail->shop_code);
    ?>
                                            <input type="text" name="shop_code" class="form-control disabled" id="shop_code" placeholder="Enter shop code" readonly value="<?php echo $field_value; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Owner Name</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('vender_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->vender_name);
    }
    ?>
                                            <input type="vender_name" name="vender_name" class="form-control" id="vender_name" placeholder="Enter owner name" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('vender_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>TAX Number/GST</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('tax_number');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->tax_number;
    }
    ?>
                                            <input type="text" name="tax_number" class="form-control tax-mask" id="tax_number" placeholder="Enter TAX number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('tax_number'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="loader" style="display: none;"></div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Contact information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no1');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $vender_detail->contact_no1;
    }
    ?>
                                            <input type="text" name="contact_no1" class="form-control" id="contact_no1" placeholder="Enter contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no1'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Alternate Contact Number</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no2');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->contact_no2;
    }
    ?>
                                            <input type="text" name="contact_no2" class="form-control" id="contact_no2" placeholder="Enter alternate contact number" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no2'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Location</h4>
                                    <hr class="mt-1 mb-3">
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Address/Landmark</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Start typing and select your google location from google suggestions. This is for the map and also for locating your business."></i>
                                        <div>
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->address);
    }
    ?>
                                            <input id="autocomplete" placeholder="Start typing and find your place in google map" onFocus="geolocate()" class="form-control" type="text" value="<?php echo $field_value; ?>" name="address">
                                            <input type="hidden" id="administrative_area_level_2" name="city">
                                            <input type="hidden" id="administrative_area_level_1" name="state">
                                            <div class="validation-error-label">
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Zip Code</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="Zip code will be get by address"></i>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('zip_code');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->zip_code;
    }
    ?>
                                            <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="Enter zip code" value="<?php echo $field_value; ?>" readonly>
                                            <div class="validation-error-label">
                                                <?php echo form_error('zip_code'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>City</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="City name will be get by address"></i>
                                        <div>
                                        <?php
    $field_value = $vender_detail->city;
    ?>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" readonly value="<?php echo $field_value; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>State</label><i class="far fa-question-circle" data-container="body" data-toggle="popover" data-placement="top" data-content="State name will be get by address"></i>
                                        <div>
                                        <?php
    $field_value = $vender_detail->state;
    ?>
                                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter state" readonly value="<?php echo $field_value; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Shop Availability</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table class="table table-hover mb-0">
                                            <tbody>
                                                <?php
                                                foreach ($this->config->item("days") as $key => $value) { 
                                                    $open = '';
                                                    $full_day = '';
                                                    if(!empty($shop_availibality)){
                                                        foreach ($shop_availibality as $key_data => $value_data) {
                                                            if($value == $value_data['day']){
                                                                if($value_data['is_closed'] == '0'){
                                                                    $open = 'checked';
                                                                }
                                                                 if($value_data['full_day'] == '1'){
                                                                    $full_day = 'checked';
                                                                }
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                  <tr data-id='<?php echo $key; ?>' data-day='<?php echo $value; ?>'>
                                                    <td><?php echo $value; ?></td>
                                                    <?php 
                                                     if($open == 'checked'){ 
                                                        if($full_day == 'checked'){?>

                                                        <td class="from_td">
                                                            <div class="text-center">24 Hours Open</div>
                                                        </td>
                                                        <td class="to_td">
                                                        </td>
                                                    
                                                    <?php }else{ ?>
                                                    <td class="from_td">
                                                        <select class="form-control select2 from_time" name="<?php echo $value; ?>[]">
                                                            <option disabled >Select Time</option>
                                                        </select>
                                                    </td>
                                                    <td class="to_td">
                                                        <select class="form-control select2 to_time" name="<?php echo $value; ?>[]">
                                                            <option disabled >Select Time</option>
                                                        </select>
                                                    </td>
                                                <?php }
                                                     }else{ ?>
                                                        <td class="from_td">
                                                            <div class="text-center">CLOSED</div>
                                                        </td>
                                                        <td class="to_td">
                                                        </td>
                                                    <?php }
                                                    if($open == 'checked'){
                                                    ?>

                                                    <td class="fullday_td text-center">
                                                        <input type="checkbox" id="fullday_<?php echo $key; ?>" switch="none" class="fullday" value="fullday" name="<?php echo $value; ?>[]" <?php echo $full_day; ?> >
                                                        <label class="mb-0 mt-1" for="fullday_<?php echo $key; ?>" data-on-label="Fullday" data-off-label="Custom"></label>
                                                    </td>
                                                    <?php } else{ ?>
                                                        <td class="fullday_td text-center" >
                                                        </td>
                                                    <?php } ?>
                                                    <td class="text-center">
                                                        <input type="checkbox" id="open_<?php echo $key; ?>" switch="none"  class="open" value='open' name="<?php echo $value; ?>[]" <?php echo $open; ?>>
                                                        <label class="mb-0 mt-1" for="open_<?php echo $key; ?>" data-on-label="Open" data-off-label="Closed"></label>
                                                    </td>
                                                  </tr>  
                                                <?php }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="validation-error-label">
                                        <?php echo form_error('availibality'); ?>
                                    </div>
                                    <div class="validation-availibality">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Shop Information</h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Shop Cuisines</label>
                                        <div>
                                            <select class="select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="Choose cuisines that you are serving..." name="cuisines[]">
                                                <?php 
                                                
                                                foreach ($cuisines_data as $key => $value) {
                                                    $selected = '';
                                                    if (in_array($value['id'], array_column($vender_cuisine_detail, 'cuisine_id'))){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option value='".$value['id']."' ".$selected.">".$value['cuisine_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="validation-error-label">
                                                <?php echo form_error('cuisines[]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Shop Website</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('website');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = stripslashes($vender_detail->website);
    }
    ?>
                                            <input type="text" name="website" class="form-control" id="website" placeholder="Enter shop website" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('website'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Minimum Order</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('min_order');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $vender_detail->min_order;
    }
    ?>
                                            <input type="number" name="min_order" class="form-control demo2" id="min_order" placeholder="Enter minimum order amount" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('min_order'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Delivery Charges</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('delivery_charges');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->delivery_charges;
    }
    ?>
                                            <input type="number" name="delivery_charges" class="form-control demo2" id="delivery_charges" placeholder="Enter delivery charges amount" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('delivery_charges'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Facebook Link</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('facebook_link');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $vender_detail->facebook_link;
    }
    ?>
                                            <input type="text" name="facebook_link" class="form-control" id="facebook_link" placeholder="Enter facebook link" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('facebook_link'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Twitter Link </label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('twitter_link');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    else{
        $field_value = $vender_detail->twitter_link;
    }
    ?>
                                            <input type="text" name="twitter_link" class="form-control" id="twitter_link" placeholder="Enter twitter link" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('twitter_link'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Pinterest Link</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('pinterest_link');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = $vender_detail->pinterest_link;
    }
    ?>
                                            <input type="text" name="pinterest_link" class="form-control" id="pinterest_link" placeholder="Enter pinterest link" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('pinterest_link'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="required">Payment</label>
                                        <div class="d-block mt-2">
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("0", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("0", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline" value="0" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline">Card</label>
                                            </div>
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("1", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("1", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline1" value="1" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline1">Apple Pay</label>
                                            </div>
                                            <?php
    $field_value = '';
    $temp_value = set_value('payment_mode[]');
    if (isset($temp_value) && !empty($temp_value)) {
       if (in_array("2", $temp_value)){
            $field_value = 'checked';
       }
    }
    else{
        if (in_array("2", $payment_mode)){
            $field_value = 'checked';
       }
    }
    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline2" value="2" name="payment_mode[]" <?php echo $field_value; ?> >
                                                <label class="custom-control-label" for="customControlInline2">Google Pay</label>
                                            </div>
                                        </div>
                                        <div class="validation-error-label">
                                            <?php echo form_error('payment_mode[]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="required">Description (Minimum 150 Words)</label>
                                        <div>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('about');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->about);
    }
    ?>
                                            <textarea name="about" class="form-control" id="about" placeholder="Detail description about your shop"><?php echo $field_value; ?></textarea>
                                            <div class="validation-error-label">
                                                <?php echo form_error('about'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('profile_picture');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->profile_picture);
    }
    ?>
                                        <input type="file" name="profile_picture" class="filestyle" data-buttonname="btn-secondary" accept="image/*" value="" id="profile_picture">
                                        <div class="validation-error-label">
                                            <?php echo form_error('profile_picture'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Brochure File</label>
                                        <?php
    $field_value = NULL;
    $temp_value = set_value('broacher');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }else{
        $field_value = stripslashes($vender_detail->broacher);
    }
    ?>
                                        <input type="file" name="broacher" class="filestyle" data-buttonname="btn-secondary" accept="application/pdf, image/*" value="">
                                        <a href="<?php echo $brochure_url; ?>"><?php echo $field_value; ?></a>
                                        <div class="validation-error-label">
                                            <?php echo form_error('broacher'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <img src="<?php echo $prof_url; ?>" class="img-circle profile-avatar small" alt="User avatar" id="blah" onerror="this.src='<?php echo $prof_defualt_url; ?>'" >
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group m-b-0">
                                        <div>
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="<?php echo base_url().'vender-list'; ?>" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> 
            </div> <!-- end row -->
        </form>

    </div>
</div>
<?php
$google_key = $this->config->item("google_key");
?>
<script src="<?php echo base_url().'assets/js/custom/vender/vender_account.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_key; ?>&libraries=places&callback=initAutocomplete" async defer></script>

<script type="text/javascript">
    var available_time = jQuery.parseJSON('<?php echo json_encode($available_time); ?>');
    var shop_availibality = jQuery.parseJSON('<?php echo json_encode($shop_availibality); ?>');

    var from_time_selected = '<?php echo $from_time_selected; ?>';
    var to_time_selected = '<?php echo $to_time_selected; ?>';
    //console.log(shop_availibality);
</script>