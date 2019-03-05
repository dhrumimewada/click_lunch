<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_push extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'email_push_management')) ) ){
			
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

	public function validate_shop($shops = NULL, $group_id = NULL) {
		if($group_id == 5 && empty($shops)){
			$this->form_validation->set_message('validate_shop', 'The restaurant field is required.');
			return False;
		}else {
			return True;
		}
	}

	public function validate_order_no($no_of_orders = NULL, $group_id = NULL) {
		$no_of_orders = trim($no_of_orders);
		if($group_id == 6 && $no_of_orders == ''){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is required.');
			return False;	
		}else if ($group_id == 6 && ! ctype_digit(strval($no_of_orders)) ){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is invalid.');
			return False;
		}else if($group_id == 6 && (int)$no_of_orders <= 0){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is invalid.');
				return False;
		}else {
			return True;
		}
	}

	public function custom_email_customer(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		$is_admin = $this->auth->is_admin();
		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();


		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|callback_validate_shop[' . $_POST['group'] . ']'),
					array('field' => 'no_of_orders', 'label' => 'minimum number of orders', 'rules' => 'trim|callback_validate_order_no[' . $_POST['group'] . ']'),
					array('field' => 'group', 'label' => 'group', 'rules' => 'trim|required'),
					array('field' => 'emat_email_subject', 'label' => 'email subject', 'rules' => 'trim|required'),
					array('field' => 'emat_email_message', 'label' => 'email message', 'rules' => 'trim|required')
				);

				if($this->input->post("group") == 7){
					$shop_validation = array('field' => 'item[]', 'label' => 'product/combo', 'rules' => 'trim|required');
					array_push($validation_rules, $shop_validation);
				}

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){

					//$data = $this->email_template_model->send_custom_email_customer();
					// echo "<pre>";
					// print_r($data);
					// exit;
					if($this->email_template_model->send_custom_email_customer()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "vender-custom-email-customer");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "vender-custom-email-customer");
					}
				}

			}
		}


		

		$output_data["is_admin"] = $is_admin;
		$output_data["is_vender"] = $is_vender;
		$output_data["is_employee"] = $is_employee;
		// echo "<pre>";
		// print_r($output_data["group"]); exit;
		
		if($is_admin){
			$shop_list = $this->email_template_model->get_table_data('shop');
			$output_data["shop_list"] = $shop_list;
			$output_data["group"] = $this->config->item("group_for_admin");
		}else if($is_vender || $is_employee){
			$output_data["group"] = $this->config->item("group_for_shop_email");
			$item_list = $this->email_template_model->get_table_data('item');
			$output_data["item_list"] = $item_list;
		}else{

		}

		$output_data["to"] =$to;
		$output_data['main_content'] = "admin/email_template/email_custom_customer";
		$this->load->view('template/template',$output_data);	
	}

}
