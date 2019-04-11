<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_vender()) || ($this->auth->is_admin()) ||($this->auth->is_dispatcher()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'orders')) ) ){
			
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

		$pickup_minutes = $this->config->item("pickup_minutes");
		$delivery_minutes = $this->config->item("delivery_minutes");

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				if($is_dispatcher){
					$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a> ";
					if($value['order_status'] == 3){
						$status_str .= "<button type='button' class='btn btn-sm btn-yellow waves-effect waves-light assign-db' title='Reassign Delivery Boy' data-popup='tooltip' data-toggle='modal' data-target='#db-model' data-ordername='".$order_name."' data-prev-db-id='" . $value["delivery_boy_id"] . "'>Reassign</button>";
					}else if($value['order_status'] == 1){
						$status_str .= "<button type='button' class='btn btn-success btn-sm waves-effect waves-light assign-db' title='Send Request to Delivery Boy' data-popup='tooltip' data-toggle='modal' data-target='#db-model' data-ordername='".$order_name."'>Send Request</button>";
					}else{

					}
				}else if($is_vender || $is_employee){
					$status_str = 
						"<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a>
						<button type='button' class='btn btn-success btn-sm waves-effect waves-light update-status' status-id='1' title='Accept' data-popup='tooltip' > Accept</button>
						<button type='button' class='btn btn-danger btn-sm waves-effect waves-light update-status' status-id='2' title='Reject' data-popup='tooltip' > Reject</button>";
				}else{
					$status_str = '';
				}

				$created_date_ts = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
				$created_date = $created_date_ts->format('j M, Y h:i A');

				if($value['order_type'] == 1 || 3){

                    $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                    $my_delivery_minutes = $delivery_minutes + $pickup_minutes;
                    $my_delivery_time = $my_date->add(new DateInterval('PT'.$my_delivery_minutes.'M'));
                    $delivery_time = $my_delivery_time->format('j M, Y h:i A');
                    $delivery_time_ts = $my_delivery_time->format('Y-m-d H:i:s');

                }else if($value['order_type'] == 2 || 4){

                    $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                    $my_created_date = $my_date->format('Y-m-d');
                    $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $my_created_date.' '.$value['later_time']);
                    $delivery_time = $later_datetime->format('j M, Y h:i A');
                    $delivery_time_ts = $later_datetime->format('Y-m-d H:i:s');


                }else if($value['order_type'] == 5 || 6){

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
		            $value["shop_name"],
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

  	public function order_detail($id = NULL){

  		$output_data['is_vender'] = $this->auth->is_vender();
		$output_data['is_employee'] = $this->auth->is_employee();
		$output_data['is_dispatcher'] = $this->auth->is_dispatcher();
		$output_data['is_admin'] = $this->auth->is_admin();

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
  		$output_data['main_content'] = "dispatcher/order/order_detail";
		$this->load->view('template/template',$output_data);	
  	}

  	public function get_all_db(){
  		$where = array('deleted_at' => NULL, 'status' => 1, 'device_token !=' => '');
        $select = array('id','username','mobile_number');
        $table = 'delivery_boy';
        $data = get_data_by_filter($table,$select, $where);
  		if(isset($data) && is_array($data) && !empty($data)){
  			echo json_encode($data);
			return TRUE;
		}else{
			return FALSE;
		}
  	}

  	public function set_db(){
  		$delivery_boy_id = intval($_POST['db_id']);
  		$order_id = intval($_POST['order_id']);

  		if (isset($order_id) && !is_null($order_id) && !empty($order_id) && isset($delivery_boy_id) && !is_null($delivery_boy_id) && !empty($delivery_boy_id)) {
  			$result = $this->order_model->set_delivery_boy();
  			echo $result;
			return TRUE;
  		}else{
  			return FALSE;
  		}
  	}

  	public function order_status_update(){
  		$order_id = $id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('order_status' => $status,'updated_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('orders', $user_data);

			$customer_data = array();
			$this->db->select('t1.device_type, t1.device_token, t2.customer_id');
			$this->db->from('customer t1');
			$this->db->join('orders t2', 't1.id = t2.customer_id');
			$this->db->where('t2.id', $order_id);
			$this->db->where('t1.device_type !=', '');
			$this->db->where('t1.device_type !=', 0);
			$this->db->where('t1.device_token !=', '');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$customer_data = (array)$sql_query->row();

				$device_type = $customer_data['device_type'];
				$device_token = $customer_data['device_token'];

				if($status == 1){
					$push_title = 'Order Accepted by Restaurant';
					$message = 'Your order no. CL'.$order_id.' has been accepted by restaurant.';
					$push_type = 'order_accepted';
					$notification_type = 2;
				}else{
					$push_title = 'Order Rejected by Restaurant';
					$message = 'Your order no. CL'.$order_id.' has been rejected by restaurant.';
					$push_type = 'order_rejected';
					$notification_type = 3;
				}
				
				$push_data = array(
						'order_id' => $order_id,
						'customer_id' => $_POST['customer_id'],
						'message' => $message
						);
				$result = send_push($device_type,$device_token, $push_title, $push_data, $push_type);

				$success_data = notification_add($notification_type, $customer_data['customer_id'], $push_title, $message, $order_id);
				$notification_store_data= array('notification_type' => $notification_type, 'customer_id' => $customer_data['customer_id'], 'push_title' => $push_title, 'message' =>$message, 'order_id' => $order_id);
			}

			echo json_encode(array("is_success" => true, 'notification_store_data' => $notification_store_data));
			return TRUE;
		}else{
			return FALSE;
		}
  	}

  	public function test(){
  		$success_data = notification_add(2, '33', 'ffff', 'gfff', 195);
  		echo "<pre>";
  		print_r($success_data);
  		exit;
  	}

  	public function quantity_update_reject_order(){
  		// increse quantity of products of order if shop reject the order
  		if (isset($_POST['order_id']) && !is_null($_POST['order_id']) && !empty($_POST['order_id'])){

  			$this->db->select('item_id, quantity');
			$this->db->from('order_items');
			$this->db->where('order_id', $_POST['order_id']);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$return_data = $sql_query->result_array();
				foreach ($return_data as $key => $value) {

					$this->db->select('quantity');
					$this->db->from('item');
					$this->db->where('id', $value['item_id']);
					$sql_query = $this->db->get();
					if ($sql_query->num_rows() > 0){
						$item_data = (array)$sql_query->row();
						$quantity = $item_data['quantity'] + $value['quantity'];
						$update_data = array('quantity' => $quantity);
						$this->db->where('id', $value['item_id']);
						$this->db->update('item', $update_data);
					}

				}

				echo json_encode(array("is_success" => true));
				return TRUE;
			}else{
				echo json_encode(array("is_success" => false));
				return TRUE;
			}
  		}else{
			return FALSE;
		}
  	}

  	public function all_orders(){
		$output_data['table_title'] = "All Orders";
		$output_data['table_name'] = "all_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";
		$this->load->view('template/template',$output_data);	
	}

	public function all_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_list = $this->order_model->get_all_order();

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant</span>';
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

  	public function db_assigned_orders(){
		$output_data['table_title'] = "New Orders";
		$output_data['table_name'] = "db_assigned_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";

		$this->load->view('template/template',$output_data);	
	}

	public function db_assigned_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('3','4');
	  	$order_list = $this->order_model->get_all_order($order_status);

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant</span>';
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

  	public function live_orders(){
		$output_data['table_title'] = "Live Orders";
		$output_data['table_name'] = "live_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";

		$this->load->view('template/template',$output_data);	
	}

	public function live_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('5');
	  	$order_list = $this->order_model->get_all_order($order_status);

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant</span>';
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

  	public function cancel_orders(){
		$output_data['table_title'] = "Cancelled Orders";
		$output_data['table_name'] = "cancel_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";

		$this->load->view('template/template',$output_data);	
	}

	public function cancel_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('2','7','8');
	  	$order_list = $this->order_model->get_all_order($order_status);

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant</span>';
                }else if($value['order_status'] == 1){
                	$order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                }else if($value['order_status'] == 2){
                	$order_status = '<span class="badge badge-danger">Cancelled by Restaurant</span>';
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

  	public function completed_orders(){
		$output_data['table_title'] = "Completed Orders";
		$output_data['table_name'] = "completed_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";

		$this->load->view('template/template',$output_data);	
	}

	public function completed_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$order_status = array('6');
	  	$order_list = $this->order_model->get_all_order($order_status);

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant</span>';
                }else if($value['order_status'] == 1){
                	$order_status = '<span class="badge badge-info">Accepted by Restaurant</span>';
                }else if($value['order_status'] == 2){
                	$order_status = '<span class="badge badge-danger">Cancelled by Restaurant</span>';
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

  	public function weekly_orders(){
		$output_data['table_title'] = "weekly Orders";
		$output_data['table_name'] = "all_weekly_orders";
		$output_data['main_content'] = "dispatcher/order/all_orders";

		$this->load->view('template/template',$output_data);	
	}

	public function all_weekly_orders_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$weekly_orders = array('5', '6');
	  	$weekly_orders = array();
	  	$order_list = $this->order_model->get_all_order(array(), $weekly_orders);

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
                	$order_status = '<span class="badge badge-primary">Pending from Restaurant from Restaurant</span>';
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