<?php

class Employee_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
	}

	public function get_employee_profile(){
		$return_data = array();
		$sql_select = array("t1.*", "t2.shop_name","t3.role_name");
		$this->db->select($sql_select);
		$this->db->where("t1.deleted_at", NULL);
		$this->db->where("t1.status !=", 0);
		$this->db->where("t1.id", $this->auth->get_user_id());
		$this->db->from('employee t1');
		$this->db->join('shop t2', 't1.shop_id = t2.id', "left join");
		$this->db->join('role t3', 't1.role = t3.id', "left join");
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->row();
		}
		return $return_data;
	}

	public function update_profile($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data['first_name'] = ucwords(addslashes($this->input->post("first_name")));
		$user_data['last_name'] = ucwords(addslashes($this->input->post("last_name")));
		$user_data['contact_no'] = $this->input->post("contact_no");
		$user_data['updated_at'] = date('Y-m-d H:i:s');

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $this->auth->get_user_id());
			$this->db->from('employee');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$profile_picture_old = $return_data->profile_picture;

				if (isset($profile_picture_old) && !empty($profile_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old)) {
						unlink(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old);
					}
				}
			}
		}
	
		$this->db->where('id', $this->auth->get_user_id());
		$this->db->update("employee", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating profile");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Profile updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('employee');
		$this->db->where('activation_token', $this->input->post("token"));
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 0);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {

			$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'activation_token' => '',
						'status' => '1',
						'updated_at' => date('Y-m-d H:i:s')
					);
			$this->db->where("activation_token",$this->input->post("token"));
			$this->db->update("employee", $user_data);
				
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