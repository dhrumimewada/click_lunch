<?php

class Profile_model extends CI_Model {
	public function __construct() {
		parent::__construct();
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
}