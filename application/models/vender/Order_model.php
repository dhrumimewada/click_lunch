<?php

class Order_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_order($order_status = array(), $order_type = array()){
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
		$this->db->join('customer t2', 't1.customer_id = t2.id');
		$this->db->join('shop t3', 't1.shop_id = t3.id');

		if(is_array($order_status) && !empty($order_status)){
			$this->db->where_in("t1.order_status", $order_status);
		}

		if(is_array($order_type) && !empty($order_type)){
			$this->db->where_in("t1.order_type", $order_type);
		}

		$this->db->where("t1.shop_id",$this->auth->get_user_id());
		

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		//return $this->db->last_query();
		return $return_data;
	}

	public function get_today_upcoming_order($today_upcoming = NULL){
		$return_data = array();
		$sql_select = array(
						't1.id',
						't1.customer_id',
						't1.shop_id',
						't1.order_status',
						't1.order_type',
						't1.total',
						't1.later_time',
						't1.schedule_time',
						't1.schedule_date',
						't2.username',
						't3.shop_name',
						't1.created_at'
		);
		$this->db->select($sql_select);

		$this->db->from('orders t1');
		$this->db->join('customer t2', 't1.customer_id = t2.id');
		$this->db->join('shop t3', 't1.shop_id = t3.id');

		$this->db->where("t1.shop_id",$this->auth->get_user_id());

		$this->db->group_start();
		
			$this->db->group_start();

	            $this->db->group_start();
	                $order_type = array('1','2','3','4');
	                $this->db->where_in('t1.order_type', $order_type);

	                if($today_upcoming == 1){
	                	$this->db->where('DATE(t1.created_at)', date('Y-m-d'));
	                }else{
	                	$this->db->where('DATE(t1.created_at) >', date('Y-m-d'));
	                }
	                
	            $this->db->group_end();

	            $this->db->or_group_start();
	                $order_type = array('5','6');
	                $this->db->where_in('t1.order_type', $order_type);

	                if($today_upcoming == 1){
	                	$this->db->where('DATE(t1.schedule_date)', date('Y-m-d'));
	                }else{
	                	$this->db->where('DATE(t1.schedule_date) >', date('Y-m-d'));
	                }
	                
	            $this->db->group_end();

	        $this->db->group_end();

	        $this->db->group_start();

	        	$this->db->group_start();
	                $order_type = array('1','2','5');
	                $this->db->where_in('t1.order_type', $order_type);
	                $this->db->where('delivery_boy_id !=', 0);
	                $order_status = array('4','5');
	                $this->db->where_in('t1.order_status', $order_status);
	            $this->db->group_end();

	            $this->db->or_group_start();
	                $order_type = array('3','4','6');
	                $this->db->where_in('t1.order_type', $order_type);
	                $order_status = array('1');
	                $this->db->where_in('t1.order_status', $order_status);
	            $this->db->group_end();

	        $this->db->group_end();

        $this->db->group_end();

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		//return $this->db->last_query();
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

				if($return_data['order']->delivery_boy_id != 0){
					$this->db->select('email, username, mobile_number');
					$this->db->where("id", $return_data['order']->delivery_boy_id);
					$this->db->from('delivery_boy');
					$sql_query = $this->db->get();
					if ($sql_query->num_rows() > 0) {
						$result_array =  (array)$sql_query->row();
						$return_data['delivery_boy'] = array();
						$return_data['delivery_boy']['delivery_boy_name'] = $result_array['username'];
						$return_data['delivery_boy']['delivery_boy_email'] = $result_array['email'];
						$return_data['delivery_boy']['delivery_boy_mobile_number'] = $result_array['mobile_number'];
					}
				}

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
}
?>