<?php

class Category_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_category($id = NULL) {
		$return_data = array();
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where("deleted_at", NULL);
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
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



		$user_data = array(
						'category_name' => ucwords(addslashes($this->input->post("category_name"))),
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$this->db->insert("category", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Category added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put() {
		$this->db->trans_begin();
		$return_value = FALSE;

		$user_data['category_name'] = ucwords(addslashes($this->input->post("category_name")));
		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("category_id"));
		$this->db->update("category", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Category updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

}
?>
