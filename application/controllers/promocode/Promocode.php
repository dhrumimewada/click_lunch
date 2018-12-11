<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || ($this->auth->is_admin()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'promocode')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("promocode_model");
	}

	public function index(){

		$promocode_list = $this->promocode_model->get_promocode();
		//echo '<pre>'; print_r($_SESSION); exit;
		$output_data["promocode_list"] = $promocode_list;
		$output_data['main_content'] = "promocode/index";
		$this->load->view('template/template',$output_data);	
	}

	public function checkfromto($to = NULL, $from = NULL) {

		$from_time = date('d-m-Y', strtotime($from));
		$to_time = date('d-m-Y', strtotime($to));

		// $from_time = Carbon::createFromFormat('d-m-Y',$from)->format('Y-m-d');
		// $to_time = Carbon::createFromFormat('d-m-Y',$to)->format('Y-m-d');
		if($from_time > $to_time){
			$this->form_validation->set_message('checkfromto', 'The to date should be greater than from date.');
			return FALSE;
		}
		return TRUE;			
	}

	public function customcode($str) {
		if (preg_match('/[^a-zA-Z0-9]/', $str)) {
			$this->form_validation->set_message('customcode', 'The {field} field contain only alphabets and numbers.');
			return FALSE;
		}
		return TRUE;
	}

	public function isexists($str = NULL, $id = NULL) {

			$this->db->select('*');
			if ($id != '') {
				$this->db->where_not_in('id', $id);
			}
			if(!$this->auth->is_admin()){
				if($this->auth->is_vender()){
					$this->db->where('shop_id', intval($this->auth->get_user_id()));
				}else{
					$this->db->where('shop_id', intval($this->auth->get_emp_shop_id()));
				}
			}else{
				$this->db->where('shop_id','');
			}
			$this->db->where('promocode', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('promocode');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The promocode field is already exists");
				return FALSE;
			} else {
				return TRUE;
			}
	}

	public function post(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'promocode', 'label' => 'promocode', 'rules' => 'trim|required|min_length[3]|max_length[20]|callback_customcode|callback_isexists'),
					array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]'),
					array('field' => 'promo_min_order', 'label' => 'minimum order', 'rules' => 'trim|required|numeric|max_length[10]'),
					array('field' => 'from_date', 'label' => 'from date', 'rules' => 'trim|required'),
					 array('field' => 'to_date', 'label' => 'to date', 'rules' => 'trim|required|callback_checkfromto[' . $this->input->post("from_date") . ']'),
					array('field' => 'to_date', 'label' => 'to date', 'rules' => 'trim|required'),
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {
					if($this->promocode_model->post($modal_data)){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-add");
					}
				} 
			}
		}

		$output_data['main_content'] = "promocode/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){
				$validation_rules = array(
					
					array('field' => 'promocode', 'label' => 'promocode', 'rules' => 'trim|required|min_length[3]|max_length[20]|callback_customcode|callback_isexists[' . $this->input->post("promocode_id") . ']'),
					array('field' => 'promo_min_order', 'label' => 'minimum order', 'rules' => 'trim|required|numeric|max_length[10]'),
					array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]'),
					array('field' => 'from_date', 'label' => 'from date', 'rules' => 'trim|required'),
					array('field' => 'to_date', 'label' => 'to date', 'rules' => 'trim|required|callback_checkfromto[' . $this->input->post("from_date") . ']'),
				);

				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true) {
					if($this->promocode_model->put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-update/".encrypt($this->input->post("promocode_id")));
					}

					
				} 
			}
		}
		$output_data['promocode_data'] = $this->promocode_model->get_promocode(decrypt($id));
		if (!isset($output_data['promocode_data']) || empty($output_data['promocode_data']) || count($output_data['promocode_data']) <= 0){
			$this->auth->set_error_message("Promocode not found");
			$this->session->set_flashdata($this->auth->get_messages_array());
			redirect(base_url() . "promocode-list");
		}
		$output_data['main_content'] = "promocode/put";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('promocode', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_promocode(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('promocode', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
?>