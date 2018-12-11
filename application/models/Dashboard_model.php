<?php

class Dashboard_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_total(){
		$return_data = array();

		$this->db->select('COUNT(id)');
		$this->db->from('admin');
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$total_admin = $this->db->get()->result_array();
		$return_data['total_admin'] = $total_admin[0]['COUNT(id)'];

		$this->db->select('COUNT(id)');
		$this->db->from('shop');
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$total_shop = $this->db->get()->result_array();
		$return_data['total_shop'] = $total_shop[0]['COUNT(id)'];

		$this->db->select('COUNT(id)');
		$this->db->from('cuisine');
		$this->db->where("deleted_at", NULL);
		$this->db->where("is_active", 1);
		$total_cuisine = $this->db->get()->result_array();
		$return_data['total_cuisine'] = $total_cuisine[0]['COUNT(id)'];

		$this->db->select('COUNT(id)');
		$this->db->from('promocode');
		$this->db->where("deleted_at", NULL);
		$this->db->where("status", 1);
		$total_promocode = $this->db->get()->result_array();
		$return_data['total_promocode'] = $total_promocode[0]['COUNT(id)'];

		$this->db->select('*');
		$this->db->from('shop');
		$this->db->where("deleted_at", NULL);
		$this->db->order_by("created_at", 'desc');
		$this->db->limit(5);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data['shops'] = $sql_query->result_array();
		}
		return $return_data;

	}
}

?>