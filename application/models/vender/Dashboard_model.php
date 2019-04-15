<?php

class Dashboard_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_total(){
		$return_data = array();

		$this->db->select('COUNT(id)');
		$this->db->from('orders');
		$this->db->where("deleted_at", NULL);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$total_order = $this->db->get()->result_array();
		$return_data['total_order'] = $total_order[0]['COUNT(id)'];

		$this->db->select('COUNT(id)');
		$this->db->from('item');
		$this->db->where("deleted_at", NULL);
		$this->db->where("is_active", 1);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$total_item = $this->db->get()->result_array();
		$return_data['total_product'] = $total_item[0]['COUNT(id)'];

		$return_data['total_earning'] = 0;

		$this->db->select('COUNT(id)');
		$this->db->from('promocode');
		$this->db->where("deleted_at", NULL);
		$this->db->where("shop_id", $this->auth->get_user_id());
		$this->db->where("status", 1);
		$total_promocode = $this->db->get()->result_array();
		$return_data['total_promocode'] = $total_promocode[0]['COUNT(id)'];

		return $return_data;

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
						't1.later_time',
						't1.schedule_time',
						't1.schedule_date',
						't1.delivery_boy_id',
						't2.username',
						't3.shop_name',
						't1.created_at'
		);
		$this->db->select($sql_select);

		$this->db->from('orders t1');
		$this->db->join('customer t2', 't1.customer_id = t2.id');
		$this->db->join('shop t3', 't1.shop_id = t3.id');
	
		$this->db->where('t2.status', 1);
		$this->db->where('t3.deleted_at', NULL);
		$this->db->order_by("t1.created_at", "desc");
		$this->db->limit("8");

		if($this->auth->is_dispatcher()){

			$this->db->group_start();
				$this->db->where('t1.order_type', 1);
				$this->db->or_where('t1.order_type', 2);
				$this->db->or_where('t1.order_type', 5);
			$this->db->group_end();
		
			$this->db->group_start();
				$this->db->or_where('t1.order_status', 1);
				$this->db->or_where('t1.order_status', 3);
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
}

?>