<?php
$post_link = base_url().'add-request-address';
?>

<div id="content">
    <div class="favourites-order-wrapper order-history-wrapper grey-bg">
        <div class="container">
            <div class="favourites-order-block white-bg">
            <?php echo get_msg(); ?>    
                <div class="contact-us-inner"> 
                    <div class="contact-inner-title">
                        <h3>Request Popular Location</h3>
                    </div>
                    <div class="row center-us ">                                    
                        <div class="modal-body">
                            <form class="form-validate" id="popular-form" action="<?php echo $post_link; ?>" method="post">                                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('house_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="house_no" placeholder="House/Office Number*" name="house_no" autocomplete="off" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('house_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('street');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="street" placeholder="Street/Locality*" name="street" autocomplete="off" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('street'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('city');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="city" placeholder="City*" name="city" autocomplete="off" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('zipcode');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="zipcode" placeholder="Zip Code* Ex: 10001" name="zipcode" autocomplete="off" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('zipcode'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('nickname');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="nickname" placeholder="Nickname" name="nickname" autocomplete="off" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('nickname'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="gender delivery-address address_type d-flex row m-0">
                                            <?php
                $field_value = NULL;
                $temp_value = set_value('address_type');
                if (isset($temp_value) && !empty($temp_value)) {
                    $field_value = $temp_value;
                }
                if(!isset($field_value) && is_null($field_value)){
                    $field_value = 1;
                }
                ?> 
                                            <?php
                                            unset($address_type[3]);
                                            foreach ($address_type as $key => $value) {
                                            ?>
                                            <div class="form-check col-md-4">
                                                <input class="form-check-input" type="radio" name="address_type" id="genderRadios<?php  echo $key;?>" value="<?php echo $key;?>" <?php echo ($field_value == $key)?'checked':'' ?>>
                                                <label class="form-check-label" for="genderRadios<?php echo $key;?>"><?php echo ucfirst($value);?></label>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                                
                                    <div class="col-sm-12 cont-sub">
                                        <input type="submit" name="submit" class="register red-btn" id="contatc-btn" value="Submit">
                                    </div>
                                </div>                                            
                            </form>
                        </div>
                    </div>
                </div>
                <div class="form-actions d-flex justify-content-center">
                    <a href="<?php echo BASE_URL(); ?>welcome" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url().'web-assets/js/custom/add_popular_address.js'; ?>"></script>