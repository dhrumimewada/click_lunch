<?php

class Customer_m extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function register() {
		return $_POST;
	}
}
?>