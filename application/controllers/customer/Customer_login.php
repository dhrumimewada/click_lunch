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
		$this->db->select('activation_token');
        $this->db->where("activation_token",$token);
        $this->db->where("deleted_at",NULL);
        $this->db->where("status",0);
        $this->db->from("customer");
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
        	$data = array(
				'status' => 1,
				'activation_token' => ''
				);
			$this->db->where('activation_token',$token);
			$this->db->update('customer', $data);
			$return = array('status' => true);
			echo "<h2>Your account has been activated</h2>";
			return json_encode($return);
        }else{
        	$return = array('status' => false);
        	echo "<h2>Server encounter error</h2>";
			return json_encode($return);
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
						echo "<h2>Your password updated successfully</h2>";
						exit;
					}else{
						echo "<h2>Server encounter error</h2>";
						exit;
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