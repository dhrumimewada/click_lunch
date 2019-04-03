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
						'contact_no' => $this->input->post("contact_no"),
						'address' => addslashes($this->input->post("address")),
						'city' => addslashes($this->input->post("city")),
						'state' => addslashes($this->input->post("state")),
						'country' => addslashes($this->input->post("country")),
						'zip_code' => $this->input->post("zipcode"),
						'latitude' => $this->input->post("latitude"),
						'longitude' => $this->input->post("longitude"),
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'status' => 0,
						'created_at' => date('Y-m-d H:i:s')
					);
		if($this->db->insert("delivery_dispatcher", $user_data)){
			$user_id = $this->db->insert_id();

			$this->db->select('emat_email_subject,emat_email_message');
			$this->db->from('email_template');
			$this->db->where('emat_email_type', 1);
			$this->db->where("emat_is_active", 1);
			$sql_query = $this->db->get();
			$return_data = $sql_query->row();

			if (!isset($return_data) && empty($return_data)){
				$this->auth->set_error_message("Email template not found. Error into sending mail.");
				return FALSE;
			}

			$activation_token = bin2hex(random_bytes(20));
			$email_var_data["activation_link"] = base_url() . 'dispatcher-setpassword/'. $activation_token;

			$from = "";
			$to = $this->input->post("email");
			$subject = $return_data->emat_email_subject;

			$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
			$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
			$mail = sendmail($from, $to, $subject, $message);

			if(!$mail){

				if(isset($profile_picture) && !empty($profile_picture)){
					unlink(FCPATH . $this->config->item("delivery_dispatcher_photo_path") . "/" . $profile_picture);
				}

				$this->db->where("id", $user_id);
				$this->db->delete("delivery_dispatcher");
				$this->auth->set_error_message("Error into sending mail");
				return FALSE;
			}else{
				$token_array = array('activation_token' => $activation_token);
				$this->db->where("id", $user_id);
				$this->db->update("delivery_dispatcher", $token_array);
			}

		}

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
		$user_data['city'] = addslashes($this->input->post("city"));
		$user_data['state'] = addslashes($this->input->post("state"));
		$user_data['country'] = addslashes($this->input->post("country"));
		$user_data['zip_code'] = $this->input->post("zipcode");

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