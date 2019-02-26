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
	 	$order_view_url = base_url().'order-detail';

		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();
		$is_dispatcher = $this->auth->is_dispatcher();

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);

				if($is_dispatcher){
					$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";
				}else if($is_vender || $is_employee){
					$status_str = 
						"<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>
						<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' status-id='1' title='Accept' data-popup='tooltip' > Accept</button>
						<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' status-id='2' title='Reject' data-popup='tooltip' > Reject</button>";
				}else{
					$status_str = '';
				}

				$created_date_ts = strtotime($value["created_at"]);
                $created_date = date("j M, Y g:i a", $created_date_ts);
		       	
		       	$data[] = array(
		            $value['id'],
		            'CL'.$value['id'],
		            $value["username"],
		            $value["shop_name"],
		            '&#36;'.$value["total"],
		            $created_date,
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

  	public function order_detail($id = NULL){
  		$order_data = $this->order_model->get_order_detail($id);
  		// echo "<pre>";
  		// print_r($order_data);
  		// exit;
  		$output_data['order_data'] = $order_data;
  		$output_data['main_content'] = "dispatcher/order/order_detail";
		$this->load->view('template/template',$output_data);	
  	}

  	public function order_status_update(){
  		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('order_status' => $status,'updated_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('orders', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
  	}

}