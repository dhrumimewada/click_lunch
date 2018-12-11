<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class My_CI_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if ($this->auth->is_logged_in() == FALSE) {
			redirect(base_url() . "login-admin");
		}
	}
}