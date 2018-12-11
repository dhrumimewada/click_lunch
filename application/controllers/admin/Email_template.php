<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_template extends CI_Controller {

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
		$this->load->model("email_template_model");
	}

	public function index(){

		$template_list = $this->email_template_model->get_templates();

		$output_data["template_list"] = $template_list;
		$output_data['main_content'] = "admin/email_template/index";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = NULL){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'emat_email_subject', 'label' => 'email subject', 'rules' => 'trim|required'),
					array('field' => 'emat_email_message', 'label' => 'email message', 'rules' => 'trim|required')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){

					///echo "<pre>"; print_r($_POST); exit;

					if($this->email_template_model->put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}
				}	

			}
		}
		
		$output_data["template_detail"] = $this->email_template_model->get_templates($id);
		if (!isset($output_data['template_detail']) || empty($output_data['template_detail']) || count($output_data['template_detail']) <= 0){
			$this->auth->set_error_message("Email template data not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "email-list");
		}
		$output_data['main_content'] = "admin/email_template/put";
		$this->load->view('template/template',$output_data);	
	}

}
