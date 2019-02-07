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

		// echo "<pre>";
		// print_r($output_data["shops"]); exit;

		$output_data['main_content'] = 'welcome/home';
		$this->load->view('web/template',$output_data);
	}

	public function shop($id = NULL){
		$shop = $this->welcome_model->get_shops($id);
		$output_data["shop"] = $shop[0];

		$select = array('name','price','offer_price','item_picture');
		$where = array('shop_id' => decrypt($id) ,'deleted_at' => NULL, 'is_active' => 1, 'quantity !=' => 0 );
		$output_data["item"] = get_data_by_filter('item',$select,$where);

		// echo "<pre>";
		// print_r($output_data["item"]); exit;

		$output_data['main_content'] = 'restaurant_detail';
		$this->load->view('web/template',$output_data);
	}

	public function subscribe(){
		if (isset($_POST['email']) && !empty($_POST['email'])){
			echo $result = $this->welcome_model->subscribe();
		}
	}

	public function weekly_planner()
	{
		$this->load->view('web/weekly-planner');
	}

	public function takeout_restaurant()
	{
		$this->load->view('web/takeout-restaurant');
	}

	public function faq()
	{
		$this->load->view('web/faq');
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

	public function cart()
	{

		$this->load->view('web/cart');
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
