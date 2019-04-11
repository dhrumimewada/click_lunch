<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_push extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_admin()) || ($this->auth->is_dispatcher()))){
			
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

	public function custom_push_deliveryboy(){

		$output_data["is_admin"] = $this->auth->is_admin();
		$output_data["is_dispatcher"] = $this->auth->is_dispatcher();

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'delivery_boy[]', 'label' => 'restaurant', 'rules' => 'trim|required'),
					array('field' => 'notification_title', 'label' => 'title', 'rules' => 'trim|required'),
					array('field' => 'notification_message', 'label' => 'message', 'rules' => 'trim|required')
				);

				//echo "<pre>";
				//print_r($_POST['emat_email_message']);

				
				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					
					// $abc = $this->email_template_model->send_custom_push_customer();
					// echo "<pre>";
					//print_r($_POST);
					//print_r($abc);
					//exit;
					if($this->email_template_model->send_custom_push_db()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						
						if($output_data["is_admin"]){
							redirect(base_url() . "email-list");
						}else{
							redirect(base_url() . "custom-push-deliveryboy");
						}
						
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-push-deliveryboy");
					}
				}

			}
		}


		$delivery_boy_list = $this->email_template_model->get_table_data('delivery_boy');
		$output_data["delivery_boy_list"] = $delivery_boy_list;
		$output_data['main_content'] = "admin/email_template/custom_push_db";
		$this->load->view('template/template',$output_data);	
	}
}
?>