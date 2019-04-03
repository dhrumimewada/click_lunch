<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("customer/customer_model");
	}

	public function setpassword($id = NULL) {
		// print_r(decrypt($id));
		// exit;
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'cpassword', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true){
					if($this->customer_model->set_password()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-vender");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "login-vender");
					}
				}
				//echo "<pre>"; print_r($_POST); exit;
			}
		}
		$output_data["id"] = $id;
		$this->load->view('admin/customer/setpassword',$output_data);	
	}

	public function activate_account($token=''){
		$this->db->select('id, username, activation_token, email, password');
        $this->db->where("activation_token", $token);
        $this->db->where("deleted_at", NULL);
        $this->db->where("status", 0);
        $this->db->from("customer");
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){

        	$user = $sql_query->row();

        	$data = array(
				'status' => 1,
				'activation_token' => ''
				);
			$this->db->where('activation_token',$token);
			$this->db->update('customer', $data);

			$this->session->unset_userdata('employee_user');
			$this->session->unset_userdata('vendor_user');
			$this->session->unset_userdata('admin_user');
			$this->session->unset_userdata('dispatcher_user');
			$this->session->unset_userdata('customer_user');

			$session_data['user_id'] = (int) $user->id;
			$session_data['username'] =  (string) $user->username;
			$session_data['email'] =  (string) $user->email;
			$session_data['logged_in'] = (bool) TRUE;
			$session_data['is_admin'] = (bool) FALSE;
			$session_data['is_vender'] = (bool) FALSE;
			$session_data['is_employee'] = (bool) FALSE;
			$session_data['is_dispatcher'] = (bool) FALSE;
			$session_data['is_customer'] = (bool) TRUE;
			$session_data['role_id'] = (bool) FALSE;
			$session_data['shop_id'] = (bool) FALSE;

			$this->session_data = $session_data;
			$this->session->set_userdata(array('customer_user' => $this->session_data));


			redirect(base_url() . "welcome");
			// $return = array('status' => true);
			// echo "<h2>Your account has been activated</h2>";
			// return json_encode($return);
        }else{
        	redirect(base_url() . "welcome");
        }	
	}

	public function reset_password($token=''){
		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[6]'),
					array('field' => 'cpassword', 'label' => 'confirm password', 'rules' => 'trim|required|matches[password]')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true){
					if($this->customer_model->set_password()){
						redirect(base_url());
					}else{
						redirect(base_url());
					}
				}
			}
		}

		if($token != ''){
			$output_data["token"] = $token;
			$output_data["user_type"] = 'customer';
			$this->load->view('admin/vender/setpassword',$output_data);	
		}else{
			echo "<h2>Server encounter error</h2>";
			exit;
		}
	}
}
?>