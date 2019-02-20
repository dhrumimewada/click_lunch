<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin/banner_model");
		$this->load->model("website/welcome_model");
	}

	public function index(){
		$banner_list = $this->banner_model->get_banner();
		$output_data["banner_list"] = $banner_list;

		$select = array('id','cuisine_name','cuisine_picture');
		$where = array('deleted_at' => NULL, 'is_active' => 1);
		$output_data["cuisines"] = get_data_by_filter('cuisine',$select,$where);

		$select = array('txt1','txt2','txt3');
		$output_data["highlight"] = get_data_by_filter('highlight',$select);

		$output_data["shops"] = $this->welcome_model->get_shops();

		$output_data['main_content'] = 'welcome/home';
		$this->load->view('web/template',$output_data);
	}

	public function shop($short_name = NULL){
		$shop = $this->welcome_model->get_shops($short_name);
		$output_data["shop"] = $shop[0];
		if(is_empty($shop[0])){
			$this->load->view('web/error_page');
		}else{
			$select = array('id','name','short_name','price','offer_price','item_picture');
			$where = array('shop_id' => $shop[0]['id'] ,'deleted_at' => NULL, 'is_active' => 1, 'quantity !=' => 0 );
			$output_data["item"] = get_data_by_filter('item',$select,$where);

			$output_data['main_content'] = 'restaurant_detail';
			$this->load->view('web/template',$output_data);
		}
	}

	public function item($short_name = NULL){

		$item = $this->welcome_model->get_item_data($short_name);
		if(is_empty($item)){
			$this->load->view('web/error_page');
		}else{
			$output_data["item"] = $item;
			//echo "<pre>"; print_r($item); exit;
			$output_data['main_content'] = 'item_detail';
			$this->load->view('web/template',$output_data);
		}
		
	}

	public function get_shops(){

		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$shops = $this->welcome_model->get_shops();

		echo json_encode($shops);
		return true;
		exit;
	}

	public function cart(){
		echo "<pre>";
		print_r($_POST);
		exit;
	}

	public function subscribe(){
		if (isset($_POST['email']) && !empty($_POST['email'])){
			echo $result = $this->welcome_model->subscribe();
		}
	}

	public function faq(){

		$output_data['main_content'] = 'faq';
		$this->load->view('web/template',$output_data);
	}

	public function isexists($str) {
		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->from('shop');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$this->form_validation->set_message('isexists', "The restaurant email is already in use.");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function restaurant_partner_form(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'shop_name', 'label' => 'restaurant name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
					array('field' => 'email', 'label' => 'email address', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'mobile_number', 'label' => 'phone number', 'rules' => 'trim|required|min_length[12]|max_length[12]'),
					array('field' => 'address', 'label' => 'restaurant address', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'message', 'label' => 'message', 'rules' => 'trim|max_length[1000]')
				);
				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {
					if($this->welcome_model->post_restaurant_partner()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "restaurant-partner-form");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "restaurant-partner-form");
					}	
				} 
			}
		}

		$output_data['main_content'] = 'restaurant_partner_form';
		$this->load->view('web/template',$output_data);
	}

	public function weekly_planner()
	{
		$this->load->view('web/weekly-planner');
	}

	public function takeout_restaurant()
	{
		$this->load->view('web/takeout-restaurant');
	}

	public function profile()
	{
		$this->load->view('web/profile');
	}

	public function order_history()
	{
		$this->load->view('web/order-history');
	}

	public function delivery_address()
	{
		$this->load->view('web/delivery-address');
	}

	public function terms_of_service()
	{

		$this->load->view('web/terms-of-service');
	}

	public function restaurant_detail()
	{

		$this->load->view('web/restaurant-detail');
	}

	public function reset_password()
	{

		$this->load->view('web/reset-password');
	}

	public function place_order()
	{

		$this->load->view('web/place-order');
	}

	public function place_order_weekly()
	{

		$this->load->view('web/place-order-weekly');
	}

	public function place_order_takeout()
	{

		$this->load->view('web/place-order-takeout');
	}

	public function change_location()
	{

		$this->load->view('web/change-location');
	}

	public function checkout()
	{

		$this->load->view('web/checkout');
	}

	public function contact_us()
	{

		$this->load->view('web/contact-us');
	}

	public function get_the_app()
	{

		$this->load->view('web/get-the-app');
	}

	public function order_detail()
	{

		$this->load->view('web/order-detail');
	}

	public function delivery()
	{
		$this->load->view('web/delivery');
	}


	public function restaurant_partner()
	{
		$this->load->view('web/restaurant-partner');
	}

	public function add_card()
	{
		$this->load->view('web/add-card');
	}

	public function favourites()
	{
		$this->load->view('web/favourites');
	}

}
