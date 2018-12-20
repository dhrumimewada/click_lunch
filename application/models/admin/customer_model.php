<?php

class Customer_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
	}

	public function get_customer($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('customer');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where("deleted_at", NULL);
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

	public function post($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])) {
			$profile_picture = $modal_data['profile_picture']['file_name'];
		}

		$user_data = array(
						'full_name' => ucwords(addslashes($this->input->post("full_name"))),
						'email' => $this->input->post("email"),
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'contact_no' => $this->input->post("contact_no"),
						'address' => addslashes($this->input->post("address")),
						//'city' => $this->input->post("city"),
						//'state' => $this->input->post("state"),
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$response = $this->db->insert("customer", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Customer added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;
		// echo '<pre>';
		// print_r($modal_data);exit;

		$user_data['full_name'] = ucwords(addslashes($this->input->post("full_name")));
		$user_data['address'] = addslashes($this->input->post("address"));

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $this->input->post("customer_id"));
			$this->db->from('customer');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$profile_picture_old = $return_data->profile_picture;

				if (isset($profile_picture_old) && !empty($profile_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("customer_profile_path") . "/" . $profile_picture_old)) {
						unlink(FCPATH . $this->config->item("customer_profile_path") . "/" . $profile_picture_old);
					}
				}
			}
		}

		$user_data['contact_no'] = $this->input->post("contact_no");
		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("customer_id"));
		$this->db->update("customer", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Customer updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('deleted_at');
		$this->db->from('shop');
		$this->db->where('id', decrypt($this->input->post("customer_id")));
		$this->db->where('deleted_at !=', NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}


		$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'status' => 1,
						'updated_at' => date('Y-m-d H:i:s')
					);
		$this->db->where("id", decrypt($this->input->post("customer_id")));
		$this->db->update("shop", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("password updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}