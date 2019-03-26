<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_template extends CI_Controller {

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
		$this->load->model("email_template_model");
	}

	public function index(){
		$template_list = $this->email_template_model->get_templates();
		$output_data["template_list"] = $template_list;
		$output_data['main_content'] = "admin/email_template/index";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = NULL){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'emat_email_subject', 'label' => 'email subject', 'rules' => 'trim|required'),
					array('field' => 'emat_email_message', 'label' => 'email message', 'rules' => 'trim|required')
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){

					///echo "<pre>"; print_r($_POST); exit;

					if($this->email_template_model->put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}
				}	

			}
		}
		
		$output_data["template_detail"] = $this->email_template_model->get_templates($id);
		if (!isset($output_data['template_detail']) || empty($output_data['template_detail']) || count($output_data['template_detail']) <= 0){
			$this->auth->set_error_message("Email template data not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "email-list");
		}
		$output_data['main_content'] = "admin/email_template/put";
		$this->load->view('template/template',$output_data);	
	}

	public function custom_email($to = NULL){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'email_to[]', 'label' => 'email to', 'rules' => 'trim|required'),
					array('field' => 'emat_email_subject', 'label' => 'email subject', 'rules' => 'trim|required'),
					array('field' => 'emat_email_message', 'label' => 'email message', 'rules' => 'trim|required'),
					array('field' => 'to_type', 'label' => 'email type', 'rules' => 'trim|required')
				);


				//echo "<pre>";
					//print_r(htmlentities($_POST['emat_email_message']));
					// $txt = htmlentities($_POST['emat_email_message']);
					// print_r(html_entity_decode($txt));
					// exit;

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					 // $abc = $this->email_template_model->send_custom_email();
					 // exit;
					
					if($this->email_template_model->send_custom_email()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "email-list");
					}
				}	

			}
		}

		$to_list = $this->email_template_model->get_table_data($to);
		
		$output_data["to_list"] = $to_list;
		$output_data["to"] =$to;
		$output_data['main_content'] = "admin/email_template/email_custom";
		$this->load->view('template/template',$output_data);	
	}
	public function validate_shop($shops = NULL, $group_id = NULL) {
		if($group_id == 5 && empty($shops)){
			$this->form_validation->set_message('validate_shop', 'The restaurant field is required.');
			return False;
		}else {
			return True;
		}
	}

	public function validate_order_no($no_of_orders = NULL, $group_id = NULL) {
		$no_of_orders = trim($no_of_orders);
		if($group_id == 6 && $no_of_orders == ''){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is required.');
			return False;	
		}else if ($group_id == 6 && ! ctype_digit(strval($no_of_orders)) ){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is invalid.');
			return False;
		}else if($group_id == 6 && (int)$no_of_orders <= 0){
			$this->form_validation->set_message('validate_order_no', 'The minimum number of orders field is invalid.');
				return False;
		}else {
			return True;
		}
	}

	public function test(){
		//$abc = send_push_multiple(array(), array(), 'My Check', 'Hello everyone!!!', 'test');
		$customers_data = array();
		$this->db->select('t2.device_type,t2.device_token');
        $this->db->where("t2.deleted_at", NULL);
        $this->db->where("t2.status", 1);

		$this->db->where("t1.shop_id", 52);

		$device_type = array('1','2');
       // $this->db->where_in("t2.device_type", $device_type);
        $this->db->where("t2.device_token !=", '');

		$this->db->from('orders t1');
        $this->db->join('customer t2', 't1.customer_id = t2.id');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
        	$customers_data = $sql_query->result_array();
        	//$emails_array = array_column($customers_data, 'email');
        }

		echo "<pre>";
		print_r($customers_data);
		exit;

	}

	public function custom_email_customer(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|callback_validate_shop[' . $_POST['group'] . ']'),
					array('field' => 'no_of_orders', 'label' => 'minimum number of orders', 'rules' => 'trim|callback_validate_order_no[' . $_POST['group'] . ']'),
					array('field' => 'group', 'label' => 'group', 'rules' => 'trim|required'),
					array('field' => 'emat_email_subject', 'label' => 'email subject', 'rules' => 'trim|required'),
					array('field' => 'emat_email_message', 'label' => 'email message', 'rules' => 'trim|required')
				);

				// echo "<pre>";
				// print_r($_POST);

				// $abc = $this->email_template_model->send_custom_email_customer();
				// print_r($abc);
				// exit;

				
				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					
					if($this->email_template_model->send_custom_email_customer()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-email-customer");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-email-customer");
					}
				}

			}
		}


		$shop_list = $this->email_template_model->get_table_data('shop');
		$output_data["group"] = $this->config->item("group_for_admin");
		unset($output_data["group"][7]);
		// echo "<pre>";
		// print_r($output_data["group"]); exit;
		
		$output_data["shop_list"] = $shop_list;

		$output_data["is_admin"] = $this->auth->is_admin();
		$output_data["is_vender"] = $this->auth->is_vender();

		$output_data['main_content'] = "admin/email_template/email_custom_customer";
		$this->load->view('template/template',$output_data);	
	}

	public function custom_push_customer(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|callback_validate_shop[' . $_POST['group'] . ']'),
					array('field' => 'no_of_orders', 'label' => 'minimum number of orders', 'rules' => 'trim|callback_validate_order_no[' . $_POST['group'] . ']'),
					array('field' => 'group', 'label' => 'group', 'rules' => 'trim|required'),
					array('field' => 'notification_title', 'label' => 'title', 'rules' => 'trim|required'),
					array('field' => 'notification_message', 'label' => 'message', 'rules' => 'trim|required')
				);

				//echo "<pre>";
				//print_r($_POST['emat_email_message']);

				
				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					
					//$abc = $this->email_template_model->send_custom_push_customer();
					// echo "<pre>";
					// print_r($_POST);
					// print_r($abc);
					// exit;
					if($this->email_template_model->send_custom_push_customer()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-push-customer");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-push-customer");
					}
				}

			}
		}


		$shop_list = $this->email_template_model->get_table_data('shop');
		$output_data["group"] = $this->config->item("group_for_admin");
		unset($output_data["group"][7]);
		// echo "<pre>";
		// print_r($output_data["group"]); exit;

		$output_data["is_admin"] = $this->auth->is_admin();
		$output_data["is_vender"] = $this->auth->is_vender();
	
		$output_data["shop_list"] = $shop_list;

		$output_data['main_content'] = "admin/email_template/push_custom_customer";
		$this->load->view('template/template',$output_data);	
	}

	public function custom_push_shop(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|required'),
					array('field' => 'notification_title', 'label' => 'title', 'rules' => 'trim|required'),
					array('field' => 'notification_message', 'label' => 'message', 'rules' => 'trim|required')
				);

				//echo "<pre>";
				//print_r($_POST['emat_email_message']);

				
				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true){
					
					// $abc = $this->email_template_model->send_custom_push_customer();
					// echo "<pre>";
					//print_r($_POST);
					//print_r($abc);
					//exit;
					if($this->email_template_model->send_custom_push_shop()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-push-restaurant");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "custom-push-restaurant");
					}
				}

			}
		}


		$shop_list = $this->email_template_model->get_table_data('shop');
		$output_data["shop_list"] = $shop_list;
		$output_data['main_content'] = "admin/email_template/push_custom_shop";
		$this->load->view('template/template',$output_data);	
	}

}
