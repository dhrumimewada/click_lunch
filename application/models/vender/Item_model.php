<?php

class Item_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_item($id = NULL){
		$return_data = array();
		$sql_select = array("t1.*", "t2.cuisine_name");
		$this->db->select($sql_select);
		$this->db->from('item t1');
		$this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
		if (isset($id) && !is_null($id)) {
			$this->db->where('t1.id', $id);
		}

		if($this->auth->is_vender()){
			$this->db->where("t1.shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
		}else{
		}

		$this->db->where("t1.deleted_at", NULL);
		$this->db->where("t2.deleted_at", NULL);
		$this->db->where("t2.is_active", 1);
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

	public function get_variant_groups(){
		$return_data = array();
		$this->db->select('id,name');
		$this->db->from('variant_group');
		if($this->auth->is_vender()){
			$this->db->where("shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("shop_id",$this->auth->get_emp_shop_id());
		}else{
		}
		$this->db->where("deleted_at", NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_item_variants($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('variant_items');
		$this->db->where("item_id",$id);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function post($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['item_picture']) && !empty($modal_data['item_picture'])) {
			$item_picture = $modal_data['item_picture']['file_name'];
		}

		if($this->auth->is_vender()){
			$shop_id = $this->auth->get_user_id();
		}elseif ($this->auth->is_employee()) {
			$shop_id = $this->auth->get_emp_shop_id();
		}else{
			$shop_id = NULL;
		}

		$is_combo = 0;
		if($this->input->post("item_type") == 'Combo'){
			$is_combo = 1;
		}

		$inventory_status = '0';
		if ($this->input->post("inventory_status")) {
			$inventory_status = $this->input->post("inventory_status");
		}

		// echo "<pre>";
		// print_r($_POST);
		// exit;

		$user_data = array(
						'shop_id' => intval($shop_id),
						'cuisine_id' => intval($this->input->post("cuisine_id")),
						'category_id' => intval($this->input->post("category_id")),
						'name' => ucwords(addslashes($this->input->post("name"))),
						'quantity' => intval($this->input->post("quantity")),
						'price' => sprintf("%.2f", $this->input->post("price")),
						'offer_price' => sprintf("%.2f", $this->input->post("offer_price")),
						'item_description' => ucwords(addslashes($this->input->post("item_description"))),
						'item_picture' => ((isset($item_picture) && !empty($item_picture)) ? $item_picture : ''),
						'is_combo' => intval($is_combo),
						'inventory_status' => intval($inventory_status),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);

		$this->db->insert("item", $user_data);
		$insert_id = $this->db->insert_id();

		if(($this->input->post("variant_group")) && ($this->input->post("variant_name")) && ($this->input->post("variant_price"))){
			$group_array = array();

			foreach ($this->input->post("variant_group") as $key => $value) {
				$group_array[$key]['variant_group_id'] = $value;
			}
			foreach ($this->input->post("variant_name") as $key => $value) {
				$group_array[$key]['name'] = $value;
			}
			foreach ($this->input->post("variant_price") as $key => $value) {
				$group_array[$key]['price'] = $value;
				$group_array[$key]['created_at'] = date('Y-m-d H:i:s');
				$group_array[$key]['item_id'] = $insert_id;
			}
			foreach ($group_array as $key => $value) {
				$this->db->insert("variant_items", $value);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Item added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data1 = array();
		if (isset($modal_data['item_picture']) && !empty($modal_data['item_picture'])){
			
			$user_data1['item_picture'] = $modal_data['item_picture']['file_name'];

			$this->db->select('item_picture');
			$this->db->where('id', $this->input->post("item_id"));
			$this->db->from('item');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$item_picture_old = $return_data->item_picture;

				if (isset($item_picture_old) && !empty($item_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("item_photo_path") . "/" . $item_picture_old)) {
						unlink(FCPATH . $this->config->item("item_photo_path") . "/" . $item_picture_old);
					}
				}
			}
		}

		if($this->auth->is_vender()){
			$shop_id = $this->auth->get_user_id();
		}elseif ($this->auth->is_employee()) {
			$shop_id = $this->auth->get_emp_shop_id();
		}else{
			$shop_id = NULL;
		}

		$is_combo = 0;
		if($this->input->post("item_type") == 'Combo'){
			$is_combo = 1;
		}

		$inventory_status = '0';
		if ($this->input->post("inventory_status")) {
			$inventory_status = $this->input->post("inventory_status");
		}

		$user_data2 = array(
						'shop_id' => intval($shop_id),
						'cuisine_id' => intval($this->input->post("cuisine_id")),
						'category_id' => intval($this->input->post("category_id")),
						'name' => ucwords(addslashes($this->input->post("name"))),
						'quantity' => intval($this->input->post("quantity")),
						'price' => sprintf("%.2f", $this->input->post("price")),
						'offer_price' => sprintf("%.2f", $this->input->post("offer_price")),
						'item_description' => ucwords(addslashes($this->input->post("item_description"))),
						'is_combo' => intval($is_combo),
						'inventory_status' => intval($inventory_status),
						'created_at' => date('Y-m-d H:i:s')
					);
		$user_data = array_merge($user_data1,$user_data2);

		$this->db->where("id", $this->input->post("item_id"));
		$this->db->update("item", $user_data);

		$this->db->where('item_id', $this->input->post("item_id"));
		$this->db->delete('variant_items');

		if(($this->input->post("variant_group")) && ($this->input->post("variant_name")) && ($this->input->post("variant_price"))){
			$group_array = array();

			foreach ($this->input->post("variant_group") as $key => $value) {
				$group_array[$key]['variant_group_id'] = $value;
			}
			foreach ($this->input->post("variant_name") as $key => $value) {
				$group_array[$key]['name'] = $value;
			}
			foreach ($this->input->post("variant_price") as $key => $value) {
				$group_array[$key]['price'] = $value;
				$group_array[$key]['created_at'] = date('Y-m-d H:i:s');
				$group_array[$key]['item_id'] = $this->input->post("item_id");
			}
			foreach ($group_array as $key => $value) {
				$this->db->insert("variant_items", $value);
			}
		}

		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Item updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}
?>