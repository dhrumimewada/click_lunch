<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

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
		$this->load->model("vender/order_model");
	}

	public function order_detail($id = NULL){

  // 		$output_data['is_vender'] = $this->auth->is_vender();
		// $output_data['is_employee'] = $this->auth->is_employee();
		// $output_data['is_dispatcher'] = $this->auth->is_dispatcher();
		// $output_data['is_admin'] = $this->auth->is_admin();

  		$order_data = $this->order_model->get_order_detail($id);
  		// echo "<pre>";
  		// print_r($order_data);
  		// exit;
  		$order_type = $order_data['order']->order_type;
  		if($order_type == 1){
        	$order_type = 'Delivery Now';
        }else if($order_type == 2){
        	$order_type = 'Delivery Later';
        }else if($order_type == 3){
        	$order_type = 'Takeout Now';
        }else if($order_type == 4){
        	$order_type = 'Takeout Later';
        }else if($order_type == 5){
        	$order_type = 'Weekly Delivery';
        }else if($order_type == 6){
        	$order_type = 'Weekly Takeout';
        }else{
        	$order_type = '';
        }

  		$output_data['order_data'] = $order_data;
  		$output_data['order_type'] = $order_type;
  		$output_data['main_content'] = "vender/order/order_detail";
		$this->load->view('template/template',$output_data);	
  	}

	public function accepted(){

		$output_data['table_title'] = "Accepted Orders";
		$output_data['table_name'] = "accepted_orders";
		$output_data['main_content'] = "vender/order/index";
		$this->load->view('template/template',$output_data);	
	}

	public function accepted_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('1');
	  	$order_list = $this->order_model->get_order($order_status);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

				$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
				$created_date = $created_date_ts->format('j M, Y h:i A');

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

                $order_status ='<span class="badge badge-info">Accepted by Restaurant</span>';
		       	
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

  	public function rejected(){

		$output_data['table_title'] = "Rejected Orders";
		$output_data['table_name'] = "rejected_orders";
		$output_data['main_content'] = "vender/order/index";
		$this->load->view('template/template',$output_data);	
	}

	public function rejected_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('2','7');
	  	$order_list = $this->order_model->get_order($order_status);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

				$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
				$created_date = $created_date_ts->format('j M, Y h:i A');

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
                	$order_status = '<span class="badge badge-danger">Cancelled by Customer</span>';
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

  	public function today(){

		$output_data['table_title'] = "Current Orders";
		$output_data['table_name'] = "today_orders";
		$output_data['main_content'] = "vender/order/order_today_upcoming";
		$this->load->view('template/template',$output_data);	
	}

	public function today_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$today_upcoming = 1; //get today
	  	$order_list = $this->order_model->get_today_upcoming_order($today_upcoming);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		$pickup_minutes = $this->config->item("pickup_minutes");
		$delivery_minutes = $this->config->item("delivery_minutes");

		foreach($order_list as $key => $value) {

			$id = encrypt($value['id']);
			$order_name = 'CL'.$value['id'];

			$status_str = 
					"<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

			if(($value['order_type'] == 3) || ($value['order_type'] == 4) || ($value['order_type'] == 6)){
				$status_str .= 
					"<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' status-id='1' title='Completed' data-popup='tooltip' > Completed</button>
					<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' status-id='2' title='Cancel' data-popup='tooltip' > Cancel</button>";
			}

			$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
			$created_date = $created_date_ts->format('j M, Y h:i A');

			if(($value['order_type'] == 1) || ($value['order_type'] == 3)){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_delivery_minutes = $delivery_minutes + $pickup_minutes;
                $my_delivery_time = $my_date->add(new DateInterval('PT'.$my_delivery_minutes.'M'));
                $delivery_time = $my_delivery_time->format('j M, Y h:i A');
                $delivery_time_ts = $my_delivery_time->format('Y-m-d H:i:s');

            }else if(($value['order_type'] == 2) || ($value['order_type'] == 4)){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_created_date = $my_date->format('Y-m-d');
                $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $my_created_date.' '.$value['later_time']);
                $delivery_time = $later_datetime->format('j M, Y h:i A');
                $delivery_time_ts = $later_datetime->format('Y-m-d H:i:s');


            }else if(($value['order_type'] == 5) || ($value['order_type'] == 6)){

                $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                $delivery_time = $my_date->format('j M, Y h:i A');
                $delivery_time_ts = $my_date->format('Y-m-d H:i:s');

            }else{

                $delivery_time = '';
                $delivery_time_ts = date('Y-m-d H:i:s');
            }
	       	
	       	$data[] = array(
	            $value['id'],
	            $order_name,
	            $value["username"],
	            '&#36;'.$value["total"],
	            $created_date,
	            $delivery_time,
	            $delivery_time_ts,
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

  	public function upcoming(){

		$output_data['table_title'] = "Upcoming Orders";
		$output_data['table_name'] = "upcoming_orders";
		$output_data['main_content'] = "vender/order/order_today_upcoming";
		$this->load->view('template/template',$output_data);	
	}

	public function upcoming_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$today_upcoming = 2; //get today
	  	$order_list = $this->order_model->get_today_upcoming_order($today_upcoming);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		$pickup_minutes = $this->config->item("pickup_minutes");
		$delivery_minutes = $this->config->item("delivery_minutes");

		foreach($order_list as $key => $value) {

			$id = encrypt($value['id']);
			$order_name = 'CL'.$value['id'];

			$status_str = 
					"<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";

			if(($value['order_type'] == 3) || ($value['order_type'] == 4) || ($value['order_type'] == 6)){
				$status_str .= 
					"<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' status-id='1' title='Completed' data-popup='tooltip' > Completed</button>
					<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' status-id='2' title='Cancel' data-popup='tooltip' > Cancel</button>";
			}

			$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
			$created_date = $created_date_ts->format('j M, Y h:i A');

			if(($value['order_type'] == 1) || ($value['order_type'] == 3)){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_delivery_minutes = $delivery_minutes + $pickup_minutes;
                $my_delivery_time = $my_date->add(new DateInterval('PT'.$my_delivery_minutes.'M'));
                $delivery_time = $my_delivery_time->format('j M, Y h:i A');
                $delivery_time_ts = $my_delivery_time->format('Y-m-d H:i:s');

            }else if(($value['order_type'] == 2) || ($value['order_type'] == 4)){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_created_date = $my_date->format('Y-m-d');
                $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $my_created_date.' '.$value['later_time']);
                $delivery_time = $later_datetime->format('j M, Y h:i A');
                $delivery_time_ts = $later_datetime->format('Y-m-d H:i:s');


            }else if(($value['order_type'] == 5) || ($value['order_type'] == 6)){

                $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                $delivery_time = $my_date->format('j M, Y h:i A');
                $delivery_time_ts = $my_date->format('Y-m-d H:i:s');

            }else{

                $delivery_time = '';
                $delivery_time_ts = date('Y-m-d H:i:s');
            }
	       	
	       	$data[] = array(
	            $value['id'],
	            $order_name,
	            $value["username"],
	            '&#36;'.$value["total"],
	            $created_date,
	            $delivery_time,
	            $delivery_time_ts,
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

  	public function completed(){

		$output_data['table_title'] = "Completed Orders";
		$output_data['table_name'] = "completed_orders_vender";
		$output_data['main_content'] = "vender/order/index";
		$this->load->view('template/template',$output_data);	
	}

	public function completed_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('6');
	  	$order_list = $this->order_model->get_order($order_status);

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";
				// <button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-trash' status-id='1' title='Trash' data-popup='tooltip' >Trash</button>

				$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
				$created_date = $created_date_ts->format('j M, Y h:i A');

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
                	$order_status = '<span class="badge badge-danger">Cancelled by Customer</span>';
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

  	public function all(){

		$output_data['table_title'] = "All Orders";
		$output_data['table_name'] = "all_orders_vender";
		$output_data['main_content'] = "vender/order/index";
		$this->load->view('template/template',$output_data);	
	}

	public function all_order_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_list = $this->order_model->get_order();

	 	$data = array();
	 	$action_data = '';
	 	$order_view_url = base_url().'vender-order-detail';

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>";
				// <button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-trash' status-id='1' title='Trash' data-popup='tooltip' >Trash</button>

				$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
				$created_date = $created_date_ts->format('j M, Y h:i A');

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
                	$order_status = '<span class="badge badge-primary">Arrived</span>';
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
                	$order_status = '<span class="badge badge-danger">Cancelled by Customer</span>';
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
