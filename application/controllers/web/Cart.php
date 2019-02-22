<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("website/welcome_model");
	}

	public function cart_destroy(){
		echo "<pre>";
		echo "Before destroy";
		print_r($this->cart->contents());
		// echo "after destroy";
		// $this->cart->destroy();
		// echo "<pre>";
		// print_r($this->cart->contents());
		exit;
	}

	public function my_cart(){
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
				foreach ($_POST['group'] as $key => $value) {
					foreach ($value as $key1 => $value1) {
						array_push($all_varients, $value1);
					}
				}
				// get varients data from DB
				$all_variants_data = $this->welcome_model->get_variants($all_varients);
				$total_variants_price = 0.00;
				// Sum of varients prices
				foreach ($all_variants_data as $key => $value) {
					$total_variants_price += number_format((float)$value['price'], 2, '.', '');
				}


	        	if(is_array($_POST['group']) && !empty($_POST['group'])){
	        		$item_data['group_data'] = $_POST['group'];
	        	}
	        }

	        if($item_data['offer_price'] == ''){
	        	$price = $item_data['price'];
	        }else{
	        	$price = $item_data['offer_price'];
	        }
			
			$total_price = $price + $total_variants_price;
			$insert_data = array(
								'id' => md5($item_data['id'].serialize($_POST['group'])),
								'item_id' => $item_data['id'],
								'name' => $item_data['name'],
								'price' => number_format((float)$total_price, 2, '.', ''),
								'item_price' => number_format((float)$price, 2, '.', ''),
								'varient_price' => number_format((float)$total_variants_price, 2, '.', ''),
								'qty' => $_POST['quantity'],
								'shop_id' => $_POST['shop_id'],
								'picture' => $item_data['item_picture'],
								'is_combo' => $item_data['is_combo'],
								'group_data' => $_POST['group']
							);

			// This function add items into cart.
			$this->cart->insert($insert_data);
		}

		// echo "<pre>";
		// print_r($this->cart->contents());
		// exit;
		redirect('cart');
		
		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['main_content'] = 'cart';
		$this->load->view('web/template',$output_data);
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
		foreach ($data['cart_contents']['group_data'] as $key => $value) {
			foreach ($value as $key1 => $value1) {
				array_push($variants, $value1);
			}
		}

		$data['variants'] = $variants;
		
		echo json_encode($data);
		exit;
		
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
}