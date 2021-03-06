<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'orders')) ) ))
		{
			
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


			$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
			$created_date = $created_date_ts->format('j M, Y h:i A');

			if($value['order_type'] == 1){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_delivery_minutes = $delivery_minutes + $pickup_minutes;
                $my_delivery_time = $my_date->add(new DateInterval('PT'.$my_delivery_minutes.'M'));
                $delivery_time = $my_delivery_time->format('j M, Y h:i A');
                $delivery_time_ts = $my_delivery_time->format('Y-m-d H:i:s');

            }else if($value['order_type'] == 3){

            	$my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
            	$my_delivery_time = $my_date->add(new DateInterval('PT'.$pickup_minutes.'M'));

                $delivery_time = $my_delivery_time->format('j M, Y h:i A');
                $delivery_time_ts = $my_date->format('Y-m-d H:i:s');

                $current_datetime = new DateTime();
                if($my_delivery_time <= $current_datetime){
                	$status_str .= 
						"<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' title='Completed' data-popup='tooltip' status-id='6'> Completed</button>
						<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' title='Cancel' data-popup='tooltip' status-id='8' > Cancel</button>";
                }
                
            }else if(($value['order_type'] == 2) || ($value['order_type'] == 4)){

                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                $my_created_date = $my_date->format('Y-m-d');
                $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $my_created_date.' '.$value['later_time']);
                $delivery_time = $later_datetime->format('j M, Y h:i A');
                $delivery_time_ts = $later_datetime->format('Y-m-d H:i:s');

                $current_datetime = new DateTime();

                if(($value['order_type'] == 4) && ($later_datetime <= $current_datetime)){
                	$status_str .= 
					"<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' title='Completed' data-popup='tooltip' status-id='6'> Completed</button>
					<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' title='Cancel' data-popup='tooltip' status-id='8'> Cancel</button>";
                }
            }else if(($value['order_type'] == 5) || ($value['order_type'] == 6)){

                $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                $delivery_time = $my_date->format('j M, Y h:i A');
                $delivery_time_ts = $my_date->format('Y-m-d H:i:s');

                $current_datetime = new DateTime();

                if(($value['order_type'] == 6) && ($my_date <= $current_datetime)){
                	$status_str .= 
					"<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' status-id='6' title='Completed' data-popup='tooltip' > Completed</button>
					<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' status-id='8' title='Cancel' data-popup='tooltip' > Cancel</button>";
                }

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

  	public function vender_order_status_update(){

  		$order_id = $_POST['id'];
		$status = $_POST['status'];

		if (isset($order_id) && !is_null($order_id) && !empty($order_id)){

			$user_data = array('order_status' => $status,'updated_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $order_id);
			$this->db->update('orders', $user_data);

			$customer_data = array();
			$this->db->select('t2.customer_id, t1.device_type, t1.device_token, t1.email, t2.customer_id, t3.shop_name');
			$this->db->from('customer t1');
			$this->db->join('orders t2', 't1.id = t2.customer_id');
			$this->db->join('shop t3', 't2.shop_id = t3.id');
			$this->db->where('t2.id', $order_id);
			$this->db->where('t1.device_type !=', '');
			$this->db->where('t1.device_type !=', 0);
			$this->db->where('t1.device_token !=', '');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$customer_data = (array)$sql_query->row();

				$device_type = $customer_data['device_type'];
				$device_token = $customer_data['device_token'];

				if($status == 6){
					$push_title = 'Order Completed';
					$message = 'Your order no. CL'.$order_id.' from '.stripslashes($customer_data['shop_name']).' has been completed.';
					$push_type = 'order_completed';
					$notification_type = 7;
				}else{
					$push_title = 'Order Cancelled';
					$message = 'Your order no. CL'.$order_id.' from '.stripslashes($customer_data['shop_name']).' has been cancelled.';
					$push_type = 'order_rejected';
					$notification_type = 3;
				}
				
				$push_data = array(
						'order_id' => $order_id,
						'customer_id' => $customer_data['customer_id'],
						'message' => $message
						);
				$result = send_push($device_type,$device_token, $push_title, $push_data, $push_type);

				$success_data = notification_add($notification_type, $customer_data['customer_id'], $push_title, $message, $order_id);
				$notification_store_data= array('notification_type' => $notification_type, 'customer_id' => $customer_data['customer_id'], 'push_title' => $push_title, 'message' => $message, 'order_id' => $order_id);

				// send mail

				// send mail
                $this->db->select('emat_email_subject,emat_email_message');
                $this->db->from('email_template');

                 if($status == 6){
                	$this->db->where('emat_email_type', 10);
                }else{
                	$this->db->where('emat_email_type', 11);
                }
                
                $this->db->where("emat_is_active", 1);
                $sql_query = $this->db->get();
                $return_data = $sql_query->row();

                if (!isset($return_data) && empty($return_data)){
                    echo json_encode(array("is_success" => false, 'message' => 'Email template not found. Error into sending mail.'));
					return TRUE;
                }else{

                    $email_var_data["order_id"] = 'CL'.$order_id;
                    $email_var_data["shop_name"] = $customer_data['shop_name'];

                    $from = "";
                    $to =  array($customer_data['email']);
                    $subject = $return_data->emat_email_subject;

                    $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                    $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                    $mail = sendmail($from, $to, $subject, $message);
                }


			}

			if($status == 6){
				$str = 'completed.';
			}else{
				$str = 'cancelled.';
			}

			echo json_encode(array("is_success" => true, 'message' => 'Order CL'.$order_id.' has been '. $str));
			return TRUE;

		}else{
			echo json_encode(array("is_success" => false, 'message' => 'Parameter not found'));
			return TRUE;
		}

  		
  	}

}
