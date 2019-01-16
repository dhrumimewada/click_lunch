<?php

class Customer_model extends CI_Model {

	public function __construct() {
		parent::__construct();
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
						'username' => ucwords(addslashes($this->input->post("username"))),
						'email' => $this->input->post("email"),
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'mobile_number' => $this->input->post("mobile_number"),
						'address' => addslashes($this->input->post("address")),
						//'city' => $this->input->post("city"),
						//'state' => $this->input->post("state"),
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$response = $this->db->insert("customer", $user_data);
		$user_id = $this->db->insert_id();

		if($response){
			$activation_token = encrypt($user_id);
			$email_var_data["customer_name"] = ucwords($this->input->post("username"));
			$email_var_data["email"] = $this->input->post("email");
			$email_var_data["password"] = $this->input->post("password");
			$email_var_data["recovery_link"] = base_url() . 'customer-setpassword/'. $activation_token;

			$from = "excellentwebworld@admin.com";
			$to = $this->input->post("email");
			$subject = "Welcome To Click Lunch";

			$this->db->select('emat_email_subject,emat_email_message');
			$this->db->from('email_template');
			$this->db->where('emat_email_type', 3);
			$this->db->where("emat_is_active", 1);
			$sql_query = $this->db->get();
			$return_data = $sql_query->row();

			if (!isset($return_data) && empty($return_data)){
				$this->auth->set_error_message("Email template not found. Error into sending mail.");
				return FALSE;
			}

			$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
			$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
			$mail = sendmail($from, $to, $subject, $message);
		}

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

		$user_data['username'] = ucwords(addslashes($this->input->post("username")));
		$user_data['address'] = addslashes($this->input->post("address"));
		$user_data['gender'] = addslashes($this->input->post("gender"));

		$dob = date('Y-m-d', strtotime($this->input->post("dob")));
		$user_data['dob'] = $dob;

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

		$user_data['mobile_number'] = $this->input->post("mobile_number");
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