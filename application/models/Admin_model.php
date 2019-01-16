<?php

class Admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_all_admin() {
		$return_data = array();
		$this->db->select('id,email,username,status,created_at');
		$this->db->from('admin');
		$this->db->where("deleted_at", NULL);
		$this->db->where("id !=", $this->auth->get_user_id());
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function add_admin($modal_data = NULL) {

		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])) {
			$profile_picture = $modal_data['profile_picture']['file_name'];
		}

		$user_data = array(
						'email' => $this->input->post("email"),
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'username' => $this->input->post("username"),
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : '')
					);
		$response = $this->db->insert("admin", $user_data);

		if($response){
			$activation_token = encrypt($user_id);
			$email_var_data["admin_name"] = ucwords($this->input->post("username"));
			$email_var_data["email"] = $this->input->post("email");
			$email_var_data["password"] = $this->input->post("password");
			$email_var_data["login_link"] = base_url() . 'login-admin';

			$from = "excellentwebworld@admin.com";
			$to = $this->input->post("email");
			$subject = "Welcome To Click Lunch";

			$this->db->select('emat_email_subject,emat_email_message');
			$this->db->from('email_template');
			$this->db->where('emat_email_type', 5);
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
			$this->auth->set_status_message("Admin added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function update_profile($modal_data = NULL) {

		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])) {
			$profile_picture = $modal_data['profile_picture']['file_name'];
		}
		 //print_r($profile_picture); exit;
		$user_data = array(
						'username' => $this->input->post("username"),
						'updated_at' => date('Y-m-d H:i:s')
					);
		if((isset($profile_picture) && !empty($profile_picture))){
			$user_data += [ "profile_picture" => $profile_picture ];
		}
		$this->db->where("id", $this->auth->get_user_id());
		$response = $this->db->update("admin", $user_data);

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

	public function get_user_detail($id = NULL){
		if(!isset($id) && $id == ''){
			$id = $this->auth->get_user_id();
		}

		$return_data = array();
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("deleted_at", NULL);
		$this->db->where("id", $id);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->row();
		}
		return $return_data;
	}
}
?>
