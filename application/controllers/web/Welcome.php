<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *');  
		
		$this->load->model("admin/banner_model");
		$this->load->model("website/welcome_model");
		$this->load->library('parser');
	}


	public function check(){
		echo "<pre>";
		print_r($_SESSION);
		exit;
	}

	public function index(){

		$output_data["cuisines"] = $this->welcome_model->get_cuisines();
		$output_data["category"] = $this->welcome_model->get_category();
		$output_data["banner_list"] = $this->welcome_model->get_banners();

		$select = array('txt1','txt2','txt3');
		$output_data["highlight"] = get_data_by_filter('highlight',$select);

		//$loc = $this->welcome_model->get_current_lat_long();

		// echo "<pre>";
		// print_r($loc);
		// $ipaddress = $_SERVER['REMOTE_ADDR'];
		// echo $ipaddress;
		// exit;

		// $loc[0] = 23.0333;
		// $loc[1] = 72.6167;

		//$output_data["shops"] = $this->welcome_model->get_shops(NULL, NULL, NULL, NULL, $loc[0], $loc[1]);
		$output_data["combo_shops"] = $this->welcome_model->get_shops();

		//echo "<pre>";
		//print_r($loc);
		// print_r($output_data["shops"]);
		// exit;

		$output_data['main_content'] = 'welcome/home';
		$this->load->view('web/template',$output_data);
	}

	public function shop($order_type = NULL, $tab_pan = NULL, $short_name = NULL){
		$shop = $this->welcome_model->get_shops($short_name);
		$output_data["shop"] = $shop[0];
		if(is_empty($shop[0])){
			$this->load->view('web/error_page');
		}else{
			$output_data["item"] = $this->welcome_model->get_items($shop[0]['id']);
			$output_data["tab_pan"] = $tab_pan;
			$output_data["order_type"] = $order_type;
			//echo "<pre>";
			// print_r($output_data["item"]);
			//print_r($items);
			//exit;
			$output_data['main_content'] = 'restaurant_detail';
			$this->load->view('web/template',$output_data);
		}
	}

	public function item($order_type = NULL, $short_name = NULL){

		$item = $this->welcome_model->get_item_data($short_name);
		if(is_empty($item)){
			$this->load->view('web/error_page');
		}else{
			$output_data["item"] = $item;
			$output_data["order_type"] = $order_type;
			//echo "<pre>"; print_r($item); exit;
			$output_data['main_content'] = 'item_detail';
			$this->load->view('web/template',$output_data);
		}
		
	}

	public function get_shops_by_filter(){
		if(isset($_POST['cuisine_id']) && $_POST['cuisine_id'] != ''){
			$cuisine_id = $_POST['cuisine_id'];
		}else{
			$cuisine_id = NULL;
		}

		if(isset($_POST['pickup']) && $_POST['pickup'] != '' && $_POST['pickup'] == 1){
			$pickup = $_POST['pickup'];
		}else{
			$pickup = NULL;
		}

		if(isset($_POST['popular']) && $_POST['popular'] != '' && $_POST['popular'] == 1){
			$popular = $_POST['popular'];
		}else{
			$popular = NULL;
		}

		if(isset($_POST['delivery_fee']) && $_POST['delivery_fee'] != ''){
			$delivery_fee = $_POST['delivery_fee'];
		}else{
			$delivery_fee = NULL;
		}

		if(isset($_POST['minimum_order_amount']) && $_POST['minimum_order_amount'] != ''){
			$minimum_order_amount = $_POST['minimum_order_amount'];
		}else{
			$minimum_order_amount = NULL;
		}

		if(isset($_POST['category']) && $_POST['category'] != ''){
			$category = $_POST['category'];
		}else{
			$category = NULL;
		}

		if(isset($_POST['rating']) && $_POST['rating'] != ''){
			$rating = $_POST['rating'];
		}else{
			$rating = NULL;
		}

		if(isset($_POST['weekly']) && $_POST['weekly'] != ''){
			$weekly = $_POST['weekly'];
		}else{
			$weekly = NULL;
		}

		if(isset($_POST['delivery_restaurants']) && $_POST['delivery_restaurants'] != ''){
			$delivery_restaurants = $_POST['delivery_restaurants'];
		}else{
			$delivery_restaurants = NULL;
		}

		if(isset($_POST['pickup_restaurants']) && $_POST['pickup_restaurants'] != ''){
			$pickup_restaurants = $_POST['pickup_restaurants'];
		}else{
			$pickup_restaurants = NULL;
		}

		if(isset($_POST['latitude']) && $_POST['latitude'] != ''){
			$this->session->set_userdata('latitude', $_POST['latitude']);
			$latitude = $_POST['latitude'];
		}else{
			$latitude = NULL;
		}

		if(isset($_POST['longitude']) && $_POST['longitude'] != ''){
			$this->session->set_userdata('longitude',  $_POST['longitude']);
			$longitude = $_POST['longitude'];
		}else{
			$longitude = NULL;
		}

		$shops = $this->welcome_model->get_shops(NULL, $cuisine_id, $pickup, $popular, $latitude, $longitude, $delivery_fee, $minimum_order_amount, $category, $rating, $weekly, $delivery_restaurants, $pickup_restaurants);
		if(is_array($shops) && !empty($shops)){
			echo json_encode(array("is_success" => true, "shops" => $shops));
			return TRUE;
		}else{
			echo json_encode(array("is_success" => false));
			return FALSE;
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
		$data = get_rating(52);
		print_r($data);
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

	public function logout(){
		if($this->auth->logout()){
			redirect(base_url() . "welcome");
		}
	}

	public function isexists($str) {
		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->from('shop');
		$sql_query = $this->db->get();

		$this->db->select('email');
		$this->db->where('email', $str);
		$this->db->where('deleted_at', NULL);
		$this->db->from('shop_request');
		$sql_query2 = $this->db->get();

		if ($sql_query->num_rows() > 0 || $sql_query2->num_rows() > 0) {
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
					array('field' => 'vender_name', 'label' => 'full name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
					array('field' => 'email', 'label' => 'email address', 'rules' => 'trim|required|max_length[225]|valid_email|callback_isexists'),
					array('field' => 'mobile_number', 'label' => 'phone number', 'rules' => 'trim|required|min_length[15]|max_length[15]'),
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

	public function email_check_availability(){

		$this->db->select('id');
		$this->db->where('email', $_POST['email']);
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			return FALSE;
		}else{
			echo '1';
			return TRUE;
		}
	}

	public function number_check_availability(){
		$this->db->select('id');
		$this->db->where('mobile_number', $_POST['register_number']);
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			return FALSE;
		}else{
			echo '1';
			return TRUE;
		}
	}	

	public function register_customer(){
		$error = '0';
		$this->db->select('id');
		$this->db->where('email', $_POST['email']);
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$error = '1';
		}else{

			$register_number = str_replace('+1 ', '', $_POST['mobile_number']);
			$this->db->select('id');
			$this->db->where('mobile_number', $register_number);
			$this->db->where('deleted_at', NULL);
			$this->db->from('customer');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$error = '2';
			}else{

				$dob = DateTime::createFromFormat('d-m-Y', $_POST['dob']);
				$dob = $dob->format("Y-m-d");

				$user = array( 
                        'username' => $_POST['name'], 
                        'email'=> $_POST['email'], 
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'device_type'=> 0, 
                        'mobile_number'=>$register_number,
                        'latitude'=> '',
                        'longitude'=> '',
                        'gender'=> $_POST['gender'],
                        'dob'=> $dob
                    );
				$this->db->insert('customer', $user);
				$insert_id = $this->db->insert_id();

                if($insert_id){

                	$this->db->select('*');
					$this->db->from('email_template');
					$this->db->where('emat_email_type', 1);
					$this->db->where("emat_is_active", 1);
					$sql_query = $this->db->get();
					$return_data = $sql_query->row();

					if (isset($return_data) && !empty($return_data)){

						$activation_token = bin2hex(random_bytes(20));
						$email_var_data["activation_link"] = base_url() . 'customer-activate/'. $activation_token;
						$from = "";
						$to = $_POST['email'];
						$subject = 'Activate Your '.$this->config->item('site_name').' Account';

						$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
						$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
						$mail = sendmail($from, $to, $subject, $message);
						if(!$mail){
							$error = '4';
						}else{
							$update_data = array('activation_token' => $activation_token);
                            $this->db->where('id', $insert_id);
                            $this->db->update('customer', $update_data);
						}

					}else{
						$error = '3';
					}
                }
			}
		}
		echo $error;
		return TRUE;
	}

	public function login_customer(){
		$error = '0';
		$this->db->select('*');
		$this->db->where('email', $_POST['email']);
		$this->db->where("password !=",'');
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$customer = $sql_query->row();
			if($this->auth->login($_POST['email'], $_POST['password'], 'customer')){
				echo 'login success';
			}else{
				$error = '2';
			}
		}else{
			$error = '1';
		}
		echo $error;
		return TRUE;
	}

	public function forgot_password_customer(){
		$error = '0';
		$this->db->select('id');
		$this->db->where('email', $_POST['email']);
		$this->db->where("password !=",'');
		$this->db->where('status', 1);
		$this->db->where('deleted_at', NULL);
		$this->db->from('customer');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			if($this->auth->password_recovery($_POST['email'],'customer')){
				echo "Recovery MAil Sent";
			}else{
				$error = '2';
			}
		}else{
			$error = '1';
		}
		echo $error;
		return TRUE;
	}

	public function terms_service(){
		$output_data['main_content'] = 'terms_service';
		$this->load->view('web/template',$output_data);
	}

	public function contact_us()
	{

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'name', 'label' => 'full name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
					array('field' => 'email', 'label' => 'e-mail', 'rules' => 'trim|required|max_length[225]|valid_email'),
					array('field' => 'contact_no', 'label' => 'phone number', 'rules' => 'trim|required|min_length[12]|max_length[12]'),
					array('field' => 'subject', 'label' => 'subject', 'rules' => 'trim|required|max_length[255]'),
					array('field' => 'message', 'label' => 'message', 'rules' => 'trim|required|max_length[1000]')
				);
				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {
					if($this->welcome_model->contact_us_post()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "contact-us");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "contact-us");
					}	
				} 
			}
		}

		$output_data['main_content'] = 'contact_us';
		$this->load->view('web/template',$output_data);
	}

	public function request_add_popular_address(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){
			if (isset($_POST['submit'])){

				$validation_rules = array(
				
					array('field' => 'house_no', 'label' => 'house/office number', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'street', 'label' => 'street', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'city', 'label' => 'city', 'rules' => 'trim|required|max_length[250]'),
					array('field' => 'zipcode', 'label' => 'zipcode', 'rules' => 'trim|required|numeric|max_length[5]|min_length[5]'),
					array('field' => 'nickname', 'label' => 'nick name', 'rules' => 'trim'),
					array('field' => 'address_type', 'label' => 'address type', 'rules' => 'trim|required')
				);
				$this->form_validation->set_rules($validation_rules);
				
				if ($this->form_validation->run() === true) {
					if($this->welcome_model->request_add_popular_address()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "add-request-address");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "add-request-address");
					}	
				} 
			}
		}

		$output_data["address_type"] = $this->config->item("address_type");
		$output_data['main_content'] = 'add_popular_address';
		$this->load->view('web/template',$output_data);
	}

	public function about_us(){
		$output_data['main_content'] = 'about_us';
		$this->load->view('web/template',$output_data);
	}

	public function coming_soon(){
		$output_data['main_content'] = 'coming_soon';
		$this->load->view('web/template',$output_data);
	}

	public function weekly_planner(){
		$days = $this->config->item("days");
		$today = date('l');
		foreach ($days as $key => $value) {
			if($today == $value){
				$days[$key] = 'Today';
			}
		}
		$output_data["days"] = $this->config->item("days");
		$output_data["total_days"] = $this->config->item("days");
		$data = $this->welcome_model->get_shops_by_weekly_days();
		// echo "<pre>";
		// print_r($data);
		// exit;
		$output_data["shop_data"] = $data;
		$this->session->set_userdata('order_type', 3);
		$output_data['main_content'] = 'weekly_planner';
		$this->load->view('web/template',$output_data);
	}

	public function delivery_restaurants(){
		$output_data['main_content'] = 'delivery_restaurants';
		$this->load->view('web/template',$output_data);
	}

	public function takeout_restaurants(){
		$output_data['main_content'] = 'takeout_restaurants';
		$this->load->view('web/template',$output_data);
	}

	public function set_order_type_session(){

		$this->db->select('takeout_delivery_status');
		$this->db->from('shop');
		$this->db->where("id",  $_POST['shopid']);
		if($_POST['order_type'] == 1){
			$this->db->group_start();
                $this->db->where("takeout_delivery_status", 1);
                $this->db->or_where("takeout_delivery_status", 3);
            $this->db->group_end();
		}else if($_POST['order_type'] == 2){
			$this->db->group_start();
                $this->db->where("takeout_delivery_status", 2);
                $this->db->or_where("takeout_delivery_status", 3);
            $this->db->group_end();
		}else{
			echo json_encode(array("is_success" => false, "message" => 'Order type not found'));
			return false;
		}
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0){
			$this->session->set_userdata('order_type', $_POST['order_type']);
			if($this->session->userdata('order_type')){
				echo json_encode(array("is_success" => true));
				return TRUE;
			}else{
				echo json_encode(array("is_success" => false));
				return false;
			}
		}else{
			if($_POST['order_type'] == 1){
				echo json_encode(array("is_success" => false, "message" => 'This restaurant not providing delivery. Please select takeout for order.'));
				return false;
			}else{
				echo json_encode(array("is_success" => false, "message" => 'This restaurant not providing takeout. Please select takeout for delivery.'));
				return false;
			}
			
		}

		
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
