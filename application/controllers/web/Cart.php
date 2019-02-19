<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("website/welcome_model");
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

	        	if(is_array($_POST['group']) && !empty($_POST['group'])){
	        		$item_data['group_data'] = $_POST['group'];
	        	}
	        }

	        if($item_data['offer_price'] == ''){
	        	$price = $item_data['price'];
	        }else{
	        	$price = $item_data['offer_price'];
	        }
			
			$insert_data = array('id' => $item_data['id'],
								'name' => $item_data['name'],
								'price' => number_format((float)$price, 2, '.', ''),
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
		
		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['main_content'] = 'cart';
		$this->load->view('web/template',$output_data);
	}

	public function get_cart_item_data(){
		$row_id = $_POST['id'];
		$cart_contents = $this->cart->contents();
		$data = array();
		$cart_content_item = $cart_contents[$_POST['id']];
		$data['cart_contents'] = $cart_contents[$_POST['id']];
		$data['item_variants'] = $this->welcome_model->get_item_variants($cart_content_item['id']);
	
		echo json_encode($data);
		exit;
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