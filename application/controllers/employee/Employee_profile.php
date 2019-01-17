<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_employee())){

		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("employee/employee_model");
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return FALSE;
		}
		return TRUE;
	}

	public function my_profile(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				
				$validation_rules = array(

					array('field' => 'first_name', 'label' => 'first name', 'rules' => 'trim|required|min_length[2]|max_length[20]|callback_customAlpha'),
					array('field' => 'last_name', 'label' => 'last name', 'rules' => 'trim|required|min_length[2]|max_length[20]|callback_customAlpha'),
					array('field' => 'contact_no', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === TRUE) {

					//echo '<pre>'; print_r($_POST); exit;

					$file_upload = TRUE;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = FALSE;
						$config['file_name'] = 'employee' . '_' . time();
						$config['file_ext_tolower'] = TRUE;

						$this->load->library('upload');
						$this->upload->initialize($config, TRUE);

						if (!$this->upload->do_upload('profile_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = FALSE;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['profile_picture'] = $file_upload_data;
						}

					}

					if ($file_upload){
						if($this->employee_model->update_profile($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-profile");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "employee-profile");
						}
					}
					
				} 


			}
		}

		$data['employee_detail'] = $this->employee_model->get_employee_profile();
		// echo '<pre>'; 
		// print_r($this->db->last_query());
		// print_r($data); exit;
		$data['main_content'] = "employee/my_profile";
		$this->load->view('template/template',$data);
	}

	public function checkpw($str) {
		$this->db->select('password');
		$this->db->where('id',$this->auth->get_user_id());
		$this->db->where('deleted_at', NULL);
		$this->db->from('employee');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$data = $sql_query->row();
			if (!password_verify($str, $data->password)){
				$this->form_validation->set_message('checkpw', 'The current password is incorrect');
				return FALSE;
			}else{
				return TRUE;
			}
		} 
	}

	public function change_password(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'old_password', 'label' => 'current password', 'rules' => 'trim|required|callback_checkpw'),
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'c_password', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					$user_data = array('password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT));
					$this->db->where('id',$this->auth->get_user_id());
					if($this->db->update('employee',$user_data)){
						$this->auth->set_status_message("Password has been changed successfully.");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "employee-change-password");
					}else{
						$this->auth->set_status_message("Unable to change password");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "employee-change-password");
					}
				}	

			}
		}
		$data['main_content'] = "vender/change_password";
		$this->load->view('template/template',$data);
	}
}
?>