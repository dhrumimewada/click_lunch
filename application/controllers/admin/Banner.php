<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banner extends CI_Controller {

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
		$this->load->model("admin/banner_model");
	}

	public function index(){

		$banner_list = $this->banner_model->get_banner();

		$output_data["banner_list"] = $banner_list;
		$output_data['main_content'] = "admin/banner/index";
		$this->load->view('template/template',$output_data);	
	}

	public function highlight(){

		$highlight_list = $this->banner_model->get_highlight();

		$output_data["highlight_list"] = $highlight_list;
		// echo "<pre>";
		// print_r($output_data);
		// exit;
		$output_data['main_content'] = "admin/banner/highlight";
		$this->load->view('template/template',$output_data);	
	}

	public function highlight_put1(){
		
		$error = false;
		$number = 0;
		foreach ($_POST['highlight0'] as $key => $value) {
			if(trim($value) == ''){
				$error = true;
				$number = $key+1;
				break;
			}
		}
		if($error == true){
			$this->auth->set_error_message('Highlight text '.$number.' is required');
		}else{
			$this->auth->set_status_message("Slider text updated successfully");	
		}
		$this->session->set_flashdata($this->auth->get_messages_array());
		redirect(base_url() . "highlight-list");
		
	}

	public function highlight_put($id = NULL){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'txt1', 'label' => 'highlight text1', 'rules' => 'trim|required|max_length[8]'),
					array('field' => 'txt2', 'label' => 'highlight text2', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'txt3', 'label' => 'highlight text3', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'highlight_id', 'label' => 'highlight id', 'rules' => 'trim|required')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {
					if($this->banner_model->highlight_put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "highlight-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "highlight-update/".encrypt($this->input->post("highlight_id")));
					}	
				} 
			}
		}
		$output_data['highlight'] = $this->banner_model->get_highlight(decrypt($id));
		$output_data['main_content'] = "admin/banner/highlight_put";
		$this->load->view('template/template',$output_data);	
	}

	public function isexists($str = NULL, $id = NULL) {

			$this->db->select('*');
			if ($id != '') {
				$this->db->where_not_in('id', $id);
			}
			$this->db->where('banner_name', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('banner');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The banner name field is already exists");
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
			$this->db->update('banner', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_banner(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('banner', $user_data);
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
					
					array('field' => 'title', 'label' => 'title', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
					array('field' => 'sub_title', 'label' => 'subtitle', 'rules' => 'trim|required|min_length[2]|max_length[100]')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					// echo "<pre>";
					// print_r($_FILES);
					// exit;

					if (isset($_FILES['banner_picture']) && !empty($_FILES['banner_picture']) && strlen($_FILES['banner_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("banner_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'banner' . '_' . time();
						$config['file_ext_tolower'] = true;
						$config['min_width'] = '1920';
						$config['min_height'] = '900';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('banner_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['banner_picture'] = $file_upload_data;

							$this->load->library('image_lib');

							$config['image_library'] = 'gd2';
							$config['source_image'] = FCPATH . $this->config->item("banner_photo_path").'/'.$file_upload_data['file_name'];
							$config['create_thumb'] = TRUE;
							$config['thumb_marker'] = '_thumb';
						    $config['maintain_ratio'] = TRUE;
						    $config['width'] = 600;
	    					$config['height'] = 600;

						    $this->image_lib->clear();
						    $this->image_lib->initialize($config);

						    if (!$this->image_lib->resize()){
							    ucfirst($this->upload->display_errors());
								$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
								$this->session->set_flashdata($this->auth->get_messages_array());
								$file_upload = false;
							}else{
								$file_upload = true;
							}

						}

					}

					if ($file_upload){
						if($this->banner_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "banner-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "banner-add");
						}
					}
					
				} 
			}
		}

		$output_data['main_content'] = "admin/banner/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'title', 'label' => 'title', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
					array('field' => 'sub_title', 'label' => 'subtitle', 'rules' => 'trim|required|min_length[2]|max_length[100]')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					// echo "<pre>";
					// print_r($_POST);
					// exit;

					if (isset($_FILES['banner_picture']) && !empty($_FILES['banner_picture']) && strlen($_FILES['banner_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("banner_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'banner' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('banner_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['banner_picture'] = $file_upload_data;

							// $this->load->library('image_lib');

							// $config['image_library'] = 'gd2';
							// $config['source_image'] = FCPATH . $this->config->item("banner_photo_path").'/'.$file_upload_data['file_name'];
							// $config['create_thumb'] = TRUE;
							// $config['thumb_marker'] = '_thumb';
						 //    $config['maintain_ratio'] = TRUE;
						 //    $config['width'] = 600;
	    		// 			$config['height'] = 600;

						 //    $this->image_lib->clear();
						 //    $this->image_lib->initialize($config);

						 //    if (!$this->image_lib->resize()){
							//     ucfirst($this->upload->display_errors());
							// 	$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							// 	$this->session->set_flashdata($this->auth->get_messages_array());
							// 	$file_upload = false;
							// }else{
							// 	$file_upload = true;
							// }
							
						}

					}

					if ($file_upload){
						if($this->banner_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "banner-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "banner-update/".encrypt($this->input->post("banner_id")));
						}
					}
					
				} 
			}
		}
		$output_data['banner_data'] = $this->banner_model->get_banner(decrypt($id));
		// if (!isset($output_data['banner_data']) || empty($output_data['banner_data']) || count($output_data['banner_data']) <= 0){
		// 	$this->auth->set_error_message("Banner data not found");
		// 	$this->session->set_flashdata($this->auth->get_messages_array());
		// 	redirect(base_url() . "banner-list");
		// }
		$output_data['main_content'] = "admin/banner/put";
		$this->load->view('template/template',$output_data);	
	}

}
