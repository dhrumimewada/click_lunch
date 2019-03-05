<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {

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
		$this->load->model("admin/category_model");
	}

	public function index(){

		$category_list = $this->category_model->get_category();

		$output_data["category_list"] = $category_list;
		$output_data['main_content'] = "admin/category/index";
		$this->load->view('template/template',$output_data);	
	}

	public function isexists($str = NULL, $id = NULL) {

			$this->db->select('*');
			if ($id != '') {
				$this->db->where_not_in('id', $id);
			}
			$this->db->where('category_name', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('category');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The category name field is already exists");
				return FALSE;
			} else {
				return TRUE;
			}
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {

			$where = array('category_id' => $id);
            $select = array('id');
            $table = 'item';
            $category_items = get_data_by_filter($table,$select, $where);
            if(count($category_items) > 0){
            	echo json_encode(array("is_success" => false, "message" => 'Could not delete'));
				return TRUE;
            }else{
            	$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
				$this->db->where('id', $id);
				$this->db->update('category', $user_data);
				echo json_encode(array("is_success" => true));
				return TRUE;
            }
			
		}else{
			return FALSE;
		}
	}

	public function active_deactive_category(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('category', $user_data);
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
					
					array('field' => 'category_name', 'label' => 'category name', 'rules' => 'trim|required|min_length[2]|max_length[50]|callback_isexists')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {
					if($this->category_model->post()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "category-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "category-add");
					}	
				} 
			}
		}

		$output_data['main_content'] = "admin/category/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'category_name', 'label' => 'category name', 'rules' => 'trim|required|min_length[2]|max_length[50]|callback_isexists[' . $this->input->post("category_id") . ']')
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {
					if($this->category_model->put($modal_data)){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "category-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "category-update/".encrypt($this->input->post("category_id")));
					}	
				} 
			}
		}
		$output_data['category_data'] = $this->category_model->get_category(decrypt($id));
		if (!isset($output_data['category_data']) || empty($output_data['category_data']) || count($output_data['category_data']) <= 0){
			$this->auth->set_error_message("category data not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "category-list");
		}
		$output_data['main_content'] = "admin/category/put";
		$this->load->view('template/template',$output_data);	
	}

}
