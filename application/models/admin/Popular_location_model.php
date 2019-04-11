<?php

class Popular_location_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_popular_location($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('delivery_address');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where("customer_id",'0');
		$this->db->where("popular",'1');
		// if($this->auth->is_admin()){
		// 	$this->db->where("shop_id",'');
		// }elseif($this->auth->is_vender()){
		// 	$this->db->where("shop_id",$this->auth->get_user_id());
		// }elseif ($this->auth->is_employee()) {
		// 	$this->db->where("shop_id",$this->auth->get_emp_shop_id());
		// }else{
		// }

		$this->db->where("deleted_at", NULL);
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

	public function post($lat,$long) {
		$this->db->trans_begin();
		$return_value = FALSE;

		$location_data = array(
						'house_no' => $this->input->post("house_no"),
						'street' => $this->input->post("street"),
						'city' => $this->input->post("city"),
						'zipcode' => intval($this->input->post("zipcode")),
						'address_type' => intval($this->input->post("address_type")),
						'delivery_instruction' => $this->input->post("delivery_instruction"),
						'popular' => 1,
						'customer_id' => 0
					);

		if($this->input->post("nickname")){
			$location_data['nickname'] = $this->input->post("nickname");
		}

		if($lat != NULL && $long != NULL){
			$location_data['latitude'] = $lat;
			$location_data['longitude'] = $long;
		}

		// if($this->auth->is_admin()){
		// 	$user_data['shop_id'] = '';
		// }elseif($this->auth->is_vender()){
		// 	$user_data['shop_id'] = intval($this->auth->get_user_id());
		// }elseif ($this->auth->is_employee()) {
		// 	$user_data['shop_id'] = intval($this->auth->get_emp_shop_id());
		// }else{
		// 	$this->auth->set_error_message("User not found");
		// 	return FALSE;
		// }

		$this->db->insert("delivery_address", $location_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Popular location added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
	public function put() {
		$this->db->trans_begin();
		$return_value = FALSE;

		// echo '<pre>'; print_r($_POST); exit;
		$from_date = date('Y-m-d', strtotime($this->input->post("from_date")));
		$to_date = date('Y-m-d', strtotime($this->input->post("to_date")));

		$user_data = array(
						'popular_location' => strtoupper($this->input->post("popular_location")),
						'amount' => $this->input->post("amount"),
						'promo_min_order' => floatval($this->input->post("promo_min_order")),
						'discount_type' => intval($this->input->post("discount_type")),
						'from_date' => $from_date,
						'to_date' => $to_date,
						'status' => 1,
						'updated_at' => date('Y-m-d H:i:s')
					);
		
		if($this->auth->is_admin()){
			$user_data['shop_id'] = '';
		}elseif($this->auth->is_vender()){
			$user_data['shop_id'] = intval($this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$user_data['shop_id'] = intval($this->auth->get_emp_shop_id());
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}
	
		$this->db->where('id', $this->input->post("popular_location_id"));
		$this->db->update("popular_location", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("popular_location updated successfully");
			$return_value = TRUE;
		}
		return $return_value;
	}

	public function get_requests() {
		$return_data = array();
		$this->db->select('t1.*');
		$this->db->from('delivery_address_popular_request t1');
		$this->db->where("t1.deleted_at", NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function request_accept(){

		$this->db->select('*');
		$this->db->from('delivery_address_popular_request');
		$this->db->where("deleted_at", NULL);
		$this->db->where("id", $_POST['id']);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$request = (array)$sql_query->row();

			$house_no = str_replace(" ","+",trim($request['house_no']));
            $street = str_replace(" ","+",trim($request['street']));
            $city = str_replace(" ","+",trim($request['city']));
            $zipcode = str_replace(" ","+",trim($request['zipcode']));

            $address = $house_no."+".$street."+".$city."+".$zipcode;

            $google_key = $this->config->item('google_key');
            $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&key=$google_key");
            $json = json_decode($json);

            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        	if($lat == '' || $long == ''){
        		return array("is_success" => false, 'message' => 'Could not fetch latitude & longitude for this location');
        	}else{

        		$location_data = array(
						'house_no' => $request['house_no'],
						'street' => $request['street'],
						'city' => $request['city'],
						'zipcode' => $request['zipcode'],
						'nickname' => $request['nickname'],
						'address_type' => $request['address_type'],
						'latitude' => $lat,
						'longitude' => $long,
						'popular' => 1,
						'customer_id' => 0
					);

        		$this->db->insert("delivery_address", $location_data);

        		$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
        		$this->db->where('id', $_POST['id']);
				if($this->db->update("delivery_address_popular_request", $user_data)){
					return array("is_success" => true, 'message' => 'Popular location request has been accepted.');
				}else{
					return array("is_success" => false, 'message' => 'Server encounter error');
				}
        	}


		}else{
			return array("is_success" => false, 'message' => 'Request not found');
		}
	}

}
?>