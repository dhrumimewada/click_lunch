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

		foreach($order_list as $key => $value) {

				$id = encrypt($value['id']);
				$order_name = 'CL'.$value['id'];

				if($is_dispatcher){
					$status_str = "<a href='".$order_view_url."/".$id."' class='btn btn-outline-primary waves-effect waves-light btn-sm' status-id='" . $value["order_status"] . "' title='View' data-popup='tooltip' > View</a> ";
					if($value['order_status'] == 0){
						$status_str .= "<button type='button' class='btn btn-sm btn-yellow waves-effect waves-light pending' title='Pending' data-popup='tooltip' disabled>Pending</button>";
					}elseif($value['order_status'] == 1){
						$status_str .= "<button type='button' class='btn btn-success btn-sm waves-effect waves-light assign-db' title='Assign to Delivery Boy' data-popup='tooltip' data-toggle='modal' data-target='#db-model' data-ordername='".$order_name."'> Assign</button>";
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

				$created_date_ts = strtotime($value["created_at"]);
                $created_date = date("j M, Y g:i a", $created_date_ts);
		       	
		       	$data[] = array(
		            $value['id'],
		            $order_name,
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
  		$where = array('deleted_at' => NULL, 'status' => 1);
        $select = array('id','username');
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