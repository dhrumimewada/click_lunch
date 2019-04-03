<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popular_location extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || ($this->auth->is_admin()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'popular_location')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("admin/popular_location_model");
	}

	public function index(){

		$popular_location_list = $this->popular_location_model->get_popular_location();
		
		$output_data["popular_location_list"] = $popular_location_list;
		$output_data["address_type"] = $this->config->item("address_type");
		$output_data['main_content'] = "admin/popular_location/index";
		$this->load->view('template/template',$output_data);	
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
			$this->db->where('popular_location', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('popular_location');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The popular_location field is already exists");
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
					
					array('field' => 'house_no', 'label' => 'house/office number', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'street', 'label' => 'street', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'zipcode', 'label' => 'zipcode', 'rules' => 'trim|numeric|max_length[5]|min_length[5]'),
					array('field' => 'nickname', 'label' => 'nick name', 'rules' => 'trim'),
					array('field' => 'address_type', 'label' => 'address type', 'rules' => 'trim|required'),
					 array('field' => 'delivery_instruction', 'label' => 'delivery instruction', 'rules' => 'trim')
				);

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {
					

					$house_no = str_replace(" ","+",trim($_POST['house_no']));
	                $street = str_replace(" ","+",trim($_POST['street']));
	                $city = str_replace(" ","+",trim($_POST['city']));
	                $zipcode = str_replace(" ","+",trim($_POST['zipcode']));

	                $address = $house_no."+".$street."+".$city."+".$zipcode;

	                $google_key = $this->config->item('google_key');
	                $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&key=$google_key");
	                $json = json_decode($json);

	                $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

                	if($lat == '' || $long == ''){
                		$this->auth->set_error_message("Server could not fetch location.");
                		$this->session->set_flashdata($this->auth->get_messages_array());
                	}else{

                		if($this->popular_location_model->post($lat,$long)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "popular-location-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "popular-location-add");
						}

                	}

					
				} 
			}
		}

		$output_data["address_type"] = $this->config->item("address_type");
		$output_data['main_content'] = "admin/popular_location/post";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('delivery_address', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function popular_location_requests(){

		$output_data["requests"] = $this->popular_location_model->get_requests();
		$output_data["address_type"] = $this->config->item("address_type");
		$output_data['main_content'] = "admin/popular_location/requests";
		$this->load->view('template/template',$output_data);	
	}

	public function request_delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('delivery_address_popular_request', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function request_accept(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			
			$result = $this->popular_location_model->request_accept();
			echo json_encode($result);
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
?>