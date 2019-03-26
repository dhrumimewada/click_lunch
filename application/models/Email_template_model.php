<?php

class Email_template_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_templates($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('email_template');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where("emat_is_active", 1);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			if (isset($id) && !is_null($id)) {
				$return_data = $sql_query->row();
			}else{
				$return_data = $sql_query->result_array();
			}
			
		}
		return $return_data;
	}

	public function get_table_data($table_name = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where("deleted_at", NULL);
		
		if($table_name == 'item'){
			$this->db->where("is_active", 1);
		}else{
			$this->db->where("status", 1);
		}

		if($this->auth->is_vender()){
			$this->db->where("shop_id", $this->auth->get_user_id());
		}else if($this->auth->is_employee()){
			$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
		}else{

		}
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function put() {

		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data = array(
						'emat_email_subject' => $this->input->post("emat_email_subject"),
						'emat_email_message' => $this->input->post("emat_email_message"),
						'updated_at' => date('Y-m-d H:i:s')
					);

		$this->db->where("emat_email_type", $this->input->post("emat_email_type"));
		$response = $this->db->update("email_template", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating template");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Template updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function send_custom_email(){
		$return_value = FALSE;

		$from = "";
		$subject = $this->input->post("emat_email_subject");
		$email_message_string = $this->input->post("emat_email_message");
		$message = $this->load->view("email_templates/custom_mail", array("mail_body" => $email_message_string), TRUE);

		$this->db->select('email');
		$this->db->from($this->input->post("to_type"));
		$this->db->where_in("id", $this->input->post("email_to"));
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();

			$emails = array_column($return_data, 'email');
			$email_data = implode(',', $emails);
			$total_sended = count($emails);
			$mail = sendmail($from, $email_data, $subject, $message);

			$this->auth->set_status_message("Total ".$total_sended. " emails sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("Something went wrong. please try again later");
		}
		return $return_value;
	}

	public function send_custom_email_customer(){
		$return_value = FALSE;

		$from = "";
		$subject = $this->input->post("emat_email_subject");
		$email_message_string = $this->input->post("emat_email_message");
		$message = $this->load->view("email_templates/custom_mail", array("mail_body" => $email_message_string), TRUE);

		$emails_array = array();

        if($this->input->post("group") == 4){

        	if($this->auth->is_admin()){
        		$this->db->select('email');
		        $this->db->where("deleted_at", NULL);
		        $this->db->where("status", 1);
		        $this->db->from('customer');
		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	$emails_array = array_column($customers_data, 'email');
		        }
        	}else{

		        $this->db->select('t2.email');
		        $this->db->where("t2.deleted_at", NULL);
		        $this->db->where("t2.status", 1);

		        if($this->auth->is_vender()){
					$this->db->where("t1.shop_id", $this->auth->get_user_id());
				}else if($this->auth->is_employee()){
					$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
				}

				$this->db->from('orders t1');
		        $this->db->join('customer t2', 't1.customer_id = t2.id');
		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	$emails_array = array_column($customers_data, 'email');
		        }

        	}

		}else if($this->input->post("group") == 6){

			$emails_array = $this->get_X_ordered_customers(intval($this->input->post("no_of_orders")));

		}else if($this->input->post("group") == 7){

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item'])){

				$this->db->select('t2.email,t1.id');
		        $this->db->where("t2.deleted_at", NULL);
		        $this->db->where("t2.status", 1);

		        if($this->auth->is_vender()){
					$this->db->where("t1.shop_id", $this->auth->get_user_id());
				}else if($this->auth->is_employee()){
					$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
				}

				$this->db->from('orders t1');
		        $this->db->join('customer t2', 't1.customer_id = t2.id');
		        $this->db->join('order_items t3', 't1.id = t3.order_id');

		        $this->db->where_in("t3.item_id", $this->input->post("item"));

		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	$emails_array = array_column($customers_data, 'email');
		        }

			}

		}else if($this->input->post("group") == 1){

			$emails_array = $this->get_new_customers();

		}else if($this->input->post("group") == 5){

			if(isset($_POST['shop']) && is_array($_POST['shop']) && !empty($_POST['shop'])){

				$this->db->select('t1.email');
				$this->db->from('customer t1');
				$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
				$this->db->where('t1.deleted_at', NULL);
				$this->db->where('t1.status', 1);
				$this->db->where_in('t2.shop_id', $_POST['shop']);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$valid_customers = $sql_query->result_array();
					$emails_array = array_column($valid_customers, 'email');
				}

			}

		}else{

		}

		if(is_array($emails_array) && !empty($emails_array)){
			$emails_array = array_unique($emails_array);
			$email_data = implode(',', $emails_array);
			$total_sended = count($emails_array);
			$mail = sendmail($from, $email_data, $subject, $message);
			
			$this->auth->set_status_message("Total ".$total_sended. " emails sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("No any user found");
		}

		return $return_value;	
	}

	public function get_X_ordered_customers($X_number_of_order = NULL){
		$return_data = array();

		if(isset($X_number_of_order) && $X_number_of_order != ''){
			$this->db->select('t1.email');
			$this->db->from('customer t1');
			$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
			$this->db->where('t1.deleted_at', NULL);
			$this->db->where('t1.status', 1);
			$this->db->where('t2.order_status', 6);

			if($this->auth->is_vender()){
				$this->db->where("t2.shop_id", $this->auth->get_user_id());
			}else if($this->auth->is_employee()){
				$this->db->where("t2.shop_id",$this->auth->get_emp_shop_id());
			}

			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$valid_customers = $sql_query->result_array();
				$emails_array = array_column($valid_customers, 'email');
				$total = array_count_values($emails_array);
				$return_data = array();
				foreach ($total as $key => $value) {
					if($value >= $X_number_of_order){
						array_push($return_data, $key);
					}
				}
			}
		}
		
		return $return_data;
	}

	public function get_X_ordered_customers_for_push($X_number_of_order = NULL){
		$return_data = array();

		if(isset($X_number_of_order) && $X_number_of_order != ''){
			$this->db->select('t1.device_type,t1.device_token,t1.id');
			$this->db->from('customer t1');
			$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
			$this->db->where('t1.deleted_at', NULL);
			$this->db->where('t1.status', 1);
			$this->db->where('t2.order_status', 6);

			if($this->auth->is_vender()){
				$this->db->where("t2.shop_id", $this->auth->get_user_id());
			}else if($this->auth->is_employee()){
				$this->db->where("t2.shop_id",$this->auth->get_emp_shop_id());
			}

			$device_type = array('1','2');
	        $this->db->where_in("t1.device_type", $device_type);
	        $this->db->where("t1.device_token !=", '');

			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$valid_customers = $sql_query->result_array();
				$ids_array = array_column($valid_customers, 'id');
				$total_data = array_count_values($ids_array);
				$return_data = array();
				foreach ($total_data as $key => $value) {
					if($value >= $X_number_of_order){
						foreach ($valid_customers as $key1 => $value1) {
							if($value1['id'] == $key){
								array_push($return_data, $valid_customers[$key1]);
							}
						}
					}
				}
			}
		}
		return $return_data;
	}

	public function get_new_customers(){
		$return_data = array();

		$this->db->select('t1.email');
		$this->db->from('customer t1');
		$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
		$this->db->where('t2.customer_id IS NULL',null,true);
		$this->db->where('t1.deleted_at', NULL);
		$this->db->where('t1.status', 1);

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$customer_data = $sql_query->result_array();
			$return_data = array_column($customer_data, 'email');
		}

		return $return_data;
	}

	public function get_new_customers_for_push(){
		$return_data = array();

		$this->db->select('t1.device_type,t1.device_token');
		$this->db->from('customer t1');
		$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
		$this->db->where('t2.customer_id IS NULL',null,true);
		$this->db->where('t1.deleted_at', NULL);
		$this->db->where('t1.status', 1);

		$device_type = array('1','2');
		$this->db->where_in("t1.device_type", $device_type);
		$this->db->where("t1.device_token !=", '');

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
		}
		//return $this->db->last_query();
		return $return_data;
	}

	public function send_custom_push_customer(){

		$return_value = FALSE;

		$notification_title = $this->input->post("notification_title");
		$notification_message = $this->input->post("notification_message");

		$emails_array = array();

        if($this->input->post("group") == 4){

        	if($this->auth->is_admin()){
        		$this->db->select('device_type,device_token');
		        $this->db->where("deleted_at", NULL);
		        $this->db->where("status", 1);

		        $device_type = array('1','2');
		        $this->db->where_in("device_type", $device_type);
		        $this->db->where("device_token !=", '');

		        $this->db->from('customer');
		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	//$emails_array = array_column($customers_data, 'email');
		        	$emails_array = $customers_data;
		        }
        	}else{

		        $this->db->select('t2.device_type,t2.device_token');
		        $this->db->where("t2.deleted_at", NULL);
		        $this->db->where("t2.status", 1);

		        if($this->auth->is_vender()){
					$this->db->where("t1.shop_id", $this->auth->get_user_id());
				}else if($this->auth->is_employee()){
					$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
				}

				$device_type = array('1','2');
		        $this->db->where_in("t2.device_type", $device_type);
		        $this->db->where("t2.device_token !=", '');

				$this->db->from('orders t1');
		        $this->db->join('customer t2', 't1.customer_id = t2.id');
		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	//$emails_array = array_column($customers_data, 'email');
		        	$emails_array = $customers_data;
		        }

        	}

		}else if($this->input->post("group") == 6){

			$emails_array = $this->get_X_ordered_customers_for_push(intval($this->input->post("no_of_orders")));

		}else if($this->input->post("group") == 7){

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item'])){

				$this->db->select('t2.device_type,t2.device_token,t1.id');
		        $this->db->where("t2.deleted_at", NULL);
		        $this->db->where("t2.status", 1);

		        if($this->auth->is_vender()){
					$this->db->where("t1.shop_id", $this->auth->get_user_id());
				}else if($this->auth->is_employee()){
					$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
				}

				$this->db->from('orders t1');
		        $this->db->join('customer t2', 't1.customer_id = t2.id');
		        $this->db->join('order_items t3', 't1.id = t3.order_id');

		        $this->db->where_in("t3.item_id", $this->input->post("item"));

		        $sql_query = $this->db->get();
		        if ($sql_query->num_rows() > 0){
		        	$customers_data = $sql_query->result_array();
		        	//$emails_array = array_column($customers_data, 'email');
		        	$emails_array = $customers_data;
		        }

			}

		}else if($this->input->post("group") == 1){

			$emails_array = $this->get_new_customers_for_push();

		}else if($this->input->post("group") == 5){

			if(isset($_POST['shop']) && is_array($_POST['shop']) && !empty($_POST['shop'])){

				$this->db->select('t1.device_type,t1.device_token');
				$this->db->from('customer t1');
				$this->db->join('orders t2', 't1.id = t2.customer_id', "left");
				$this->db->where('t1.deleted_at', NULL);
				$this->db->where('t1.status', 1);
				$this->db->where_in('t2.shop_id', $_POST['shop']);

				$device_type = array('1','2');
		        $this->db->where_in("t1.device_type", $device_type);
		        $this->db->where("t1.device_token !=", '');

				$sql_query = $this->db->get();
				//return $this->db->last_query();
				if ($sql_query->num_rows() > 0){

					$customers_data = $sql_query->result_array();
					//$emails_array = array_column($customers_data, 'email');
					$emails_array = $customers_data;
				}

			}

		}else{

		}

		if(is_array($emails_array) && !empty($emails_array)){
			$unique_array = array_map("unserialize", array_unique(array_map("serialize", $emails_array)));
			//return $unique_array;

			$ios_data = array();
  			$android_data = array();

			foreach ($unique_array as $key => $value) {
				if($value['device_type'] == 1){
	  				array_push($android_data, $device_type_token_array[$key]['device_token']);
	  			}else if($value['device_type'] == 2){
	  				array_push($ios_data, $device_type_token_array[$key]['device_token']);
	  			}else{

	  			}
			}

			if(!empty($android_data)){
				$data1 = send_push_multiple_android($android_data, $ios_data, $notification_title, $notification_message, 'admin_notification');
			}
			if(!empty($ios_data)){
				$data2 = send_push_multiple_ios($ios_data, $notification_title, $notification_message, 'admin_notification');
			}
			
			$this->auth->set_status_message("Notification(s) sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("No any customer found");
		}

		return $return_value;	
	}

	public function send_custom_push_shop(){
		$return_value = FALSE;

		$notification_title = $this->input->post("notification_title");
		$notification_message = $this->input->post("notification_message");

		$this->db->select('device_token');
		$this->db->from('shop');
		$this->db->where('device_token !=', '');
		$this->db->where('t1.deleted_at', NULL);
		$this->db->where('t1.status', 1);

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$shop_data = $sql_query->result_array();
			$shop_devices = array_column($shop_data, 'device_token');

			if(isset($shop_devices) && is_array($shop_devices) && !empty($shop_devices)){
				$data = send_push_multiple_ios($shop_devices, $notification_title, $notification_message, 'admin_notification');
			}

			$this->auth->set_status_message("Notification(s) sent successfully");
			$return_value = TRUE;
		}else{
			$this->auth->set_error_message("No any logged in restaurant found");
		}	
		return $return_value;
	}
	
}