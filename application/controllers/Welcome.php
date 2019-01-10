<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("dashboard_model");
	}

	public function index()
	{
		$data = $this->dashboard_model->get_total();
		//echo '<pre>'; print_r($data); exit;

		$data['main_content'] = "main_page";
		$this->load->view('template/template',$data);
	}

	public function form_validation()
	{
		$data['main_content'] = "form_validations";
		$this->load->view('template/template',$data);
	}

	public function profile()
	{
		$data['main_content'] = "profile";
		$this->load->view('template/template',$data);
	}

	public function error_page(){
		$data['main_content'] = "error_page";
		$this->load->view('template/template',$data);
	}

	public function maintenance(){
		if($this->auth->is_logged_in() == TRUE){
			$data['main_content'] = "maintenance";
			$this->load->view('template/template',$data);
		}else{
			redirect(base_url() . "vender-logout");
		}
	}
}
