<?php

class Employee_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_employee($id = NULL){
		$return_data = array();
		$sql_select = array("t1.*", "t2.role_name");
		$this->db->select($sql_select);
		$this->db->from('employee t1');
		if (isset($id) && !is_null($id)) {
			$this->db->where('t1.id', $id);
		}
		$this->db->where("t1.shop_id",$this->auth->get_user_id());
		$this->db->where("t1.deleted_at", NULL);
		$this->db->join('role t2', 't1.role = t2.id', "left join");
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

	public function get_roles(){
		$return_data = array();
		$this->db->select('id,role_name');
		$this->db->from('role');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
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
						'shop_id' => intval($this->auth->get_user_id()),
						'first_name' => ucwords(addslashes($this->input->post("first_name"))),
						'last_name' => ucwords(addslashes($this->input->post("last_name"))),
						'email' => $this->input->post("email"),
						'role' => intval($this->input->post("role")),
						'status' => 0,
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'created_at' => date('Y-m-d H:i:s')
					);
		$response = $this->db->insert("employee", $user_data);
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

		if($response){

			$activation_token = encrypt($user_id);
			$email_var_data["vender_name"] = $this->input->post("first_name")." ".$this->input->post("last_name");
			$email_var_data["activation_link"] = base_url() . 'employee-setpassword/'. $activation_token;

			$from = "excellentwebworld@admin.com";
			$to = $this->input->post("email");
			$subject = "Account Activation";

			$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
			$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
			$mail = sendmail($from, $to, $subject, $message);
		}

		if(!$mail){
			$this->auth->set_error_message("Error into sending mail");
			return FALSE;
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Employee added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;
		// echo '<pre>';
		// print_r($modal_data);exit;

		$user_data['shop_id'] = $this->auth->get_user_id();
		$user_data['role'] = $this->input->post("role");
		$user_data['first_name'] = ucwords(addslashes($this->input->post("first_name")));
		$user_data['last_name'] = ucwords(addslashes($this->input->post("last_name")));

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $this->input->post("employee_id"));
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

		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("employee_id"));
		$this->db->update("employee", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Employee updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

}
?>