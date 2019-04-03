<?php

class Welcome_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('parser');
	}

	public function get_popular_shops(){
		$return_data = array();
		$this->db->select('shop_id');
		$this->db->from('orders');
		$this->db->where("order_status", 6);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$shops = $sql_query->result_array();
			$return_data = array_column($shops, 'shop_id');
			$return_data = array_count_values($return_data);
			$return_data=array_flip($return_data);
			asort($return_data);
		}
		return $return_data;
	}

	public function get_current_lat_long(){
		$ipaddress = '';
		$location = array();
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';


		$json  = file_get_contents("http://ipinfo.io/".$ipaddress."/geo");
		$json  =  json_decode($json ,true);

		if(is_array($json['loc']) && !empty($json['loc'])){
			$location = explode(',', $json['loc']);
		}
		

		return $location;
	}

	public function get_shops($short_name = NULL, $cuisine_id = NULL, $pickup = NULL, $popular = NULL, $latitude = NULL, $longitude = NULL, $delivery_fee = NULL, $minimum_order_amount = NULL, $category = NULL, $rating = NULL){
		$return_data = array();
		$new_data = array();

		// get delivery_available_mile
        $delivery_available_mile = '';
        $this->db->select('data');
        $this->db->where("name", 'delivery_available_mile');
        $this->db->from('setting');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $delivery_available_mile_data = $sql_query->row();
            $delivery_available_mile = $delivery_available_mile_data->data;
        }

		$sql_select = array(
						't1.id',
						't1.shop_name',
						't1.short_name',
						't1.profile_picture',
						't1.order_by_time',
						't1.delivery_time',
						't1.contact_no1',
						'CONCAT(t1.city, ", ", t1.zip_code, ", ", t1.state) as address',
						);

		if(isset($latitude) && $latitude != "" && isset($longitude) && $longitude != ""){

            $distance = "(3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." - t1.latitude) * pi()/180 / 2), 2) +COS( ".$latitude." * pi()/180) * COS(t1.longitude * pi()/180) * POWER(SIN(( ".$longitude." - t1.longitude) * pi()/180 / 2), 2) ))) as distance";
            array_push($sql_select,$distance);

        }

		$this->db->select($sql_select);
		$this->db->from('shop t1');
		$this->db->join('shop_cuisines t2', 't1.id = t2.shop_id');
		$this->db->where("t1.deleted_at", NULL);
		$this->db->group_by('t2.shop_id');
		$this->db->where("t1.status", 1);
		if (isset($cuisine_id) && !is_null($cuisine_id)) {
			$this->db->where('t2.cuisine_id',$cuisine_id);
		}
		if (isset($pickup) && !is_null($pickup)) {
			$this->db->group_start();
			$this->db->where('t1.takeout_delivery_status',2);
			$this->db->or_where('t1.takeout_delivery_status',3);
			$this->db->group_end();
		}
		if (isset($short_name) && !is_null($short_name)) {
			$this->db->where('t1.short_name',$short_name);
		}

		if(isset($latitude) && $latitude != "" && isset($longitude) && $longitude != ""){
			$this->db->order_by("distance", "asc");
            $this->db->having("distance <=",$delivery_available_mile);
		}

		if (isset($delivery_fee) && !is_null($delivery_fee)){
			if($delivery_fee == 1){
				$this->db->order_by("t1.charges_of_minimum_mile", "desc");
			}else{
				$this->db->order_by("t1.charges_of_minimum_mile", "asc");
			}
			
		}

		if (isset($minimum_order_amount) && !is_null($minimum_order_amount)){
			if($minimum_order_amount == 1){
				$this->db->order_by("t1.min_order", "desc");
			}else{
				$this->db->order_by("t1.min_order", "asc");
			}
			
		}

		$this->db->where("t1.longitude !=", '');
        $this->db->where("t1.latitude !=", '');

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();		

			if (isset($popular) && !is_null($popular)){
				$new_shops = array();
				$this->db->select('shop_id');
				$this->db->from('orders');
				$this->db->where("order_status", 6);
				$this->db->where_in("shop_id", array_column($return_data, 'id'));
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$query = $this->db->last_query();
					$popular_shops_data = $sql_query->result_array();
					$popular_shops = array_column($popular_shops_data, 'shop_id');

					$popular_shops = array_count_values($popular_shops);
					arsort($popular_shops);

					
					foreach ($popular_shops as $key => $value) {
						foreach ($return_data as $key1 => $value1) {
							if($key == $value1['id']){
								array_push($new_shops, $return_data[$key1]);
							}
						}
					}
				}
				$return_data = $new_shops;
			}

			$this->db->select('shop_id');
			$this->db->from('item');
			$this->db->where("quantity !=", 0);
			$this->db->where("deleted_at", NULL);
			$this->db->where("is_active", 1);
			$this->db->where("is_combo", 1);
			$this->db->where_in("shop_id", array_column($return_data, 'id'));
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$combo_shops_data = $sql_query->result_array();
				$combo_shops = array_column($combo_shops_data, 'shop_id');
			}
			
			foreach ($return_data as $key => $value) {

				// get cuisines of shop
				$sql_select = array("t2.cuisine_name","t1.cuisine_id");
				$this->db->select($sql_select);
				$this->db->from('shop_cuisines t1');
				$this->db->where("t1.shop_id", $value['id']);
				$this->db->join('cuisine t2', 't1.cuisine_id = t2.id');
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$cuisines_data = $sql_query->result_array();
					$return_data[$key]['cuisine'] = $cuisines_data;
				}

				$this->db->select('day, from_time, to_time, full_day, is_closed');
				$this->db->from('shop_availibality');
				$this->db->where("shop_id", $value['id']);
				$this->db->where("day", date('l'));
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$return_data[$key]['availibality'] = (array)$sql_query->row();
				}

				if(isset($short_name)){
					$this->db->select('day, from_time, to_time, full_day, is_closed');
					$this->db->from('shop_availibality');
					$this->db->where("shop_id", $value['id']);
					$sql_query = $this->db->get();
					if ($sql_query->num_rows() > 0){
						$return_data[$key]['all_working_time'] = $sql_query->result_array();
					}
				}

				if(empty($return_data[$key]['cuisine']) || empty($return_data[$key]['availibality'])){
					unset($return_data[$key]);
					continue;
				}

				if(in_array($value['id'], $combo_shops)){
					$return_data[$key]['combo_available'] = true;
				}else{
					$return_data[$key]['combo_available'] = false;
				}

			}

			$return_data = array_values($return_data);

			$new_shops = array();
			if (isset($category) && !is_null($category)){
				$this->db->select('shop_id');
				$this->db->from('item');
				$this->db->where("category_id", $category);
				$this->db->where_in("shop_id", array_column($return_data, 'id'));
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$query = $this->db->last_query();
					$category_shops_data = $sql_query->result_array();
					$category_shops = array_column($category_shops_data, 'shop_id');
					$category_shops = array_unique($category_shops);
					$new_shops = array();
					foreach ($category_shops as $key => $value) {
						foreach ($return_data as $key1 => $value1) {
							if($value == $value1['id']){
								array_push($new_shops, $return_data[$key1]);
							}
						}
					}
				}
				$return_data = $new_shops;
			}

		}
		return $return_data;
	}

	public function get_shop_data($short_name = NULL){
		$return_data = array();

		$sql_select = array('t1.id','t1.name','t1.short_name','t1.price','t1.offer_price','t1.item_picture');
		$this->db->select($sql_select);
		$this->db->from('item t1');

		return $return_data;
	}

	public function get_item_data($short_name = NULL){
		$return_data = array();
		$result = array();

		$sql_select = array('t1.id','t1.shop_id','t1.name','t1.short_name','t1.quantity','t1.price','t1.offer_price','t1.item_description','t1.item_picture','t1.is_combo','t2.category_name');
		$this->db->select($sql_select);
		$this->db->from('item t1');
		$this->db->where("t1.short_name", $short_name);
		$this->db->join('category t2', 't1.category_id = t2.id','left');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = (array)$sql_query->row();
			$result['item_data'] = $return_data;

				$sql_select = array('id','variant_group_id','name','price');
				$this->db->select($sql_select);
				$this->db->from('variant_items');
				$this->db->where("item_id", $return_data['id']);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$item_data = $sql_query->result_array();
					$group_array = array_column($item_data, 'variant_group_id');

					$sql_select = array('id','name','selection','availability');
					$this->db->select($sql_select);
					$this->db->from('variant_group');
					$this->db->where_in("id", $group_array);
					$sql_query = $this->db->get();
					if ($sql_query->num_rows() > 0){
						$group_data = $sql_query->result_array();

						foreach ($group_data as $key => $value) {
							$group_data[$key]['items'] = array();

							foreach ($item_data as $key1 => $value1) {
								if($value1['variant_group_id'] == $value['id']){
									$group_data[$key]['items'][] = $item_data[$key1];
								}
							}
						}
						$result['group_data'] = $group_data;
					}
				}

		}

		return $result;
	}

	public function get_item_variants($id = NULL){
		$return_data = array();
		if(isset($id) && $id != '' && !is_null($id)){
			$sql_select = array('id','variant_group_id','name','price');
			$this->db->select($sql_select);
			$this->db->from('variant_items');
			$this->db->where("item_id", $id);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$item_data = $sql_query->result_array();
				$group_array = array_column($item_data, 'variant_group_id');

				$sql_select = array('id','name','selection','availability');
				$this->db->select($sql_select);
				$this->db->from('variant_group');
				$this->db->where_in("id", $group_array);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$group_data = $sql_query->result_array();

					foreach ($group_data as $key => $value) {
						$group_data[$key]['items'] = array();

						foreach ($item_data as $key1 => $value1) {
							if($value1['variant_group_id'] == $value['id']){
								$group_data[$key]['items'][] = $item_data[$key1];
							}
						}
					}
					$return_data = $group_data;
				}
			}
		}
		return $return_data;
	}

	public function get_variants($values = array()){
		$return_data = array();

		$sql_select = array('id','variant_group_id','item_id', 'price');

		$this->db->select($sql_select);
		$this->db->from('variant_items');
		$this->db->where_in("id", $values);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_cuisines(){
		$return_data = array();
		$sql_select = array('id','cuisine_name','cuisine_picture');

		$this->db->select($sql_select);
		$this->db->where('is_active',1);
		$this->db->where('deleted_at', NULL);
		$this->db->order_by('created_at','desc');
		$this->db->from('cuisine');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_category($value=''){
		$return_data = array();
		$sql_select = array('id','category_name');

		$this->db->select($sql_select);
		$this->db->where('status',1);
		$this->db->where('deleted_at', NULL);
		$this->db->order_by('created_at','desc');
		$this->db->from('category');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function subscribe(){
		$return = false;

		$this->db->select('*');
		$this->db->from('subscriber');
		$this->db->where("email", $_POST['email']);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() <= 0){
			$data = array('email' => $_POST['email']);
			if($this->db->insert("subscriber", $data)){

				$this->db->select('emat_email_subject,emat_email_message');
				$this->db->from('email_template');
				$this->db->where('emat_email_type', 6);
				$this->db->where("emat_is_active", 1);
				$sql_query = $this->db->get();
				$return_data = $sql_query->row();

				if (!isset($return_data) && empty($return_data)){
					$this->auth->set_error_message("Email template not found. Error into sending mail.");
					return FALSE;
				}

				$from = "";
				$to = $_POST['email'];
				$subject = $return_data->emat_email_subject;
				$encrypted_email = encrypt($_POST['email']);
				$email_var_data = array();
				$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
				$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
				$mail = sendmail($from, $to, $subject, $message);

				if(!$mail){
					$return = false;
				}else{
					$return = true;
				}
			}
		}else{
			$return = true;
		}
		return $return;
	}

	public function post_restaurant_partner(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$mobile_number = str_replace("+1 ", "",  $this->input->post("mobile_number"));

		$shop_name = preg_replace("/[^a-zA-Z ]/", "", strtolower($this->input->post("shop_name")));
		$name_array =  explode(" ",$shop_name);
		$short_name_array = array();

		foreach($name_array as $key => $value){
		    $value1 = trim($value);
		    if($value1 != ''){
		        $short_name_array[$key] = $value1;
		    }
		}
		$short_name = implode("-",$short_name_array);

		$this->db->select('short_name');
		$this->db->from('shop');
		$this->db->where("short_name LIKE '$short_name%'");
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$exists_data = $sql_query->num_rows();
			$short_name = $short_name."-".$exists_data;
		}


		$user_data = array(
						'shop_name' => ucwords(addslashes($this->input->post("shop_name"))),
						'vender_name' => ucwords(addslashes($this->input->post("vender_name"))),
						'email' => $this->input->post("email"),
						'address' => addslashes($this->input->post("address")),
						'city' => addslashes($this->input->post("city")),
						'state' => addslashes($this->input->post("state")),
						'country' => addslashes($this->input->post("country")),
						'zip_code' => $this->input->post("zipcode"),
						'latitude' => $this->input->post("latitude"),
						'longitude' => $this->input->post("longitude"),
						'contact_no1' => $mobile_number,
						'short_name' => $short_name,
						'message' => addslashes($this->input->post("message"))
					);
		$response = $this->db->insert("shop", $user_data);
		$user_id = $this->db->insert_id();

		$shop_code = str_replace(' ', '', $this->input->post("shop_name"));
		$shop_code = preg_replace('/[^A-Za-z0-9\-]/', '', $shop_code);
		$shop_code = strtoupper(substr($shop_code, 0, 3)).$user_id;

		$user_data = array('shop_code' => $shop_code );
		$this->db->where("id", $user_id);
		$this->db->update("shop", $user_data);

		$this->db->select('emat_email_subject,emat_email_message');
		$this->db->from('email_template');
		$this->db->where('emat_email_type', 1);
		$this->db->where("emat_is_active", 1);
		$sql_query = $this->db->get();
		$return_data = $sql_query->row();


		if (!isset($return_data) && empty($return_data)){
			$this->auth->set_error_message("Email template not found. Please try again later or contact clicklunch team.");
			return FALSE;
		}

		if($response){

			$activation_token = bin2hex(random_bytes(20));
			$email_var_data["activation_link"] = base_url() . 'vender-setpassword/'. $activation_token;

			$from = "";
			$to = $this->input->post("email");
			$subject = $return_data->emat_email_subject;

			$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
			$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
			$mail = sendmail($from, $to, $subject, $message);

			if(!$mail){
				$this->db->where("id", $user_id);
				$this->db->delete("shop");

				$this->auth->set_error_message("Error into sending activation mail. Please try again later");
				return FALSE;
			}else{
				$token_array = array('activation_token' => $activation_token);
				$this->db->where("id", $user_id);
				$this->db->update("shop", $token_array);
			}

		}
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into registation. Please try again");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("You are successfully registered into clicklunch. You have got activation mail on your email address.");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function additional_recommendation_items($cart_data = array()){
		$return_data = array();
		if(isset($cart_data) && is_array($cart_data) && !empty($cart_data)){

			$cart_products = array_unique(array_column($cart_data, 'item_id'));
			$shop_id = array_unique(array_column($cart_data, 'shop_id'));

			$this->db->select('*');
			$this->db->from('item');
			$this->db->where("deleted_at", NULL);
			$this->db->where_not_in("id", $cart_products);
			$this->db->where("is_active", 1);
			$this->db->where("recommended", 1);
			$this->db->where("shop_id",$shop_id[0]);
			$this->db->limit(3);
			$this->db->order_by("id", "desc");
			$this->db->where("quantity !=",0);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$return_data = $sql_query->result_array();
			}
		}
		return $return_data;
	}

	public function fetch_delivery_charge($shop_id = NULL, $address_id = NULL){
		$return_data = NULL;
		if(isset($shop_id) && isset($address_id)){

			$this->db->select('latitude,longitude,minimum_mile,delivery_charges_per_mile,charges_of_minimum_mile');
			$this->db->where("id", $shop_id);
			$this->db->from('shop');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$shop_data = $sql_query->row();
				$shop_latitude = $shop_data->latitude;
				$shop_longitude = $shop_data->longitude;
			}

			$this->db->select('latitude,longitude');
			$this->db->where("id", $address_id);
			$this->db->from('delivery_address');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$address_data = $sql_query->row();
				$address_latitude = $address_data->latitude;
				$address_longitude = $address_data->longitude;
			}

			if($shop_latitude != '' && $shop_longitude != '' && $address_latitude != '' && $address_longitude != ''){

				$google_key = $this->config->item("google_key");
	            $distance_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$shop_latitude.",".$shop_longitude."&destinations=".$address_latitude.",".$address_longitude."&key=".$google_key;        
	            $distance = (array)json_decode(file_get_contents($distance_url));
	            $km = $distance['rows'][0]->elements[0]->distance->value;

	            if($km != '0'){
                    $mile = $km / 1609.34;
                }else{
                    $mile = 0;
                }
	            $mile =  number_format((float)$mile, 2, '.', '');
	            $delivery_avalilable_mile = $this->config->item("delivery_avalilable_mile");

	            if($mile <= $delivery_avalilable_mile){
                    if($mile > $shop_data->minimum_mile){
                        $charges = $mile * $shop_data->delivery_charges_per_mile;
                        $charges = number_format((float)$charges, 2, '.', '');
                    }else{
                        $charges = $shop_data->charges_of_minimum_mile;
                    }
                }else{
                	$charges = FALSE;
                }
                $return_data = $charges;
			}

		}
		return $return_data;
	}

	public function fetch_promocode(){
		$return_data = array();
		$cart = $this->cart->contents();
		if(isset($cart) && is_array($cart) && !empty($cart)){
			$total_amount = 0;
			$products_array = array();
			foreach ($cart as $key => $value) {
				$shop_id = $value['shop_id'];
				$total_amount += $value['subtotal'];
				array_push($products_array, $value['item_id']);
			}

			$today = date('Y-m-d');
			$valid_promocodes = array();

            // Get All customer promocode - GROUP 4
            $this->db->select('*'); 

            $this->db->group_start();
                $this->db->where('shop_id',$shop_id);  
                $this->db->where('group_type',4);  
            $this->db->group_end();

            $this->db->or_group_start();
                $this->db->where('shop_id','');  
                $this->db->where('group_type',4);  
            $this->db->group_end();

            $this->db->group_start();
                $this->db->where('from_date <=', $today);
                $this->db->where('to_date >=', $today);
            $this->db->group_end();

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
            $this->db->group_end();

            $this->db->where('status',1);  
            $this->db->where('deleted_at',NULL);  
            $this->db->from('promocode'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $all_customer_promocode = $sql_query->result_array();
                foreach ($all_customer_promocode as $key => $value) {
                    // if product based promocode added by shop
                    if(($value['shop_id'] != '') && ($value['promo_type'] == 1)){
                        $this->db->select('product_id'); 
                        $this->db->where('promocode_id',$value['id']);  
                        $this->db->where_in('product_id',$products_array);  
                        $this->db->from('promocode_valid_product'); 
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() <= 0){
                            unset($all_customer_promocode[$key]);
                        }
                    }
                }
                foreach ($all_customer_promocode as $key => $value){
                    array_push($valid_promocodes, $all_customer_promocode[$key]);
                }
            }

            // Get promocode ( added by admin for group of shops) GROUP 5
            $this->db->select('t2.*'); 
            $this->db->where('t1.shop_id',$shop_id);  
            $this->db->where('t2.group_type',5);  
            $this->db->from('promocode_shops t1');
            $this->db->join('promocode t2', 't1.promocode_id = t2.id', "right join");

            $this->db->group_start();
                $this->db->where('t2.from_date <=', $today);
                $this->db->where('t2.to_date >=', $today);
            $this->db->group_end();

            $this->db->where('t2.status',1);  
            $this->db->where('t2.shop_id','');  
            $this->db->where('t2.deleted_at',NULL);  

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
            $this->db->group_end();

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $group_of_shops_promocode = $sql_query->result_array();
                foreach ($group_of_shops_promocode as $key => $value){
                    array_push($valid_promocodes, $group_of_shops_promocode[$key]);
                }
            }

            // Get customer total completed order
            $where = array('customer_id' => $_POST['customer_id'], 'order_status' => 5);
            $select = array('id');
            $table = 'orders';
            $customer_total_orders_array = get_data_by_filter($table,$select, $where);
            $customer_total_orders = count($customer_total_orders_array);

            $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $shop_id, 'order_status' => 5);
            $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
            $customer_total_shop_orders = count($customer_total_shop_orders_array);

            $X_ordered_promocode = array();

            // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (Admin - vender)
            $this->db->select('*'); 

            $this->db->group_start();
                $this->db->group_start();
                    $this->db->where('shop_id','');  
                    $this->db->where('min_no_of_orders <=', $customer_total_orders);  
                $this->db->group_end();

                $this->db->or_group_start();
                    $this->db->where('shop_id',$shop_id);  
                    $this->db->where('min_no_of_orders <=', $customer_total_shop_orders);  
                $this->db->group_end();
            $this->db->group_end();

            
            $this->db->where('group_type',6);  

            $this->db->group_start();
                $this->db->where('from_date <=', $today);
                $this->db->where('to_date >=', $today);
            $this->db->group_end();

            
            $this->db->where('status',1);  
            $this->db->where('deleted_at',NULL);  

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
            $this->db->group_end();

            $this->db->from('promocode'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $X_ordered_promocode = $sql_query->result_array();
                foreach ($X_ordered_promocode as $key => $value){
                    array_push($valid_promocodes, $X_ordered_promocode[$key]);
                }
            }

            // If no any ordered from any shop - promocode by admin - GROUP 1
            $new_customer_for_admin_promocode = array();
            if($customer_total_orders == 0){
                $this->db->select('*'); 

                $this->db->where('shop_id','');  
                $this->db->where('group_type',1);  

                $this->db->group_start();
                    $this->db->where('from_date <=', $today);
                    $this->db->where('to_date >=', $today);
                $this->db->group_end();

                $this->db->group_start();
                    $this->db->where('promo_min_order_amount', '');
                    $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
                $this->db->group_end();

                $this->db->where('status',1);  
                $this->db->where('deleted_at',NULL);  
                $this->db->from('promocode'); 
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $new_customer_for_admin_promocode = $sql_query->result_array();
                    foreach ($new_customer_for_admin_promocode as $key => $value){
                        array_push($valid_promocodes, $new_customer_for_admin_promocode[$key]);
                    }
                }

            }else{

                // Get customer total completed order for this shop
                $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $shop_id, 'order_status' => 5);
                $select = array('id');
                $table = 'orders';
                $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
                $customer_total_shop_orders = count($customer_total_shop_orders_array);
                $X_shop_ordered_promocode = array();

                // If no any ordered from this shop - promocode by shop - GROUP 1
                $new_customer_for_shop_promocode = array();
                if($customer_total_shop_orders <= 0){
                    $this->db->select('*'); 
                    $this->db->where('shop_id',$shop_id);  
                    $this->db->where('group_type',1);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  

                    $this->db->group_start();
                        $this->db->where('promo_min_order_amount', '');
                        $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
                    $this->db->group_end();

                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $new_customer_for_shop_promocode = $sql_query->result_array();
                        foreach ($new_customer_for_shop_promocode as $key => $value) {
                            // if product based promocode
                            if($value['promo_type'] == 1){
                                $this->db->select('product_id'); 
                                $this->db->where('promocode_id',$value['id']);  
                                $this->db->where_in('product_id',$products_array);  
                                $this->db->from('promocode_valid_product'); 
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() <= 0){
                                    unset($new_customer_for_shop_promocode[$key]);
                                }
                            }
                        }
                        foreach ($new_customer_for_shop_promocode as $key => $value){
                            array_push($valid_promocodes, $new_customer_for_shop_promocode[$key]);
                        }
                    }
                }

                if($customer_total_shop_orders > 0){

                    // GROUP 7 PROMOCODES ARE PENDING - waiting for order

                    $customer_total_shop_orders_ids = array_column($customer_total_shop_orders_array, 'id');

                    $this->db->select('item_id');  
                    $this->db->where_in('order_id',$customer_total_shop_orders_ids);  
                    $this->db->from('order_items'); 
                    $sql_query = $this->db->get();
                    $customer_total_item_orders_array = $sql_query->result_array();
                    $customer_total_ordered_items = array_column($customer_total_item_orders_array, 'item_id');
                    $customer_total_ordered_items = array_unique($customer_total_ordered_items);

                    // get promocode for this shop - have to orderd these products

                    $this->db->select('id'); 
                    $this->db->where('shop_id',$shop_id);  
                    $this->db->where('group_type',7);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  

                    $this->db->group_start();
                        $this->db->where('promo_min_order_amount', '');
                        $this->db->or_where('promo_min_order_amount <=', floatval($total_amount));
                    $this->db->group_end();

                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){

                        $promocode_shop_group7_array = $sql_query->result_array();
                        $promocode_shop_group7_ids = array_column($promocode_shop_group7_array, 'id');
                        
                        $this->db->select('*'); 
                        $this->db->where('shop_id',$shop_id);  
                        $this->db->where_in('promocode_id',$promocode_shop_group7_ids);  
                        $this->db->from('promocode_products'); 
                        $sql_query = $this->db->get();
                        $promocode_haveto_ordeded_products = $sql_query->result_array();

                        $matched_ordered_products = array();
                        foreach ($promocode_haveto_ordeded_products as $key => $value) {
                            if(in_array($value['product_id'], $customer_total_ordered_items)){
                                $matched_ordered_products[] = $value;
                            }
                        }

                        if(isset($matched_ordered_products) && !empty($matched_ordered_products)){
                            foreach ($matched_ordered_products as $key => $value) {
                                $where = array('id' => $value['promocode_id']);
                                $select = array('*');
                                $table = 'promocode';
                                $promocode_valid_data = get_data_by_filter($table,$select, $where);
                                array_push($valid_promocodes, $promocode_valid_data[0]);
                            }
                        }

                    }

                }
            }

            $return_data = $valid_promocodes;

		}
		return $return_data;
    }

    public function contact_us_post(){

		$this->db->trans_begin();
		$return_value = FALSE;
		$user_data = array(
						'name' => ucwords(addslashes($this->input->post("name"))),
						'email' => $this->input->post("email"),
						'subject' => addslashes($this->input->post("subject")),
						'contact_no' => $this->input->post("contact_no"),
						'message' => addslashes($this->input->post("message"))
					);
		$this->db->insert("contact_us", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into submitting form. Please try again");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Thanks for contacting us. we'll get back to you shortly");
			$return_value = TRUE;
		}

		return $return_value;
    }
}