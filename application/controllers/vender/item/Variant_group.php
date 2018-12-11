<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variant_group extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'item')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("vender/variant_group_model");
	}

	public function index(){

		$variant_group_list = $this->variant_group_model->get_variant_group();
		$output_data["variant_group_list"] = $variant_group_list;
		//echo "<pre>"; print_r($output_data["item_list"]); exit;
		//echo "<pre>"; print_r($this->db->last_query()); exit;
		$output_data['main_content'] = "vender/variant_group/index";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('variant_group', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function post(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'name', 'label' => 'variant group name', 'rules' => 'trim|required|min_length[3]')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {
					if($this->variant_group_model->post()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "variant-group-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "variant-group-add");
					}
				} 
			}
		}

		$output_data['main_content'] = "vender/variant_group/post";
		$this->load->view('template/template',$output_data);	
	}



}
?>