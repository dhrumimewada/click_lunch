<?php

class Profile_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

    public function get_cards($id = NULL){
        $return_data = array();

        $this->db->select('*');
        $this->db->from('customer_payment_card');
        $this->db->where("customer_id", $this->auth->get_user_id());
        $this->db->where("deleted_at", NULL);
        $this->db->order_by("id", "desc");

        if (isset($id) && !is_null($id)) {
            $this->db->where('id', $id);
        }

        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            if (isset($id) && !is_null($id)) {
                $return_data = $sql_query->row();
            }else{
                $return_data = $sql_query->result_array();
            }
        }
        return $return_data;
    }

	public function add_address(){

		$return_value = FALSE;

		$delivery_address_data = array(
            'customer_id' => $this->auth->get_user_id(),
            'default_address' => '1',
            'house_no' => ucwords(addslashes($this->input->post("housernum"))),
            'city' => ucwords(addslashes($this->input->post("city"))),
            'street' => ucwords(addslashes($this->input->post("street"))),
            'zipcode' => ucwords(addslashes($this->input->post("zipcode"))),
            'address_type' => $this->input->post("addresstype")
        );

        if(isset($_POST['delivery_instruction'])){
            $delivery_address_data['delivery_instruction'] = addslashes($this->input->post("delivery_instruction"));
        }
        if(isset($_POST['nickname'])){
            $delivery_address_data['nickname'] = addslashes($this->input->post("nickname"));
        }

        $house_no = str_replace(" ","+",trim(addslashes($this->input->post("housernum"))));
        $street = str_replace(" ","+",trim(addslashes($this->input->post("street"))));
        $city = str_replace(" ","+",trim(addslashes($this->input->post("city"))));
        $zipcode = str_replace(" ","+",trim(addslashes($this->input->post("zipcode"))));

        $address = $house_no."+".$street."+".$city."+".$zipcode;

        $google_key = $this->config->item('google_key');
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&key=$google_key");
        $json = json_decode($json);

        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        if(isset($lat) && $lat != "" && isset($long) && $long != ""){
            $delivery_address_data['latitude'] = $lat;
            $delivery_address_data['longitude'] = $long;

            if($this->db->insert('delivery_address',$delivery_address_data)){
            	$delivery_address_id = $this->db->insert_id();

            	$data = array('default_address' => 0);
            	$this->db->where('default_address',1);
            	$this->db->where('id !=',$delivery_address_id);
            	$this->db->update('delivery_address', $data);

                $this->session->set_userdata('delivery_address_id', encrypt($id));

                $this->auth->set_status_message("Delivery address added successfully");
                $return_value = TRUE;
            }else{
                $this->auth->set_error_message("Server encountered an error. please try again");
            }
        }else{
            $this->auth->set_error_message("Sorry, We could not fetch location. Please enter correct address");
        }

		return $return_value;
	}

    public function set_as_defualt_address(){

        $this->db->trans_begin();
        $return_value = FALSE;

        $old_data_array = array('default_address' => 0);
        $this->db->where('customer_id',$this->auth->get_user_id());
        $this->db->where('default_address',1);
        $this->db->update('delivery_address',$old_data_array);

        $data_array = array('default_address' => 1);
        $this->db->where('customer_id',$this->auth->get_user_id());
        $this->db->where('id',$this->input->post("address"));

        $this->db->update('delivery_address',$data_array);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->auth->set_error_message("Error into updating data");
        } else {
            $this->db->trans_commit();
            $this->auth->set_status_message("Change location successfully");
            $return_value = TRUE;
        }

        return $return_value;
    }

    public function update_profile($modal_data = NULL) {
        $this->db->trans_begin();
        $return_value = FALSE;
        // echo '<pre>';
        // print_r($modal_data);exit;

        $user_data['username'] = ucwords(addslashes($this->input->post("username")));
        $user_data['gender'] = addslashes($this->input->post("gender"));

        $dob = date('Y-m-d', strtotime($this->input->post("dob")));
        $user_data['dob'] = $dob;

        if (isset($modal_data['profile_picture']) && !empty($modal_data['profile_picture'])){
            
            $user_data['profile_picture'] = $modal_data['profile_picture']['file_name'];

            $this->db->select('profile_picture');
            $this->db->where('id', $this->auth->get_user_id());
            $this->db->from('customer');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0) {
                $return_data = $sql_query->row();
                $profile_picture_old = $return_data->profile_picture;

                if (isset($profile_picture_old) && !empty($profile_picture_old)) {
                    if (file_exists(FCPATH . $this->config->item("customer_profile_path") . "/" . $profile_picture_old)) {
                        unlink(FCPATH . $this->config->item("customer_profile_path") . "/" . $profile_picture_old);
                    }
                }
            }
        }

        $user_data['mobile_number'] = $this->input->post("mobile_number");
        $user_data['updated_at'] = date('Y-m-d H:i:s');
    
        $this->db->where('id', $this->auth->get_user_id());
        $this->db->update("customer", $user_data);
        //echo '<pre>'; print_r($this->db->last_query());exit;

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->auth->set_error_message("Error into updating data");
        } else {
            $this->db->trans_commit();
            $this->auth->set_status_message("Profile updated successfully");
            $return_value = TRUE;
        }

        return $return_value;
    }

    public function add_card(){

        $this->db->trans_begin();
        $return_value = FALSE;

        $payment_card_data = array(
                            'customer_id' => $this->auth->get_user_id(),
                            'card_holder_name' => addslashes($this->input->post("card_holder_name")),
                            'card_number' => encrypt($this->input->post("card_number")),
                            'display_number' => 'XXXX XXXX XXXX '.substr($this->input->post("card_number"), -4),
                            'expiry_date' => encrypt($this->input->post("expiry_date")),
                            'cvv' => encrypt($this->input->post("cvv")),
                            'card_type' => intval($this->input->post("card_type"))
                        );
        if(isset($_POST['nickname'])){
            $payment_card_data['nickname'] = addslashes($this->input->post("nickname"));
        }

        if(isset($_POST['card_id'])){
            $this->db->where('id',intval($this->input->post("card_id")));
            $this->db->update('customer_payment_card',$payment_card_data);
        }else{
            $this->db->insert('customer_payment_card',$payment_card_data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->auth->set_error_message("Error into inserting data");
        } else {
            $this->db->trans_commit();
            if(isset($_POST['card_id'])){
                $this->auth->set_status_message("Payment card updated successfully");
            }else{
                $this->auth->set_status_message("Payment card added successfully");
            }
            $return_value = TRUE;
        }

        return $return_value;
    }
}