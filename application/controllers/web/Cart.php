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
		echo "after destroy";
		$this->cart->destroy();
		echo "<pre>";
		print_r($this->cart->contents());

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