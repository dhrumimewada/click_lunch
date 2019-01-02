<?php

class Delivery_dispatcher_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_delivery_dispatcher($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('delivery_dispatcher');
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
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$response = $this->db->insert("delivery_dispatcher", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Delivery dispatcher added successfully");
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
			$this->db->where('id', $this->input->post("dispatcher_id"));
			$this->db->from('delivery_dispatcher');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$profile_picture_old = $return_data->profile_picture;

				if (isset($profile_picture_old) && !empty($profile_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("delivery_dispatcher_photo_path") . "/" . $profile_picture_old)) {
						unlink(FCPATH . $this->config->item("delivery_dispatcher_photo_path") . "/" . $profile_picture_old);
					}
				}
			}
		}

		$user_data['contact_no'] = $this->input->post("contact_no");
		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("delivery_dispatcher_id"));
		$this->db->update("delivery_dispatcher", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Delivery dispatcher updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}