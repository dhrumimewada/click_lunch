<?php

class Welcome_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_shops($short_name = NULL){
		$return_data = array();
		$this->db->select('t1.id,t1.shop_name,t1.short_name,t1.profile_picture,t1.order_by_time,t1.delivery_time, t1.contact_no1,CONCAT(t1.city, ", ", t1.zip_code, ", ", t1.state) as address');
		$this->db->from('shop t1');
		$this->db->join('shop_cuisines t2', 't1.id = t2.shop_id','right');
		$this->db->where("t1.deleted_at", NULL);
		$this->db->group_by('t2.shop_id');
		$this->db->where("t1.status", 1);
		if (isset($short_name) && !is_null($short_name)) {
			$this->db->where('t1.short_name',$short_name);
		}
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();		
			foreach ($return_data as $key => $value) {

				// get cuisines of shop
				$sql_select = array("t2.cuisine_name");
				$this->db->select($sql_select);
				$this->db->from('shop_cuisines t1');
				$this->db->where("t1.shop_id", $value['id']);
				$this->db->join('cuisine t2', 't1.cuisine_id = t2.id');
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$cuisines_data = $sql_query->result_array();
					$cuisine_list = array_column($cuisines_data, 'cuisine_name');
					$cuisines = implode(', ', $cuisine_list);
					$return_data[$key]['cuisine'] = $cuisines;
				}
			}
		}
		return $return_data;
	}

	public function get_item_data($short_name = NULL){
		$return_data = array();
		$result = array();

		$sql_select = array('t1.id','t1.shop_id','t1.name','t1.short_name','t1.quantity','t1.price','t1.offer_price','t1.item_description','t1.item_picture','t1.is_combo','t2.category_name');
		$this->db->select($sql_select);
		$this->db->from('item t1');
		$this->db->where("t1.short_name", $short_name);
		$this->db->join('category t2', 't1.category_id = t2.id','left');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = (array)$sql_query->row();
			$result['item_data'] = $return_data;

				$sql_select = array('id','variant_group_id','name','price');
				$this->db->select($sql_select);
				$this->db->from('variant_items');
				$this->db->where("item_id", $return_data['id']);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$item_data = $sql_query->result_array();
					$group_array = array_column($item_data, 'variant_group_id');

					$sql_select = array('id','name','selection','availability');
					$this->db->select($sql_select);
					$this->db->from('variant_group');
					$this->db->where_in("id", $group_array);
					$sql_query = $this->db->get();
					if ($sql_query->num_rows() > 0){
						$group_data = $sql_query->result_array();

						foreach ($group_data as $key => $value) {
							$group_data[$key]['items'] = array();

							foreach ($item_data as $key1 => $value1) {
								if($value1['variant_group_id'] == $value['id']){
									$group_data[$key]['items'][] = $item_data[$key1];
								}
							}
						}
						$result['group_data'] = $group_data;
					}
				}

		}

		return $result;
	}

	public function get_item_variants($id = NULL){
		$return_data = array();
		if(isset($id) && $id != '' && !is_null($id)){
			$sql_select = array('id','variant_group_id','name','price');
			$this->db->select($sql_select);
			$this->db->from('variant_items');
			$this->db->where("item_id", $id);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$item_data = $sql_query->result_array();
				$group_array = array_column($item_data, 'variant_group_id');

				$sql_select = array('id','name','selection','availability');
				$this->db->select($sql_select);
				$this->db->from('variant_group');
				$this->db->where_in("id", $group_array);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$group_data = $sql_query->result_array();

					foreach ($group_data as $key => $value) {
						$group_data[$key]['items'] = array();

						foreach ($item_data as $key1 => $value1) {
							if($value1['variant_group_id'] == $value['id']){
								$group_data[$key]['items'][] = $item_data[$key1];
							}
						}
					}
					$return_data = $group_data;
				}
			}
		}
		return $return_data;
	}

	public function get_variants($values = array()){
		$return_data = array();

		$sql_select = array('id','variant_group_id','item_id', 'price');

		$this->db->select($sql_select);
		$this->db->from('variant_items');
		$this->db->where_in("id", $values);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function subscribe(){
		$return = false;

		$this->db->select('*');
		$this->db->from('subscriber');
		$this->db->where("email", $_POST['email']);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() <= 0){
			$data = array('email' => $_POST['email']);
			if($this->db->insert("subscriber", $data)){
				$return = true;
			}
		}else{
			$return = true;
		}
		return $return;
	}

	public function post_restaurant_partner(){
		$this->db->trans_begin();
		$return_value = FALSE;
		$user_data = array(
						'shop_name' => ucwords(addslashes($this->input->post("shop_name"))),
						'email' => $this->input->post("email"),
						'address' => addslashes($this->input->post("address")),
						'contact_no' => $this->input->post("mobile_number"),
						'message' => addslashes($this->input->post("message"))
					);
		$this->db->insert("shop_request", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into registation. Please try again");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Your registration request submitted successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function additional_recommendation_items($cart_data = array()){
		$return_data = array();
		if(isset($cart_data) && is_array($cart_data) && !empty($cart_data)){

			$cart_products = array_unique(array_column($cart_data, 'item_id'));
			$shop_id = array_unique(array_column($cart_data, 'shop_id'));

			$this->db->select('*');
			$this->db->from('item');
			$this->db->where("deleted_at", NULL);
			$this->db->where_not_in("id", $cart_products);
			$this->db->where("is_active", 1);
			$this->db->where("recommended", 1);
			$this->db->where("shop_id",$shop_id[0]);
			$this->db->limit(3);
			$this->db->order_by("id", "desc");
			$this->db->where("quantity !=",0);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				$return_data = $sql_query->result_array();
			}
		}
		return $return_data;
	}
}