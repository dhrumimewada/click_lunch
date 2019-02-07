<?php

class Welcome_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_shops($id = NULL){
		$return_data = array();
		$this->db->select('t1.id,t1.shop_name,t1.profile_picture, t1.contact_no1,CONCAT(t1.city, ", ", t1.zip_code, ", ", t1.state) as address');
		$this->db->from('shop t1');
		$this->db->join('shop_cuisines t2', 't1.id = t2.shop_id','right');
		$this->db->where("t1.deleted_at", NULL);
		$this->db->group_by('t2.shop_id');
		$this->db->where("t1.status", 1);
		if (isset($id) && !is_null($id)) {
			$this->db->where('t1.id', decrypt($id));
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
}