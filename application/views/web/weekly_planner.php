<style type="text/css" media="screen">
   .tab-content>.active{
        display: inline-flex !important;
   } 
   .swal2-radio label{
        display: inline-block;
        margin: 0px 40px;
   }
   .swal2-radio span{
        font-size: 20px;
        padding: 0 10px;
   }
</style>
<div id="content">
    <div class="favourites-order-wrapper order-history-wrapper grey-bg">
        <div class="container">
        	<div class="favourites-order-block">
        		<?php echo get_msg(); ?>
        		<div class="contact-us-inner"> 
                    <div class="offer-title2">
                        <ul class="nav nav-tabs justify-content-center border-bottom-0" id="weekly-tabs" role="tablist">
                            <?php
                            foreach ($days as $key => $value) {
                                $active = '';
                                if($value == date('l')){
                                    $active = 'active';
                                }
                            ?>
                            <li class="nav-item mr-3">
                                <a class="nav-link <?php echo $active; ?>" id="<?php echo $value; ?>-tab" data-toggle="tab" href="#<?php echo $value; ?>" role="tab" aria-controls="<?php echo $value; ?>" aria-selected="false"><?php echo $value; ?></a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <?php
                        foreach ($shop_data as $shop_key => $shop_value) {
                            $active = '';
                            if($shop_key == date('l')){
                                $active = 'active';
                            }
                        ?>
                        <div class="tab-pane fade show <?php echo $active; ?> restaurant row mt-4 w-100" id="<?php echo $shop_key; ?>" role="tabpanel" aria-labelledby="<?php echo $shop_key; ?>-tab">
                            <?php
                            foreach ($shop_value as $key => $value) {

                                $photo_url = base_url() . 'web-assets/images/logo-3.png';
                                if (isset($value['profile_picture']) && ($value['profile_picture'] != '')) {
                                    if (file_exists($this->config->item("profile_path") . '/'.$value['profile_picture'])){
                                        $photo_url = base_url() . $this->config->item("profile_path") . '/'.$value['profile_picture'];
                                    }
                                }
                                ?>
                                <!--  -->
                                <div class="col-lg-3 px-2">
                                    <div class="card">
                                        
                                            <div class="restaurant-img position-relative">
                                                <img class="card-img-top select-type pointer" src="<?php echo $photo_url; ?>" alt="Card image cap">
                                                <div class="rating txt1">Ratings</div>
                                                <div class="rating txt2 txt-red"><?php echo $value['rating']; ?></div>
                                            </div>
                                            <div class="card-body restaurant-body">
                                                    <div class="card-title font-md text-center cut-text">
                                                        <?php $selected_day = strtolower($shop_key); ?>
                                                        <!-- <a href="<?php echo BASE_URL().'restaurant/weekly_'.$selected_day.'/nearby/'.$value['short_name']; ?>" class="txt-red" target="_blank"> -->
                                                        <a href="javascript:void(0);" class="select-type txt-red" data-name="<?php echo $value['short_name']; ?>" data-shopid="<?php echo $value['id']; ?>" data-day="<?php echo $selected_day; ?>">
                                                        <?php echo stripcslashes($value['shop_name']); ?>
                                                        </a>
                                                    </div>
                                                    <b>
                                                        <div class="d-inline-block txt-black font-small">Delivery <?php echo $value['delivery_time']; ?></div>
                                                        <div class="d-inline-block txt-black float-right font-small">Order by <?php echo $value['order_by_time']; ?></div>
                                                    </b>
                                                    <?php
                                                    if(isset($value['cuisine']) && $value['cuisine'] != ''){
                                                    ?>
                                                    <div class="position-relative txt-black font-14 pl-4 cusion cut-text">
                                                        <?php
                                                        $total = count($value['cuisine']) - 1;
                                                        foreach ($value['cuisine'] as $key1 => $value1) {
                                                            echo '<span class="d-inline-block">'.$value1['cuisine_name'].'</span>';
                                                            if($key1 != $total){
                                                                echo ', ';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="card-text txt-black font-11">
                                                        <?php
                                                        if($value['availibality']['is_closed'] == 1){
                                                            echo $time = 'TODAY CLOSED';
                                                        }else if($value['availibality']['full_day'] == 1){
                                                            echo $time = 'FULL DAY OPEN';
                                                        }else if($value['availibality']['from_time'] != '' && $value['availibality']['to_time'] != ''){
                                                            echo $time = $value['availibality']['from_time'].' to '.$value['availibality']['to_time'];
                                                        }else{
                                                            echo '&nbsp;';
                                                        }
                                                        ?>
                                                    </div>
                                                    <!-- <div class="text-right txt-black mt-1"><b>0.71mi</b></div> -->
                                            </div>
                                            <div class="restaurant-hover">
                                                <div class="restaurant-hover-list">
                                                     <div class="restaurant-hover-img">
                                                        <a href="<?php echo BASE_URL().'restaurant/'.$value['short_name'].'/weekly/nearby'; ?>" target="_blank"><img src="<?php echo $assets; ?>images/zoom-in-out.png"></a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <!--  -->
                            <?php }
                            ?>
                            

                            
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>
<script type="text/javascript">
var latitude = '<?php echo $_SESSION['latitude']; ?>';
var longitude = '<?php echo $_SESSION['longitude']; ?>';

var get_shop_data_url = "<?php echo base_url().'get-shops-by-filter'; ?>";
var photo_url = '<?php echo base_url() . $this->config->item("profile_path") . '/'; ?>';
var defualt_photo_url = '<?php echo base_url() . 'web-assets/images/logo-3.png'; ?>';

var shop_url = '<?php echo base_url().'restaurant/'; ?>';
var zoom_out_img_url = '<?php echo base_url().'web-assets/images/zoom-in-out.png'; ?>';

var set_order_type_session = "<?php echo base_url().'set-order-type-session'; ?>";

$(document).ready(function(){

});
</script>
<script src="<?php echo base_url().'web-assets/js/custom/weekly_planner.js'; ?>"></script>