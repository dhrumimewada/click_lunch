<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("website/profile_model");
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

	}

	public function my_delievry_address($id = NULL){
		$this->session->set_userdata('delivery_address_id', $id);
		// print_r($this->session->userdata('delivery_address_id'));
		// exit;
		redirect(base_url() . "cart");
	}

	public function unset_d(){
		$this->session->set_userdata('delivery_address_id', '');
	}
}