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
		
		if($table_name == 'item'){
			$this->db->where("is_active", 1);
		}else{
			$this->db->where("status", 1);
		}

		if($this->auth->is_vender()){
			$this->db->where("shop_id", $this->auth->get_user_id());
		}
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

			$emails = array_column($return_data, 'email');
			$email_data = implode(',', $emails);
			$total_sended = count($emails);
			$mail = sendmail($from, $email_data, $subject, $message);

			$this->auth->set_status_message("Total ".$total_sended. " emails sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("Something went wrong. please try again later");
		}
		return $return_value;
	}

	public function send_custom_email_customer(){
		$return_value = FALSE;

		$from = "";
		$subject = $this->input->post("emat_email_subject");
		$email_message_string = $this->input->post("emat_email_message");
		$message = $this->load->view("email_templates/custom_mail", array("mail_body" => $email_message_string), TRUE);

		$customer_list = array();

		if($this->input->post("group") == 4){
			// All customer for shop
            $this->db->select('t2.email');
            $this->db->where("t2.deleted_at", NULL);
            $this->db->where("t2.status", 1);
            if($this->auth->is_vender()){
				$this->db->where("t1.shop_id", $this->auth->get_user_id());
			}else if($this->auth->is_employee()){
				$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
			}
            $this->db->from('orders t1');
            $this->db->join('customer t2', 't1.customer_id = t2.id', "left join");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
            	$customer_list = $sql_query->result_array();
            }
		}

		if(is_array($customer_list) && !empty($customer_list)){

			$emails = array_column($customer_list, 'email');
			$email_data = implode(',', $emails);
			$total_sended = count($emails);
			$mail = sendmail($from, $email_data, $subject, $message);
			
			$this->auth->set_status_message("Total ".$total_sended. " emails sent successfully");
			$return_value = TRUE;
		}else{
			//$this->auth->set_error_message("Something went wrong. please try again later");
			$this->auth->set_error_message("Under Devlopment");
		}
		return $return_value;
		
	}

	
}