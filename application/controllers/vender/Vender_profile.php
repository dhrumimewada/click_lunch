<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vender_profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'profile')) ) ) {
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("vender/vender_model");
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return FALSE;
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

	public function my_profile(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				
				$validation_rules = array(

					array('field' => 'shop_name', 'label' => 'shop title', 'rules' => 'trim|required|max_length[50]'),
					array('field' => 'tag_line', 'label' => 'tagline', 'rules' => 'trim|max_length[70]'),
					array('field' => 'vender_name', 'label' => 'owner name', 'rules' => 'trim|required|max_length[50]|callback_customAlpha'),
					array('field' => 'tax_number', 'label' => 'TAX number', 'rules' => 'trim|callback_valid_taxno'),
					array('field' => 'contact_no1', 'label' => 'contact number', 'rules' => 'trim|required|min_length[12]|max_length[12]'),
					array('field' => 'contact_no2', 'label' => 'alternate contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),

					array('field' => 'delivery_morning_from', 'label' => 'from time', 'rules' => 'trim|required'),
					array('field' => 'delivery_morning_to', 'label' => 'to time', 'rules' => 'trim|required'),
					array('field' => 'delivery_evening_from', 'label' => 'from time', 'rules' => 'trim|required'),
					array('field' => 'delivery_evening_to', 'label' => 'to time', 'rules' => 'trim|required'),

					array('field' => 'delivery_time', 'label' => 'delivery time', 'rules' => 'trim|required'),
					array('field' => 'order_by_time', 'label' => 'order by time', 'rules' => 'trim|required'),

					array('field' => 'cuisines[]', 'label' => 'shop cuisines', 'rules' => 'trim|required|numeric'),
					array('field' => 'website', 'label' => 'shop website', 'rules' => 'trim|valid_url'),
					array('field' => 'min_order', 'label' => 'minimum order', 'rules' => 'trim|required|numeric|greater_than_equal_to[0]'),
					array('field' => 'service_charge', 'label' => 'service charge', 'rules' => 'trim|required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]|max_length[10]'),
					array('field' => 'facebook_link', 'label' => 'facebook link', 'rules' => 'trim|valid_url'),
					array('field' => 'twitter_link', 'label' => 'twitter link', 'rules' => 'trim|valid_url'),
					array('field' => 'pinterest_link', 'label' => 'pinterest link', 'rules' => 'trim|valid_url'),
					array('field' => 'payment_mode[]', 'label' => 'payment mode', 'rules' => 'trim|required|numeric'),
					array('field' => 'takeout_delivery_status[]', 'label' => 'available service', 'rules' => 'trim|required|numeric'),
					array('field' => 'about', 'label' => 'description', 'rules' => 'trim|required|min_length[150]')
				);

				$this->form_validation->set_rules($validation_rules);


				if ($this->form_validation->run() === TRUE) {

					$file_upload = $file_upload2 =  TRUE;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = FALSE;
						$config['file_name'] = 'vender' . '_' . time();
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

							$this->load->library('image_lib');

							$config['image_library'] = 'gd2';
							$config['source_image'] = FCPATH . $this->config->item("profile_path").'/'.$file_upload_data['file_name'];
							$config['create_thumb'] = TRUE;
							$config['thumb_marker'] = '';
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

					if (isset($_FILES['broacher']) && !empty($_FILES['broacher']) && strlen($_FILES['broacher']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("brochure_path");
						$config['allowed_types'] = 'pdf';
						$config['encrypt_name'] = FALSE;
						$config['file_name'] = 'brochure' . '_' . time();
						$config['file_ext_tolower'] = TRUE;

						$this->load->library('upload');
						$this->upload->initialize($config, TRUE);

						if (!$this->upload->do_upload('broacher')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload2 = FALSE;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['broacher'] = $file_upload_data;
						}
					}

					if ($file_upload && $file_upload2){
						// $abc = $this->vender_model->update_profile($modal_data);
						// echo "<pre>";
						// print_r($abc);
						// exit;
						if($this->vender_model->update_profile($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-profile");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "vender-profile");
						}
					}
					
				}
			}
		}
		
		if($this->auth->is_vender()){
			$user_id = $this->auth->get_user_id();
		}else if(($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'profile')) ){
			$user_id = $this->auth->get_emp_shop_id();
		}else{
			
		}
		

		$data['vender_detail'] = $this->vender_model->get_vender_detail($user_id);
		$data['vender_cuisine_detail'] = $this->vender_model->get_vender_cuisine($user_id);
		$data['shop_availibality'] = $this->vender_model->get_shop_availibality($user_id);
		$shop_hour = $this->vender_model->get_shop_hour($user_id);


		$delivery = array();
		foreach ($shop_hour as $key => $value) {
			if($value['morning_evening'] == 1){
				$delivery['morning']['from'] = $value['from_time'];
				$delivery['morning']['to'] = $value['to_time'];
			}else{
				$delivery['evening']['from'] = $value['from_time'];
				$delivery['evening']['to'] = $value['to_time'];
			}
		}

		$data['delivery'] = $delivery;
		$data['cuisines_data'] = get_cuisine();
		$data['main_content'] = "vender/my_profile";

		// echo "<pre>";
		// print_r($data['vender_detail']);
		// exit;

		$this->load->view('template/template',$data);
	}

	public function checkpw($str) {
		$this->db->select('password');
		$this->db->where('id',$this->auth->get_user_id());
		$this->db->where('deleted_at', NULL);
		$this->db->from('shop');
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
					if($this->db->update('shop',$user_data)){
						$this->auth->set_status_message("Password has been changed successfully.");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "vender-change-password");
					}else{
						$this->auth->set_status_message("Unable to change password");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "vender-change-password");
					}
				}	

			}
		}
		$data['main_content'] = "vender/change_password";
		$this->load->view('template/template',$data);
	}
}
?>