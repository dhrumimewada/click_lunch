<style type="text/css" media="screen">
   .tab-content>.active{
        display: inline-flex !important;
   } 
</style>
<div id="content">
    <div class="favourites-order-wrapper order-history-wrapper grey-bg">
        <div class="container">
        	<div class="favourites-order-block">
        		<?php echo get_msg(); ?>
        		<div class="contact-us-inner"> 
                    <div class="contact-inner-title">
                        <h3>Delivery Restaurants</h3>
                    </div>
                    <div class="tab-content">
	                    <div class="tab-pane fade show active restaurant row mt-4 w-100" id="delivery-restaurants">
	                    	<!-- <div id="">
	                    		<div class="">No any restaurants found</div>
	                    	</div> -->
	                    </div>
                	</div>
                </div>
        	</div>
        </div>
    </div>
</div>
<script type="text/javascript">
var latitude = '<?php echo $_SESSION['lat']; ?>';
var longitude = '<?php echo $_SESSION['long']; ?>';

var get_shop_data_url = "<?php echo base_url().'get-shops-by-filter'; ?>";
var photo_url = '<?php echo base_url() . $this->config->item("profile_path") . '/'; ?>';
var defualt_photo_url = '<?php echo base_url() . 'web-assets/images/logo-3.png'; ?>';

var shop_url = '<?php echo base_url().'restaurant/'; ?>';
var zoom_out_img_url = '<?php echo base_url().'web-assets/images/zoom-in-out.png'; ?>';

var cuisine_id = '';
var pickup = '';
var popular = '';
var delivery_fee = '';
var minimum_order_amount = '';
var category = '';
var rating = '';

var delivery_restaurants = 1;
var pickup_restaurants = '';
$(document).ready(function(){

});
</script>
<script src="<?php echo base_url().'web-assets/js/custom/home.js'; ?>"></script>