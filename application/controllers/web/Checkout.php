<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("website/welcome_model");
		$this->load->model("website/profile_model");
		$this->load->model("api/customer_api_model");
	}

	public function index(){
		$tax = '';
        $this->db->select('data');
        $this->db->where("name", 'tax');
        $this->db->from('setting');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $tax_data = $sql_query->row();
            $tax = $tax_data->data;
        }

		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['tax'] = $tax;

		$shop_id = '';
		$service_charge = '';
		$subtotal = 0;
		foreach ($this->cart->contents() as $key => $value) {
			$shop_id = $value['shop_id'];
			break;
		}
		$this->db->select('service_charge,payment_mode');
        $this->db->where("id", $shop_id);
        $this->db->from('shop');
        $sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
            $shop_data = $sql_query->row();
            $service_charge = $shop_data->service_charge;
            $payment_mode = $shop_data->payment_mode;
            $payment_mode_array = explode(',', $payment_mode);
            if(in_array('0', $payment_mode_array)){
            	$output_data['payment_card'] = true;

            	$customer_cards = $this->profile_model->get_cards();
        		$output_data['cards'] = $customer_cards;
            }
            if(in_array('1', $payment_mode_array)){
            	$output_data['payment_apple_pay'] = true;
            }
            if(in_array('2', $payment_mode_array)){
            	$output_data['payment_google_pay'] = true;
            }
        }
        $output_data['service_charge'] = $service_charge;
        $address_id = decrypt($_SESSION['delivery_address_id']);

        if(isset($_SESSION['delivery_fee']) && $_SESSION['delivery_fee'] != ''){
			$delivery_fee = $_SESSION['delivery_fee'];
        }else{
        	$delivery_fee = $this->welcome_model->fetch_delivery_charge($shop_id, $address_id);
        	$this->session->set_userdata('delivery_fee', $delivery_fee);
        }

        // echo "<pre>";
        // //$abc = $this->welcome_model->fetch_delivery_charge($shop_id, $address_id);
         //print_r($output_data['cards']);
        // echo "ABC";
        // exit;
        
        if($delivery_fee == FALSE){
        	$this->auth->set_error_message("Delivery is not available on this location");
        	$this->session->set_flashdata($this->auth->get_messages_array());
        	redirect(base_url() . "cart");
        }
        $output_data['delivery_fee'] = $delivery_fee;

        $valid_promocodes = $this->welcome_model->fetch_promocode();
        $output_data['promocodes'] = $valid_promocodes;

        

        // echo "<pre>";
        // print_r($output_data['delivery_fee']);
        // exit;

		$output_data['main_content'] = "checkout";
		$this->load->view('web/template',$output_data);
	}

	public function add_card(){
		if (isset($_POST) && !empty($_POST)){

			if(validate_expiry_date($_POST['expiry_date'])){
				if(validate_card_number($_POST['card_number'], $_POST['card_type'])){
					if($_POST['card_type'] == 3 && strlen($_POST['cvv']) != 4){
						echo json_encode(array("is_success" => false, 'message' => 'Invalid CVV'));
						return TRUE;
					}else{
						$id = $this->profile_model->add_card_with_returnid();
						if($id != 0 && isset($id)){
							echo json_encode(array("is_success" => true, 'message' => 'Payment card added successfully', 'id' => $id));
							return TRUE;
						}else{
							echo json_encode(array("is_success" => false, 'message' => 'Error into inserting card'));
							return TRUE;
						}
					}
				}else{
					echo json_encode(array("is_success" => false, 'message' => 'Invalid card'));
					return TRUE;
				}
			}else{
				echo json_encode(array("is_success" => false, 'message' => 'Invalid expiry date'));
				return TRUE;
			}	
		}else{
			return false;
		}
	}

	public function get_promocode_data(){
		$promocode = $this->profile_model->get_promocode_data();

		$all_sub_total = 0;
		$cart_items = array();
		foreach ($this->cart->contents() as $key => $value) {
			array_push($cart_items, $value['item_id']);
			$all_sub_total += $value['subtotal'];
		}

		// check all conditions
		$promo_amount = 0;
		if($promocode['promo_type'] == 1){

			$real_cart_data = array();
			foreach ($this->cart->contents() as $key => $value) {
				$real_cart_data[$value['item_id']] += $value['subtotal'];
			}
			$items = array_keys($real_cart_data);

			$matched_products = array_intersect($items,$promocode['applied_on_products']);
			$product_price = array();
			$cart_products = array();
			$count  = 0;

			foreach ($real_cart_data as $key => $value){
				foreach ($matched_products as $key1 => $value1) {
					if($value1 == $key){
						if($promocode['discount_type'] == 0){
							// if subtotal of single item - apply promo
							if($value <  $promocode['amount']){
								$promo_amount += $value;
							}else{
								$promo_amount += $promocode['amount'];
							}
						}else{
							$promo_amount += ($value * $promocode['amount']) / 100;
						}
					}
				}
			}
		}else{
			if($promocode['discount_type'] == 0){
				$promo_amount = $promocode['amount'];
				if($promo_amount > $all_sub_total){
					$promo_amount = $all_sub_total;
				}
			}else{
				$promo_amount = ($all_sub_total * $promocode['amount']) / 100;
				if($promo_amount > $promocode['max_disc']){
					$promo_amount = $promocode['max_disc'];
				}
			}
		}

		//echo json_encode(array('data' => $promocode, 'cart_products' => $cart_products));
		echo json_encode(array('data' => $promocode, 'promo_amount' => $promo_amount));
		return TRUE;
	}

	public function validate_promocode(){
		$valid_promocodes = $this->welcome_model->fetch_promocode();
		$promocodes = array_column($valid_promocodes, 'promocode');
		if(in_array(strtoupper($_POST['promocode']),$promocodes)){
			echo json_encode(array("is_success" => true, "promocode" => $_POST['promocode'], 'arra' => $promocodes));
			return TRUE;
		}else{
			echo json_encode(array("is_success" => false, "promocode" => $_POST['promocode'], 'arra' => $promocodes));
			return false;
		}
	}

	public function place_order(){

		$cart_contents = $this->cart->contents();

		$not_avilable_item = array();
		foreach ($cart_contents as $key => $value){

			$shop_id = $value['shop_id'];
			$this->db->select('*');
            $this->db->from('item');
            $this->db->where('id', $value['item_id']);
            $this->db->where('shop_id', $value['shop_id']);
            $this->db->where('quantity >=', intval($value['qty']));
            $this->db->where('deleted_at',NULL);
            $this->db->where('is_active',1);
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                
            }else{
            	array_push($not_avilable_item, $value['item_id']);
            }
		}

		if(empty($not_avilable_item)){
			$later_time = '';
			if(($_POST['order_type'] == 2) || ($_POST['order_type'] == 4)){
				if(isset($_POST['later_time']) && $_POST['later_time'] != ''){
                    $later_time = $_POST['later_time'];
                }
			}

			$promocode_id = '';
			if(isset($_POST['promocode']) && $_POST['promocode'] != ""){

                $this->db->select('id');
	            $this->db->from('promocode');
	            $this->db->where('promocode', $_POST['promocode']);
	            $sql_query = $this->db->get();
	            if ($sql_query->num_rows() > 0){
	            	$promocode_data = $sql_query->row();
	            	$promocode_id = $promocode_data->id;
	            }
            }

            $schedule_date = $schedule_time ='';
            if($_POST['order_type'] == 5){
            	if(isset($_POST['schedule_date']) && $_POST['schedule_date'] != '' && isset($_POST['schedule_time']) && $_POST['schedule_time'] != ''){
                    $schedule_date = $_POST['schedule_date'];
                    $schedule_time = $_POST['schedule_time'];
                }else{
                    $schedule_date = '';
                    $schedule_time = '';
                }
            }

            $data = array( 
	                    'customer_id' => $this->auth->get_user_id(), 
	                    'shop_id'=> $shop_id, 
	                    'order_type'=> $_POST['order_type'], 
	                    'later_time'=> $later_time,
	                    'delivery_charges' => number_format((float)$_POST['delivery_amount'], 2, '.', ''),
	                    'promocode_id'=> $promocode_id,
	                    'promo_amount'=> '',
	                    'tax' => $_POST['tax'], 
	                    'service_charge' => $_POST['service_charge'], 
	                    'schedule_date'=> $schedule_date,
	                    'schedule_time'=> $schedule_time,
	                    'delivery_address_id'=> decrypt($_SESSION['delivery_address_id']),

	                    'order_status'=> 0,
	                    'payment_status'=> 1,
	                    'payment_mode'=> $_POST['payment_type'],
	                    'transaction_id'=> ''
	                );

            if($this->db->insert('orders', $data)){

            	$order_id = $this->db->insert_id();
                $my_product_data = array();
                $my_variant_data = array();
                $sub_total = 0;

                foreach ($cart_contents as $key => $value){

                	$this->db->select('IF(offer_price = "", price, offer_price) as price'); 
                    $this->db->where('id',$value['item_id']); 
                    $this->db->where('shop_id',$value['shop_id']); 
                    $this->db->from('item'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $product_price_array = $sql_query->row();
                        $item_price = $product_price_array->price;
                    }else{
                        $item_price = '';
                    }

                    $product_data = array(
                        'order_id' => $order_id,
                        'item_id' => $value['item_id'],
                        'item_price' => $item_price,
                        'variants_price' => '',
                        'quantity' => $value['qty'],
                        'total_product_price' => ''
                    );

                    $this->db->insert('order_items', $product_data);
                    $product_insert_id = $this->db->insert_id();
                    $my_product_data[] = $product_data;

                    $varients_price = 0;
                    foreach ($value['group_data'] as $group_key => $group_value){
                    	foreach ($group_value as $variant_key => $variant_value) {

                    		$this->db->select('id,variant_group_id,price'); 
                            $this->db->where('id',$variant_value); 
                            $this->db->where('item_id',$value['item_id']);
                            $this->db->from('variant_items'); 
                            $sql_query = $this->db->get();
                            if ($sql_query->num_rows() > 0){
                                $variant_array = $sql_query->row();

                                $variant_data = 
                                    array(
                                        'order_item_id' => $product_insert_id,
                                        'variant_group_id' => $variant_array->variant_group_id,
                                        'variant_id' => $variant_value,
                                        'price' => number_format((float)$variant_array->price, 2, '.', '')
                                    );
                                $this->db->insert('order_item_variant', $variant_data);

                                $varients_price +=  number_format((float)$variant_array->price, 2, '.', '');
                                $my_variant_data[] = $variant_data;
                    		}
                    	}
                	}
                }

                $total_product_price = ($item_price + $varients_price) * $value['qty'];

                $product_data_edited = 
                        array(
                            'variants_price' => number_format((float)$varients_price, 2, '.', ''),
                            'total_product_price' => number_format((float)$total_product_price, 2, '.', '')
                        );
                $this->db->where('id',$product_insert_id); 
                $this->db->update('order_items', $product_data_edited);

                $sub_total += $total_product_price;
            }

            $sub_total = number_format((float)$sub_total, 2, '.', '');
            $order_data_edited = array(
                                'subtotal' => $sub_total
                                );

            $promo_discount = 0;
            $promocode_data = array();
            if(isset($_POST['promocode']) && $_POST['promocode'] != ''){

                $this->db->select('*');
                $this->db->from('promocode');
                $this->db->where('promocode', $_POST['promocode']);
                $this->db->where('deleted_at',NULL);
                $this->db->where('status', 1);

                $this->db->group_start();
                    $this->db->where("shop_id", $shop_id);
                    $this->db->or_where("shop_id", '');
                $this->db->group_end();

                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $promocode_data = $sql_query->row();
                }
            }

            if(isset($promocode_data) && !empty($promocode_data)){
	            if($promocode_data->promo_type == 2){
	                
	                if($promocode_data->discount_type == 0){
	                    $promo_discount = $promocode_data->amount;
	                }else{
	                    $promo_discount = (floatval($sub_total) * floatval($promocode_data->amount)) / 100;
	                }
	            }else{
	                $promocode_valid_products = $this->customer_api_model->get_promocode_valid_products($promocode_data->id);
	                if(isset($promocode_valid_products) && !empty($promocode_valid_products)){
	                    $valid_products = array();
	                    foreach ($promocode_valid_products as $key => $value) {
	                        $valid_products[] = $value['product_id'];
	                    }
	                    foreach ($order_data['products'] as $products_key => $products_value){
	                        if (in_array($products_value['product_id'], $valid_products)){
	                            if($promocode_data->discount_type == 0){
	                                // flat
	                                $promo_discount += $promocode_data->amount;
	                            }else{
	                                // perc
	                                $total_product_price = 0;
	                                $this->db->select('total_product_price'); 
	                                $this->db->where('item_id',$products_value['product_id']); 
	                                $this->db->where('order_id',$order_id); 
	                                $this->db->from('order_items');
	                                $sql_query = $this->db->get();
	                                if ($sql_query->num_rows() > 0){
	                                    $total_product_price_array = $sql_query->row();
	                                    $total_product_price = $total_product_price_array->total_product_price;
	                                    $promo_discount += (floatval($total_product_price) * floatval($promocode_data->amount)) / 100;
	                                }
	                            }   
	                        }
	                    }
	                }
	            }
	        }

	        if(isset($promocode_data->max_disc) && $promocode_data->max_disc != ''){
	            $promo_discount = (floatval($promocode_data->max_disc) < floatval($promo_discount))?floatval($promocode_data->max_disc):$promo_discount;
	        }

	        $sub_total2 = floatval($sub_total) - floatval($promo_discount);
            $sub_total2 = number_format((float)$sub_total2, 2, '.', '');

            $tax = (floatval($sub_total2) * floatval($order_data['tax'])) / 100;
            $tax = number_format((float)$tax, 2, '.', '');

            $service_charge = (floatval($sub_total2) * floatval($order_data['service_charge'])) / 100;
            $service_charge = number_format((float)$service_charge, 2, '.', '');

            $delivery_charges = number_format((float)$order_data['delivery_charges'], 2, '.', '');


            $total = $sub_total2 + $tax + $service_charge + $delivery_charges;

            $order_data_edited['promo_amount'] = number_format((float)$promo_discount, 2, '.', '');
            $order_data_edited['total'] = number_format((float)$total, 2, '.', '');

            $order_data_edited['QR_code'] = $this->generate_qr_code('CL'.$order_id);

            $this->db->where('id',$order_id);  
            $this->db->update('orders', $order_data_edited);

            echo json_encode(array("is_success" => true, "order_id" => $order_id , 'message' => 'Order sucess'));
			return TRUE;

		}else{

			$this->db->select('name');
            $this->db->from('item');
            $this->db->where_in('id', $not_avilable_item);
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
            	$not_avilable_items_name = $sql_query->result_array();
            	$names = array_column($not_avilable_items_name, 'name');
            	$items_name = implode(', ', $names);
            }

			echo json_encode(array("is_success" => false, 'not_avilable_item' => $not_avilable_item, "message" => $items_name.' not avilable.'));
			return TRUE;
		}
	}

	public function generate_qr_code($data_string = NULL){
        $return_data = NULL;
        if(isset($data_string) && !is_null($data_string)){

            $unique_code = $data_string.'_'.time();
            $googleapis = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$unique_code."&choe=UTF-8";
            $file = file_get_contents($googleapis);

            $path = FCPATH . $this->config->item("qr_code_path").'/'.$unique_code.'.png';
            if(file_put_contents($path, $file)){
                $return_data = $unique_code.".png";
            }else{
                $return_data = '';
            }
            
        }
        return $return_data;
    }

    public function order_success($order_id = NULL){
    	if(isset($order_id) && $order_id != ''){
    	
    		$order = $this->profile_model->order_detail($order_id);

    		// echo '<pre>';
    		// print_r($order);
    		// exit;

    		$output_data['order'] = $order;
    		$output_data['main_content'] = "order_success";
			$this->load->view('web/template',$output_data);
    	}else{
    		echo 'order id not found';
    	}
    }
}
