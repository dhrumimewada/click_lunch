<?php

class Dispatcher_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_total(){
		$return_data = array();

		$this->db->select('COUNT(id)');
		$this->db->from('orders');
		$this->db->where("deleted_at", NULL);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$total_order = $this->db->get()->result_array();
		$return_data['total_order'] = $total_order[0]['COUNT(id)'];

		$this->db->select('COUNT(id)');
		$this->db->from('item');
		$this->db->where("deleted_at", NULL);
		$this->db->where("is_active", 1);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$total_item = $this->db->get()->result_array();
		$return_data['total_product'] = $total_item[0]['COUNT(id)'];

		$return_data['total_earning'] = 0;

		$this->db->select('COUNT(id)');
		$this->db->from('promocode');
		$this->db->where("deleted_at", NULL);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$this->db->where("status", 1);
		$total_promocode = $this->db->get()->result_array();
		$return_data['total_promocode'] = $total_promocode[0]['COUNT(id)'];

		return $return_data;

	}

	public function get_dispatcher($id = NULL){
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

	public function update_profile($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data['full_name'] = ucwords(addslashes($this->input->post("full_name")));
		$user_data['contact_no'] = $this->input->post("contact_no");
		$user_data['address'] = $this->input->post("address");
		$user_data['city'] = addslashes($this->input->post("city"));
		$user_data['state'] = addslashes($this->input->post("state"));
		$user_data['country'] = addslashes($this->input->post("country"));
		$user_data['zip_code'] = $this->input->post("zipcode");
		$user_data['updated_at'] = date('Y-m-d H:i:s');

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $this->auth->get_user_id());
			$this->db->from('delivery_dispatcher');
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
		$this->db->update("delivery_dispatcher", $user_data);

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
		$this->db->from('delivery_dispatcher');
		$this->db->where('activation_token', $this->input->post("token"));
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 0);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$shop = $sql_query->row();

			$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'activation_token' => '',
						'status' => '1',
						'updated_at' => date('Y-m-d H:i:s')
					);
			$this->db->where("activation_token",$this->input->post("token"));
			$this->db->update("delivery_dispatcher", $user_data);

		}else{
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}
	
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Password set successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function reset_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('delivery_dispatcher');
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
			$this->db->update("delivery_dispatcher", $user_data);
				
		}else{
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}
	
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Password reset successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function deliveryboy_set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('delivery_boy');
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
			$this->db->update("delivery_boy", $user_data);
				
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