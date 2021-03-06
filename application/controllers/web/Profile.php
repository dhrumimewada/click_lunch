<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_customer())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
			}
			redirect(base_url() . "welcome");
		}
		$this->load->library('cart');
		$this->load->model("website/profile_model");
	}

	public function customAlpha($str) {
		if (!preg_match('/^[a-z \-]+$/i', $str)) {
			$this->form_validation->set_message('customAlpha', 'The {field} field contain only alphabets and space.');
			return false;
		}
		return TRUE;
	}

	public function update_profile(){
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'username', 'label' => 'full name', 'rules' => 'trim|required|callback_customAlpha|min_length[3]|max_length[50]'),
					array('field' => 'mobile_number', 'label' => 'mobile number', 'rules' => 'trim|required|min_length[15]|max_length[15]'),
					array('field' => 'dob', 'label' => 'date of birth', 'rules' => 'trim|required'),
					array('field' => 'gender', 'label' => 'gender', 'rules' => 'trim|required')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true){
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
						if($this->profile_model->update_profile($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "contact-info");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "contact-info");
						}
					}
				}
			}
		}

		$where = array('id' => $this->auth->get_user_id(), 'deleted_at' => NULL, 'status' => 1);
        $select = array('email','profile_picture','username','mobile_number','dob','gender');
        $table = 'customer';
        $customer_data = get_data_by_filter($table,$select, $where);

        $data['customer'] = $customer_data[0];

		$data['main_content'] = "profile";
		$this->load->view('web/template',$data);
	}

	public function checkpw($str) {
		$this->db->select('password');
		$this->db->where('id',$this->auth->get_user_id());
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
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

	public function validate_card_number($card_number = NULL, $card_type = NULL) {

		$valid = validate_card($card_number);
		if($valid == FALSE){
			$this->form_validation->set_message('validate_card_number', 'The card number is incorrect');
			return FALSE;
		}else{
			$card_types = array('1' => 'visa', '2' => 'mastercard', '3' => 'amex', '4' => 'jcb', '5' => 'dinnerclub', '6' => 'discover');
			$my_card_type = $card_types[$card_type];
			$card_type = validate_customer_card($card_number);
			if($card_type != '' && $card_type == $my_card_type){
				return TRUE;
			}else{
				$this->form_validation->set_message('validate_card_number', 'The card number is incorrect');
				return FALSE;
			}
		}
	}

	public function validate_expiry_date($expiry_date = NULL){
		$expiry_date_array = explode('/',$expiry_date);

		if(isset($expiry_date) && $expiry_date != '' && !is_null($expiry_date) && checkdate($expiry_date_array[0],'01',$expiry_date_array[1])){
            
            $expiry_date_obj = DateTime::createFromFormat('d/m/Y H:i:s', "01/" . $expiry_date_array[0] . "/" .  $expiry_date_array[1]." 00:00:00");
            $expiry_date_obj = new DateTime($expiry_date_obj->format("Y/m/t"));

            $my_date = date('d/m/Y');
            $today = DateTime::createFromFormat('d/m/Y H:i:s', $my_date ." 00:00:00");

            if($expiry_date_obj >= $today){
                return TRUE;
            }else{
            	$this->form_validation->set_message('validate_expiry_date', 'Your card is expired');
				return FALSE;
            }
        }else{
        	$this->form_validation->set_message('validate_expiry_date', 'The expiry date is invalid');
			return FALSE;
        }
	}

	public function update_password(){
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'old_password', 'label' => 'current password', 'rules' => 'trim|required|callback_checkpw'),
					array('field' => 'new_password', 'label' => 'new password', 'rules' => 'trim|required|min_length[6]|max_length[50]'),
					array('field' => 'confirm_password', 'label' => 'confirm new password', 'rules' => 'trim|required|matches[new_password]')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					$user_data = array('password' => password_hash($this->input->post("new_password"), PASSWORD_DEFAULT));
					$this->db->where('id',$this->auth->get_user_id());
					if($this->db->update('customer',$user_data)){
						$this->auth->set_status_message("Password has been changed successfully.");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "contact-info");
					}else{
						$this->auth->set_status_message("Unable to change password");
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "reset-password");
					}
				}	
			}
		}
		$data['main_content'] = "reset_password";
		$this->load->view('web/template',$data);
	}

	public function payment_setting($id = NULL){
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'card_holder_name', 'label' => 'card holder name', 'rules' => 'trim|required|callback_customAlpha|min_length[3]|max_length[50]'),
					array('field' => 'nickname', 'label' => 'nick name', 'rules' => 'trim|callback_customAlpha|min_length[3]|max_length[50]'),
					array('field' => 'card_number', 'label' => 'card number', 'rules' => 'trim|required|is_natural|min_length[13]|max_length[16]|callback_validate_card_number[' . $this->input->post("card_type") . ']'),
					array('field' => 'expiry_date', 'label' => 'expiry date', 'rules' => 'trim|required|callback_validate_expiry_date'),
					array('field' => 'cvv', 'label' => 'cvv', 'rules' => 'trim|required|is_natural|min_length[3]|max_length[4]'),
					array('field' => 'card_type', 'label' => 'card type', 'rules' => 'trim|required|is_natural')
				);

				$this->form_validation->set_rules($validation_rules);
				
				if ($this->form_validation->run() === true) {
					if($this->profile_model->add_card()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "customer-payment-setting");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "customer-payment-setting");
					}	
				} 
			}
		}

        $payment_card_data = $this->profile_model->get_cards();
        $data['payment_cards'] = $payment_card_data;

        if(isset($id) && !is_null($id) && $id != ''){
        	$my_payment_card = $this->profile_model->get_cards(decrypt($id));
        	$data['my_payment_card'] = $my_payment_card;

        	// echo "<pre>";
        	// print_r($data);
        	// exit;
        }

		$data['main_content'] = "payment_setting";
		$this->load->view('web/template',$data);
	}

	public function payment_card_delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {

			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('customer_payment_card', $user_data);

			$where = array('customer_id' => $this->auth->get_user_id(), 'deleted_at' => NULL);
	        $select = array('id');
	        $table = 'customer_payment_card';
	        $payment_card_data = get_data_by_filter($table,$select, $where);
	        if(empty($payment_card_data)){
	        	$empty = true;
	        }else{
	        	$empty = false;
	        }

			echo json_encode(array("is_success" => true, 'empty' => $empty));
			return TRUE;
			
		}else{
			return FALSE;
		}
	}

	public function add_address(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if($this->profile_model->add_address()){
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "cart");
			}else{
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "cart");
			}
		}else{
			$this->auth->set_error_message("Please try again");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "cart");
		}
	}

	public function all_address(){

		$is_customer = $this->auth->is_customer();
		$is_logged_in = $this->auth->is_logged_in();

		if($is_logged_in && $is_customer){
			$where = array('customer_id' => $this->auth->get_user_id(), 'deleted_at' => NULL);
	        $select = array('id','house_no','street','city','zipcode','latitude','longitude','address_type');
	        $table = 'delivery_address';
	        $customer_addresses = get_data_by_filter($table,$select, $where);

	        $where = array('popular' => 1, 'deleted_at' => NULL);
	        $select = array('id','default_address','house_no','street','city','zipcode','latitude','longitude','address_type');
	        $table = 'delivery_address';
	        $admin_addresses = get_data_by_filter($table,$select, $where);

	        if(isset($_SESSION['delivery_address_id']) && $_SESSION['delivery_address_id'] != ''){
	        	$output_data["default"] = decrypt($_SESSION['delivery_address_id']);
	        }

	        $address_type = $this->config->item("address_type");

	         // echo "<pre>";
	         // print_r($_SESSION['delivery_address_id']);
	         // print_r($output_data);
	        // print_r($address_type);
	       //  exit;
	        $output_data["admin_addresses"] = $admin_addresses;
	        $output_data["customer_addresses"] = $customer_addresses;
	        $output_data["address_type"] = $address_type;

	        $output_data['main_content'] = 'all_address';
			$this->load->view('web/template',$output_data);
		}else{
			redirect(base_url() . "welcome");
		}
	}

	public function my_delievry_address($id = NULL){
		$this->session->set_userdata('delivery_address_id', $id);
		// print_r($this->session->userdata('delivery_address_id'));
		// exit;
		redirect(base_url() . "cart");
	}

	public function change_location(){

		if (isset($_POST) && !empty($_POST)){
			if($this->profile_model->set_as_defualt_address()){
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "change-location");
			}else{
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "change-location");
			}
		}

		$where = array('customer_id' => $this->auth->get_user_id(), 'deleted_at' => NULL);
        $select = array('id','default_address','house_no','street','city','zipcode','latitude','longitude','address_type');
        $table = 'delivery_address';
        $customer_addresses = get_data_by_filter($table,$select, $where);

        $address_type = $this->config->item("address_type");

        $output_data["customer_addresses"] = $customer_addresses;
        $output_data["address_type"] = $address_type;

        $output_data['main_content'] = 'change_location';
		$this->load->view('web/template',$output_data);
	}

	public function unset_d(){
		$this->session->set_userdata('delivery_address_id', '');
	}

	public function order_history(){
		$this->load->library('pagination');

		$order = $this->profile_model->order_history();

		$config['base_url'] = base_url().'order-history';
		$config['total_rows'] = count($order);
		$config['per_page'] = 8;
		$config["uri_segment"] = 2;

		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['prev_link'] = '<i class="mdi mdi-chevron-left mdi-24px"></i>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_link'] = '<i class="mdi mdi-chevron-right mdi-24px"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$output_data["links"] = $this->pagination->create_links();

		

	
		$output_data["order"] = $this->profile_model->order_history($config["per_page"], $page);

		// echo "<pre>";
		// print_r($output_data["order"]);
		// exit;
		$output_data['main_content'] = 'order_history';
		$this->load->view('web/template',$output_data);
	}

	public function favourite_status_update(){

		$is_success = false;
		if (isset($_POST['id']) && !is_null($_POST['id']) && !empty($_POST['id'])) {

			$user_data = array('favourite' => $_POST['status']);
			$this->db->where('id', $_POST['id']);
			if($this->db->update('orders', $user_data)){
				$is_success = true;
			}
		}
		echo json_encode(array("is_success" => $is_success));
		return $is_success;
	}

	public function get_cuisine(){
		$is_success = false;
		$data = array();

		$this->db->select('id,cuisine_name');
		$this->db->from('cuisine');
		$this->db->where("deleted_at", NULL);
		$this->db->where("is_active", 1);
		$this->db->where("cuisine_name !=", 'All');

		if(isset($_POST['str']) && $_POST['str'] != ''){
			$this->db->where("cuisine_name LIKE '%".$_POST['str']."%'");
		}
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$data = $sql_query->result_array();
			$is_success = true;
		}

		echo json_encode(array("is_success" => $is_success, "data" => $data));
		return $is_success;
	}

	public function get_order_history_filtered(){
		//$is_success = false;
		$is_success = true;
		$mydate = '';

		if($_POST['date'] != ''){
			$date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
			$mydate = $date->format('Y-m-d');
		}

		if($_POST['cuisines'] == NULL){
			$filter_data = array();
		}else{
			$filter_data = $this->profile_model->order_history(NULL,NULL, $mydate, $_POST['cuisines']);
		}
		
		echo json_encode(array("is_success" => $is_success, "filter_data" => $filter_data, 'date' => $mydate , 'cuisines' => $_POST['cuisines']));
		return $is_success;

	}

	public function get_favourite_orders(){
		$fav = true;
		$output_data["order"] = $this->profile_model->order_history(NULL, NULL, NULL, array(), $fav);

		// echo "<pre>";
		// print_r($output_data["order"]);
		// exit;
		$output_data['main_content'] = 'favourite_orders';
		$this->load->view('web/template',$output_data);
	}

	public function delete_delievry_address(){
		$is_success = FALSE;
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)){
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->where('customer_id', $this->auth->get_user_id());
			if($this->db->update('delivery_address', $user_data)){
				$is_success = TRUE;
			}else{
				$is_success = FALSE;
			}
		}
		echo json_encode(array("is_success" => $is_success));
		return $is_success;
	}

	public function update_delievry_address(){
		
		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				if($this->profile_model->update_delievry_address()){
					redirect(base_url() . "choose-address");
				}else{
					redirect(base_url() . "choose-address");
				}
			}
		}
	}

}