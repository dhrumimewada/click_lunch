<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatcher extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if($this->auth->is_dispatcher()){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "dispatcher-logout");
			}
		}
		$this->load->model("dispatcher/dispatcher_model");
	}

	public function dashboard(){
		$output_data['total'] = $this->dispatcher_model->get_total();
		$output_data['main_content'] = "dispatcher/dashboard";
		$this->load->view('template/template',$output_data);	
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return false;
		}
		return TRUE;
	}

	public function profile(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				
				$validation_rules = array(

					array('field' => 'full_name', 'label' => 'full name', 'rules' => 'trim|required|min_length[3]|max_length[50]|callback_customAlpha'),
					array('field' => 'address', 'label' => 'address', 'rules' => 'trim'),
					array('field' => 'contact_no', 'label' => 'contact number', 'rules' => 'trim|numeric|required|min_length[10]|max_length[15]|greater_than[0]')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === TRUE) {

					// echo '<pre>'; print_r($_POST);print_r($_FILES); exit;

					$file_upload = TRUE;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = FALSE;
						$config['file_name'] = 'dispatcher' . '_' . time();
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
						if($this->dispatcher_model->update_profile($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "dispatcher-profile");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "dispatcher-profile");
						}
					}
					
				} 


			}
		}

		$data['dispatcher_detail'] = $this->dispatcher_model->get_dispatcher($this->auth->get_user_id());
		// echo '<pre>'; 
		// print_r($this->db->last_query());
		// print_r($data); exit;
		$data['main_content'] = "dispatcher/profile";
		$this->load->view('template/template',$data);
	}

	public function checkpw($str) {
		$this->db->select('password');
		$this->db->where('id',$this->auth->get_user_id());
		$this->db->where('deleted_at', NULL);
		$this->db->from('delivery_dispatcher');
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
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]|max_length[50]'),
					array('field' => 'c_password', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					$user_data = array('password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT));
					$this->db->where('id',$this->auth->get_user_id());
					if($this->db->update('delivery_dispatcher',$user_data)){
						$this->auth->set_status_message("Password has been changed successfully.");
						$this->session->set_flashdata($this->auth->get_messages_array());
						// print_r('changed');
						// exit;
						redirect(base_url() . "dispatcher-change-password");
					}else{
						$this->auth->set_status_message("Unable to change password");
						$this->session->set_flashdata($this->auth->get_messages_array());
						// print_r('Unable');
						// exit;
						redirect(base_url() . "dispatcher-change-password");
					}
				}	

			}
		}
		$data['main_content'] = "dispatcher/change_password";
		$this->load->view('template/template',$data);
	}

}
?>
