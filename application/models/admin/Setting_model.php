<?php

class Setting_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_settings(){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('setting');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();	
		}
		return $return_data;
	}

	public function put() {

		$this->db->trans_begin();
		$return_value = FALSE;

		$tax = number_format((float)$this->input->post("tax"), 2, '.', '');
		$user_data = array('data' => $tax);

		$this->db->where('name', 'tax');
		$this->db->update("setting", $user_data);

		$delivery_available_mile = number_format((float)$this->input->post("delivery_available_mile"), 2, '.', '');
		$user_data = array('data' => $delivery_available_mile);

		$this->db->where('name', 'delivery_available_mile');
		$this->db->update("setting", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating setting");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Setting updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}