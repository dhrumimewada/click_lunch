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
		// echo "Before destroy";
		 print_r($this->cart->contents());
		// exit;
		// echo "after destroy";
		//print_r($this->cart->destroy());
		 
		// echo "<pre>";
		// print_r($shops);

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

	public function check_exists_cart(){
		if(isset($_POST['order_type']) && $_POST['order_type'] != ''){

			if(!empty($this->cart->contents())){

				$cart_order_type= array_column($this->cart->contents(), 'order_type');
				$shop_id= array_column($this->cart->contents(), 'shop_id');
				if(($cart_order_type[0] == $_POST['order_type']) && ($shop_id[0] == $_POST['shop_id'])){
					echo json_encode(array("is_success" => true, 'diff_order_type' => 0, 'cart_order_type' => $cart_order_type));
					return true;
				}else{
					echo json_encode(array("is_success" => true, 'diff_order_type' => 1, 'cart_order_type' => $cart_order_type));
					return true;
				}

			}else{
				echo json_encode(array("is_success" => true, 'diff_order_type' => 0));
				return true;
			}
		}else{
			echo json_encode(array("is_success" => false));
			return false;
		}	
	}

	public function my_cart(){

		$is_customer = $this->auth->is_customer();
		$is_logged_in = $this->auth->is_logged_in();
		if($is_logged_in && $is_customer){

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

		$continue_shopping_url = '';
		if($this->cart->contents() !== NULL && !empty($this->cart->contents())){
			foreach ($this->cart->contents() as $key => $value) {
				$shop_id = $value['shop_id'];
				$order_type = $value['order_type'];
				break;
			}
			$this->db->select('short_name');
            $this->db->where("id",$shop_id);
            $this->db->from("shop");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
            	$shop_data = $sql_query->row();
            	$shop_short_name = $shop_data->short_name;
            	$continue_shopping_url = base_url().'restaurant/'.$order_type.'/naerby/'.$shop_short_name;
            }
		}
		$output_data['continue_shopping_url'] = $continue_shopping_url;

		$additional_recommendation = $this->welcome_model->additional_recommendation_items($this->cart->contents());
		$output_data['additional_recommendation'] = $additional_recommendation;
		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['main_content'] = 'cart';
		$this->load->view('web/template',$output_data);
	}

	public function cart_add($order_type = NULL){

		// echo "<pre>";
		// print_r($order_type);
		// exit;

		if(!empty($this->cart->contents())){
			$cart_order_type= array_column($this->cart->contents(), 'order_type');
			$cart_shop_id= array_column($this->cart->contents(), 'shop_id');
			if($cart_order_type[0] != $order_type || $_POST['shop_id'] != $cart_shop_id[0]){
				$this->cart->destroy();
			}
		}

		if(isset($_POST['item_id']) && !empty($_POST["item_id"])){
			$this->db->select('id,shop_id,name,item_picture,is_combo,offer_price,price');
	        $this->db->where("id",$_POST['item_id']);
	        $this->db->where("deleted_at",NULL);
	        $this->db->where("is_active",1);
	        $this->db->from("item");
	        $sql_query = $this->db->get();
	        if ($sql_query->num_rows() > 0){
	        	$item_data = (array)$sql_query->row();

	        	// if (isset($_SESSION['cart_shop']) && $_SESSION['cart_shop'] != ''){
	        	// 	if($item_data['shop_id'] != $_SESSION['cart_shop']){
	        	// 		$this->cart->destroy();
	        	// 	}
	        	// }else{
	        	// 	$this->session->set_userdata('cart_shop', $_POST['shop_id']);
	        	// }

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
	        		$item_data['group_data'] = array();
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
									'order_type' => $order_type,
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

				// echo "<pre>";
				// print_r('Current cart:');
				// print_r($this->cart->contents());
				// print_r('Insering data:');
				// print_r($insert_data);
				
				$this->cart->product_name_rules  = '^.';

				// This function add items into cart.
				if($this->cart->insert($insert_data)){

					// print_r('After Insering data cart:');
					// print_r($this->cart->contents());
					// exit;
					//echo 'inserted';
					$where = array('id' => $_POST['shop_id'], 'deleted_at' => NULL);
			        $select = array('short_name');
			        $table = 'shop';
			        $short_name_data = get_data_by_filter($table,$select, $where);
			        if(count($short_name_data[0]) > 0){
			        	$shop_short_name = $short_name_data[0]['short_name'];
			        	$this->session->set_userdata('shop_short_name',$shop_short_name);
			        }
				}else{

					// print_r('Not inserted');
					// print_r($this->cart->contents());
					// exit;
					//echo 'fail';
				}
	        }
		}

		//echo "<pre>";
	        //print_r($item_data);
	        //print_r($insert_data);
	        //print_r($this->cart->contents());
	       // exit;
		redirect(base_url() . "cart");
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
			$total_cart_items = count($this->cart->contents());
			echo json_encode(array("is_success" => true, "total_cart_items" => $total_cart_items));
			return TRUE;
		}else{
			$total_cart_items = count($this->cart->contents());
			echo json_encode(array("is_success" => false, "total_cart_items" => $total_cart_items));
			return false;
		}	
	}

	
}