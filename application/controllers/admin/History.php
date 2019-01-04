<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class History extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_admin() || $this->auth->is_vender())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "logout-admin");
			}
		}
		$this->load->model("admin/cuisine_model");
	}

	public function transaction_history(){

		$output_data['main_content'] = "admin/history/transaction_history";
		$this->load->view('template/template',$output_data);	
	}

	public function receipt_history(){

		$output_data['main_content'] = "admin/history/receipt_history";
		$this->load->view('template/template',$output_data);	
	}

	public function payment_history(){

		$output_data['main_content'] = "admin/history/payment_history";
		$this->load->view('template/template',$output_data);	
	}

	public function earning_report(){

		$output_data['main_content'] = "admin/history/earning_report";
		$this->load->view('template/template',$output_data);	
	}

}
