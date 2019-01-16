<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vender extends CI_Controller {

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
		$this->load->model("vender_model");
	}

	public function index(){

		$vender_list = $this->vender_model->get_vender();

		$output_data["vender_list"] = $vender_list;
		//echo "<pre>"; print_r($output_data["vender_list"]); exit;
		$output_data['main_content'] = "admin/vender/index";
		$this->load->view('template/template',$output_data);	
	}

	public function sendmail()
	{
		$this->load->view('email_templates/activation_mail');
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return false;
		}
		return TRUE;
	}

	public function valid_taxno($str) {
		if (strpos($str, '_') !== false) {
			$this->form_validation->set_message('valid_taxno', 'The {field} field is invalid.');
			return false;
		}
		return TRUE;
	}

	public function post(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'shop_name', 'label' => 'restaurant name', 'rules' => 'trim|required|max_length[50]'),
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'vender_name', 'label' => 'contact person name', 'rules' => 'trim|required|min_length[3]|max_length[50]|callback_customAlpha'),
					array('field' => 'address', 'label' => 'address', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'contact_no1', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'contact_no2', 'label' => 'alternate contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'website', 'label' => 'restaurant website', 'rules' => 'trim|valid_url'),
					array('field' => 'tax_number', 'label' => 'TAX id', 'rules' => 'trim|callback_valid_taxno')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'vender' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('profile_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['profile_picture'] = $file_upload_data;
						}

					}

					if ($file_upload){
						if($this->vender_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-add");
						}
					}
					
				} 
			}
		}

		$output_data['main_content'] = "admin/vender/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'shop_name', 'label' => 'restaurant name', 'rules' => 'trim|required|min_length[2]'),
					array('field' => 'vender_name', 'label' => 'contact person name', 'rules' => 'trim|required|min_length[3]|callback_customAlpha'),
					array('field' => 'contact_no1', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'contact_no2', 'label' => 'alternate contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'address', 'label' => 'address', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'website', 'label' => 'restaurant website', 'rules' => 'trim|valid_url'),
					array('field' => 'tax_number', 'label' => 'TAX id', 'rules' => 'trim|callback_valid_taxno'),
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'vender' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('profile_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['profile_picture'] = $file_upload_data;
						}

					}

					if ($file_upload){
						if($this->vender_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-update");
						}
					}
					
				} 
			}
		}

		$output_data["vender_detail"] = $this->vender_model->get_vender(decrypt($id));

		if (!isset($output_data['vender_detail']) || empty($output_data['vender_detail']) || count($output_data['vender_detail']) <= 0){
			$this->auth->set_error_message("Vender not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "vender-list");
		}

		$output_data['id'] = $id;
		$output_data['main_content'] = "admin/vender/put";
		$this->load->view('template/template',$output_data);	
	}


	public function isexists($str) {
		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->from('shop');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$this->form_validation->set_message('isexists', "The shop email is already in use.");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	

	public function active_deactive_vender(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('shop', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('shop', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function vender_perc(){
		$vender_perc = $this->vender_model->get_vender();
		$output_data["vender_perc_list"] = $vender_perc;
		//echo "<pre>"; print_r($output_data["vender_perc"]); exit;
		$output_data['main_content'] = "admin/vender/vender_perc";
		$this->load->view('template/template',$output_data);	
	}

	public function put_vender_perc(){
		$id = $_POST['id'];
		$perc_num = $_POST['perc_num'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('percentage' => number_format((float)$perc_num, 2, '.', '') );
			$this->db->where('id', $id);
			$this->db->update('shop', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
