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

    public function add_card_with_returnid(){

        $this->db->trans_begin();
        $return_value = 0;

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

        $this->db->insert('customer_payment_card',$payment_card_data);
        $insert_id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->auth->set_error_message("Error into inserting data");
        } else {
            $this->db->trans_commit();
            $this->auth->set_status_message("Payment card added successfully");
            $return_value = $insert_id;
        }

        return $return_value;
    }

    public function get_promocode_data(){
        $return_data = array();
        $promocode = $this->input->post("promocode");
        $this->db->select('*');
        $this->db->where('promocode', $promocode);
        $this->db->from('promocode');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $promocode = (array)$sql_query->row();
            if($promocode['promo_type'] == 1){
                $this->db->select('product_id');
                $this->db->where('promocode_id', $promocode['id']);
                $this->db->from('promocode_valid_product');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $applied_on_products = $sql_query->result_array();
                    $promocode['applied_on_products'] = array_column($applied_on_products, 'product_id');
                }else{
                    $promocode['applied_on_products'] = array();
                }
            }else{
                $promocode['applied_on_products'] = array();
            }
            $return_data = $promocode;
        }
        return $return_data;
    }

    public function order_detail($id = NULL){
        $return_data = array();
        if(isset($id) && !is_null($id)){
            $sql_select = array(
                                't1.id',
                                't1.total',
                                't2.username',
                                't1.order_type',
                                'CONCAT_WS(", ", t4.house_no, t4.street, t4.city, t4.zipcode) AS delivery_address',
                                't4.latitude as address_latitude',
                                't4.longitude as address_longitude',
                                't3.shop_name',
                                't3.profile_picture',
                                't3.address as shop_address',
                                't3.latitude as shop_latitude',
                                't3.longitude as shop_longitude',
                                't3.profile_picture as shop_picture',
                                't1.payment_mode',
                                't1.subtotal',
                                't1.promo_amount',
                                'ROUND((((t1.subtotal + t1.promo_amount) * t1.tax) / 100), 2) as tax_amount',
                                'ROUND((((t1.subtotal + t1.promo_amount) * t1.service_charge) / 100), 2) as service_charge_amount',
                                't1.delivery_charges',
                                't1.total',
                                'IF(t1.order_type=5, t1.schedule_date, "") as schedule_date',
                                'IF(t1.order_type=5, t1.schedule_time, "") as schedule_time',
                                'IF(t1.order_type=2, t1.later_time, "") as later_time',
                                't1.created_at',
                                't1.QR_code'
                );
                $this->db->select($sql_select);

                $this->db->from('orders t1');
                $this->db->join('customer t2', 't1.customer_id = t2.id','left');
                $this->db->join('shop t3', 't1.shop_id = t3.id','left');
                $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

                $this->db->where('t1.id', $id);
                $this->db->where('t1.customer_id',$this->auth->get_user_id());
                $sql_query = $this->db->get();

                if ($sql_query->num_rows() > 0){
                    $return_data = (array)$sql_query->row();
                    $return_data['rating'] = '3.5';

                    $sql_select = array(
                                    't2.name',
                                    't1.quantity',
                                    't1.total_product_price'
                    );

                    $this->db->select($sql_select);
                    $this->db->from('order_items t1');
                    $this->db->where('t1.order_id', $id);
                    $this->db->join('item t2', 't1.item_id = t2.id','left');
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $return_data['products'] = $sql_query->result_array();
                    }               
                }
        }
        return $return_data;
    }

    public function order_history($limit = NULL, $start = NULL, $date = NULL, $cuisines = array(), $fav = false){
        
        $return_data = array();

        $sql_select = array(
                        't1.id',
                        't1.total',
                        't1.order_type',
                        't1.order_status',
                        't1.favourite',
                        't3.shop_name',
                        't3.address as shop_address',
                        't3.profile_picture as shop_picture',
                        't1.created_at'
        );
        $this->db->select($sql_select);

        $this->db->from('orders t1');
        $this->db->join('shop t3', 't1.shop_id = t3.id','left');

        if(isset($cuisines) && is_array($cuisines) && !empty($cuisines)){
            $this->db->join('order_items t4', 't1.id = t4.order_id','left');
            $this->db->join('item t5', 't4.item_id = t5.id','left');
            $this->db->where_in('t5.cuisine_id',$cuisines);
        }

        if(isset($date) && !is_null($date) && $date != ''){
            $this->db->where('DATE(t1.created_at)', $date);
        }
        $this->db->where('t1.customer_id',$this->auth->get_user_id());
        $this->db->order_by("t1.created_at", "desc");

        if(isset($limit) && isset($start) && !is_null($limit) && !is_null($start)){
            $this->db->limit($limit, $start);
        }

        if(isset($fav) && $fav == TRUE){
            $this->db->where('t1.favourite',1);
        }

        // $limit = 10; // messages per page
        // if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
        //     $start = $limit * ($_POST['page_number'] - 1);
        //     $this->db->limit($limit, $start);
        // }else{
        //     if(isset($_POST['keyword']) && !is_null($_POST['keyword']) && $_POST['keyword'] != ''){
        //         $this->db->where("t3.shop_name LIKE '%".$_POST['keyword']."%'");
        //     }else{
        //         $this->db->limit($limit);
        //     }
        // }

        

        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $return_data = $sql_query->result_array();
        }

        //return $this->db->last_query();
        return $return_data;
    }
}