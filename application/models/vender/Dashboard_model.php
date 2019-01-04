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
}

?>