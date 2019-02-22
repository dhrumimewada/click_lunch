<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {

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
		$this->load->model("admin/setting_model");
	}

	public function index1(){
		$settings = $this->setting_model->get_settings();
		$output_data["settings"] = $settings;
		$output_data['main_content'] = "admin/setting/index";
		$this->load->view('template/template',$output_data);	
	}

	public function index(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'tax', 'label' => 'TAX', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {
					if($this->setting_model->put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "setting");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "setting");
					}
				}
			}
		}	
		$settings = $this->setting_model->get_settings();
		$output_data["settings"] = $settings;
		$output_data['main_content'] = "admin/setting/index";
		$this->load->view('template/template',$output_data);	
	}

}
