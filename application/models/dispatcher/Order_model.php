<?php

class Order_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_order($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('orders');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where('order_status', 0);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			if (isset($id) && !is_null($id)) {
				$return_data = $sql_query->row();
			}else{
				$return_data = $sql_query->result_array();
			}
			
		}
		return $return_data;
	}
}
?>