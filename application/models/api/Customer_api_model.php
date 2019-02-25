<?php

class Customer_api_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_products_price($product_array = array()){
		$data = array();
		$this->db->select('IF(offer_price = "", price, offer_price) as price,id');
		$this->db->from('item');
		if (isset($product_array) && !empty($product_array)) {
			$this->db->where_in('id', $product_array);
		}
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
			$data = array();
			foreach ($return_data as $key => $value) {
				$data[$value['id']] = $value['price'];
			}
		}
		return $data;
	}

	public function get_promocode_valid_products($id = NULL){
		$return_data = array();

		if(isset($id) && !is_null($id)){
			$this->db->select('product_id');
			$this->db->from('promocode_valid_product');
			$this->db->where('promocode_id', $id);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->result_array();
			}
		}
		return $return_data;
	}
}