<?php

class Banner_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_banner($id = NULL) {
		$return_data = array();
		$this->db->select('*');
		$this->db->from('banner');
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

	public function get_highlight() {
		$return_data = array();
		$this->db->select('*');
		$this->db->from('highlight');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();
		}
		return $return_data;
	}

	public function post($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['banner_picture']) && !empty($modal_data['banner_picture'])) {
			$banner_picture = $modal_data['banner_picture']['file_name'];
		}

		$user_data = array(
						'title' => ucwords(addslashes($this->input->post("title"))),
						'sub_title' => ucfirst(addslashes($this->input->post("sub_title"))),
						'banner_picture' => ((isset($banner_picture) && !empty($banner_picture)) ? $banner_picture : ''),
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s')
					);
		$this->db->insert("banner", $user_data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Banner added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;
		// echo '<pre>';
		// print_r($modal_data);exit;

		$user_data['title'] = ucwords(addslashes($this->input->post("title")));
		$user_data['sub_title'] = ucfirst(addslashes($this->input->post("sub_title")));

		if (isset($modal_data['banner_picture']) && !empty($modal_data['banner_picture'])){
			
			$user_data['banner_picture'] = $modal_data['banner_picture']['file_name'];

			$this->db->select('banner_picture');
			$this->db->where('id', $this->input->post("banner_id"));
			$this->db->from('banner');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$banner_picture_old = $return_data->banner_picture;

				if (isset($banner_picture_old) && !empty($banner_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("banner_photo_path") . "/" . $banner_picture_old)) {
						unlink(FCPATH . $this->config->item("banner_photo_path") . "/" . $banner_picture_old);
					}
				}
			}
		}

		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("banner_id"));
		$this->db->update("banner", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Banner updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

}
?>
