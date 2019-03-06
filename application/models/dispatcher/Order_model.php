<?php

class Order_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_order(){
		$return_data = array();
		$sql_select = array(
						't1.id',
						't1.customer_id',
						't1.shop_id',
						't1.order_status',
						't1.order_type',
						't1.total',
						't2.username',
						't3.shop_name',
						't1.created_at'
		);
		$this->db->select($sql_select);

		$this->db->from('orders t1');
		$this->db->join('customer t2', 't1.customer_id = t2.id','left');
		$this->db->join('shop t3', 't1.shop_id = t3.id','left');

		
		$this->db->where('t2.status', 1);
		$this->db->where('t3.deleted_at', NULL);

		if($this->auth->is_dispatcher()){

			$this->db->group_start();
				$this->db->where('t1.order_type', 1);
				$this->db->or_where('t1.order_type', 2);
				$this->db->or_where('t1.order_type', 5);
			$this->db->group_end();
		
			$this->db->group_start();
			$this->db->where('t1.order_status', 0);
			$this->db->or_where('t1.order_status', 1);
			$this->db->group_end();
		}elseif($this->auth->is_vender()){
			$this->db->where("t1.shop_id",$this->auth->get_user_id());
			$this->db->where('t1.order_status', 0);
		}elseif ($this->auth->is_employee()) {
			$this->db->where("t1.shop_id",$this->auth->get_emp_shop_id());
			$this->db->where('t1.order_status', 0);
		}else{
		}

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function get_order_detail($id = NULL){
		//$return_data = array();
		if(isset($id) && !is_null($id)){

			$order_id = decrypt($id);

			$sql_select = array(
							't1.*',
							't2.email',
							't2.username',
							't2.mobile_number',
							't3.house_no',
							't3.street',
							't3.city',
							't3.zipcode',
							't3.address_type',
							't4.shop_name',
							't4.city as shop_city',
							't4.state as shop_state',
							't4.zip_code as shop_zip_code',
							't4.contact_no1 as shop_number1',
							't4.contact_no2 as shop_number2',
							't5.promocode'
			);

			$this->db->select($sql_select);
			$this->db->from('orders t1');
			$this->db->join('delivery_address t3', 't1.delivery_address_id = t3.id','left');
			$this->db->join('customer t2', 't1.customer_id = t2.id','left');
			$this->db->join('shop t4', 't1.shop_id = t4.id','left');
			$this->db->join('promocode t5', 't1.promocode_id = t5.id','left');
			$this->db->where("t1.id", $order_id);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data['order'] = $sql_query->row();

				$sql_select = array(
								't2.name',
								't1.*'
								
				);

				$this->db->select($sql_select);
				$this->db->from('order_items t1');
				$this->db->join('item t2', 't1.item_id = t2.id','left');
				$this->db->where("t1.order_id", $order_id);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0) {
					$return_data['order_items'] = $sql_query->result_array();
					foreach ($return_data['order_items'] as $key => $value) {

						$sql_select = array(
										't2.name as group_name',
										't3.name as varient_name',
										't1.variant_group_id as group_id',
										't1.price as varient_price'	
							);


						$this->db->select($sql_select);
						$this->db->from('order_item_variant t1');
						$this->db->join('variant_group t2', 't1.variant_group_id = t2.id','left');
						$this->db->join('variant_items t3', 't1.variant_id = t3.id','left');
						$this->db->where("t1.order_item_id", $value['id']);
						$sql_query = $this->db->get();
						if ($sql_query->num_rows() > 0){
							$varient_data = $sql_query->result_array();
							$return_data['order_items'][$key]['varients'] = $varient_data;

							$groups = array_column($varient_data, 'group_name');
							$groups = array_unique($groups);
							$return_data['order_items'][$key]['groups'] = $groups;
						}
					}
				}

			}
		}
		return $return_data;
	}

	public function set_delivery_boy(){
		$return = FALSE;
		if(isset($_POST['db_id']) && $_POST['db_id'] != '' && isset($_POST['order_id']) && $_POST['order_id'] != ''){
			$data = array('delivery_boy_id' => intval($_POST['db_id']), 'order_status' => 3);
			$this->db->where('id', $_POST['order_id']);
			if($this->db->update('orders', $data)){

				$where = array('deleted_at' => NULL, 'status' => 1, 'device_token !=' => '', 'id' => $_POST['db_id']);
		        $select = array('id','device_token','username');
		        $table = 'delivery_boy';
		        $data = get_data_by_filter($table,$select, $where);

		        $sql_select = array(
								't2.shop_name',
								't2.profile_picture as shop_picture',
								't2.address as shop_address',
								'CONCAT_WS(", ", t3.house_no, t3.street, t3.city, t3.zipcode) AS delivery_address'
					);


				$this->db->select($sql_select);
				$this->db->from('orders t1');
				$this->db->join('shop t2', 't1.shop_id = t2.id','left');
				$this->db->join('delivery_address t3', 't1.delivery_address_id = t3.id','left');
				$this->db->where("t1.id", $_POST['order_id']);
				$sql_query = $this->db->get();
				if ($sql_query->num_rows() > 0){
					$order_data = (array)$sql_query->row();

					$device_token = $data[0]['device_token'];
			        $push_title = 'New request of delivery';
			        $push_data_msg = 'Hey '.$data[0]['username'].'!';
			        $push_data_msg .= 'You got new order delivery request.';
			        $push_data = array(
				        	'order_id' => $_POST['order_id'],
				        	'message' => $push_data_msg,
				        	'shop_name' => $order_data['shop_name'],
				        	'shop_address' => $order_data['shop_address'],
				        	'shop_picture' => $order_data['shop_picture'],
				        	'delivery_address' => $order_data['delivery_address']
				        );
			        $push_type = 'request';

					$result = send_push('Android',$device_token, $push_title, $push_data, $push_type);
					$return = TRUE;

				}else{
					$return = FALSE;
				}
			}
		}
		return $return;
	}
}
?>