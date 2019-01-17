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

	public function post($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['category_picture']) && !empty($modal_data['category_picture'])) {
			$category_picture = $modal_data['category_picture']['file_name'];
		}

		$user_data = array(
						'category_name' => ucwords(addslashes($this->input->post("category_name"))),
						'category_picture' => ((isset($category_picture) && !empty($category_picture)) ? $category_picture : ''),
						'is_active' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$this->db->insert("category", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Cuisine added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;
		// echo '<pre>';
		// print_r($modal_data);exit;

		$user_data['category_name'] = ucwords(addslashes($this->input->post("category_name")));

		if (isset($modal_data['category_picture']) && !empty($modal_data['category_picture'])){
			
			$user_data['category_picture'] = $modal_data['category_picture']['file_name'];

			$this->db->select('category_picture');
			$this->db->where('id', $this->input->post("category_id"));
			$this->db->from('category');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$category_picture_old = $return_data->category_picture;

				if (isset($category_picture_old) && !empty($category_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("category_photo_path") . "/" . $category_picture_old)) {
						unlink(FCPATH . $this->config->item("category_photo_path") . "/" . $category_picture_old);
					}
				}
			}
		}

		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("category_id"));
		$this->db->update("category", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Cuisine updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

}
?>
