<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (($this->auth->is_logged_in() == TRUE) && (($this->auth->is_vender()) || (($this->auth->is_employee()) && (is_allowed($this->auth->get_role_id(), 'item')) ) ) ){
		}else{
			if($this->auth->is_logged_in() == TRUE){
				$this->auth->set_error_message("You are not allowed to access");
				$this->session->set_flashdata($this->auth->get_messages_array());
				redirect(base_url() . "error-page");
			}else{
				redirect(base_url() . "vender-logout");
			}
		}

		$this->load->model("vender/item_model");
		$this->load->model("admin/category_model");
	}

	public function index(){

		$item_list = $this->item_model->get_item();
		$output_data["item_list"] = $item_list;
		$output_data['main_content'] = "vender/item/index";
		$this->load->view('template/template',$output_data);	
	}

	public function delete(){
		$id = $_POST['id'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('deleted_at' => date('Y-m-d H:i:s') );
			$this->db->where('id', $id);
			$this->db->update('item', $user_data);

			$this->db->where('item_id', $id);
			$this->db->delete('variant_items');
			
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function active_deactive_item(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {
			$user_data = array('is_active' => $status );
			$this->db->where('id', $id);
			$this->db->update('item', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function recommended_item(){
		$id = $_POST['id'];
		$status = $_POST['status'];
		if (isset($id) && !is_null($id) && !empty($id)) {

			if($this->auth->is_vender()){
				$shop_id = $this->auth->get_user_id();
			}elseif ($this->auth->is_employee()) {
				$shop_id = $this->auth->get_emp_shop_id();
			}else{
				echo json_encode(array("is_success" => false));
				return FALSE;
			}


			if($status == 1){
				$where = array('recommended' => 1, 'deleted_at' => NULL, 'shop_id' => $shop_id);
	            $select = array('id');
	            $table = 'item';
	            $recommended_items = get_data_by_filter($table,$select, $where);
	            if(count($recommended_items) >= 3){
	            	echo json_encode(array("is_success" => false, "recommended_items" => $recommended_items));
					return TRUE;
	            }
			}
			$user_data = array('recommended' => $status );
			$this->db->where('id', $id);
			$this->db->update('item', $user_data);
			echo json_encode(array("is_success" => true));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function post($type = NULL){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'name', 'label' => 'name', 'rules' => 'trim|required|min_length[2]'),
					array('field' => 'cuisine_id', 'label' => 'cuisine', 'rules' => 'trim|required|numeric'),
					array('field' => 'category_id', 'label' => 'category', 'rules' => 'trim|required|numeric'),
					array('field' => 'price', 'label' => 'price', 'rules' => 'trim|required|numeric|greater_than[0]'),
					array('field' => 'offer_price', 'label' => 'offer price', 'rules' => 'trim|numeric|less_than['.$this->input->post("price").']'),
					array('field' => 'quantity', 'label' => 'quantity', 'rules' => 'trim|numeric|greater_than_equal_to[0]'),
					array('field' => 'item_description', 'label' => 'short description', 'rules' => 'trim'),
				);

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run() === true) {

					$file_upload = true;
					if (isset($_FILES['item_picture']) && !empty($_FILES['item_picture']) && strlen($_FILES['item_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("item_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'item' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('item_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['item_picture'] = $file_upload_data;

							// $this->load->library('image_lib');

							// $config['image_library'] = 'gd2';
							// $config['source_image'] = FCPATH . $this->config->item("item_photo_path").'/'.$file_upload_data['file_name'];
							// $config['create_thumb'] = TRUE;
							// $config['thumb_marker'] = '';
						 //    $config['maintain_ratio'] = TRUE;
						 //    $config['width'] = 600;
	    		// 			$config['height'] = 600;

						 //    $this->image_lib->clear();
						 //    $this->image_lib->initialize($config);

						 //    if (!$this->image_lib->resize()){
							//     ucfirst($this->upload->display_errors());
							// 	$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							// 	$this->session->set_flashdata($this->auth->get_messages_array());
							// 	$file_upload = false;
							// }else{
							// 	$file_upload = true;
							// }
						}

					}

					if ($file_upload){
						if($this->item_model->post($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "item-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "item-add");
						}
					}
					
				} 
			}
		}

		//$output_data['category_data'] = $this->item_model->get_active_category();
		$output_data['variant_groups'] = $this->item_model->get_variant_groups();
		$output_data['cuisines_data'] = get_cuisine2();
		$output_data['category_data'] = $this->category_model->get_category();
		$output_data['item_type'] = $type;


		//$item_list = $this->item_model->get_item();
		//$output_data["combo_product_data"] = $item_list;

		// 		echo "<pre>";
		// print_r($output_data['category_data']); exit;

		$output_data['main_content'] = "vender/item/post";
		$this->load->view('template/template',$output_data);	
	}

	public function put($id = ''){

		$this->auth->clear_messages();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item("form_field_error_prefix"), $this->config->item("form_field_error_suffix"));

		if (isset($_POST) && !empty($_POST)){

			if (isset($_POST['submit'])){

				$validation_rules = array(
					
					array('field' => 'name', 'label' => 'item name', 'rules' => 'trim|required|min_length[2]'),
					array('field' => 'cuisine_id', 'label' => 'cuisine', 'rules' => 'trim|required|numeric'),
					array('field' => 'category_id', 'label' => 'category', 'rules' => 'trim|required|numeric'),
					array('field' => 'price', 'label' => 'item price', 'rules' => 'trim|required|numeric|greater_than[0]'),
					array('field' => 'offer_price', 'label' => 'item offer price', 'rules' => 'trim|numeric|less_than['.$this->input->post("price").']'),
					array('field' => 'quantity', 'label' => 'item quantity', 'rules' => 'trim|numeric|greater_than_equal_to[0]'),
					array('field' => 'item_description', 'label' => 'short description', 'rules' => 'trim'),
				);

				$this->form_validation->set_rules($validation_rules);

				 
				if ($this->form_validation->run() === true) {

					$file_upload = true;
					if (isset($_FILES['item_picture']) && !empty($_FILES['item_picture']) && strlen($_FILES['item_picture']['name']) > 0) {

						$config['upload_path'] = FCPATH . $this->config->item("item_photo_path");
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['encrypt_name'] = false;
						$config['file_name'] = 'item' . '_' . time();
						$config['file_ext_tolower'] = true;
						// $config['max_size'] = '1024';
						// $config['min_width'] = '300';
						// $config['max_width'] = '300';
						// $config['min_height'] = '120';
						// $config['max_height'] = '120';

						$this->load->library('upload');
						$this->upload->initialize($config, true);

						if (!$this->upload->do_upload('item_picture')) {
							ucfirst($this->upload->display_errors());
							$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							$this->session->set_flashdata($this->auth->get_messages_array());
							$file_upload = false;
						} else {
							$file_upload_data = $this->upload->data();
							$modal_data['item_picture'] = $file_upload_data;

							// $this->load->library('image_lib');

							// $config['image_library'] = 'gd2';
							// $config['source_image'] = FCPATH . $this->config->item("item_photo_path").'/'.$file_upload_data['file_name'];
							// $config['create_thumb'] = TRUE;
							// $config['thumb_marker'] = '';
						 //    $config['maintain_ratio'] = TRUE;
						 //    $config['width'] = 600;
	    		// 			$config['height'] = 600;

						 //    $this->image_lib->clear();
						 //    $this->image_lib->initialize($config);

						 //    if (!$this->image_lib->resize()){
							//     ucfirst($this->upload->display_errors());
							// 	$this->auth->set_error_message(ucfirst($this->upload->display_errors()));
							// 	$this->session->set_flashdata($this->auth->get_messages_array());
							// 	$file_upload = false;
							// }else{
							// 	$file_upload = true;
							// }
						}

					}

					if ($file_upload){
						if($this->item_model->put($modal_data)){
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "item-list");
						}else{
							$this->session->set_flashdata($this->auth->get_messages_array());
							redirect(base_url() . "item-list");
						}
					}
					
				} 
			}
		}

		$output_data['cuisines_data'] = get_cuisine2();
		$output_data['item_variant_data'] = $this->item_model->get_item_variants(decrypt($id));
		$output_data['item_data'] = $this->item_model->get_item(decrypt($id));
		$output_data['category_data'] = $this->category_model->get_category();
		$output_data['variant_groups'] = $this->item_model->get_variant_groups();
		
		// if (!isset($output_data['item_data']) || empty($output_data['item_data']) || count($output_data['item_data']) <= 0){
		// 	$this->auth->set_error_message("Item data not found");
		// 	$this->session->set_flashdata($this->auth->get_messages_array());
		// 	redirect(base_url() . "item-list");
		// }

		$output_data['main_content'] = "vender/item/put";
		$this->load->view('template/template',$output_data);	
	}

}
?>