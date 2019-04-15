<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_admin())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You must be authenticated to access this page.");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "logout-admin");
			}
			
		}
		$this->load->model("admin_model");
	}

	public function admin_list(){

		$admin_list = $this->admin_model->get_all_admin();

		$output_data["admin_list"] = $admin_list;
		$output_data['main_content'] = "admin/admin_list";
		$this->load->view('template/template',$output_data);	
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return false;
		}
		return TRUE;
	}

	public function isexists($str) {
		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->from('admin');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$this->form_validation->set_message('isexists', "This email id is already in use.");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function checkpw($str) {
		$this->db->select('password');
		$this->db->where('id',$this->auth->get_user_id());
		$this->db->where('deleted_at', NULL);
		$this->db->from('admin');
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

	public function create_new_admin(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|min_length[3]|callback_customAlpha'),
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'c_password', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);

				
				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'admin' . '_' . time();
						$config['file_ext_tolower'] = true;


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

						if($this->admin_model->add_admin($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "admin-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "add_admin");
						}
					}
					
				} 
			}
		}

		$data['main_content'] = "admin/add_admin";
		$this->load->view('template/template',$data);
	}

	public function delete_admin(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$this->db->where('id', $id);
			$this->db->delete('admin');
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_admin(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('admin', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
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
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]|max_length[50]'),
					array('field' => 'c_password', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					$user_data = array('password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT));
					$this->db->where('id',$this->auth->get_user_id());
					if($this->db->update('admin',$user_data)){
						$this->auth->set_status_message("Password has been changed successfully.");
						$this->session->set_flashdata($this->auth->get_messages_array());
						// print_r('changed');
						// exit;
						redirect(base_url() . "change-password");
					}else{
						$this->auth->set_status_message("Unable to change password");
						$this->session->set_flashdata($this->auth->get_messages_array());
						// print_r('Unable');
						// exit;
						redirect(base_url() . "change-password");
					}
				}	

			}
		}
		$data['main_content'] = "admin/change_password";
		$this->load->view('template/template',$data);
	}

	public function my_profile(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(

					array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|min_length[3]|callback_customAlpha')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {

					$file_upload = true;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'admin' . '_' . time();
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
						if($this->admin_model->update_profile($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "my-profile");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "my-profile");
						}
					}
					
				} 
			}
		}

		$data['user_data'] = $this->admin_model->get_user_detail();
		$data['main_content'] = "admin/my_profile";
		$this->load->view('template/template',$data);
	}
}
