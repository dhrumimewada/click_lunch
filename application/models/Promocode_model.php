<?php

class Promocode_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_promocode($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('promocode');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		if($this->auth->is_admin()){
			$this->db->where("shop_id",'');
		}elseif($this->auth->is_vender()){
			$this->db->where("shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("shop_id",$this->auth->get_emp_shop_id());
		}else{
		}

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

	public function post() {
		$this->db->trans_begin();
		$return_value = FALSE;

		$is_admin = $this->auth->is_admin();
		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();

		$from_date = date('Y-m-d', strtotime($this->input->post("from_date")));
		$to_date = date('Y-m-d', strtotime($this->input->post("to_date")));

		$user_data = array(
						'group_type' => intval($this->input->post("group")),
						'promocode' => strtoupper($this->input->post("promocode")),
						'amount' => number_format((float)$this->input->post("amount"), 2, '.', ''),
						'promo_min_order_amount' => number_format((float)$this->input->post("promo_min_order"), 2, '.', ''),
						'discount_type' => intval($this->input->post("discount_type")),
						'usage_limit' => intval($this->input->post("usage_limit")),
						'from_date' => $from_date,
						'to_date' => $to_date,
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);

		if($is_admin){
			$user_data['shop_id'] = '';
		}elseif($is_vender){
			$user_data['shop_id'] = intval($this->auth->get_user_id());
		}elseif ($is_employee) {
			$user_data['shop_id'] = intval($this->auth->get_emp_shop_id());
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}

		if(isset($_POST['no_of_orders']) && $_POST['no_of_orders'] != '' && $this->input->post("group") == 6){
			$user_data['min_no_of_orders'] = $_POST['no_of_orders'];
		}

		if(isset($_POST['max_disc']) && $_POST['max_disc'] != '' && $this->input->post("discount_type") == 1){
			$user_data['max_disc'] = number_format((float)$this->input->post("max_disc"), 2, '.', '');
		}

		if(isset($_POST['promo_type']) && $_POST['promo_type'] != '' && ($is_vender || $is_employee)){
			$user_data['promo_type'] = $_POST['promo_type'];
		}

		$this->db->insert("promocode", $user_data);
		$insert_id = $this->db->insert_id();

		if($insert_id){
			if(isset($_POST['applied_on_products']) && is_array($_POST['applied_on_products']) && !empty($_POST['applied_on_products']) && $_POST['promo_type'] == 1 && ($is_vender || $is_employee)){
				$promocode_valid_product = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}else{
					$shop_id = '';
				}

				foreach ($_POST['applied_on_products'] as $key => $value) {
					$products = array();
					$products = array('promocode_id' => $insert_id,
										'shop_id' => $shop_id,
										'product_id' => $value
										);
					array_push($promocode_valid_product, $products);
				}
				if(!empty($promocode_valid_product)){
					$this->db->insert_batch('promocode_valid_product', $promocode_valid_product); 
				}
			}

			if(isset($_POST['shop']) && is_array($_POST['shop']) && !empty($_POST['shop']) && $this->input->post("group") == 5 && $is_admin){
				$promocode_shops = array();

				foreach ($_POST['shop'] as $key => $value) {
					$shop_array = array();
					$shop_array = array('promocode_id' => $insert_id,
										'shop_id' => $value
										);
					array_push($promocode_shops, $shop_array);
				}
				if(!empty($promocode_shops)){
					$this->db->insert_batch('promocode_shops', $promocode_shops); 
				}
			}

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item']) && $this->input->post("group") == 7 && ($is_vender || $is_employee)){
				$promocode_products = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}else{
					$shop_id = '';
				}

				foreach ($_POST['item'] as $key => $value) {
					$item_array = array();
					$item_array = array('promocode_id' => $insert_id,
										'shop_id' => $shop_id,
										'product_id' => $value
										);
					array_push($promocode_products, $item_array);
				}
				if(!empty($promocode_products)){
					$this->db->insert_batch('promocode_products', $promocode_products); 
				}
			}
		}
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Promocode added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
	public function put() {
		$this->db->trans_begin();
		$return_value = FALSE;

		$is_admin = $this->auth->is_admin();
		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();

		$from_date = date('Y-m-d', strtotime($this->input->post("from_date")));
		$to_date = date('Y-m-d', strtotime($this->input->post("to_date")));

		$user_data = array(
						'group_type' => intval($this->input->post("group")),
						'promocode' => strtoupper($this->input->post("promocode")),
						'amount' => number_format((float)$this->input->post("amount"), 2, '.', ''),
						'promo_min_order_amount' => number_format((float)$this->input->post("promo_min_order"), 2, '.', ''),
						'discount_type' => intval($this->input->post("discount_type")),
						'usage_limit' => intval($this->input->post("usage_limit")),
						'from_date' => $from_date,
						'to_date' => $to_date,
						'updated_at' => date('Y-m-d H:i:s')
					);
		
		if($is_admin){
			$user_data['shop_id'] = '';
		}elseif($is_vender){
			$user_data['shop_id'] = intval($this->auth->get_user_id());
		}elseif ($is_employee) {
			$user_data['shop_id'] = intval($this->auth->get_emp_shop_id());
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}

		if(isset($_POST['no_of_orders']) && $_POST['no_of_orders'] != '' && $this->input->post("group") == 6){
			$user_data['min_no_of_orders'] = $_POST['no_of_orders'];
		}

		if(isset($_POST['max_disc']) && $_POST['max_disc'] != '' && $this->input->post("discount_type") == 1){
			$user_data['max_disc'] = number_format((float)$this->input->post("max_disc"), 2, '.', '');
		}

		if(isset($_POST['promo_type']) && $_POST['promo_type'] != '' && ($is_vender || $is_employee)){
			$user_data['promo_type'] = $_POST['promo_type'];
		}
	
		$this->db->where('id', $this->input->post("promocode_id"));
		$this->db->update("promocode", $user_data);

		$insert_id = $this->input->post("promocode_id");

		if($insert_id){

			$where = array('promocode_id' => $insert_id);

			// Delete promocode_valid_product
			$this->db->where($where);
			$this->db->delete('promocode_valid_product');

			// Delete promocode_shops
			$this->db->where($where);
			$this->db->delete('promocode_shops');

			// Delete promocode_shops
			$this->db->where($where);
			$this->db->delete('promocode_products');


			if(isset($_POST['applied_on_products']) && is_array($_POST['applied_on_products']) && !empty($_POST['applied_on_products']) && $_POST['promo_type'] == 1 && ($is_vender || $is_employee)){
				$promocode_valid_product = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}else{
					$shop_id = '';
				}

				foreach ($_POST['applied_on_products'] as $key => $value) {
					$products = array();
					$products = array('promocode_id' => $insert_id,
										'shop_id' => $shop_id,
										'product_id' => $value
										);
					array_push($promocode_valid_product, $products);
				}
				if(!empty($promocode_valid_product)){
					$this->db->insert_batch('promocode_valid_product', $promocode_valid_product); 
				}
			}

			if(isset($_POST['shop']) && is_array($_POST['shop']) && !empty($_POST['shop']) && $this->input->post("group") == 5 && $is_admin){
				$promocode_shops = array();

				foreach ($_POST['shop'] as $key => $value) {
					$shop_array = array();
					$shop_array = array('promocode_id' => $insert_id,
										'shop_id' => $value
										);
					array_push($promocode_shops, $shop_array);
				}
				if(!empty($promocode_shops)){
					$this->db->insert_batch('promocode_shops', $promocode_shops); 
				}
			}

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item']) && $this->input->post("group") == 7 && ($is_vender || $is_employee)){
				$promocode_products = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}else{
					$shop_id = '';
				}

				foreach ($_POST['item'] as $key => $value) {
					$item_array = array();
					$item_array = array('promocode_id' => $insert_id,
										'shop_id' => $shop_id,
										'product_id' => $value
										);
					array_push($promocode_products, $item_array);
				}
				if(!empty($promocode_products)){
					$this->db->insert_batch('promocode_products', $promocode_products); 
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Promocode updated successfully");
			$return_value = TRUE;
		}
		return $return_value;
	}

}
?>