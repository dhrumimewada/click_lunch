<?php

class Inventory_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_inventory($id = NULL) {
		$return_data = array();
		$sql_select = array("t1.*", "t2.cuisine_name");
		$this->db->select($sql_select);
		$this->db->from('item t1');
		$this->db->join('cuisine t2', 't1.cuisine_id = t2.id');
		$this->db->where("t1.deleted_at", NULL);
		$this->db->where("t1.is_active", 1);

		if($this->auth->is_vender()){
			$this->db->where("t1.shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
		}else{
		}

		$this->db->where("t1.inventory_status", 1);
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