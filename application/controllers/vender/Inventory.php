<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_vender())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("vender/inventory_model");
	}

	public function index(){

		// $cuisine_list = $this->inventory_model->get_cuisine();

		// $output_data["cuisine_list"] = $cuisine_list;
		$output_data['main_content'] = "vender/inventory/index";
		$this->load->view('template/template',$output_data);	
	}

}
