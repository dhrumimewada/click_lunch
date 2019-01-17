<?php

class Vender_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
	}

	public function get_vender($id = NULL){
		$return_data = array();
		$this->db->select('*');
		$this->db->from('shop');
		if (isset($id) && !is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where("deleted_at", NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			if (isset($id) && !is_null($id)) {
				$return_data = $sql_query->row();
			}else{
				$return_data = $sql_query->result_array();
			}
			
		}
		return $return_data;
	}

	public function post($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])) {
			$profile_picture = $modal_data['profile_picture']['file_name'];
		}



		$payment_mode = '';
		if(isset($_POST['payment_mode'])){
			$payment_mode = implode (",", $this->input->post("payment_mode"));
		}

		// echo "<pre>";
		// var_dump($payment_mode);
		// exit;

		$user_data = array(
						'shop_name' => ucwords(addslashes($this->input->post("shop_name"))),
						'email' => $this->input->post("email"),
						'vender_name' => ucwords(addslashes($this->input->post("vender_name"))),
						'address' => addslashes($this->input->post("address")),
						'city' => addslashes($this->input->post("city")),
						'state' => addslashes($this->input->post("state")),
						'country' => addslashes($this->input->post("country")),
						'zip_code' => $this->input->post("zipcode"),
						'latitude' => $this->input->post("latitude"),
						'longitude' => $this->input->post("longitude"),
						'contact_no1' => $this->input->post("contact_no1"),
						'contact_no2' => $this->input->post("contact_no2"),
						'website' => addslashes($this->input->post("website")),
						'tax_number' => $this->input->post("tax_number"),
						'payment_mode' => $payment_mode,
						'profile_picture' => ((isset($profile_picture) && !empty($profile_picture)) ? $profile_picture : ''),
						'status' => 0,
						'created_at' => date('Y-m-d H:i:s')
					);

		$response = $this->db->insert("shop", $user_data);
		$user_id = $this->db->insert_id();

		$shop_code = str_replace(' ', '', $this->input->post("shop_name"));
		$shop_code = preg_replace('/[^A-Za-z0-9\-]/', '', $shop_code);
		$shop_code = strtoupper(substr($shop_code, 0, 3)).$user_id;

		$user_data = array('shop_code' => $shop_code );
		$this->db->where("id", $user_id);
		$this->db->update("shop", $user_data);

		// echo "<pre>";
		// print_r($user_id);
		// print_r(encrypt($user_id));
		// print_r(decrypt(encrypt($user_id)));
		// exit;

		$this->db->select('emat_email_subject,emat_email_message');
		$this->db->from('email_template');
		$this->db->where('emat_email_type', 1);
		$this->db->where("emat_is_active", 1);
		$sql_query = $this->db->get();
		$return_data = $sql_query->row();

		if (!isset($return_data) && empty($return_data)){
			$this->auth->set_error_message("Email template not found. Error into sending mail.");
			return FALSE;
		}

		if($response){

			$activation_token = bin2hex(random_bytes(20));
			$email_var_data["vender_name"] = $this->input->post("vender_name");
			$email_var_data["activation_link"] = base_url() . 'vender-setpassword/'. $activation_token;

			$from = "excellentwebworld@admin.com";
			$to = $this->input->post("email");
			$subject = "Activation mail";

			$email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
			$message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
			$mail = sendmail($from, $to, $subject, $message);
		}

		if(!$mail){
			$this->auth->set_error_message("Error into sending mail");
			return FALSE;
		}else{
			$token_array = array('activation_token' => $activation_token);
			$this->db->where("id", $user_id);
			$this->db->update("shop", $token_array);
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into inserting data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Restaurant added successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function put($modal_data = NULL) {
		$this->db->trans_begin();
		$return_value = FALSE;
		// echo '<pre>';
		// print_r($modal_data);exit;

		$user_data['shop_name'] = ucwords(addslashes($this->input->post("shop_name")));
		$user_data['vender_name'] = ucwords(addslashes($this->input->post("vender_name")));
		$user_data['address'] = addslashes($this->input->post("address"));
		$user_data['city'] = addslashes($this->input->post("city"));
		$user_data['state'] = addslashes($this->input->post("state"));
		$user_data['country'] = addslashes($this->input->post("country"));
		$user_data['zip_code'] = $this->input->post("zipcode");

		if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
			
			$user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

			$this->db->select('profile_picture');
			$this->db->where('id', $this->input->post("shop_id"));
			$this->db->from('shop');
			$sql_query = $this->db->get();
			if ($sql_query->num_rows() > 0) {
				$return_data = $sql_query->row();
				$profile_picture_old = $return_data->profile_picture;

				if (isset($profile_picture_old) && !empty($profile_picture_old)) {
					if (file_exists(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old)) {
						unlink(FCPATH . $this->config->item("profile_path") . "/" . $profile_picture_old);
					}
				}
			}
		}

		$payment_mode = '';
		if(isset($_POST['payment_mode'])){
			$payment_mode = implode (",", $this->input->post("payment_mode"));
		}

		$user_data['contact_no1'] = $this->input->post("contact_no1");
		$user_data['contact_no2'] = $this->input->post("contact_no2");
		$user_data['website'] = addslashes($this->input->post("website"));
		$user_data['tax_number'] = addslashes($this->input->post("tax_number"));
		$user_data['payment_mode'] = $payment_mode;
		$user_data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $this->input->post("shop_id"));
		$this->db->update("shop", $user_data);
		//echo '<pre>'; print_r($this->db->last_query());exit;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("Vender updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}

	public function set_password(){
		$this->db->trans_begin();
		$return_value = FALSE;

		$this->db->select('deleted_at');
		$this->db->from('shop');
		$this->db->where('id', decrypt($this->input->post("vender_id")));
		$this->db->where('deleted_at !=', NULL);
		$sql_query = $this->db->get();
		if ($sql_query->num_rows() > 0) {
			$this->auth->set_error_message("Something went wrong! Contact admin for more.");
			return $return_value;
		}


		$user_data = array(
						'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
						'status' => 1,
						'updated_at' => date('Y-m-d H:i:s')
					);
		$this->db->where("id", decrypt($this->input->post("vender_id")));
		$this->db->update("shop", $user_data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->auth->set_error_message("Error into updating data");
		} else {
			$this->db->trans_commit();
			$this->auth->set_status_message("password updated successfully");
			$return_value = TRUE;
		}

		return $return_value;
	}
}