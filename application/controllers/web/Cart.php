<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
	}

	public function cart_add(){

		$group_data = array();

		$this->db->select('id,shop_id,name,item_picture,is_combo,offer_price,price');
		//$this->db->select('*');
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
							'price' => $price,
							'qty' => $_POST['quantity'],
							'shop_id' => $_POST['shop_id'],
							'picture' => $item_data['item_picture'],
							'is_combo' => $item_data['is_combo'],
							'group_data' => $_POST['group']
						);

		// This function add items into cart.
		$this->cart->insert($insert_data);

		//print_r($this->cart->destroy());
		$output_data['cart_contents'] = $this->cart->contents();
		$output_data['cart_total'] = $this->cart->total();
		$output_data['main_content'] = 'cart';
		$this->load->view('web/template',$output_data);
	}
}