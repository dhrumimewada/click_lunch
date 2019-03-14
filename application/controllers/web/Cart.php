<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("website/welcome_model");
		$this->load->model("website/profile_model");
	}

	public function cart_destroy(){
		echo "<pre>";
		echo "Before destroy";
		print_r($this->cart->contents());
		echo "after destroy";
		print_r($_SESSION);
		// $this->cart->destroy();
		// echo "<pre>";
		// print_r($this->cart->contents());

		// $insert_data = array(
  //   				'id' => "8d39e3679e0898c5292a7e59105bda96",
  //   				'item_id' => "30",
  //   				'name' => "Veg Meal + Coco Drinks",
  //   				'price' => "15.00",
  //   				'item_price' => "15.00",
  //   				'varient_price' => "0.00",
  //   				'qty' => "1",
  //   				'shop_id' => "58",
  //   				'picture' => "item_1547462856.jpg",
  //   				'is_combo' => "1"
  //   			);

		// 		// This function add items into cart.
		// 		if($this->cart->insert($insert_data)){
		// 			echo 'inserted';
		// 		}else{
		// 			echo 'fail';
		// 		}

		// 		echo "<pre>";
		//         // print_r($item_data);
		//          print_r($insert_data);
		//         print_r($this->cart->contents());
		        exit;
	}

	public function my_cart(){

		$is_customer = $this->auth->is_customer();
		$is_logged_in = $this->auth->is_logged_in();
		if(is_logged_in && $is_customer){

			if(isset($_SESSION['delivery_address_id']) && $_SESSION['delivery_address_id'] != ''){
				$where = array('id' => decrypt($this->session->userdata('delivery_address_id')));
		        $select = array('id','house_no','street','city','zipcode','latitude','longitude');
		        $table = 'delivery_address';
		        $default_address = get_data_by_filter($table,$select, $where);
		        if(count($default_address[0]) > 0){
		        	$output_data['default_address'] = $default_address[0];
		        }

			}else{
				$where = array('customer_id' => $this->auth->get_user_id(), 'default_address' => 1);
		        $select = array('id','house_no','street','city','zipcode','latitude','longitude');
		        $table = 'delivery_address';
		        $default_address = get_data_by_filter($table,$select, $where);
		        if(count($default_address[0]) > 0){
		        	$output_data['default_address'] = $default_address[0];
		        }
			}
		}

		$additional_recommendation = $this->welcome_model->additional_recommendation_items($this->cart->contents());
		$output_data['additional_recommendation'] = $additional_recommendation;

		$address_type = $this->config->item("address_type");
		$output_data['address_type'] = $address_type;
		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['main_content'] = 'cart';
		$this->load->view('web/template',$output_data);
	}

	public function cart_add(){

		if(isset($_POST['item_id']) && !empty($_POST["item_id"])){
			$this->db->select('id,shop_id,name,item_picture,is_combo,offer_price,price');
	        $this->db->where("id",$_POST['item_id']);
	        $this->db->where("deleted_at",NULL);
	        $this->db->where("is_active",1);
	        $this->db->from("item");
	        $sql_query = $this->db->get();
	        if ($sql_query->num_rows() > 0){
	        	$item_data = (array)$sql_query->row();

	        	// get all varients array
	        	$all_varients = array();
	        	$total_variants_price = 0;
	        	if(isset($_POST['group']) && is_array($_POST['group']) && !empty($_POST['group'])){

	        		foreach ($_POST['group'] as $key => $value) {
						foreach ($value as $key1 => $value1) {
							array_push($all_varients, $value1);
						}
					}

					// get varients data from DB
					$all_variants_data = $this->welcome_model->get_variants($all_varients);

					// Sum of varients prices
					foreach ($all_variants_data as $key => $value) {
						$total_variants_price += number_format((float)$value['price'], 2, '.', '');
					}

					$item_data['group_data'] = $_POST['group'];

	        	}else{
	        		$item_data['group_data'] = '';
	        	}

	        	if($item_data['offer_price'] == ''){
		        	$price = $item_data['price'];
		        }else{
		        	$price = $item_data['offer_price'];
		        }
				
				$total_price = floatval($price) + floatval($total_variants_price);

				if(isset($_POST['group']) && is_array($_POST['group']) && !empty($_POST['group'])){
					$unique_id = md5($item_data['id'].serialize($_POST['group']));
				}else{
					$unique_id = md5($item_data['id']);
				}

				$insert_data = array(
									'id' => $unique_id,
									'item_id' => $item_data['id'],
									'name' => $item_data['name'],
									'price' => number_format((float)$total_price, 2, '.', ''),
									'item_price' => number_format((float)$price, 2, '.', ''),
									'varient_price' => number_format((float)$total_variants_price, 2, '.', ''),
									'qty' => $_POST['quantity'],
									'shop_id' => $_POST['shop_id'],
									'picture' => $item_data['item_picture'],
									'is_combo' => $item_data['is_combo'],
									'group_data' => $item_data['group_data']
								);

				// This function add items into cart.
				if($this->cart->insert($insert_data)){
					//echo 'inserted';
					$where = array('id' => $_POST['shop_id'], 'deleted_at' => NULL);
			        $select = array('short_name');
			        $table = 'shop';
			        $short_name_data = get_data_by_filter($table,$select, $where);
			        if(count($short_name_data[0]) > 0){
			        	$shop_short_name = $short_name_data[0]['short_name'];
			        	$this->session->set_userdata('shop_short_name',$shop_short_name);
			        }

					$this->session->set_userdata('cart_shop', $_POST['shop_id']);
				}else{
					//echo 'fail';
				}
	        }
		}

		// echo "<pre>";
	 //        print_r($item_data);
	 //        print_r($insert_data);
	 //        print_r($this->cart->contents());
	 //        exit;
		redirect('cart');
	}

	public function get_recommendation_item_data(){
		$data['item_variants'] = $this->welcome_model->get_item_variants($_POST['id']);

		$select = array('id','name','IF(offer_price = "", price, offer_price) as price');
		$where = array('id' => $_POST['id']);
		$cart_contents = get_data_by_filter('item',$select,$where);
		$data['cart_contents'] = $cart_contents[0];
		echo json_encode($data);
		exit;
	}

	public function get_cart_item_data(){
		//$row_id = $_POST['id'];
		//$_POST['id'] = "b1b16582a987b8369a7004a54ec11da8";
		$cart_contents = $this->cart->contents();
		$data = array();
		$cart_content_item = $cart_contents[$_POST['id']];
		$data['cart_contents'] = $cart_contents[$_POST['id']];
		$data['item_variants'] = $this->welcome_model->get_item_variants($cart_content_item['item_id']);

		$variants = array();

		if(isset($data['cart_contents']['group_data']) && is_array($data['cart_contents']['group_data']) && !empty($data['cart_contents']['group_data'])){
			foreach ($data['cart_contents']['group_data'] as $key => $value) {
				foreach ($value as $key1 => $value1) {
					array_push($variants, $value1);
				}
			}
		}
		

		$data['variants'] = $variants;
		
		echo json_encode($data);
		exit;
		
	}

	public function add_recommendation_item_cart(){

		$group = array();
		foreach ($_POST['form_data'] as $key => $value) {
			preg_match_all('!\d+!', $value['name'], $matches);
			$group[$matches[0][0]][] = $value['value'];
			//print_r($matches[0][0]);
		}

		$all_varients = array();
		foreach ($group as $key => $value) {
			foreach ($value as $key1 => $value1) {
				array_push($all_varients, $value1);
			}
			
		}

		$all_varients_data = $this->welcome_model->get_variants($all_varients);
		//print_r($all_varients_data);
		$total_variants_price = 0.00;
		// Sum of varients prices
		foreach ($all_varients_data as $key => $value) {
			$total_variants_price += number_format((float)$value['price'], 2, '.', '');
		}

		$select = array('*');
		$where = array('id' => $_POST['id']);
		$item_data = get_data_by_filter('item',$select,$where);
		$item_data = $item_data[0];

		if($item_data['offer_price'] == ''){
        	$price = $item_data['price'];
        }else{
        	$price = $item_data['offer_price'];
        }
		
		$total_price = floatval($price) + floatval($total_variants_price);

		$group_data = array();
		foreach ($group as $key => $value) {
			$group_data[$key] = array();
			foreach ($value as $key1 => $value1) {
				$group_data[$key][] = $value1;
			}
		}

		if(isset($group) && is_array($group) && !empty($group)){
			$unique_id = md5($item_data['id'].serialize($group));
		}else{
			$unique_id = md5($item_data['id']);
		}

		$insert_data = array(
							'id' => $unique_id,
							'item_id' => $_POST['id'],
							'name' => $item_data['name'],
							'price' => number_format((float)$total_price, 2, '.', ''),
							'item_price' => number_format((float)$price, 2, '.', ''),
							'varient_price' => number_format((float)$total_variants_price, 2, '.', ''),
							'qty' => 1,
							'shop_id' => $item_data['shop_id'],
							'picture' => $item_data['item_picture'],
							'is_combo' => $item_data['is_combo'],
							'group_data' => $group
						);

		if($this->cart->insert($insert_data)){
			echo '1';
			return true;
		}else{
			echo '0';
			return false;
		}

		// echo json_encode($group);
		// exit;
	}

	public function add_direct_recommendation_item_cart($item_id = NULL){
		if(isset($item_id) && $item_id != '' && !is_null($item_id)){

			$select = array('*');
			$where = array('id' => $item_id);
			$item_data = get_data_by_filter('item',$select,$where);
			$item_data = $item_data[0];

			if($item_data['offer_price'] == ''){
	        	$price = $item_data['price'];
	        }else{
	        	$price = $item_data['offer_price'];
	        }
	        $total_variants_price = 0.00;


			$unique_id = md5($item_id);
			$insert_data = array(
								'id' => $unique_id,
								'item_id' => $item_id,
								'name' => $item_data['name'],
								'price' => number_format((float)$price, 2, '.', ''),
								'item_price' => number_format((float)$price, 2, '.', ''),
								'varient_price' => number_format((float)$total_variants_price, 2, '.', ''),
								'qty' => 1,
								'shop_id' => $item_data['shop_id'],
								'picture' => $item_data['item_picture'],
								'is_combo' => $item_data['is_combo'],
								'group_data' => array()
							);

			$this->cart->insert($insert_data);
			redirect(base_url() . "cart");
		}
	}

	public function update_cart_item_data(){
		//echo "<pre>";
		$group = array();
		foreach ($_POST['form_data'] as $key => $value) {
			preg_match_all('!\d+!', $value['name'], $matches);
			$group[$matches[0][0]][] = $value['value'];
			//print_r($matches[0][0]);
		}
		
		$all_varients = array();
		foreach ($group as $key => $value) {
			foreach ($value as $key1 => $value1) {
				array_push($all_varients, $value1);
			}
			
		}
		$all_varients_data = $this->welcome_model->get_variants($all_varients);
		//print_r($all_varients_data);
		$total_variants_price = 0.00;
		// Sum of varients prices
		foreach ($all_varients_data as $key => $value) {
			$total_variants_price += number_format((float)$value['price'], 2, '.', '');
		}

		$cart_contents = $this->cart->contents();
		$cart_content_data = $cart_contents[$_POST['row_id']];

		$item_price = $cart_content_data['item_price'];
		$price = $cart_content_data['item_price'] + $total_variants_price;

		$data = array(
		        'rowid' => $_POST['row_id'],
		        'price' => $price,
		        'varient_price' => number_format((float)$total_variants_price, 2, '.', ''),
		        'group_data' => $group
		);
		
		if($this->cart->update($data)){
			echo 'true';
			return true;
		}else{
			echo 'false';
			return false;
		}

		//exit;
	}

	public function update_quantity(){

		$cart_contents = $this->cart->contents();
		$cart_content_data = $cart_contents[$_POST['cart_id']];
		$old_qty = $cart_content_data['qty'];
		$qty = 0;
		if($_POST['minus_plus'] == 1){
			$qty = $old_qty + 1;
		}else{
			$qty = $old_qty - 1;
		}
		$data = array(
		        'rowid' => $_POST['cart_id'],
		        'qty' => $qty
		);
		
		if($this->cart->update($data)){
			echo 'true';
			return true;
		}else{
			echo 'false';
			return false;
		}
	}

	public function cart_item_delete(){
		if($this->cart->remove($_POST['id'])){
			echo TRUE;
			return true;
		}else{
			echo FALSE;
			return false;
		}	
	}

	public function checkout(){
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
		$this->db->select('service_charge');
        $this->db->where("id", $shop_id);
        $this->db->from('shop');
        $sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
            $shop_data = $sql_query->row();
            $service_charge = $shop_data->service_charge;
        }
        $output_data['service_charge'] = $service_charge;
        $address_id = decrypt($_SESSION['delivery_address_id']);

        if(isset($_SESSION['delivery_fee'])){
			$delivery_fee = $_SESSION['delivery_fee'];
        }else{
        	$delivery_fee = $this->welcome_model->fetch_delivery_charge($shop_id, $address_id);
        	$this->session->set_userdata('delivery_fee', $delivery_fee);
        }
        
        if($delivery_fee == FALSE){
        	$this->auth->set_error_message("Delivery is not available on this location");
        	$this->session->set_flashdata($this->auth->get_messages_array());
        	redirect(base_url() . "cart");
        }
        $output_data['delivery_fee'] = $delivery_fee;

        $valid_promocodes = $this->welcome_model->fetch_promocode();
        $output_data['promocodes'] = $valid_promocodes;

        $customer_cards = $this->profile_model->get_cards();
        $output_data['cards'] = $customer_cards;

        // echo "<pre>";
        // print_r($valid_promocodes);
        // exit;

		$output_data['main_content'] = "checkout";
		$this->load->view('web/template',$output_data);
	}

	public function set_promocode($promocode = NULL){
		$this->session->set_userdata('promocode', $promocode);
		redirect(base_url() . "checkout");
	}

	public function promocode_remove(){
		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['remove'])){
				$this->session->unset_userdata('promocode');
			}else{

			}
			redirect(base_url() . "checkout");
		}
	}
}