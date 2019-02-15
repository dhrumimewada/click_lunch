<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
	}

	public function cart_add(){
		$insert_data = array( 'id' => '11',
		'name' => 'dhrumi',
		 'price' => '50',
		'qty' => '2' );

		 // This function add items into cart.
		$this->cart->insert($insert_data);

		$insert_data = array( 'id' => '12',
		'name' => 'dhrumi2',
		 'price' => '10',
		'qty' => '2' );

		 // This function add items into cart.
		$this->cart->insert($insert_data);

		echo "<pre>";
		print_r($this->cart->contents());
		print_r($this->cart->total());
		//print_r($this->cart->destroy());
		exit;
	}
}