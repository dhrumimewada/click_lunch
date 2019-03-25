<?php

class Order_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_order($order_type = array()){
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

		$this->db->where_in("t1.order_type", $order_type);

		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		//return $this->db->last_query();
		return $return_data;
	}
}
?>