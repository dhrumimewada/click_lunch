<?php

class Customer_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('customer');
		$this->db->where('remember_token', $this->input->post("token"));
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 1);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {

			$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'remember_token' => '',
						'updated_at' => date('Y-m-d H:i:s')
					);
			$this->db->where("remember_token",$this->input->post("token"));
			$this->db->update("customer", $user_data);
				
		}else{
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}
	
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Password changed successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}