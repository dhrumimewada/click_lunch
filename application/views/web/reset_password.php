<?php
$reset_link = base_url().'reset-password';
$home_link = base_url().'welcome';
?>
<div id="content">
    <div class="favourites-order-wrapper order-history-wrapper grey-bg">
        <div class="container">
            <div class="favourites-order-block white-bg">   
            <?php echo get_msg(); ?>      
                <div class="faq-inner reset-inner"> 
                    <div class="faq-title">
                        <h3>Reset Password</h3>
                    </div>
                  <form class="reset-form" id="reset-form" method="post" action="<?php echo $reset_link; ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <?php
    $field_value = NULL;
    $temp_value = set_value('old_password');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>                                   
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Current password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('old_password'); ?>
                                </div>
                            </div>
                             <div class="form-group"> 
                             <?php
    $field_value = NULL;
    $temp_value = set_value('new_password');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>                                         
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('new_password'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <?php
    $field_value = NULL;
    $temp_value = set_value('confirm_password');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password" value="<?php echo $field_value; ?>">
                                <div class="validation-error-label">
                                    <?php echo form_error('confirm_password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>                               
                    <div class="row">                                   
                        <div class="col-sm-6 reset-btn">
                            <input type="submit" name="submit" class="register small-red-btn" value="Submit">
                        </div>
                    </div>                        
                </form>
                </div>
                <div class="form-actions d-flex justify-content-center">
                    <a href="<?php echo $home_link; ?>" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url().'web-assets/js/custom/profile.js'; ?>"></script>