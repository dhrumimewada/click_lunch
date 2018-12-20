<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'profile')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("promocode_model");
	}

	public function vender_dashboard(){
		$promocode_list = $this->promocode_model->get_promocode();

		$output_data["promocode"] = $promocode_list;

		$output_data['main_content'] = "vender/dashboard";
		$this->load->view('template/template',$output_data);	
	}

}
?>
