<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && ($this->auth->is_vender())){
			
		}else{
			if($this->auth->is_logged_in() == TRUE){

				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("vender/inventory_model");
	}

	public function index(){

		$inventory_list = $this->inventory_model->get_inventory();

		$output_data["inventory_list"] = $inventory_list;
		$output_data['main_content'] = "vender/inventory/index";
		$this->load->view('template/template',$output_data);	
	}

	public function inventory_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));


	  	$inventory_list = $this->inventory_model->get_inventory();

	 	$data = array();
	 	$action_data = '';
	 	$edit_link = base_url().'delivery-dispatcher-update';

		foreach($inventory_list as $key => $inventory) {

		       $action_str = "<label class='btn btn-outline-primary btn-sm waves-effect waves-light quantity-stock-update' title='Edit' data-popup='tooltip'> Edit</label>";

		       $quantity_str = "<label class='label-quantity'>". $inventory['quantity']."</label>";
		       $notify_stock_str = "<label class='label-notify-stock'>". $inventory['notify_stock']."</label>";

		       if($inventory["offer_price"] != ''){
		       		$price = "&#36;" . $inventory["offer_price"];
                }else{
                	$price = "&#36;" .$inventory["price"];
                }

		       $data[] = array(
		            $inventory['id'],
		            stripslashes($inventory["name"]),
		            stripslashes($inventory["name"]),
		            $price,
		           	$quantity_str,
		           	$notify_stock_str,
		            $action_str,
		       );

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($inventory_list),
	         "recordsFiltered" => count($inventory_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

}
