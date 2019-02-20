<?php
$post_link = base_url().'restaurant-partner-form';
?>
<style type="text/css" media="screen">
.partner-form-validate .validation-error-label{
    margin: 0;
}
</style>
<div class="container-fluid grey-bg">
    <div class="form-content">
        <div class="container content-form">
            <div class="row">
                <h3>Register Your Restaurant</h3>
                <div class="col-12 mt-3">
                    <?php echo get_msg(); ?>
                </div>
                <div class="col-md-12 form-border">
                    <form class="partner-form-validate mt-5" action="<?php echo $post_link; ?>" method="post">
                        <div class="form-group">
                            <?php
    $field_value = NULL;
    $temp_value = set_value('shop_name');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                            <input type="text" name="shop_name" class="form-control input-border" placeholder="Restaurant Name *" value="<?php echo $field_value; ?>" />
                            <div class="validation-error-label">
                                <?php echo form_error('shop_name'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <?php
        $field_value = NULL;
        $temp_value = set_value('email');
        if (isset($temp_value) && !empty($temp_value)) {
            $field_value = $temp_value;
        }
        ?>
                                <input type="text" name="email" class="form-control input-border" placeholder="Email Address *" value="<?php echo $field_value; ?>" />
                                <div class="validation-error-label">
                                    <?php echo form_error('email'); ?>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <?php
        $field_value = NULL;
        $temp_value = set_value('mobile_number');
        if (isset($temp_value) && !empty($temp_value)) {
            $field_value = $temp_value;
        }
        ?>
                                <input type="text" name="mobile_number" class="form-control input-border" placeholder="Phone Number *" id="mobile_number" value="<?php echo $field_value; ?>" />
                                <div class="validation-error-label">
                                    <?php echo form_error('mobile_number'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
    $field_value = NULL;
    $temp_value = set_value('address');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                            <textarea class="form-control input-border exampleFormControlTextarea1" name="address" id="" rows="3" placeholder="Restaurant Address *"><?php echo $field_value; ?></textarea>
                            <div class="validation-error-label">
                                <?php echo form_error('address'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
    $field_value = NULL;
    $temp_value = set_value('message');
    if (isset($temp_value) && !empty($temp_value)) {
        $field_value = $temp_value;
    }
    ?>
                            <textarea class="form-control input-border exampleFormControlTextarea1" name="message" id="" rows="3" placeholder="Your Message"><?php echo $field_value; ?></textarea>
                            <div class="validation-error-label">
                                <?php echo form_error('message'); ?>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
                            <button type="submit" class="small-red-btn" name="submit">Submit</button>
                        </div>

                    </form>

                    <div class="join-network">
                        <div class="join-network-box">
                            <div class="join-network-title">

                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>WHY JOIN THE NETWORK?</h3>
                                        <p>ClickLunch makes lunch easy and convenient for business professionals. Employees order online each morning, and restaurants prepare and deliver meals in bulk.</p>
                                        <b>CLICKLUNCH SOLVES YOUR RESTAURAN&apos;S NEEDS BY PROVIDING...</b>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="network-list">
                                        <div class="network-img">
                                            <img src="<?php echo base_url().'web-assets/images/image001.png'; ?>" alt="">
                                        </div>
                                        <div class="network-txt">
                                            <h5>CONSISTENT NEW SALES</h5>
                                            <p>ClickLunch generates consistent orders before your doors ever open, bringing you new business on a daily basis.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="network-list">
                                        <div class="network-img">
                                            <img src="<?php echo base_url().'web-assets/images/image002.png'; ?>" alt="">
                                        </div>
                                        <div class="network-txt">
                                            <h5>CLICKLUNCH -FUNDED DAILY MARKETING</h5>
                                            <p>On average, ClickLunch markets your brand to a targeted audience of more than 1,250 business professionals each day.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="network-list">
                                        <div class="network-img">
                                            <img src="<?php echo base_url().'web-assets/images/image003.png'; ?>" alt="">
                                        </div>
                                        <div class="network-txt">
                                            <h5>EASY OPERATIONS & DAILY SUPPORT</h5>
                                            <p>Orders are handled when your kitchen has excess capacity, and we provide a dedicated Support team to assist with daily operations.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="network-list">
                                        <div class="network-img">
                                            <img src="<?php echo base_url().'web-assets/images/image004.png'; ?>" alt="">
                                        </div>
                                        <div class="network-txt">
                                            <h5>PROFITABLE DELIVERY</h5>
                                            <p>The combination of our low fee and high sales volume makes ClickLunch the most <i><b> profitable delivery solution </b></i> in the industry.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center mt-5 mb-5">
                        <a href="<?php echo base_url(); ?>welcome" class="white-btn">BACK TO HOME</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script src="<?php echo base_url().'web-assets/js/custom/restaurant_partner_form.js'; ?>"></script>