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
		}elseif($user_type == 'employee'){
			$this->db->from('employee');
		}elseif($user_type == 'dispatcher'){
			$this->db->from('delivery_dispatcher');
		}elseif($user_type == 'customer'){
			$this->db->from('customer');
		}else{
			return false;
		}
		
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", "1");
		$this->db->where("email", $identity);
		$sql_query = $this->db->get();

		// User exists, now validate credentials.
		if ($sql_query->num_rows() == 1) {
			$user = $sql_query->row();	
			
			// Verify submitted password matches database.

			if (password_verify($password, $user->password)) {

				$this->session->unset_userdata('employee_user');
				$this->session->unset_userdata('vendor_user');
				$this->session->unset_userdata('admin_user');
				$this->session->unset_userdata('dispatcher_user');
				$this->session->unset_userdata('customer_user');
				// Set user login sessions.
				if($user_type == 'admin'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->username;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) TRUE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['is_dispatcher'] = (bool) FALSE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('admin_user' => $this->session_data));
					
				}elseif($user_type == 'vender'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->shop_name;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) TRUE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['is_dispatcher'] = (bool) FALSE;
					$session_data['is_customer'] = (bool) FALSE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('vendor_user' => $this->session_data));

				}elseif($user_type == 'employee'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->first_name. ' '.$user->last_name;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) TRUE;
					$session_data['is_dispatcher'] = (bool) FALSE;
					$session_data['is_customer'] = (bool) FALSE;
					$session_data['role_id'] = (int) $user->role;
					$session_data['shop_id'] = (int) $user->shop_id;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('employee_user' => $this->session_data));

				}elseif($user_type == 'dispatcher'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->full_name;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['is_customer'] = (bool) FALSE;
					$session_data['is_dispatcher'] = (bool) TRUE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('dispatcher_user' => $this->session_data));

				}elseif($user_type == 'customer'){
					$session_data['user_id'] = (int) $user->id;
					$session_data['username'] =  (string) $user->username;
					$session_data['email'] =  (string) $user->email;
					$session_data['logged_in'] = (bool) TRUE;
					$session_data['is_admin'] = (bool) FALSE;
					$session_data['is_vender'] = (bool) FALSE;
					$session_data['is_employee'] = (bool) FALSE;
					$session_data['is_dispatcher'] = (bool) FALSE;
					$session_data['is_customer'] = (bool) TRUE;
					$session_data['role_id'] = (bool) FALSE;
					$session_data['shop_id'] = (bool) FALSE;

					$this->session_data = $session_data;
					$this->session->set_userdata(array('customer_user' => $this->session_data));
				}else{
					return FALSE;
				}

				return TRUE;

			} // Password does not match, log the failed login attempt if defined via the config file.

		}

		return FALSE;
	}

	public function password_recovery($email = FALSE,$user_type = FALSE) {

		$this->load->library('parser');

		$remember_token = bin2hex(random_bytes(20));

		if($user_type == 'vender'){
			$email_var_data["recovery_link"] = base_url() . 'vender-reset-password/'. $remember_token;
		}elseif($user_type == 'employee'){
			$email_var_data["recovery_link"] = base_url() . 'employee-reset-password/'. $remember_token;
		}elseif($user_type == 'customer'){
			$email_var_data["recovery_link"] = base_url() . 'customer-reset-password/'. $remember_token;
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

		$from = '"Click Lunch" <excellentwebworld@admin.com>';
		$to = $email;
		$subject = "Request to reset your password";

		$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
		$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
		$mail = sendmail($from, $to, $subject, $message);

		if(!$mail){
			$this->auth->set_error_message("Error into sending mail");
			return FALSE;
		}else{

			$token_array = array('remember_token' => $remember_token);
			$this->db->where("email", $email);

			if($user_type == 'vender'){
				$this->db->update("shop", $token_array);
			}elseif($user_type == 'employee'){
				$this->db->update("employee", $token_array);
			}elseif($user_type == 'customer'){
				$this->db->update("customer", $token_array);
			}else{
			}
		}
		return TRUE;

	}

	public function get_user_id(){

		if($this->is_admin()){
			$user_session = $this->session->userdata('admin_user');
			return $user_session['user_id'];
		}else if($this->is_vender()){
			$user_session = $this->session->userdata('vendor_user');
			return $user_session['user_id'];
		}else if($this->is_employee()){
			$user_session = $this->session->userdata('employee_user');
			return $user_session['user_id'];
		}else if($this->is_dispatcher()){
			$user_session = $this->session->userdata('dispatcher_user');
			return $user_session['user_id'];
		}else if($this->is_customer()){
			$user_session = $this->session->userdata('customer_user');
			return $user_session['user_id'];
		}else{
			return FALSE;
		}

	}

	public function get_role_id(){
		$user_session = $this->session->userdata('employee_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return $user_session['role_id'];
        }
        else{
            return FALSE;
        }
	}

	public function get_emp_shop_id(){
		$user_session = $this->session->userdata('employee_user');
        if((isset($user_session)) && ($user_session['logged_in'] == TRUE)){
            return $user_session['shop_id'];
        }
        else{
            return FALSE;
        }
	}

	public function is_logged_in(){
		$user_admin = $this->session->userdata('admin_user');
		$user_vendor = $this->session->userdata('vendor_user');
		$user_employee = $this->session->userdata('employee_user');
		$user_dispatcher = $this->session->userdata('dispatcher_user');
		$user_customer = $this->session->userdata('customer_user');
        if((isset($user_admin)) || (isset($user_vendor)) || (isset($user_employee)) || (isset($user_dispatcher)) || (isset($user_customer))){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_admin(){
		$user_session = $this->session->userdata('admin_user');
        if((isset($user_session)) && ($user_session['user_id'] > 0)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_vender(){
		$user_session = $this->session->userdata('vendor_user');
        if((isset($user_session)) && ($user_session['user_id'] > 0)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_employee(){
		$user_session = $this->session->userdata('employee_user');
        if((isset($user_session)) && ($user_session['user_id'] > 0)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_dispatcher(){
		$user_session = $this->session->userdata('dispatcher_user');
        if((isset($user_session)) && ($user_session['user_id'] > 0)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function is_customer(){
		$user_session = $this->session->userdata('customer_user');
        if((isset($user_session)) && ($user_session['user_id'] > 0)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function logout() {
		$this->session->unset_userdata('employee_user');
		$this->session->unset_userdata('vendor_user');
		$this->session->unset_userdata('admin_user');
		$this->set_auth_defaults();
		return TRUE;
	}

	public function set_auth_defaults() {
		session_destroy(); 
	}
}

?>