<?php

class Promocode_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_promocode($id = NULL){
		$return_data = array();

		$sql_select = array('t1.*','t2.shop_name');
		$this->db->select($sql_select);
		$this->db->from('promocode t1');
		if (isset($id) && !is_null($id)) {
			$this->db->where('t1.id', $id);
		}
		if($this->auth->is_admin()){
			//$this->db->where("shop_id",'');
		}elseif($this->auth->is_vender()){
			$this->db->where("t1.shop_id",$this->auth->get_user_id());
		}elseif ($this->auth->is_employee()) {
			$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
		}else{
		}

		$this->db->join('shop t2', 't1.shop_id = t2.id','left');
		$this->db->where("t1.deleted_at", NULL);
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
			if($this->input->post("group") == 7){
				$user_data['shop_id'] = $_POST['shop'][0];
			}else{
				$user_data['shop_id'] = '';
			}
			
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

			if(($_POST['promo_type'] == 1) && (intval($this->input->post("discount_type")) == 0)){
				$this->db->select('IF(offer_price = "", price, offer_price) as price');
                $this->db->from('item');
                $this->db->order_by('ABS(price)','asc');
                $this->db->limit(1);
                $this->db->where_in('id', $_POST['applied_on_products']);
                 $sql_query = $this->db->get();
            	if ($sql_query->num_rows() > 0){
            		$minimum_item_price = (array)$sql_query->row();
            		if($user_data['amount'] > $minimum_item_price['price']){
            			$this->auth->set_error_message("Discount amount should be less than selected products price");
						return FALSE;
            		}
            	}
			}
		}

		if(intval($this->input->post("discount_type")) == 1){
			$discount = $user_data['amount']."%";
			$max_cashback = "(Max Cashback Rs.".$_POST['max_disc'].")";
		}else{
			$discount = "flat $".$user_data['amount'];
			$max_cashback = '';
		}
		if($_POST['promo_type'] == 1){
			$promo_type = "Product(s)";
		}else{
			$promo_type = "Order";
		}
		$user_data['description'] = "Use Promocode ".strtoupper($this->input->post("promocode"))." To Get ".$discount." Cashback* On Total ".$promo_type." Value ".$max_cashback;

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

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item']) && $this->input->post("group") == 7){
				$promocode_products = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}elseif($is_admin) {
					$shop_id = $_POST['shop'][0];
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
						'discount_type' => intval($this->input->post("discount_type")),
						'usage_limit' => intval($this->input->post("usage_limit")),
						'from_date' => $from_date,
						'to_date' => $to_date,
						'updated_at' => date('Y-m-d H:i:s')
					);
		
		if($is_admin){
			if($this->input->post("group") == 7){
				$user_data['shop_id'] = $_POST['shop'][0];
			}else{
				$user_data['shop_id'] = '';
			}
		}elseif($is_vender){
			$user_data['shop_id'] = intval($this->auth->get_user_id());
		}elseif ($is_employee) {
			$user_data['shop_id'] = intval($this->auth->get_emp_shop_id());
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}

		if(isset($_POST['promo_min_order']) && $_POST['promo_min_order'] != ''){
			$user_data['promo_min_order_amount'] = number_format((float)$this->input->post("promo_min_order"), 2, '.', '');
		}else{
			$user_data['promo_min_order_amount'] = '';
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

		if(intval($this->input->post("discount_type")) == 1){
			$discount = $user_data['amount']."%";
			$max_cashback = "(Max Discount $".$_POST['max_disc'].")";
		}else{
			$discount = "Flat $".$user_data['amount'];
			$max_cashback = '';
		}
		if($_POST['promo_type'] == 1){
			$promo_type = "Product(s)";
		}else{
			$promo_type = "Order";
		}
		$user_data['description'] = "Use Promocode ".strtoupper($this->input->post("promocode"))." To Get ".$discount." Discount* On Total ".$promo_type." Value ".$max_cashback;
	
		$this->db->where('id', $this->input->post("promocode_id"));

		// echo "<pre>";
		// print_r($user_data);
		// exit;
		$this->db->update("promocode", $user_data);

		$insert_id = $this->input->post("promocode_id");

		if($insert_id){

			$where = array('promocode_id' => $insert_id);

			if(($is_vender || $is_employee)){
				// Delete promocode_valid_product
				$this->db->where($where);
				$this->db->delete('promocode_valid_product');
			}
			

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

			if(isset($_POST['item']) && is_array($_POST['item']) && !empty($_POST['item']) && $this->input->post("group") == 7){
				$promocode_products = array();

				if($is_vender){
					$shop_id = intval($this->auth->get_user_id());
				}elseif($is_employee) {
					$shop_id = intval($this->auth->get_emp_shop_id());
				}elseif($is_admin) {
					$shop_id = $_POST['shop'][0];
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

	public function get_eligible_customer($promocode_id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('promocode');
		$this->db->where('id', $promocode_id);
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$promocode_data = $sql_query->row();

			if($promocode_data->group_type == 1){

				$sql_select = array(
                            "t1.id",
                            "t1.email",
                            "t1.username",
                            "t1.mobile_number",
                            "t1.address"
                        );

				$this->db->select($sql_select);
				$this->db->where("t1.deleted_at", NULL);
        		$this->db->where("t1.status", 1);
        		$this->db->where("t2.id", NULL);
        		$this->db->from('customer t1');
        		$this->db->join('orders t2', 't1.id = t2.customer_id', "left outer");
        		$sql_query = $this->db->get();
        		if ($sql_query->num_rows() > 0) {
        			$return_data = $sql_query->result_array();
        		}
			}else if($promocode_data->group_type == 4){

				$sql_select = array(
                            "t1.id",
                            "t1.email",
                            "t1.username",
                            "t1.mobile_number",
                            "t1.address"
                        );

				$this->db->select($sql_select);
				$this->db->where("t1.deleted_at", NULL);
        		$this->db->where("t1.status", 1);
        		$this->db->from('customer t1');
        		$sql_query = $this->db->get();
        		if ($sql_query->num_rows() > 0) {
        			$return_data = $sql_query->result_array();
        		}
			}else if($promocode_data->group_type == 5){

				$this->db->select('shop_id');
				$this->db->from('promocode_shops');
				$this->db->where("promocode_id", $promocode_id);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0) {
        			$shops_data = $sql_query->result_array();
        			$shops = array_column($shops_data, 'shop_id');

        			$sql_select = array(
                            "t1.id",
                            "t1.email",
                            "t1.username",
                            "t1.mobile_number",
                            "t1.address"
                        );

					$this->db->select($sql_select);
					$this->db->where("t1.deleted_at", NULL);
	        		$this->db->where("t1.status", 1);
	        		$this->db->where_in("t2.shop_id", $shops);
	        		$this->db->from('customer t1');
	        		$this->db->join('orders t2', 't1.id = t2.customer_id',"left join");
	        		$sql_query = $this->db->get();
	        		if ($sql_query->num_rows() > 0) {
	        			$return_data = $sql_query->result_array();
	        		}
        		}

			}else{

			}
			
		}
		return $return_data;
	}

}
?>