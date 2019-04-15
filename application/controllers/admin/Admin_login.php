<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin_model");
	}

	public function login(){

		if ($this->auth->is_admin() == TRUE){
			redirect(base_url() . "dashboard");
		}

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email'),
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]')

				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {
					// print_r($_POST);
					// exit;
					if($this->auth->login($this->input->post('email'), $this->input->post('password'), $this->input->post('user_type'))){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "dashboard");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-admin");
					}			
				} 
			}
		}
		$data = array('user_type' => 'admin');
		$this->load->view('login', $data);

	}

	public function logout(){
		if($this->auth->logout()){
			redirect(base_url() . "login-admin");
		}
	}

	public function accountexists($str) {
		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 1);
		$this->db->from('admin');
		$sql_query = $this->db->get();

		if (($sql_query->num_rows() > 0)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('accountexists', "Email not found.");
			return FALSE;
		}
	}

	public function admin_forgot_password(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_accountexists')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {
					if($this->auth->password_recovery($this->input->post('email'),'admin')){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "admin-forgot-password");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "admin-forgot-password");
					}			
				} 
			}
		}
		$output_data["user_type"] = 'admin';
		$this->load->view('forgot_password', $output_data);
	}

	public function admin_reset_password($token = '') {
		// print_r(decrypt($id));
		// exit;
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'cpassword', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true){
					if($this->admin_model->reset_password()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-admin");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-admin");
					}
				}
				//echo "<pre>"; print_r($_POST); exit;
			}
		}

		if($token != ''){

			
			$output_data = array('token' => $token);
			$output_data["user_type"] = 'admin';
			$this->load->view('vender/reset_password',$output_data);	

		}else{
			echo "<h2>Server encounter error</h2>";
			exit;
		}
	}

}
?>