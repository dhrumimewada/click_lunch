<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_vender())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("vender/employee_model");
	}

	public function index(){

		$employee_list = $this->employee_model->get_employee();
		$output_data["employee_list"] = $employee_list;
		//echo "<pre>"; print_r($output_data["employee_list"]); exit;
		//echo "<pre>"; print_r($this->db->last_query()); exit;
		$output_data['main_content'] = "vender/employee/index";
		$this->load->view('template/template',$output_data);	
	}

	public function isexists($str = NULL) {

			$this->db->select('email');
			$this->db->where('email', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('employee');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The email field is already exists");
				return FALSE;
			} else {
				return TRUE;
			}
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
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
					
					array('field' => 'first_name', 'label' => 'first name', 'rules' => 'trim|required|min_length[2]|callback_customAlpha'),
					array('field' => 'last_name', 'label' => 'last name', 'rules' => 'trim|required|min_length[2]|callback_customAlpha'),
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'role', 'label' => 'role', 'rules' => 'trim|required|is_natural_no_zero')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'employee' . '_' . time();
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
						if($this->employee_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-add");
						}
					}
				} 
			}
		}

		$output_data['role_data'] = $this->employee_model->get_roles();
		$output_data['main_content'] = "vender/employee/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'first_name', 'label' => 'first name', 'rules' => 'trim|required|min_length[2]|callback_customAlpha'),
					array('field' => 'last_name', 'label' => 'last name', 'rules' => 'trim|required|min_length[2]|callback_customAlpha'),
					array('field' => 'role', 'label' => 'role', 'rules' => 'trim|required|is_natural_no_zero')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {



					$file_upload = true;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'employee' . '_' . time();
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
						if($this->employee_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-update/".encrypt($this->input->post("employee_id")));
						}
					}
					
				} 
			}
		}
		$output_data['role_data'] = $this->employee_model->get_roles();
		$output_data['employee_data'] = $this->employee_model->get_employee(decrypt($id));
		if (!isset($output_data['employee_data']) || empty($output_data['employee_data']) || count($output_data['employee_data']) <= 0){
			$this->auth->set_error_message("Employee not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "employee-list");
		}
		$output_data['main_content'] = "vender/employee/put";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('employee', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_employee(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('employee', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}


}
?>