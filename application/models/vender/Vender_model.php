<?php

class Vender_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
	}

	public function get_vender_detail($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('shop');
		$this->db->where("deleted_at", NULL);
		$this->db->where("id", $id);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->row();
		}
		return $return_data;
	}

	public function get_vender_cuisine($id = NULL){
		$return_data = array();
		$sql_select = array("t1.*", "t2.*");
		$this->db->select($sql_select);
		$this->db->where('t1.shop_id', $id);
		$this->db->from('shop_cuisines t1');
		$this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_shop_availibality($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->where("shop_id", $id);
		$this->db->from('shop_availibality');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_shop_hour($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->where("shop_id", $id);
		$this->db->from('shop_hours');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function update_profile($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if($this->auth->is_vender()){
			$user_id = $this->auth->get_user_id();
		}else if(($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'profile')) ){
			$user_id = $this->auth->get_emp_shop_id();
		}else{
			$user_id = '';
		}
		   
		$from_time_selected = DateTime::createFromFormat('H:i',$this->config->item("start_time_defualt"));
		$to_time_selected = DateTime::createFromFormat('H:i',$this->config->item("end_time_defualt"));

		$availability = array();
		 
		$this->db->where('shop_id',$user_id);
		$this->db->delete('shop_hours');

		$shop_hours_array = array();

		$order_morning = array('shop_id' => $user_id,
							'order_delivery' => 1,
							'morning_evening' => 1,
							'from_time' => $this->input->post("order_morning_from"),
							'to_time' => $this->input->post("order_morning_to")
							);
		$order_evening = array('shop_id' => $user_id,
							'order_delivery' => 1,
							'morning_evening' => 2,
							'from_time' => $this->input->post("order_evening_from"),
							'to_time' => $this->input->post("order_evening_to")
							);

		$delivery_morning = array('shop_id' => $user_id,
							'order_delivery' => 2,
							'morning_evening' => 1,
							'from_time' => $this->input->post("delivery_morning_from"),
							'to_time' => $this->input->post("delivery_morning_to")
							);
		$delivery_evening = array('shop_id' => $user_id,
							'order_delivery' =>2,
							'morning_evening' => 2,
							'from_time' => $this->input->post("delivery_evening_from"),
							'to_time' => $this->input->post("delivery_evening_to")
							);

		array_push($shop_hours_array, $order_morning);
		array_push($shop_hours_array, $order_evening);
		array_push($shop_hours_array, $delivery_morning);
		array_push($shop_hours_array, $delivery_evening);

		$this->db->insert_batch('shop_hours', $shop_hours_array); 

		foreach ($this->config->item("days") as $key => $value){
		  
		  	if (!empty($_POST[$value]) && sizeof($_POST[$value]) != 0){
		  		// If not closed

			  	if($_POST[$value][0] == 'fullday'){
			  		// If full day open
			  		//echo 'full day';
			  		$availability[$value]['full_day'] = '1';
			  		$availability[$value]['closed'] = '0';
			  		$availability[$value]['from'] = '';
			  		$availability[$value]['to'] = '';
			  	}else{
			  		// If custom time open
			  		$availability[$value]['full_day'] = '0';
			  		$availability[$value]['closed'] = '0';

			  		$availability[$value]['from'] = date('h:i A', strtotime($_POST[$value][0]));
			  		$availability[$value]['to'] = date('h:i A', strtotime($_POST[$value][1]));
			  	}
		  	}else{
		  		// echo 'closed';
		  		// If closed
		  		$availability[$value]['full_day'] = '0';
		  		$availability[$value]['closed'] = '1';
		  		$availability[$value]['from'] = '';
		  		$availability[$value]['to'] = '';
		  	}
		  	
		}

		$user_data['shop_name'] = ucwords(addslashes($this->input->post("shop_name")));
		$user_data['vender_name'] = ucwords(addslashes($this->input->post("vender_name")));
		$user_data['tax_number'] = $this->input->post("tax_number");
		$user_data['contact_no1'] = $this->input->post("contact_no1");
		$user_data['contact_no2'] = $this->input->post("contact_no2");
		$user_data['address'] = addslashes($this->input->post("address"));
		$user_data['city'] = addslashes($this->input->post("city"));
		$user_data['state'] = addslashes($this->input->post("state"));
		$user_data['country'] = addslashes($this->input->post("country"));
		$user_data['zip_code'] = $this->input->post("zipcode");
		$user_data['latitude'] = $this->input->post("latitude");
		$user_data['longitude'] = $this->input->post("longitude");
		$user_data['website'] = addslashes($this->input->post("website"));
		$user_data['min_order'] = $this->input->post("min_order");
		$user_data['facebook_link'] = addslashes($this->input->post("facebook_link"));
		$user_data['twitter_link'] = addslashes($this->input->post("twitter_link"));
		$user_data['pinterest_link'] = addslashes($this->input->post("pinterest_link"));
		$user_data['about'] = addslashes($this->input->post("about"));

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $user_id);
			$this->db->from('shop');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$profile_picture_old = $return_data->profile_picture;

				if (isset($profile_picture_old) && !empty($profile_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old)) {
						unlink(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old);
					}
				}
			}
		}

		if (isset($modal_data['broacher']) && !empty($modal_data['broacher'])){
			
			$user_data['broacher'] = $modal_data['broacher']['file_name'];

			$this->db->select('broacher');
			$this->db->where('id', $user_id);
			$this->db->from('shop');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$broacher_old = $return_data->broacher;

				if (isset($broacher_old) && !empty($broacher_old)) {
					if (file_exists(FCPATH . $this->config->item("brochure_path") . "/" . $broacher_old)) {
						unlink(FCPATH . $this->config->item("brochure_path") . "/" . $broacher_old);
					}
				}
			}
		}

		$payment_mode = '';
		if(isset($_POST['payment_mode'])){
			$user_data['payment_mode'] = implode (",", $this->input->post("payment_mode"));
		}

		// echo "<pre>";
		// print_r($user_data);
		// exit;
	
		$this->db->where('id', $user_id);
		$this->db->update("shop", $user_data);

		// DELETE old availability
		$this->db->where("shop_id",$user_id);
		$this->db->delete('shop_availibality');

		//Add new availability
		foreach ($availability as $key => $value) {

			$availability_data = array(
				'shop_id' =>  $user_id,
				'day' =>  $key,
				'from_time' => $value['from'],
				'to_time' =>  $value['to'],
				'full_day' =>  $value['full_day'],
				'is_closed' =>  $value['closed'],
				'updated_at' =>  date('Y-m-d H:i:s')
				);
			$this->db->insert("shop_availibality", $availability_data);
		}

		
		// DELETE old cuisines
		$this->db->where("shop_id",$user_id);
		$this->db->delete('shop_cuisines');

		//Add new cuisines
		foreach ($this->input->post("cuisines") as $key => $value) {
			$cuisines_data = array(
		        'shop_id'=>$user_id,
		        'cuisine_id'=>$value
		    );
		    $this->db->insert('shop_cuisines',$cuisines_data);
		}
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating profile");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Profile updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('shop');
		$this->db->where('activation_token', $this->input->post("token"));
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 0);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {

			$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'activation_token' => '',
						'status' => '1',
						'updated_at' => date('Y-m-d H:i:s')
					);
			$this->db->where("activation_token",$this->input->post("token"));
			$this->db->update("shop", $user_data);
				
		}else{
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}
	
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Password changed successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function reset_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('id');
		$this->db->from('shop');
		$this->db->where('remember_token', $this->input->post("token"));
		$this->db->where('deleted_at', NULL);
		$this->db->where('status', 1);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {

			$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'remember_token' => '',
						'updated_at' => date('Y-m-d H:i:s')
					);
			$this->db->where("remember_token",$this->input->post("token"));
			$this->db->update("shop", $user_data);
				
		}else{
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}
	
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Password reset successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}