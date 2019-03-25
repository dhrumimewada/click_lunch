<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {

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
		$this->load->model("admin/order_model");
	}

	public function delivery_orders(){
		$output_data['table_title'] = "Delivery Orders";
		$output_data['table_name'] = "delivery_orders";
		$output_data['main_content'] = "admin/orders";
		$this->load->view('template/template',$output_data);	
	}

	public function delivery_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	//get all delievry orders
	  	$order_type = array('1', '2');
	  	$order_list = $this->order_model->get_order($order_type);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

				$created_date_ts = strtotime($value["created_at"]);
                $created_date = date("j M, Y h:i A", $created_date_ts);

                if($value['order_type'] == 1){
                	$order_type = 'Delivery Now';
                }else if($value['order_type'] == 2){
                	$order_type = 'Delivery Later';
                }else if($value['order_type'] == 3){
                	$order_type = 'Takeout Now';
                }else if($value['order_type'] == 4){
                	$order_type = 'Takeout Later';
                }else if($value['order_type'] == 5){
                	$order_type = 'Weekly Delivery';
                }else if($value['order_type'] == 6){
                	$order_type = 'Weekly Takeout';
                }else{
                	$order_type = '';
                }

                if($value['order_status'] == 0){
                	$order_status = '<span class="badge badge-primary">Pending</span>';
                }else if($value['order_status'] == 1){
                	$order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                }else if($value['order_status'] == 2){
                	$order_status = '<span class="badge badge-danger">Rejected by Restaurant</span>';
                }else if($value['order_status'] == 3){
                	$order_status = '<span class="badge badge-info">Delivery Boy Assigned</span>';
                }else if($value['order_status'] == 4){
                	$order_status = '<span class="badge badge-info">Accepted by Delivery Boy</span>';
                }else if($value['order_status'] == 5){
                	$order_status = '<span class="badge badge-info">Picked up</span>';
                }else if($value['order_status'] == 6){
                	$order_status = '<span class="badge badge-success">Delivered</span>';
                }else if($value['order_status'] == 7){
                	$order_status = '<span class="badge badge-danger">Delivery Fail</span>';
                }else if($value['order_status'] == 8){
                	$order_status = '<span class="badge badge-danger">Canceled by Customer</span>';
                }else{
                	$order_status ='';
                }
		       	
		       	$data[] = array(
		            $value['id'],
		            $order_name,
		            $value["username"],
		            $value["shop_name"],
		            '&#36;'.$value["total"],
		            $order_type,
		            $created_date,
		            $order_status,
		            $status_str
		       	);

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($order_list),
	         "recordsFiltered" => count($order_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

  	public function takeout_orders(){
		$output_data['table_title'] = "Takeout Orders";
		$output_data['table_name'] = "takeout_orders";
		$output_data['main_content'] = "admin/orders";
		$this->load->view('template/template',$output_data);	
	}

	public function takeout_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	//get all delievry orders
	  	$order_type = array('3', '4');
	  	$order_list = $this->order_model->get_order($order_type);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

				$created_date_ts = strtotime($value["created_at"]);
                $created_date = date("j M, Y h:i A", $created_date_ts);

                if($value['order_type'] == 1){
                	$order_type = 'Delivery Now';
                }else if($value['order_type'] == 2){
                	$order_type = 'Delivery Later';
                }else if($value['order_type'] == 3){
                	$order_type = 'Takeout Now';
                }else if($value['order_type'] == 4){
                	$order_type = 'Takeout Later';
                }else if($value['order_type'] == 5){
                	$order_type = 'Weekly Delivery';
                }else if($value['order_type'] == 6){
                	$order_type = 'Weekly Takeout';
                }else{
                	$order_type = '';
                }

                if($value['order_status'] == 0){
                	$order_status = '<span class="badge badge-primary">Pending</span>';
                }else if($value['order_status'] == 1){
                	$order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                }else if($value['order_status'] == 2){
                	$order_status = '<span class="badge badge-danger">Rejected by Restaurant</span>';
                }else if($value['order_status'] == 3){
                	$order_status = '<span class="badge badge-info">Delivery Boy Assigned</span>';
                }else if($value['order_status'] == 4){
                	$order_status = '<span class="badge badge-info">Accepted by Delivery Boy</span>';
                }else if($value['order_status'] == 5){
                	$order_status = '<span class="badge badge-info">Picked up</span>';
                }else if($value['order_status'] == 6){
                	$order_status = '<span class="badge badge-success">Delivered</span>';
                }else if($value['order_status'] == 7){
                	$order_status = '<span class="badge badge-danger">Delivery Fail</span>';
                }else if($value['order_status'] == 8){
                	$order_status = '<span class="badge badge-danger">Canceled by Customer</span>';
                }else{
                	$order_status ='';
                }
		       	
		       	$data[] = array(
		            $value['id'],
		            $order_name,
		            $value["username"],
		            $value["shop_name"],
		            '&#36;'.$value["total"],
		            $order_type,
		            $created_date,
		            $order_status,
		            $status_str
		       	);

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($order_list),
	         "recordsFiltered" => count($order_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

  	public function weekly_orders(){
		$output_data['table_title'] = "Weekly Orders";
		$output_data['table_name'] = "weekly_orders";
		$output_data['main_content'] = "admin/orders";
		$this->load->view('template/template',$output_data);	
	}

	public function weekly_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	//get all delievry orders
	  	$order_type = array('5', '6');
	  	$order_list = $this->order_model->get_order($order_type);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

				$created_date_ts = strtotime($value["created_at"]);
                $created_date = date("j M, Y h:i A", $created_date_ts);

                if($value['order_type'] == 1){
                	$order_type = 'Delivery Now';
                }else if($value['order_type'] == 2){
                	$order_type = 'Delivery Later';
                }else if($value['order_type'] == 3){
                	$order_type = 'Takeout Now';
                }else if($value['order_type'] == 4){
                	$order_type = 'Takeout Later';
                }else if($value['order_type'] == 5){
                	$order_type = 'Weekly Delivery';
                }else if($value['order_type'] == 6){
                	$order_type = 'Weekly Takeout';
                }else{
                	$order_type = '';
                }

                if($value['order_status'] == 0){
                	$order_status = '<span class="badge badge-primary">Pending</span>';
                }else if($value['order_status'] == 1){
                	$order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                }else if($value['order_status'] == 2){
                	$order_status = '<span class="badge badge-danger">Rejected by Restaurant</span>';
                }else if($value['order_status'] == 3){
                	$order_status = '<span class="badge badge-info">Delivery Boy Assigned</span>';
                }else if($value['order_status'] == 4){
                	$order_status = '<span class="badge badge-info">Accepted by Delivery Boy</span>';
                }else if($value['order_status'] == 5){
                	$order_status = '<span class="badge badge-info">Picked up</span>';
                }else if($value['order_status'] == 6){
                	$order_status = '<span class="badge badge-success">Delivered</span>';
                }else if($value['order_status'] == 7){
                	$order_status = '<span class="badge badge-danger">Delivery Fail</span>';
                }else if($value['order_status'] == 8){
                	$order_status = '<span class="badge badge-danger">Canceled by Customer</span>';
                }else{
                	$order_status ='';
                }
		       	
		       	$data[] = array(
		            $value['id'],
		            $order_name,
		            $value["username"],
		            $value["shop_name"],
		            '&#36;'.$value["total"],
		            $order_type,
		            $created_date,
		            $order_status,
		            $status_str
		       	);

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($order_list),
	         "recordsFiltered" => count($order_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

}
