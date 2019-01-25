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

}
?>