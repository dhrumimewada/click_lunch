<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_vender()) ||($this->auth->is_dispatcher()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'orders')) ) ){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("dispatcher/order_model");
	}

	public function order_new(){

		$output_data['main_content'] = "dispatcher/order/index";
		$this->load->view('template/template',$output_data);	
	}

	public function new_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));


	  	$order_list = $this->order_model->get_order();

	 	$data = array();
	 	$action_data = '';
	 	$edit_link = base_url().'customer-update';

		foreach($order_list as $key => $value) {


		       $status_str = "<button type='button' class='btn btn-success btn-sm waves-effect waves-light deactive_customer' status-id='" . $value["order_status"] . "' title='Active' data-popup='tooltip' > Assign</button>";

		       $data[] = array(
		            $value['id'],
		            'CL'.$value['id'],
		            $value["customer_id"],
		            $value["shop_id"],
		            '$233',
		            $status_str
		       );

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($customer_list),
	         "recordsFiltered" => count($customer_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

}