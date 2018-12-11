<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cuisine extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_admin())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "logout-admin");
			}
		}
		$this->load->model("admin/cuisine_model");
	}

	public function index(){

		$cuisine_list = $this->cuisine_model->get_cuisine();

		$output_data["cuisine_list"] = $cuisine_list;
		$output_data['main_content'] = "admin/cuisine/index";
		$this->load->view('template/template',$output_data);	
	}

	public function location(){

		$output_data['main_content'] = "admin/cuisine/location";
		$this->load->view('template/template',$output_data);	
	}

	public function isexists($str = NULL, $id = NULL) {

			$this->db->select('*');
			if ($id != '') {
				$this->db->where_not_in('id', $id);
			}
			$this->db->where('cuisine_name', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('cuisine');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The cuisine name field is already exists");
				return FALSE;
			} else {
				return TRUE;
			}
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('cuisine', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_cuisine(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('is_active' => $status );
			$this->db->where('id', $id);
			$this->db->update('cuisine', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function post(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'cuisine_name', 'label' => 'cuisine name', 'rules' => 'trim|required|min_length[2]|callback_isexists')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					// echo "<pre>";
					// print_r($_FILES);
					// exit;

					if (isset($_FILES['cuisine_picture']) && !empty($_FILES['cuisine_picture']) && strlen($_FILES['cuisine_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("cuisine_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'cuisine' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('cuisine_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['cuisine_picture'] = $file_upload_data;
						}

					}

					if ($file_upload){
						if($this->cuisine_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "cuisine-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "cuisine-add");
						}
					}
					
				} 
			}
		}

		$output_data['main_content'] = "admin/cuisine/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'cuisine_name', 'label' => 'cuisine name', 'rules' => 'trim|required|min_length[2]|callback_isexists[' . $this->input->post("cuisine_id") . ']')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					// echo "<pre>";
					// print_r($_POST);
					// exit;

					if (isset($_FILES['cuisine_picture']) && !empty($_FILES['cuisine_picture']) && strlen($_FILES['cuisine_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("cuisine_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'cuisine' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('cuisine_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['cuisine_picture'] = $file_upload_data;
						}

					}

					if ($file_upload){
						if($this->cuisine_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "cuisine-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "cuisine-update/".encrypt($this->input->post("cuisine_id")));
						}
					}
					
				} 
			}
		}
		$output_data['cuisine_data'] = $this->cuisine_model->get_cuisine(decrypt($id));
		if (!isset($output_data['cuisine_data']) || empty($output_data['cuisine_data']) || count($output_data['cuisine_data']) <= 0){
			$this->auth->set_error_message("Cuisine data not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "cuisine-list");
		}
		$output_data['main_content'] = "admin/cuisine/put";
		$this->load->view('template/template',$output_data);	
	}

}
