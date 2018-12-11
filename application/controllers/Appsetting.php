<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appsetting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_admin())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "logout-admin");
			}
			
		}
		$this->load->model("appsetting_model");
	}

	public function index(){

		$settings = $this->appsetting_model->get_settings();
		$output_data["settings"] = $settings;
		$output_data['main_content'] = "admin/app_setting/index";
		$this->load->view('template/template',$output_data);	
	}

	public function put(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				if($this->appsetting_model->put()){
					$this->session->set_flashdata($this->auth->get_messages_array());
					redirect(base_url() . "app-setting");
				}else{
					$this->session->set_flashdata($this->auth->get_messages_array());
					redirect(base_url() . "app-setting");
				}
	

			}
		}

		$template_detail = $this->appsetting_model->get_templates($id);
		//echo "<pre>"; print_r($template_detail); exit;
		$output_data["template_detail"] = $template_detail;
		$output_data['main_content'] = "admin/email_template/put";
		$this->load->view('template/template',$output_data);	
	}

}
