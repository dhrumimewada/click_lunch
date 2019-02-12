<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || ($this->auth->is_admin()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'promocode')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}
		$this->load->model("promocode_model");
		$this->load->model("email_template_model");
	}

	public function index(){

		$output_data['main_content'] = "promocode/index";
		$this->load->view('template/template',$output_data);	
	}

	public function promocode_list(){
	  	$draw = intval($this->input->get("draw"));
	  	$start = intval($this->input->get("start"));
	  	$length = intval($this->input->get("length"));


	  	$promocode_list = $this->promocode_model->get_promocode();

	 	$data = array();
	 	$action_data = '';
	 	$edit_link = base_url().'promocode-update';

		foreach($promocode_list as $key => $promocode) {

		       	$action_data = "<a href='".$edit_link."/".encrypt($promocode['id'])."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a><button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_promocode' title='Delete' data-popup='tooltip'>Delete</button></td>";

		       	if($promocode["status"] == 1){
	                $btn_name = 'Active';
	                $btn_class = 'btn-success';
	            }else{
	                $btn_name = 'Deactivate';
	                $btn_class = 'btn-deactive';
	            }

		       	$status_str = "<button type='button' class='btn ".$btn_class." btn-sm waves-effect waves-light deactive_promocode' status-id='" . $promocode["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button>";


		       	if($promocode["discount_type"] == 1){
                    $discount_type = 'Percentage';
                }else{
                    $discount_type = 'Flat';
                }

                $from_date_ts = strtotime($promocode["from_date"]);
                $from_date = date("j M, Y", $from_date_ts);

                $to_date_ts = strtotime($promocode["to_date"]);
                $to_date = date("j M, Y", $to_date_ts);

                $added_by = ($promocode['shop_id'] == '')?'Admin':$promocode['shop_name'];

		       	$data[] = array(
		            $promocode['id'],
		            $promocode["promocode"],
		            $added_by,
		            $promocode['amount'],
		            $discount_type,
		            $promocode["from_date"],
		            $promocode["to_date"],
		            $status_str,
		            $action_data
		       	);

		}

	  	$output = array(
	       "draw" => $draw,
	         "recordsTotal" => count($promocode_list),
	         "recordsFiltered" => count($promocode_list),
	         "data" => $data
	    );
	  	echo json_encode($output);
	  	exit();
  	}

	public function checkfromto($to = NULL, $from = NULL) {

		$from_time = date('d-m-Y', strtotime($from));
		$to_time = date('d-m-Y', strtotime($to));

		// $from_time = Carbon::createFromFormat('d-m-Y',$from)->format('Y-m-d');
		// $to_time = Carbon::createFromFormat('d-m-Y',$to)->format('Y-m-d');
		if($from_time > $to_time){
			$this->form_validation->set_message('checkfromto', 'The to date should be greater than from date.');
			//return FALSE;
		}
		return TRUE;			
	}

	public function customcode($str) {
		if (preg_match('/[^a-zA-Z0-9]/', $str)) {
			$this->form_validation->set_message('customcode', 'The {field} field contain only alphabets and numbers.');
			return FALSE;
		}
		return TRUE;
	}

	public function isexists($str = NULL, $id) {

			$this->db->select('*');
			if ($id != '') {
				$this->db->where_not_in('id', $id);
			}
			$this->db->where('promocode', $str);
			$this->db->where('deleted_at', NULL);
			$this->db->from('promocode');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$this->form_validation->set_message('isexists', "The promocode field is already exists.");
				return FALSE;
			} else {
				return TRUE;
			}
	}


	public function max_disc_validate($max_disc = NULL, $promo_min_order = NULL){
		if((floatval($promo_min_order) > floatval($max_disc)) || ($promo_min_order == '') ){
			return TRUE;
		}else{
			$this->form_validation->set_message('max_disc_validate', "The maximum discount should be less than minimum order amount.");
			return FALSE;
		}
	}

	public function min_order_validate($min_order_amount = NULL, $promo_amount = NULL){
		if(($promo_amount < $min_order_amount && $promo_amount != '') || ($min_order_amount == '') ){
			return TRUE;
		}else{
			$this->form_validation->set_message('min_order_validate', "The minimum order amount should be more than amount.");
			return FALSE;
		}
	}


	public function post(){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		$is_admin = $this->auth->is_admin();
		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					array('field' => 'group', 'label' => 'group', 'rules' => 'trim|required|numeric'),
					array('field' => 'promocode', 'label' => 'promocode', 'rules' => 'trim|required|min_length[3]|max_length[20]|callback_customcode|callback_isexists'),
					array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]'),
					array('field' => 'usage_limit', 'label' => 'usage limit', 'rules' => 'trim|required|is_natural_no_zero|max_length[10]'),
					array('field' => 'from_date', 'label' => 'from date', 'rules' => 'trim|required'),
					array('field' => 'to_date', 'label' => 'to date', 'rules' => 'trim|required|callback_checkfromto[' . $this->input->post("from_date") . ']')
				);

				if($is_vender){

					$promo_type_validation = array('field' => 'promo_type', 'label' => 'promocode type', 'rules' => 'trim|required|numeric');
					array_push($validation_rules, $promo_type_validation);

					if($this->input->post("promo_type") == 1){
						$valid_product_validation = array('field' => 'applied_on_products[]', 'label' => 'promocode applied products', 'rules' => 'trim|required');
						array_push($validation_rules, $valid_product_validation);
					}

					if($this->input->post("group") == 7){
						$shop_validation = array('field' => 'item[]', 'label' => 'product/combo', 'rules' => 'trim|required');
						array_push($validation_rules, $shop_validation);
					}

				}

				if($this->input->post("discount_type") == 1){
					$max_disc_validation = array('field' => 'max_disc', 'label' => 'maximum discount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]|callback_max_disc_validate[' . $this->input->post("promo_min_order") . ']');
					$min_order_validation = array('field' => 'promo_min_order', 'label' => 'minimum order', 'rules' => 'trim|numeric|max_length[10]|callback_min_order_validate[' . $this->input->post("amount") . ']');
					array_push($validation_rules, $max_disc_validation);
					array_push($validation_rules, $min_order_validation);
				}

				if($this->input->post("group") == 5){
					$shop_validation = array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|required');
					array_push($validation_rules, $shop_validation);
				}
				if($this->input->post("group") == 6){
					$shop_validation = array('field' => 'no_of_orders', 'label' => 'minimum number of orders', 'rules' => 'trim|required');
					array_push($validation_rules, $shop_validation);
				}

				$this->form_validation->set_rules($validation_rules);
				if ($this->form_validation->run() === true) {

					// $abc = $this->promocode_model->post();
					// echo "<pre>";
					// print_r($_POST);
					// exit; 

					if($this->promocode_model->post()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-add");
					}
				} 
			}
		}

		if($is_admin){
			$output_data["group"] = $this->config->item("group_for_admin");
			$shop_list = $this->email_template_model->get_table_data('shop');
			$output_data["shop_list"] = $shop_list;
			$output_data["is_admin"] = $is_admin;
		}elseif($is_vender || $is_employee){
			$output_data["group"] = $this->config->item("group_for_shop");
			$output_data["promo_type"] = $this->config->item("promocode_type");
			$item_list = $this->email_template_model->get_table_data('item');
			$output_data["item_list"] = $item_list;
			$output_data["is_vender"] = $is_vender;
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}

		$output_data['main_content'] = "promocode/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		$is_admin = $this->auth->is_admin();
		$is_vender = $this->auth->is_vender();
		$is_employee = $this->auth->is_employee();

		if (isset($_POST) && !empty($_POST)){

			// echo "<pre>";
			// print_r($_POST);
			// exit;

			if (isset($_POST['submit'])){
				$validation_rules = array(
					array('field' => 'group', 'label' => 'group', 'rules' => 'trim|required|numeric'),
					array('field' => 'promocode', 'label' => 'promocode', 'rules' => 'trim|required|min_length[3]|max_length[20]|callback_customcode|callback_isexists[' . $this->input->post("promocode_id") . ']'),
					array('field' => 'amount', 'label' => 'amount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]'),
					array('field' => 'usage_limit', 'label' => 'usage limit', 'rules' => 'trim|required|is_natural_no_zero|max_length[10]'),
					array('field' => 'from_date', 'label' => 'from date', 'rules' => 'trim|required'),
					array('field' => 'to_date', 'label' => 'to date', 'rules' => 'trim|required|callback_checkfromto[' . $this->input->post("from_date") . ']')
				);

				if($is_vender){
					$promo_type_validation = array('field' => 'promo_type', 'label' => 'promocode type', 'rules' => 'trim|required|numeric');
					array_push($validation_rules, $promo_type_validation);

					if($this->input->post("promo_type") == 1){
						$valid_product_validation = array('field' => 'applied_on_products[]', 'label' => 'promocode applied products', 'rules' => 'trim|required');
						array_push($validation_rules, $valid_product_validation);
					}

					if($this->input->post("group") == 7){
						$shop_validation = array('field' => 'item[]', 'label' => 'product/combo', 'rules' => 'trim|required');
						array_push($validation_rules, $shop_validation);
					}
				}

				if($this->input->post("discount_type") == 1){
					$max_disc_validation = array('field' => 'max_disc', 'label' => 'maximum discount', 'rules' => 'trim|required|numeric|greater_than[0]|max_length[10]|callback_max_disc_validate[' . $this->input->post("promo_min_order") . ']');
					$min_order_validation = array('field' => 'promo_min_order', 'label' => 'minimum order', 'rules' => 'trim|numeric|max_length[10]|callback_min_order_validate[' . $this->input->post("amount") . ']');
					array_push($validation_rules, $max_disc_validation);
					array_push($validation_rules, $min_order_validation);
				}

				if($this->input->post("group") == 5){
					$shop_validation = array('field' => 'shop[]', 'label' => 'restaurant', 'rules' => 'trim|required');
					array_push($validation_rules, $shop_validation);
				}

				if($this->input->post("group") == 6){
					$shop_validation = array('field' => 'no_of_orders', 'label' => 'minimum number of orders', 'rules' => 'trim|required');
					array_push($validation_rules, $shop_validation);
				}


				$this->form_validation->set_rules($validation_rules);
				 
				if ($this->form_validation->run() === true) {
					// $abc = $this->promocode_model->put();
					// exit;
					if($this->promocode_model->put()){
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-list");
					}else{
						$this->session->set_flashdata($this->auth->get_messages_array());
						redirect(base_url() . "promocode-update/".encrypt($this->input->post("promocode_id")));
					}

					
				}
			}
		}
		
		$promocode_data = $this->promocode_model->get_promocode(decrypt($id));
		$output_data['promocode_data'] = $promocode_data;

		if($promocode_data->group_type == 5){
			$where = array('promocode_id' => $promocode_data->id);
			$select = array('shop_id');
			$output_data['promocode_shops'] = get_data_by_filter('promocode_shops',$select,$where);
		}

		if($promocode_data->group_type == 7){

			if($is_vender){
				$shop_id = intval($this->auth->get_user_id());
			}else if($is_employee){
				$shop_id = intval($this->auth->get_emp_shop_id());
			}else if($is_admin){
				$shop_id = intval($promocode_data->shop_id);
			}else{

			}

			$where = array('shop_id' => $shop_id, 'promocode_id' => $promocode_data->id);
			$select = array('product_id');
			$output_data['promocode_products'] = get_data_by_filter('promocode_products',$select,$where);
		}

		if($promocode_data->promo_type == 1 && ($is_vender || $is_employee)){
			if($is_vender){
				$shop_id = intval($this->auth->get_user_id());
			}else{
				$shop_id = intval($this->auth->get_emp_shop_id());
			}

			$where = array('shop_id' => $shop_id, 'promocode_id' => $promocode_data->id);
			$select = array('product_id');
			$output_data['promocode_valid_product'] = get_data_by_filter('promocode_valid_product',$select,$where);
		}


		
		// if (!isset($output_data['promocode_data']) || empty($output_data['promocode_data']) || count($output_data['promocode_data']) <= 0){
		// 	$this->auth->set_error_message("Promocode not found");
		// 	$this->session->set_flashdata($this->auth->get_messages_array());
		// 	redirect(base_url() . "promocode-list");
		// }

		
		if($is_admin){
			$output_data["group"] = $this->config->item("group_for_admin");
			$shop_list = $this->email_template_model->get_table_data('shop');
			$output_data["shop_list"] = $shop_list;
			$output_data["is_admin"] = $is_admin;
		}elseif($is_vender || $is_employee){
			$output_data["group"] = $this->config->item("group_for_shop");
			$output_data["promo_type"] = $this->config->item("promocode_type");
			$output_data["is_vender"] = $is_vender;
		}else{
			$this->auth->set_error_message("User not found");
			return FALSE;
		}

		$item_list = $this->email_template_model->get_table_data('item');
		$output_data["item_list"] = $item_list;

		// echo "<pre>";
		// print_r($output_data);
		// exit;

		$output_data['main_content'] = "promocode/put";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('promocode', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_promocode(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('status' => $status );
			$this->db->where('id', $id);
			$this->db->update('promocode', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_products_by_shop(){
		$table_name = 'item';
		$select = array('id','name');
		$where = array('shop_id' => $_POST['id'], 'is_active' => 1, 'deleted_at' => NULL);
		$product_data = get_data_by_filter($table_name, $select, $where);
		if(is_array($product_data) && !empty($product_data)){
			echo json_encode($product_data);
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
}
?>