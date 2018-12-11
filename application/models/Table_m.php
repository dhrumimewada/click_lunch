<?php

class Table_m extends CI_Model {

	var $table = 'customer';
	var $column_order = array('email', 'first_name', 'last_name',  'contact_no', 'zipcode'); //set column field database for datatable orderable
	var $column_search = array('email', 'first_name', 'last_name', 'contact_no', 'zipcode'); //set column field database for datatable searchable
	var $order = array('created_at' => 'desc'); // default order


	public function __construct() {
		parent::__construct();
	}

	public function get_active_customers() {
		$return_data = array();
		$sql_select = array("t1.*");
		$this->db->select($sql_select);
		$this->db->where('t1.deleted_at', NULL);
		$this->db->from('customer t1');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	private function _get_datatables_query() {
		$this->db->from($this->table);

		$i = 0;
		// loop column
		foreach ($this->column_search as $item) {
			// if datatable send POST for search
			if ($_POST['search']['value']) {
				// first loop
				if ($i === 0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				//last loop
				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		// here order processing
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables() {
		$this->_get_datatables_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
}
?>
