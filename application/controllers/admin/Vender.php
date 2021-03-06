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

	public function vender_resend_activation_mail($shop_id = NULL){
		if(isset($shop_id) && $shop_id != ''){
			$send_mail = $this->vender_model->vender_resend_activation_mail($shop_id);
			echo json_encode($send_mail);
			return TRUE;
		}
		
	}

	public function sendmail()
	{
		//$this->load->view('email_templates/activation_mail');
		$abc = sendmail($from='dhrumi@yopmaol.com', $to = 'dhrumi2@yopmaol.com', $subject = 'test m', $message = 'msss');
		echo "<pre>";
		print_r($abc);
		exit;
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

			// echo "<pre>";
			// print_r($_POST);
			// exit;

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'shop_name', 'label' => 'restaurant name', 'rules' => 'trim|required|max_length[50]'),
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'vender_name', 'label' => 'contact person name', 'rules' => 'trim|required|min_length[3]|max_length[50]|callback_customAlpha'),
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'contact_no1', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'contact_no2', 'label' => 'alternate contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'website', 'label' => 'restaurant website', 'rules' => 'trim|valid_url'),
					array('field' => 'tax_number', 'label' => 'TAX id', 'rules' => 'trim|callback_valid_taxno'),
					array('field' => 'minimum_mile', 'label' => 'minimum mile', 'rules' => 'trim|required'),
					array('field' => 'charges_of_minimum_mile', 'label' => 'charges of minimum mile', 'rules' => 'trim|required'),
					array('field' => 'delivery_charges', 'label' => 'delivery charges', 'rules' => 'trim|required'),
					array('field' => 'payment_mode[]', 'label' => 'payment', 'rules' => 'trim|required')
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
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'website', 'label' => 'restaurant website', 'rules' => 'trim|valid_url'),
					array('field' => 'tax_number', 'label' => 'TAX id', 'rules' => 'trim|callback_valid_taxno'),
					array('field' => 'minimum_mile', 'label' => 'minimum mile', 'rules' => 'trim|required'),
					array('field' => 'charges_of_minimum_mile', 'label' => 'charges of minimum mile', 'rules' => 'trim|required'),
					array('field' => 'delivery_charges', 'label' => 'delivery charges', 'rules' => 'trim|required'),
					array('field' => 'payment_mode[]', 'label' => 'payment', 'rules' => 'trim|required')
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
			$this->form_validation->set_message('isexists', "The restaurant email is already in use.");
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
			if($this->db->update('shop', $user_data)){
				// $is_success = TRUE;
				$is_success = $this->vender_model->vender_status_update_sendmail($id , $status);

			}else{
				$is_success = FALSE;
			}
			echo json_encode(array("is_success" => $is_success));
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

			$this->db->where('shop_id', $id);
			$this->db->update('favorite', $user_data);

			$this->db->where('shop_id', $id);
			$this->db->update('item', $user_data);

			$this->db->where('shop_id', $id);
			$this->db->update('orders', $user_data);

			$this->db->where('shop_id', $id);
			$this->db->update('promocode', $user_data);

			// $this->db->where('shop_id', $id);
			// $this->db->delete('promocode_products');

			// $this->db->where('shop_id', $id);
			// $this->db->delete('promocode_shops');

			// $this->db->where('shop_id', $id);
			// $this->db->delete('promocode_valid_product');

			$this->db->where('shop_id', $id);
			$this->db->update('rating', $user_data);

			// $this->db->where('shop_id', $id);
			// $this->db->delete('shop_availibality');

			// $this->db->where('shop_id', $id);
			// $this->db->delete('shop_cuisines');

			// $this->db->where('shop_id', $id);
			// $this->db->delete('shop_hours');

			$this->db->select('id');
			$this->db->from('variant_group');
			$this->db->where('shop_id', $id);
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0){
				
				$return_data = $sql_query->result_array();
				$variant_group_array = array_column($return_data, 'id');
				$variant_group_list = explode(',',$variant_group_array);

				// $this->db->where_in('variant_group_id', $variant_group_list);
				// $this->db->delete('variant_items');

				$this->db->where('shop_id', $id);
				$this->db->update('variant_group', $user_data);

			}

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

	public function vendor_requests(){
		$output_data['main_content'] = "admin/vender/requests";
		$this->load->view('template/template',$output_data);	
	}

	public function vendor_request_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));

	  	$vendor_request_list = $this->vender_model->get_vendor_request();

	 	$data = array();
	 	$action_data = '';
	 	$edit_link = base_url().'vender-request-update';

		foreach($vendor_request_list as $key => $vendor_request) {
				// <a href='".$edit_link."/".encrypt($vendor_request['id'])."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a>
		       $action_data = "<span class='text-center d-block'> <button type='button' class='btn btn-yellow btn-sm waves-effect waves-light view-msg' title='Accept' data-popup='tooltip' data-shopname='".$vendor_request['shop_name']."'  data-msg='".$vendor_request['message']."' data-toggle='modal' data-target='#myModal'>View</button><button type='button' class='btn btn-success btn-sm waves-effect waves-light accept_vendor_request' title='Accept' data-popup='tooltip' data-toggle='modal' data-target='#accept-modal'  data-shopname='".$vendor_request['shop_name']."'>Accept</button> <button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_vendor_request' title='Verified' data-popup='tooltip' >Delete</button> <span>";

		       $data[] = array(
		            $vendor_request['id'],
		            stripslashes($vendor_request["shop_name"]),
		            stripslashes(ucfirst($vendor_request["vender_name"])),
		            $vendor_request['email'],
		            '+1 '.$vendor_request['contact_no1'],
		            $vendor_request['city'].', '.$vendor_request['zip_code'].', '.$vendor_request['state'],
		            $action_data
		       );

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($vendor_request_list),
	         "recordsFiltered" => count($vendor_request_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

  	public function vendor_request_accept(){
  		$id = $_POST['id'];
  		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('admin_verified' => 1 );
			$this->db->where('id', $id);
			$this->db->update('shop', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
  	}

  	public function vendor_request_put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'shop_name', 'label' => 'restaurant name', 'rules' => 'trim|required|max_length[50]'),
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'vender_name', 'label' => 'contact person name', 'rules' => 'trim|required|min_length[3]|max_length[50]|callback_customAlpha'),
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'country', 'label' => 'country', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'zipcode', 'label' => 'zip code', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'latitude', 'label' => 'latitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'longitude', 'label' => 'longitude', 'rules' => 'trim|max_length[255]'),
					array('field' => 'contact_no1', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'contact_no2', 'label' => 'alternate contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'website', 'label' => 'restaurant website', 'rules' => 'trim|valid_url'),
					array('field' => 'tax_number', 'label' => 'TAX id', 'rules' => 'trim|callback_valid_taxno'),
					array('field' => 'minimum_mile', 'label' => 'minimum mile', 'rules' => 'trim|required'),
					array('field' => 'charges_of_minimum_mile', 'label' => 'charges of minimum mile', 'rules' => 'trim|required'),
					array('field' => 'delivery_charges', 'label' => 'delivery charges', 'rules' => 'trim|required'),
					array('field' => 'payment_mode[]', 'label' => 'payment', 'rules' => 'trim|required')
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

						// $data = $this->vender_model->post($modal_data);
						// echo "<pre>";
						// print_r($_POST);
						// print_r($this->auth->get_messages_array());
						// exit;

						if($this->vender_model->post($modal_data)){

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

		$output_data["vender_detail"] = $this->vender_model->get_vendor_request(decrypt($id));

		// if (!isset($output_data['vender_detail']) || empty($output_data['vender_detail']) || count($output_data['vender_detail']) <= 0){
		// 	$this->auth->set_error_message("Vender not found");
		// 	$this->session->set_flashdata($this->auth->get_messages_array());
		// 	redirect(base_url() . "vender-requests");
		// }

		// echo "<pre>";
		// print_r($id);
		// exit;

		$output_data['id'] = $id;
		$output_data['main_content'] = "admin/vender/request_put";
		$this->load->view('template/template',$output_data);	
	}

	public function vendor_request_delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('shop_request', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
