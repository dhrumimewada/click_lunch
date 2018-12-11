<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function login(){

		if ($this->auth->is_logged_in() == TRUE){
			redirect(base_url() . "admin-list");
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

}
?>