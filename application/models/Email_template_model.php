<?php

class Email_template_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_templates($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('email_template');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where("emat_is_active", 1);
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

	public function get_table_data($table_name = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function put() {

		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data = array(
						'emat_email_subject' => $this->input->post("emat_email_subject"),
						'emat_email_message' => $this->input->post("emat_email_message"),
						'updated_at' => date('Y-m-d H:i:s')
					);

		$this->db->where("emat_email_type", $this->input->post("emat_email_type"));
		$response = $this->db->update("email_template", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating template");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Template updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function send_custom_email(){
		$return_value = FALSE;

		$from = "";
		$subject = $this->input->post("emat_email_subject");
		$email_message_string = $this->input->post("emat_email_message");
		$message = $this->load->view("email_templates/custom_mail", array("mail_body" => $email_message_string), TRUE);

		$this->db->select('email');
		$this->db->from($this->input->post("to_type"));
		$this->db->where_in("id", $this->input->post("email_to"));
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
			$total_sended = 0;
			foreach ($return_data as $key => $value) {
				$to = $value['email'];
				$mail = sendmail($from, $to, $subject, $message);
				if($mail){
					$total_sended++;
				}
			}
			$this->auth->set_status_message("Total ".$total_sended. " emails sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("Something went wrong. please try again later");
		}
		return $return_value;
	}

	
}