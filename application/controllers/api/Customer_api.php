<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(1);

class Customer_api extends REST_Controller {
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *');  
		$this->load->model("email_template_model");
	}

	public function test_get()
	{
		print_r('Success');
		exit;
	}

	public function init_get($app_version = '',$type = ''){

	}
}