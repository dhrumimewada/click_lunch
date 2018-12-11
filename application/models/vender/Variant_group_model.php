<?php

class variant_group_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_variant_group(){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('variant_group');
		if($this->auth->is_vender()){
			$this->db->where("shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("shop_id",$this->auth->get_emp_shop_id());
		}else{
		}
		$this->db->where("deleted_at", NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function post() {
		$this->db->trans_begin();
		$return_value = FALSE;

		$selection = '0';
		if ($this->input->post("selection")){
			$selection = $this->input->post("selection");
		}

		$availability = '0';
		if ($this->input->post("availability")) {
			$availability = $this->input->post("availability");
		}

		if($this->auth->is_vender()){
			$shop_id = $this->auth->get_user_id();
		}elseif ($this->auth->is_employee()) {
			$shop_id = $this->auth->get_emp_shop_id();
		}else{
			$shop_id = NULL;
		}

		$user_data = array(
						'shop_id' => intval($shop_id),
						'name' => ucwords(addslashes($this->input->post("name"))),
						'selection' => $selection,
						'availability' => $availability,
						'created_at' => date('Y-m-d H:i:s')
					);

		$this->db->insert("variant_group", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Variant group added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}


}
?>