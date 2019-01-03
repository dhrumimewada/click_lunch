<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("customer/customer_model");
	}

	public function setpassword($id = NULL) {
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
					if($this->customer_model->set_password()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-vender");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-vender");
					}
				}
				//echo "<pre>"; print_r($_POST); exit;
			}
		}
		$output_data["id"] = $id;
		$this->load->view('admin/customer/setpassword',$output_data);	
	}
}
?>