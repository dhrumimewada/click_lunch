<?php
$post_link = base_url().'contact-us';
?>

<div id="content">
    <div class="favourites-order-wrapper order-history-wrapper grey-bg">
        <div class="container">
            <div class="favourites-order-block white-bg">
            <?php echo get_msg(); ?>    
                <div class="contact-us-inner"> 
                    <div class="contact-inner-title">
                        <h3>Contact us</h3>
                    </div>
                    <div class="row center-us ">                                    
                        <div class="modal-body">
                            <form class="contact-form mt-5" id="contact-form" action="<?php echo $post_link; ?>" method="post">                                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $field_value; ?>" placeholder="Full Name*">
                                            <div class="validation-error-label">
                                                <?php echo form_error('name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('email');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="email" placeholder="E-mail*" name="email" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('contact_no');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="contact_no" placeholder="Phone Number*" name="contact_no" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('contact_no'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('subject');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <input type="text" class="form-control" id="subject" placeholder="Subject*" name="subject" value="<?php echo $field_value; ?>">
                                            <div class="validation-error-label">
                                                <?php echo form_error('subject'); ?>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php
    $field_value = NULL;
    $temp_value = set_value('message');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                                            <textarea class="form-control" rows="5" id="message" placeholder="Message*" name="message"><?php echo $field_value; ?></textarea>
                                            <div class="validation-error-label">
                                                <?php echo form_error('message'); ?>
                                            </div>
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
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script src="<?php echo base_url().'web-assets/js/custom/contact_us.js'; ?>"></script>



