<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		//$this->lang->load('message', 'english');
		// Get the current auth session, else get the default values
		$this->status_messages = array();
		$this->error_messages = array();		
	}

	public function set_error_message($error_message = FALSE, $overwrite_existing = FALSE) {
		return $this->set_message('error', $error_message, $overwrite_existing);
	}

	public function set_status_message($status_message = FALSE, $overwrite_existing = FALSE) {
		return $this->set_message('status', $status_message, $overwrite_existing);
	}

	private function set_message($message_type = FALSE, $message = FALSE, $overwrite_existing = FALSE) {
		if (in_array($message_type, array('status', 'error')) && $message) {

			if ($message_type == 'status') {
				// Check whether to overwrite existing messages.
				if ($overwrite_existing) {
					$this->status_messages = array();
				}

				// Check message is not already in array to avoid displaying duplicates.
				if (!in_array($message, $this->status_messages)) {
					$this->status_messages[] = $message;
				}
			}
			if ($message_type == 'error') {
				// Check whether to overwrite existing messages.
				if ($overwrite_existing) {
					$this->error_messages = array();
				}
				// Check message is not already in array to avoid displaying duplicates.
				if (!in_array($message, $this->error_messages)) {
					$this->error_messages[] = $message;
				}
			}
		}

		return $message;
	}

	private function get_messages($message_type = FALSE, $target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE) {
		if (in_array($message_type, array('status', 'error'))) {

			// Set message delimiters, by checking they do not exactly equal FALSE, we can allow NULL or empty '' delimiter values.
			if (!$prefix_delimiter) {
				$prefix_delimiter = ($message_type == 'status') ?
				$this->config->item('status_prefix') : $this->config->item('error_prefix');
			}
			if (!$suffix_delimiter) {
				$suffix_delimiter = ($message_type == 'status') ?
				$this->config->item('status_suffix') : $this->config->item('error_suffix');
			}

			// Get all messages for public users, or both public AND admin users.
			if ($message_type == 'status') {
				$messages = $this->status_messages;
			} else {
				$messages = $this->error_messages;
			}

			$statuses = FALSE;
			foreach ($messages as $message) {
				$message = ($this->lang->line($message)) ? $this->lang->line($message) : $message;
				$statuses .= $prefix_delimiter . $message . $suffix_delimiter;
			}

			return $statuses;
		}

		return FALSE;
	}

	public function status_messages($prefix_delimiter = FALSE, $suffix_delimiter = FALSE) {
		return $this->get_messages('status', $prefix_delimiter, $suffix_delimiter);
	}

	public function error_messages($prefix_delimiter = FALSE, $suffix_delimiter = FALSE) {
		return $this->get_messages('error', $prefix_delimiter, $suffix_delimiter);
	}

	public function login($identity = FALSE, $password = FALSE, $user_type = FALSE) {

		$this->db->select('*');

		if($user_type == 'admin'){
			$this->db->from('admin');
		}elseif($user_type == 'vender'){
			$this->db->from('shop');
		}else{
			
		}
		
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", "1");
		$this->db->where("email", $identity);
		$sql_query = $this->db->get();

		if ($sql_query->num_rows() <= 0){
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->where("deleted_at", NULL);
			$this->db->where("status", "1");
			$this->db->where("email", $identity);
			$sql_query2 = $this->db->get();
			if ($sql_query2->num_rows() == 1){
				$user1 = $sql_query2->row();	
				if (password_verify($password, $user1->password)){
					$session_data['user_id'] = (int) $user1->id;
					$session_data['username'] =  (string) $user1->first_name;
					$session_data['email'] =  (string) $user1->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) TRUE;
					$session_data['role_id'] = (int) $user1->role;
					$session_data['shop_id'] = (int) $user1->shop_id;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('session_user' => $this->session_data));

					return TRUE;
				}
			}
		}

		// User exists, now validate credentials.
		if ($sql_query->num_rows() == 1) {
			$user = $sql_query->row();	
			
			// Verify submitted password matches database.
			if (password_verify($password, $user->password)) {

				// Set user login sessions.
				if($user_type == 'admin'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->username;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) TRUE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;
					
				}elseif($user_type == 'vender'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->shop_name;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) TRUE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;
				}else{
					return FALSE;
				}
				
				$this->session_data = $session_data;
				$this->session->set_userdata(array('session_user' => $this->session_data));

				return TRUE;

			} // Password does not match, log the failed login attempt if defined via the config file.

		}

		return FALSE;
	}

	public function password_recovery($email = FALSE,$user_type = FALSE) {

		$this->load->library('parser');

		$this->db->select('id,email');

		if($user_type == 'vender'){
			$this->db->from('shop');
		}elseif($user_type == 'employee'){
			$this->db->from('employee');
		}else{
			$this->auth->set_error_message("User not found. Error into sending mail.");
			return FALSE;
		}
		
		$this->db->where('email', $email);
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$sql_query = $this->db->get();
		$return_data = $sql_query->row();

		if (!isset($return_data) && empty($return_data)){
			$this->auth->set_error_message("User not found. Error into sending mail.");
			return FALSE;
		}


		$activation_token = encrypt($return_data->id);
		$email_var_data["vender_name"] = $this->input->post("vender_name");

		if($user_type == 'vender'){
			$email_var_data["recovery_link"] = base_url() . 'vender-setpassword/'. $activation_token;
		}elseif($user_type == 'employee'){
			$email_var_data["recovery_link"] = base_url() . 'employee-setpassword/'. $activation_token;
		}else{
			$email_var_data["recovery_link"] = '';
		}

		

		$this->db->select('emat_email_subject,emat_email_message');
		$this->db->from('email_template');
		$this->db->where('emat_email_type', 2);
		$this->db->where("emat_is_active", 1);
		$sql_query = $this->db->get();
		$return_data = $sql_query->row();

		if (!isset($return_data) && empty($return_data)){
			$this->auth->set_error_message("Email template not found. Error into sending mail.");
			return FALSE;
		}

		$from = "excellentwebworld@admin.com";
		$to = $email;
		$subject = "Request to reset your password";

		$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
		$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
		$mail = sendmail($from, $to, $subject, $message);

		if(!$mail){
			$this->auth->set_error_message("Error into sending mail");
			return FALSE;
		}
		return TRUE;

	}

	public function get_user_id(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return $user_session['user_id'];
        }
        else{
            return FALSE;
        }
	}

	public function get_role_id(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return $user_session['role_id'];
        }
        else{
            return FALSE;
        }
	}

	public function get_emp_shop_id(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return $user_session['shop_id'];
        }
        else{
            return FALSE;
        }
	}

	public function is_logged_in(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_admin(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['is_admin'] == TRUE)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_vender(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['is_vender'] == TRUE)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_employee(){
		$user_session = $this->session->userdata('session_user');
        if((isset($user_session)) && ($user_session['is_employee'] == TRUE)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function logout() {
		$this->session->unset_userdata('session_user');
		$this->set_auth_defaults();
		return TRUE;
	}

	public function set_auth_defaults() {
		session_destroy(); 
	}
}

?>