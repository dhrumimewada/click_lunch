<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_PARSE);

class Auth {

	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model('auth_model');
		$this->CI->load->library('parser');

	}

	public function set_status_message($status_message = FALSE, $overwrite_existing = FALSE) {
		return $this->CI->auth_model->set_status_message($status_message, $overwrite_existing);
	}

	public function set_error_message($error_message, $overwrite_existing = FALSE) {
		return $this->CI->auth_model->set_error_message($error_message, $overwrite_existing);
	}

	public function get_messages($prefix_delimiter = FALSE, $suffix_delimiter = FALSE) {
		$messages = $this->get_messages_array($prefix_delimiter, $suffix_delimiter);
		return ($messages) ? $messages['status'] . $messages['errors'] : FALSE;
	}

	public function get_messages_array($prefix_delimiter = FALSE, $suffix_delimiter = FALSE) {
		$messages['status'] = $this->CI->auth_model->status_messages($prefix_delimiter, $suffix_delimiter);
		$messages['errors'] = $this->CI->auth_model->error_messages($prefix_delimiter, $suffix_delimiter);

		// Set a message type identifier to state whether they are either status, error or mixed messages.
		if (!empty($messages['status']) && empty($messages['errors'])) {
			$messages['type'] = 'status';
		} else if (empty($messages['status']) && !empty($messages['errors'])) {
			$messages['type'] = 'error';
		} else if (!empty($messages['status']) && !empty($messages['errors'])) {
			$messages['type'] = 'mixed';
		} else {
			$messages['type'] = FALSE;
		}
		// If message type is FALSE, no messages are set, so return FALSE.
		return ($messages['type']) ? $messages : FALSE;
	}

	public function clear_error_messages() {
		$this->CI->auth_model->error_messages = array();
		return TRUE;
	}

	public function clear_status_messages() {
		$this->CI->auth_model->status_messages = array();
		return TRUE;
	}

	public function clear_messages() {
		$this->CI->auth_model->status_messages = array();
		$this->CI->auth_model->error_messages = array();
		return TRUE;
	}

	public function login($identity = FALSE, $password = FALSE, $user_type = FALSE) {
		if ($this->CI->auth_model->login($identity, $password, $user_type)) {
			$this->CI->auth_model->set_status_message('You have been successfully logged in.');
			return TRUE;
		}

		if (!$this->CI->auth_model->error_messages()) {
			$this->CI->auth_model->set_error_message('Email / Password is incorrect.');
		}

		return FALSE;
	}

	public function is_logged_in() {
		if ($this->CI->auth_model->is_logged_in()) {
			//$this->CI->auth_model->set_status_message('Session expired');
			return TRUE;
		}
	}

	public function is_admin() {
		if ($this->CI->auth_model->is_admin()) {
			//$this->CI->auth_model->set_status_message('Not allowed to access');
			return TRUE;
		}
	}

	public function is_vender() {
		if ($this->CI->auth_model->is_vender()) {
			//$this->CI->auth_model->set_status_message('Not allowed to access');
			return TRUE;
		}
	}

	public function is_employee() {
		if ($this->CI->auth_model->is_employee()) {
			//$this->CI->auth_model->set_status_message('Not allowed to access');
			return TRUE;
		}
	}

	public function is_dispatcher() {
		if ($this->CI->auth_model->is_dispatcher()) {
			//$this->CI->auth_model->set_status_message('Not allowed to access');
			return TRUE;
		}
	}

	public function logout() {
		if ($this->CI->auth_model->logout()) {
			$this->CI->auth_model->set_status_message('You have been successfully logged out.');
			return TRUE;
		}
	}

	public function get_user_id() {
		if ($this->CI->auth_model->get_user_id()) {
			return $this->CI->auth_model->get_user_id();
		}
		return FALSE;
	}

	public function get_role_id() {
		if ($this->CI->auth_model->get_role_id()) {
			return $this->CI->auth_model->get_role_id();
		}
		return FALSE;
	}

	public function get_emp_shop_id() {
		if ($this->CI->auth_model->get_emp_shop_id()) {
			return $this->CI->auth_model->get_emp_shop_id();
		}
		return FALSE;
	}

	public function change_password($identity, $current_password, $new_password) {
		if ($this->CI->auth_model->change_password($identity, $current_password, $new_password)) {
			$this->CI->auth_model->set_status_message('Password has been changed successfully.');
			return TRUE;
		}
		$this->CI->auth_model->set_error_message('Unable to reset password.');
		return FALSE;
	}

	public function password_recovery($email, $user_type) {
		if ($this->CI->auth_model->password_recovery($email,$user_type)) {
			$this->CI->auth_model->set_status_message('Password recovery mail successfully sent.');
			return TRUE;
		}
		$this->CI->auth_model->set_error_message('Unable to send recovery mail.');
		return FALSE;
	}


}
