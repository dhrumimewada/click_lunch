<?php

class Appsetting_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_settings(){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('appsetting');
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$return_data = $sql_query->result_array();	
		}
		return $return_data;
	}

	public function put() {

		$this->db->trans_begin();
		$return_value = FALSE;

		
		foreach ($this->config->item("app_setting") as $key => $value){
			$app_setting = array();
			$app_version = $this->input->post("appname_".$key);
			$app_setting = array('app_version' => $app_version );
			$this->db->where('app_name', $value);
			$this->db->update("appsetting", $app_setting);
			//print_r($this->db->last_query());
		}

		//echo '<pre>'; print_r($_POST); exit;

		if ($this->input->post("customer_android_app")){
			$appsetting = array('updates' => 1 );	
		}else{
			$appsetting = array('updates' => 0 );
		}

		$this->db->where("app_name", 'customer_android_app');
		$this->db->update("appsetting", $appsetting);

		if ($this->input->post("customer_ios_app")){
			$appsetting = array('updates' => 1 );
		}else{
			$appsetting = array('updates' => 0 );
		}

		$this->db->where("app_name", 'customer_ios_app');
		$this->db->update("appsetting", $appsetting);

		if ($this->input->post("deliveryboy_android_app")){
			$appsetting = array('updates' => 1 );
		}else{
			$appsetting = array('updates' => 0 );
		}

		$this->db->where("app_name", 'deliveryboy_android_app');
		$this->db->update("appsetting", $appsetting);

		if ($this->input->post("restaurant_ipad_app")){
			$appsetting = array('updates' => 1 );
		}else{
			$appsetting = array('updates' => 0 );
		}

		$this->db->where("app_name", 'restaurant_ipad_app');
		$this->db->update("appsetting", $appsetting);

		if ($this->input->post("maintenance_mode")){
			$appsetting = array('updates' => 1 );
		}else{
			$appsetting = array('updates' => 0 );
		}

		$this->db->where("app_name", 'maintenance_mode');
		$this->db->update("appsetting", $appsetting);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating app setting");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("App setting updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}