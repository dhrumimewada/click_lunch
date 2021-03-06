<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {

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
		$this->load->model("admin/customer_model");
	}

	public function index(){

		//$customer_list = $this->customer_model->get_customer();

		//$output_data["customer_list"] = $customer_list;
		//echo "<pre>"; print_r($output_data["customer_list"]); exit;
		$output_data['main_content'] = "admin/customer/index";
		$this->load->view('template/template',$output_data);	
	}

	public function customer_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));


	  	$customer_list = $this->customer_model->get_customer();

	 	$data = array();
	 	$action_data = '';
	 	$edit_link = base_url().'customer-update';

		foreach($customer_list as $key => $customer) {

		       $action_data = "<a href='".$edit_link."/".encrypt($customer['id'])."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a>";

		       if($customer["status"] == 1){
	                $btn_name = 'Active';
	                $btn_class = 'btn-success';
	            }else{
	                $btn_name = 'Deactivated';
	                $btn_class = 'btn-deactive';
	            }

		       $status_str = "<button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_customer' status-id='" . $customer["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button>";

		       $data[] = array(
		            $customer['id'],
		            stripslashes($customer["username"]),
		            $customer['email'],
		            $customer['address'],
		            $status_str,
		            $action_data
		       );

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($customer_list),
	         "recordsFiltered" => count($customer_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
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
					
					array('field' => 'username', 'label' => 'full name', 'rules' => 'trim|required|min_length[3]|max_length[50]'),
					array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|max_length[225]|valid_email|is_unique[customer.email]'),
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'c_password', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]'),
					array('field' => 'mobile_number', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required|max_length[255]')
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {

					$file_upload = true;
					// echo "<pre>";
					// print_r($_FILES);
					// exit;

					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("customer_profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'customer' . '_' . time();
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
						if($this->customer_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "customer-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "customer-add");
						}
					}
					
				} 
			}
		}

		$output_data['main_content'] = "admin/customer/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'username', 'label' => 'full name', 'rules' => 'trim|required|min_length[3]|max_length[50]'),
					array('field' => 'mobile_number', 'label' => 'contact number', 'rules' => 'trim|min_length[12]|max_length[12]'),
					array('field' => 'address', 'label' => 'street', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'dob', 'label' => 'date of birth', 'rules' => 'trim|required'),
					array('field' => 'gender', 'label' => 'gender', 'rules' => 'trim|required')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']) && strlen($_FILES['profile_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("customer_profile_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'customer' . '_' . time();
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
						if($this->customer_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "customer-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "customer-update");
						}
					}
					
				} 
			}
		}

		$output_data["customer_detail"] = $this->customer_model->get_customer(decrypt($id));

		if (!isset($output_data['customer_detail']) || empty($output_data['customer_detail']) || count($output_data['customer_detail']) <= 0){
			$this->auth->set_error_message("Customer not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "customer-list");
		}

		$output_data['id'] = $id;
		$output_data['main_content'] = "admin/customer/put";
		$this->load->view('template/template',$output_data);	
	}

	public function active_deactive_customer(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			if($this->db->update('customer', $user_data)){
				if($status == 2){
					$result = $this->customer_model->send_silent_push($_POST['id']);
				}
				$is_success = $this->customer_model->customer_status_update_sendmail($id , $status);
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
			$this->db->update('customer', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
