<style type="text/css" media="screen">
    .btn-danger{
        color: #fff;
        background-color: #ec536c;
        border-color: #ec536c;
    }
</style>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Order Detail</h4>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="float-right font-16 mt-3"><strong>Order # CL<?php echo $order_data['order']->id; ?></strong></h4>
                                    <h3 class="mt-0">
                                        <img src="<?php echo base_url().'assets/images/click-lunch.png'; ?>" alt="" height="50">
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            <?php echo $order_data['order']->shop_name; ?><br>
                                            <?php echo $order_data['order']->shop_city; ?>,<br>
                                            <?php echo $order_data['order']->shop_state; ?>, <?php echo $order_data['order']->shop_zip_code; ?><br>
                                            <?php echo '+1 '.$order_data['order']->shop_number1; ?>
                                            <?php echo ($order_data['order']->shop_number2 != '')?'<br>'.'+1 '.$order_data['order']->shop_number2:''; ?>
                                        </address>
                                    </div>
                                    <div class="col-6 text-right">
                                        <address>
                                            <strong>Deliver To:</strong><br>
                                            <?php echo $order_data['order']->username; ?><br>
                                            <?php echo $order_data['order']->house_no.', '.$order_data['order']->street.','; ?><br>
                                            <?php echo $order_data['order']->city.' '.$order_data['order']->zipcode; ?><br>
                                            <?php echo '+1 '.$order_data['order']->mobile_number; ?>
                                        </address>
                                    </div>
                                    <div class="col-6">
                                        <strong>Order Type:</strong>
                                        <?php echo $order_type; ?><br>
                                        <?php
                                        $created_date_ts = strtotime($order_data['order']->created_at);

                                        if($order_data['order']->order_type == 2 || $order_data['order']->order_type == 4){
                                        ?>
                                        <strong>Schedule Time:</strong>
                                        <?php echo date("j M, Y", $created_date_ts).' '.$order_data['order']->later_time; ?><br>
                                        <?php
                                        }
                                        if($order_data['order']->order_type == 5 || $order_data['order']->order_type == 6){
                                        ?>
                                            <strong>Schedule Date Time:</strong>
                                            <?php
                                            $schedule_date_ts = strtotime($order_data['order']->schedule_date);
                                            echo $schedule_date = date("j M, Y", $schedule_date_ts);
                                            echo ' '.$order_data['order']->schedule_time;
                                            ?>
                                            <br>
                                        <?php
                                        }
                                        if(isset($order_data['delivery_boy']) && !empty($order_data['delivery_boy'])){
                                        ?>
                                            <strong>Delivery Boy:</strong><br>
                                            <?php
                                            echo $order_data['delivery_boy']['delivery_boy_name'];
                                            echo ' ( '.$order_data['delivery_boy']['delivery_boy_mobile_number'].' )';
                                            echo "<br>";
                                            echo $order_data['delivery_boy']['delivery_boy_email'];
                                        }
                                        ?>
                                    </div>
                                    <div class="col-6 text-right">
                                        <strong>Order Placed On:</strong><br>
                                        <?php
                                        echo $created_date = date("j M, Y h:i A", $created_date_ts);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-16"><strong>Order Summary</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><strong>Product(s)</strong></td>
                                                    <td class="text-center"><strong>Price</strong></td>
                                                    <td class="text-center"><strong>Quantity</strong>
                                                    </td>
                                                    <td class="text-right"><strong>Total</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sub_total = 0;
                                                foreach ($order_data['order_items'] as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo '<strong>'.$value['name'].'</strong>';
                                                        $total_price = $value['price'];
                                                        echo '<span class="varient-data">';
                                                        if(isset($value['groups']) && is_array($value['groups'])){
                                                            foreach ($value['groups'] as $group_key => $group_value) {
                                                                echo '<br>'.$group_value.' - ';
                                                                $varients_name = array();
                                                                foreach ($value['varients'] as $varients_key => $varients_value) {
                                                                    if($varients_value['group_name'] == $group_value){
                                                                        array_push($varients_name, ucfirst($varients_value['varient_name']));
                                                                        $total_price += $varients_value['varient_price'];
                                                                    }
                                                                }
                                                                echo implode(', ', $varients_name);
                                                            }
                                                        }
                                                        echo '</span>';
                                                        
                                                        $total_product_price = $value['item_price'] + $value['variants_price'];
                                                        $item_total_amount = $total_product_price * $value['quantity'];
                                                        $sub_total += $item_total_amount;
                                                        ?>
                                                    </td>

                                                    <td class="text-center">$<?php echo number_format((float)$total_product_price, 2, '.', ''); ?></td>
                                                    <td class="text-center"><?php echo $value['quantity']; ?></td>
                                                    <td class="text-right">$<?php echo number_format((float)$item_total_amount, 2, '.', ''); ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-right">
                                                        <strong>Subtotal</strong></td>
                                                    <td class="thick-line text-right">$<?php echo number_format((float)$sub_total, 2, '.', ''); ?></td>
                                                </tr>

                                                <?php 
                                                if(isset($order_data['order']->promocode) && $order_data['order']->promocode != ''){ 
                                                    $promo_amount = $order_data['order']->promo_amount;
                                                    $sub_total = floatval($sub_total) - floatval($promo_amount);
                                                    $sub_total = number_format((float)$sub_total, 2, '.', '');
                                                ?>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right">
                                                        <strong>Promo - (<?php echo $order_data['order']->promocode; ?>)</strong></td>
                                                    <td class="no-line text-right">-$<?php echo number_format((float)$promo_amount, 2, '.', ''); ?></td>
                                                </tr>
                                                <?php }else{
                                                    $promo_amount = 0;
                                                } ?>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right">
                                                        <?php 
                                                        $tax_amount = ($order_data['order']->tax > 0)?(floatval($sub_total) * floatval($order_data['order']->tax)) / 100 :0;
                                                        $tax_amount = number_format((float)$tax_amount, 2, '.', '');
                                                        ?>
                                                        <strong>TAX (<?php echo $order_data['order']->tax; ?>%)</strong></td>
                                                    <td class="no-line text-right">$<?php echo $tax_amount; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right">
                                                        <?php 
                                                        $service_charge_amount = ($order_data['order']->service_charge > 0)?(floatval($sub_total) * floatval($order_data['order']->service_charge)) / 100 :0;
                                                        $service_charge_amount = number_format((float)$service_charge_amount, 2, '.', '');
                                                        ?>
                                                        <strong>Service Charge (<?php echo $order_data['order']->service_charge; ?>%)</strong></td>
                                                    <td class="no-line text-right">$<?php echo $service_charge_amount    ; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right">
                                                        <strong>Delivery Charge</strong></td>
                                                    <td class="no-line text-right">$<?php echo number_format((float)$order_data['order']->delivery_charges, 2, '.', ''); ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right">
                                                        <strong>Total</strong></td>
                                                        <?php
                                                        $total = $sub_total + floatval($order_data['order']->delivery_charges) + $tax_amount + $service_charge_amount;
                                                        ?>
                                                    <td class="no-line text-right"><h4 class="m-0">$<?php echo number_format((float)$total, 2, '.', ''); ?></h4></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-primary waves-effect"><i class="fa fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->        

    </div> <!-- container-fluid -->

</div> <!-- content -->