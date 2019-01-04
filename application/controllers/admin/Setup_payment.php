<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setup_payment extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && $this->auth->is_admin()){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "logout-admin");
			}
			
		}
		//$this->load->model("appsetting_model");
	}

	public function index(){
		// $settings = $this->appsetting_model->get_settings();
		// $output_data["settings"] = $settings;
		$output_data['main_content'] = "admin/setup_payment";
		$this->load->view('template/template',$output_data);	
	}

}
