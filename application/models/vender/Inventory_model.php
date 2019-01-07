<?php

class Inventory_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_inventory($id = NULL) {
		$return_data = array();
		$this->db->select('*');
		$this->db->from('item');
		$this->db->where("deleted_at", NULL);
		$this->db->where("is_active", 1);
		$this->db->where("inventory_status", 1);
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
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