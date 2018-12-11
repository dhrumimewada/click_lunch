<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("table_m");
	}

	public function index()
	{
		$output_data["customer_data"] = $this->table_m->get_active_customers();
		$output_data['main_content'] = "table";
		$this->load->view('template/template',$output_data);
	}

	public function filter_data()
	{
		
		$list = $this->table_m->get_datatables();
		$data = array();

		foreach ($list as $value) {

			$row = array();

			$row[] = $value->first_name.' '.$value->last_name;
			$row[] = $value->email;
			$row[] = $value->contact_no;
			$row[] = $value->zipcode;
			$row[] = $value->created_at;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->table_m->count_all(),
			"recordsFiltered" => $this->table_m->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

}
