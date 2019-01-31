<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(1);

class Customer_api extends REST_Controller {
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *');  
		$this->load->model("email_template_model");
	}

	public function init_get($app_version = '',$type = ''){

        $postFields['app_version'] = $app_version;        
        $postFields['type'] = $type;               
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $MaintenanceMode = (array)$this->db->get_where('appsetting',array('app_name' => 'maintenance_mode'))->row();
            $AppVersion = (array)$this->db->get_where('appsetting',array('app_name' => $type))->row();
            $current_version = (Int)str_replace('.', '',$AppVersion['app_version']);
            $app_version = (Int)str_replace('.', '', $app_version);

            if($MaintenanceMode['updates'] == 1){
                $response['status'] = false;
                $response['update'] = false;
                $response['maintenance'] = true;
                $response['message'] = 'Server under maintenance, please try again after some time';
            }
            else if($app_version < $current_version && $AppVersion['updates'] == 0){
                $response['status'] = true;
                $response['update'] = false;
                $response['message'] = 'Clicklunch app new version available';
            }
            else if($app_version < $current_version && $AppVersion['updates'] == 1){
                $response['status'] = false;
                $response['update'] = true;
                $response['message'] = 'Clicklunch app new version available, please upgrade your application';
            }
            else{
                $response['status'] = true;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }

        $this->response($response);
    }

    public function register_post(){
    	$postFields['username'] = $_POST['username'];        
        $postFields['email'] = $_POST['email'];        
        $postFields['password'] = $_POST['password']; 
        $postFields['mobile_number'] = $_POST['mobile_number']; 
        $postFields['date_of_birth'] = $_POST['date_of_birth']; 
        $postFields['gender'] = $_POST['gender']; 
        $postFields['device_token'] = $_POST['device_token']; 
        $postFields['device_type'] = $_POST['device_type']; 
        $postFields['latitude'] = $_POST['latitude'];
        $postFields['longitude'] = $_POST['longitude'];   

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

        	$this->db->select('*');
            $this->db->where("email",$_POST['email']);
            $this->db->where("deleted_at",NULL);
            $this->db->from("customer");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){

            	$response['status'] = false;
            	$response['message'] = 'Email id is already in use';

            }else{

            	$social_user_exists = array();
                if(isset($_POST['social_id']) && $_POST['social_id'] != "" && isset($_POST['social_type']) && $_POST['social_type'] != "0" && !is_null($_POST['social_id']) && !is_null($_POST['social_type'])){

                	$this->db->select('id');
            		$this->db->where("social_id",$_POST['social_id']);
            		$this->db->where("social_type",$_POST['social_type']);
            		$this->db->from("customer");
            		$sql_query = $this->db->get();
            		if ($sql_query->num_rows() > 0){
            			$social_user_exists = $sql_query->result_array();
            		}
                }

                if(empty($social_user_exists)){

                	$google_api_key = $this->config->item("google_key");
	                $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$_POST['latitude'].','.$_POST['longitude'].'&key='.$google_api_key);
	                $output = json_decode($geocodeFromLatLong);
	                $status = $output->status;

	                $address = ($status=="OK")?$output->results[1]->formatted_address:'';

	                $user = array( 
	                        'username' => $_POST['username'], 
	                        'email'=> $_POST['email'], 
	                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
	                        'device_token'=> $_POST['device_token'], 
	                        'device_type'=> $_POST['device_type'], 
	                        'mobile_number'=> $_POST['mobile_number'],
	                        'latitude'=> $_POST['latitude'],
	                        'longitude'=> $_POST['longitude'],
	                        'gender'=> $_POST['gender'],
	                        'dob'=> $_POST['date_of_birth'],
	                        'address'=> $address
	                    );

	                if(isset($_POST['social_id']) && $_POST['social_id'] != "" && isset($_POST['social_type']) && $_POST['social_type'] != "0" && !is_null($_POST['social_id']) && !is_null($_POST['social_type'])){

	                	$user['social_id'] = $_POST['social_id'];
	                	$user['social_type'] = $_POST['social_type'];
	                }

	                $this->db->insert('customer', $user);
	                $insert_id = $this->db->insert_id();

	                if($insert_id){

	                	//Send activation mail

		                $to =  array($_POST['email']);
		                $subject = 'Activate Your '.$this->config->item('site_name').' Account';
                        $path = BASE_URL().'email_template/register.html';
                        $template = file_get_contents($path);

                        $activation_token = bin2hex(random_bytes(20));
                        $activate_url = base_url() . 'customer-activate/'. $activation_token;
                        $template = str_replace('##ACCOUNTACIVATIONURL##', $activate_url, $template);

                        $template = $this->create_email_template($template);

                        $mail = $this->send_mail($to,$subject,$template);

		                if($mail){

		                	$update_data = array('activation_token' => $activation_token);
		                	$this->db->where('id', $insert_id);
		                	$this->db->update('customer', $update_data);

		                	$response['status'] = true;
		                	$response['message'] = 'Account activation mail is sent on your email address';

		                 }else{

		                 	$response['status'] = false;
                         	$response['message'] = 'Error into sending mail. please try again later';

		                 }

	                }else{
	                    $response['status'] = false;
	                    $response['message'] = 'Error into register. please try again later';
	                }

                }else{
                	$response['status'] = false;
                    $response['message'] = 'This social account already used buy another account.';
                }
            }

        	$response['status'] = true;

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }

        $this->response($response);
    }

    public function login_post(){
    	      
        $postFields['email'] = $_POST['email'];        
        $postFields['password'] = $_POST['password']; 
        $postFields['device_token'] = $_POST['device_token']; 
        $postFields['device_type'] = $_POST['device_type']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

        	$this->db->select('*');
            $this->db->where("email",$_POST['email']);
            $this->db->where("password !=",'');
            $this->db->where("deleted_at",NULL);
            $this->db->where("status",1);
            $this->db->from("customer");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
            	$customer = $sql_query->row();
            	if (password_verify($_POST['password'],$customer->password)){

            		$data = array(
	                    'device_type' => $_POST['device_type'],
	                    'device_token' => $_POST['device_token']
	                     );

                    if(isset($_POST['latitude']) && $_POST['latitude'] != "" && !is_null($_POST['latitude']) && isset($_POST['longitude']) && $_POST['longitude'] != "" && !is_null($_POST['longitude'])){
                        $data['latitude'] = $_POST['latitude'];
                        $data['longitude'] = $_POST['longitude'];
                    }

                $this->db->where('id',$customer->id);
                $this->db->update('customer',$data);

                $response['status'] = true;
                $response['profile'] = (array)$customer;

            	}else{
            		$response['status'] = false;
            		$response['message'] = 'The password that you have entered is incorrect';
            	}
            	

            }else{
            	$response['status'] = false;
            	$response['message'] = 'User does not exists';
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }

        $this->response($response);
    }

    public function logout_post(){
        
        $postFields['customer_id'] = $_POST['customer_id'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $where = array('id' => intval($_POST['customer_id']), 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';   
            }else{
                $data = array('device_token' => '', 'device_type' => '0', 'latitude' => '','longitude' => '' );
                $this->db->where('id',$_POST['customer_id']);
                if($this->db->update('customer',$data)){
                    $response['status'] = true;
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function change_password_post(){
        $postFields['current_password'] = $_POST['current_password'];        
        $postFields['new_password'] = $_POST['new_password']; 
        $postFields['confirm_new_password'] = $_POST['confirm_new_password']; 
        $postFields['customer_id'] = $_POST['customer_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
        	$this->db->select('password');
	        $this->db->where("deleted_at",NULL);
	        $this->db->where("status",1);
	        $this->db->where("id",$_POST['customer_id']);
	        $this->db->from("customer");
	        $sql_query = $this->db->get();
	        if ($sql_query->num_rows() > 0){
	        	$data = $sql_query->row();
	        	if (!password_verify($_POST['current_password'], $data->password)){
	        		$response['status'] = false;
                	$response['message'] = 'Your current password is incorrect';
                	$response['password'] = $data->password;
           	 	}else{
           	 		$user_data = array('password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT) );
                	$this->db->where('id',$_POST['customer_id']);
                	if($this->db->update('customer',$user_data)){
	                    $response['status'] = true;
	                    $response['message'] = 'Password changed successfully';
	                }else{
	                    $response['status'] = false;
	                    $response['message'] = 'Server encountered an error. please try again';
	                }
           	 	}
	        }else{
	        	$response['status'] = false;
                $response['message'] = 'User not found';
	        }  
        }
        else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function forgot_password_post(){
        $postFields['email'] = $_POST['email']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('email' => $_POST['email'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $to =  array($_POST['email']);
                $subject = $this->config->item('site_name').' - Reset Password';
                $path = BASE_URL().'email_template/reset_password.html';
                $template = file_get_contents($path);

                $remember_token = bin2hex(random_bytes(20));
                $reset_url = base_url() . 'customer-reset-password/'. $remember_token;

                $template = str_replace('##RESETPWURL##', $reset_url, $template);
                $template = str_replace('##USERNAME##', $user['username'], $template);

                $template = $this->create_email_template($template);

                $mail = $this->send_mail($to,$subject,$template);

                if($mail){

                	$update_data = array('remember_token' => $remember_token);
                	$this->db->where('id', $user['id']);
                	$this->db->update('customer', $update_data);

                	$response['status'] = true;
                	$response['message'] = 'Reset Password mail is sent on this email address';

                 }else{

                 	$response['status'] = false;
                 	$response['message'] = 'Error into sending mail. please try again later';

                 }

            }
            
        }
        else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function myprofile_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $response['status'] = true;
                $response['profile'] = $user;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function update_profile_post(){
        $postFields['customer_id'] = $_POST['customer_id'];

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                if(isset($_POST['username']) && $_POST['username'] != ""){
                    $user_data['username'] = ucwords($_POST['username']);
                }
                if(isset($_POST['mobile_number']) && $_POST['mobile_number'] != ""){
                    $user_data['mobile_number'] = $_POST['mobile_number'];
                }
                if(isset($_POST['date_of_birth']) && $_POST['date_of_birth'] != ""){
                    $user_data['dob'] = $_POST['date_of_birth'];
                }
                if(isset($_POST['gender']) && $_POST['gender'] != ""){
                    $user_data['gender'] = $_POST['gender'];
                }

                if (isset($_FILES['image']) && !empty($_FILES['image']) && strlen($_FILES['image']['name']) > 0) {

                    //save new image in folder
                    $config['upload_path'] = FCPATH . $this->config->item("customer_profile_path");
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['encrypt_name'] = false;
                    $config['file_name'] = 'customer' . '_' . time();
                    $config['file_ext_tolower'] = true;

                    $this->load->library('upload');
                    $this->upload->initialize($config, true);

                    if (!$this->upload->do_upload('image')) {
                        $response['status'] = false;
                        $response['message'] = $this->upload->display_errors();
                    } else {

                        $image_data = $this->upload->data();

                        //remove old image from user folder
                        $this->db->select('profile_picture');
                        $this->db->where('id', intval($_POST['customer_id']));
                        $this->db->from('customer');
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0) {
                            $return_data = $sql_query->row();
                            $image_old = $return_data->image;

                            if (isset($image_old) && !empty($image_old)) {
                                if (file_exists(FCPATH . $this->config->item("customer_profile_path") . "/" . $image_old)) {
                                    unlink(FCPATH . $this->config->item("customer_profile_path") . "/" . $image_old);
                                }
                            }
                        }

                        $user_data['profile_picture'] = $image_data['file_name'];
                    }
                }



                $user_data['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id',$_POST['customer_id']);
                if($this->db->update('customer',$user_data)){

                    $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
                    $updated_user_data = (array)$this->db->get_where('customer',$where)->row();

                    $response['status'] = true;
                    $response['profile'] = $updated_user_data;
                    $response['message'] = 'Profile updated successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            } 
        }
        else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function my_setting_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $user_data = array($_POST['setting_name'] => $_POST['status'] );
                $this->db->where('id',$_POST['customer_id']);
                if($this->db->update('customer',$user_data)){
                    $response['status'] = true;
                    $response['message'] = 'Setting updated successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function setting_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['setting_name'] = $_POST['setting_name']; 
        $postFields['status'] = $_POST['status']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $user_data = array($_POST['setting_name'] => $_POST['status'] );
                $this->db->where('id',$_POST['customer_id']);
                if($this->db->update('customer',$user_data)){
                    $response['status'] = true;
                    $response['message'] = 'Setting updated successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function my_delivery_address_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $where = array('customer_id' => $_POST['customer_id'],'deleted_at' => NULL);
                $delivery_addresses = $this->db->get_where('delivery_address',$where)->result_array();

                $response['status'] = true;
                $response['delivery_addresses'] = $delivery_addresses;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function popular_delivery_addresses_get(){

        $this->db->select('*');
        $this->db->where("deleted_at",NULL);
        $this->db->where("popular",1);
        $this->db->from("delivery_address");
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $delivery_address = $sql_query->result_array();
            $response['status'] = true;
            $response['delivery_addresses'] = $delivery_address;
        }else{
            $response['status'] = false;
            $response['message'] = 'No any address found';
        }

        $this->response($response);
    }

    public function add_delivery_address_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['house_no'] = $_POST['house_no']; 
        $postFields['street'] = $_POST['street']; 
        $postFields['city'] = $_POST['city']; 
        $postFields['zipcode'] = $_POST['zipcode']; 
        $postFields['address_type'] = $_POST['address_type']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $delivery_address_data = array(
                    'customer_id' => $_POST['customer_id'],
                    'house_no' => $_POST['house_no'],
                    'city' => $_POST['city'],
                    'street' => $_POST['street'],
                    'zipcode' => $_POST['zipcode'],
                    'address_type' => $_POST['address_type']
                );

                if(isset($_POST['delivery_instruction'])){
                    $delivery_address_data['delivery_instruction'] = $_POST['delivery_instruction'];
                }
                if(isset($_POST['nickname'])){
                    $delivery_address_data['nickname'] = $_POST['nickname'];
                }

                $house_no = str_replace(" ","+",trim($_POST['house_no']));
                $street = str_replace(" ","+",trim($_POST['street']));
                $city = str_replace(" ","+",trim($_POST['city']));
                $zipcode = str_replace(" ","+",trim($_POST['zipcode']));

                $address = $house_no."+".$street."+".$city."+".$zipcode;

                $google_key = $this->config->item('google_key');
                $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&key=$google_key");
                $json = json_decode($json);

                $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

                $delivery_address_data['latitude'] = $lat;
                $delivery_address_data['longitude'] = $long;

                if($this->db->insert('delivery_address',$delivery_address_data)){
                    $response['status'] = true;
                    $response['message'] = 'Delivery address added successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
                
                
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function set_default_address_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['address_id'] = $_POST['address_id']; 
        
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $this->db->select('id');
                $this->db->where("id", $_POST['address_id']);
                $this->db->where("customer_id", $_POST['customer_id']);
                $this->db->where("deleted_at", NULL);
                $this->db->from('delivery_address');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){

                    $old_data_array = array('default_address' => 0);
                    $this->db->where('customer_id',$_POST['customer_id']);
                    $this->db->where('default_address',1);
                    $this->db->update('delivery_address',$old_data_array);

                    $data_array = array('default_address' => 1);
                    $this->db->where('customer_id',$_POST['customer_id']);
                    $this->db->where('id',$_POST['address_id']);

                    if($this->db->update('delivery_address',$data_array)){
                        $response['status'] = true;
                        $response['message'] = 'Default delivery address added successfully';
                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Server encountered an error. please try again';
                    }

                }else{
                    $response['status'] = false;
                    $response['message'] = 'Address not found';
                }

            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function delete_delivery_address_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['delivery_address_id'] = $_POST['delivery_address_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $data = array('deleted_at' => date('Y-m-d H:i:s'));

                $this->db->where('customer_id',$_POST['customer_id']);
                $this->db->where('id',$_POST['delivery_address_id']);

                if($this->db->update('delivery_address',$data)){
                    $response['status'] = true;
                    $response['message'] = 'Delivery address removed successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function my_payment_cards_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $payment_cards = array();
                $this->db->select('*');
                $where = array('customer_id' => $_POST['customer_id'],'deleted_at' => NULL);
                $this->db->where($where);
                $this->db->from('customer_payment_card');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $payment_cards = $sql_query->result_array();
                    foreach ($payment_cards as $key => $value) {
                        $payment_cards[$key]['display_number'] = substr($value['card_number'], -4);
                    }
                }

                $response['status'] = true;
                $response['payment_cards'] = $payment_cards;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function add_payment_card_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['card_holder_name'] = $_POST['card_holder_name']; 
        $postFields['card_number'] = $_POST['card_number']; 
        $postFields['expiry_date'] = $_POST['expiry_date']; 
        $postFields['cvv'] = $_POST['cvv']; 
        $postFields['card_type'] = $_POST['card_type']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $payment_card_data = array(
                    'customer_id' => $_POST['customer_id'],
                    'card_holder_name' => $_POST['card_holder_name'],
                    'card_number' => $_POST['card_number'],
                    'expiry_date' => $_POST['expiry_date'],
                    'cvv' => intval($_POST['cvv']),
                    'card_type' => intval($_POST['card_type'])
                );

                if(isset($_POST['nickname'])){
                    $payment_card_data['nickname'] = $_POST['nickname'];
                }

                if($this->db->insert('customer_payment_card',$payment_card_data)){
                    $response['status'] = true;
                    $response['message'] = 'Card added successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function edit_payment_card_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['payment_card_id'] = $_POST['payment_card_id']; 
        $postFields['card_holder_name'] = $_POST['card_holder_name']; 
        $postFields['card_number'] = $_POST['card_number']; 
        $postFields['expiry_date'] = $_POST['expiry_date']; 
        $postFields['cvv'] = $_POST['cvv']; 
        $postFields['card_type'] = $_POST['card_type']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $data = array(
                    'card_holder_name' => $_POST['card_holder_name'],
                    'card_number' => $_POST['card_number'],
                    'expiry_date' => $_POST['expiry_date'],
                    'cvv' => intval($_POST['cvv']),
                    'card_type' => intval($_POST['card_type']),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if(isset($_POST['nickname'])){
                    $data['nickname'] = $_POST['nickname'];
                }

                $this->db->where('customer_id',$_POST['customer_id']);
                $this->db->where('id',$_POST['payment_card_id']);

                if($this->db->update('customer_payment_card',$data)){
                    $response['status'] = true;
                    $response['message'] = 'Card updated successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function delete_payment_card_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['payment_card_id'] = $_POST['payment_card_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $data = array('deleted_at' => date('Y-m-d H:i:s'));

                $this->db->where('customer_id',$_POST['customer_id']);
                $this->db->where('id',$_POST['payment_card_id']);

                if($this->db->update('customer_payment_card',$data)){
                    $response['status'] = true;
                    $response['message'] = 'Card removed successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function home_post(){

        $cuisine_shops = array();
        if(isset($_POST['cuisine']) && $_POST['cuisine'] != ""){
            $cuisine_data = explode(',',$_POST['cuisine']);

            $this->db->select('shop_id'); 
            $this->db->where_in('cuisine_id',$cuisine_data); 
            $this->db->group_by('shop_id'); 
            $this->db->from('shop_cuisines'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){ 
                $cuisine_shops_array = $sql_query->result_array();
                $cuisine_shops = array_column($cuisine_shops_array, 'shop_id');
            }
        }

        if(isset($_POST['address_id']) && $_POST['address_id'] != "" && $_POST['address_id'] != "0"){

            $this->db->select('latitude, longitude'); 
            $this->db->where('id',$_POST['address_id']);  
            $this->db->from('delivery_address'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $address = $sql_query->row();
                $latitude = $address->latitude;
                $longitude = $address->longitude;
            }else{
                $response['message'] = 'Selected delivery address not found';
            }
        }

        $sql_select = array(
                            "id",
                            "shop_name",
                            "profile_picture",
                            "city",
                            "state",
                            "country",
                            "zip_code"
                        );

        if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != ""){

            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            $distance = "(3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." - latitude) * pi()/180 / 2), 2) +COS( ".$latitude." * pi()/180) * COS(longitude * pi()/180) * POWER(SIN(( ".$longitude." - longitude) * pi()/180 / 2), 2) ))) as distance";
            array_push($sql_select,$distance);

        }else if(isset($_POST['address_id']) && $_POST['address_id'] != "" && $_POST['address_id'] != "0"){

            $distance = "(3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." - latitude) * pi()/180 / 2), 2) +COS( ".$latitude." * pi()/180) * COS(longitude * pi()/180) * POWER(SIN(( ".$longitude." - longitude) * pi()/180 / 2), 2) ))) as distance";
            array_push($sql_select,$distance);

        }else{

        }
        

        $this->db->select($sql_select);

        if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != ""){
            $this->db->order_by("distance", "asc");
            $this->db->having("distance <=", 100);
        }else if(isset($_POST['address_id']) && $_POST['address_id'] != "" && $_POST['address_id'] != "0"){
            $this->db->order_by("distance", "asc");
            $this->db->having("distance <=", 100);
        }else{
            
        }
        
        if(!empty($cuisine_shops)){
            $this->db->where_in("id", $cuisine_shops);
        }
        $this->db->where("longitude !=", '');
        $this->db->where("latitude !=", '');
        $this->db->where("deleted_at", NULL);
        $this->db->where("status", 1);

        $limit = 10; // messages per page
        if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
            $start = $limit * ($_POST['page_number'] - 1);
            $this->db->limit($limit, $start);
        }else{
            $this->db->limit($limit);
        }

        $this->db->from('shop');
        $sql_query = $this->db->get();

        //$sql_query = $this->db->query('SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN((42.4483050 - latitude) * pi()/180 / 2), 2) +COS( 42.3483050 * pi()/180) * COS(longitude * pi()/180) * POWER(SIN(( -71.08359259999990 - longitude) * pi()/180 / 2), 2) ))) as distance from shop having distance <= 100 order by distance');
        
        if ($sql_query->num_rows() > 0){

            $shop_data = $sql_query->result_array();
            $shop_array = array_column($shop_data, 'id');

            $sql_select = array(
                            "t2.cuisine_name",
                            "t1.shop_id"
                        );

            $this->db->select($sql_select);
            $this->db->where("t2.deleted_at", NULL);
            $this->db->where("t2.is_active", 1);
            $this->db->where_in("t1.shop_id", $shop_array);
            $this->db->from('shop_cuisines t1');
            $this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $cuisine_data = $sql_query->result_array();                        
            }

            // Add cuisines to shop array
            foreach ($shop_data as $key => $value) {
                $shop_data[$key]['cuisine'] = array();

                foreach ($cuisine_data as $key1 => $value1) {
                    if($value['id'] == $value1['shop_id']){
                        array_push($shop_data[$key]['cuisine'], $value1['cuisine_name']);
                    }
                }
            }

            $sql_select = array(
                            "from_time",
                            "to_time",
                            "full_day",
                            "is_closed",
                            "shop_id"
                        );

            $this->db->select($sql_select);
            $this->db->where_in("shop_id", $shop_array);
            $this->db->where("day", date('l'));
            $this->db->from('shop_availibality');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $availibality_data = $sql_query->result_array();

                // Add availibality_data to shop array
                foreach ($shop_data as $key => $value) {

                    foreach ($availibality_data as $key1 => $value1) {
                        if($value['id'] == $value1['shop_id']){
                            $shop_data[$key]['from_time'] = $value1['from_time'];
                            $shop_data[$key]['to_time'] = $value1['to_time'];
                        }
                    }
                }
            }

            $response['status'] = true;
            $response['shop'] = $shop_data;
        }else{
            $response['status'] = false;
            $response['message'] = 'No any restaurant found';
        }

        $this->response($response);
    }

    public function shop_post(){
        $postFields['shop_id'] = $_POST['shop_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Restaurant not found';
            }else{

                $cuisine_data = array();
                $sql_select = array(
                                    "t2.cuisine_name"
                                );
                $this->db->select($sql_select);
                $this->db->where("t2.deleted_at", NULL);
                $this->db->where("t2.is_active", 1);
                $this->db->where("t1.shop_id", $_POST['shop_id']);
                $this->db->from('shop_cuisines t1');
                $this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $cuisine_data = $sql_query->result_array();                        
                }

                $item_data = array();
                $this->db->select('*');
                $this->db->where("deleted_at", NULL);
                $this->db->where("is_active", 1);
                $this->db->where("shop_id", $_POST['shop_id']);
                $this->db->from('item');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $item_data = $sql_query->result_array();                        
                }

                $shop_data = array(
                                'id' => $_POST['shop_id'],
                                'shop_name' => $shop['shop_name'],
                                'zip_code' => $shop['zip_code'],
                                'city' => $shop['city'],
                                'state' => $shop['state'],
                                'country' => $shop['country'],
                                'profile_picture' => $shop['profile_picture']
                                );

                $response['status'] = true;
                $response['shop'] = $shop_data;
                $response['cuisines'] = $cuisine_data;
                $response['products'] = $item_data;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function product_post(){
        $postFields['item_id'] = $_POST['item_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['item_id'],'is_active' => '1', 'deleted_at' => NULL);
            $item = (array)$this->db->get_where('item',$where)->row();
            if(empty($item)){
                $response['status'] = false;
                $response['message'] = 'Product not found';
            }else{

                $sql_select = array(
                                    "name",
                                    "price",
                                    "variant_group_id",
                                );
                $variant_group_id_array = array();
                $group = array();
                $this->db->select('variant_group_id');
                $this->db->group_by('variant_group_id'); 
                $this->db->where("item_id", $_POST['item_id']);
                $this->db->from('variant_items');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $variant_group_id_array = $sql_query->result_array();  

                    $sql_select = array(
                                    "t2.name as group_name",
                                    "t1.name",
                                    "t1.price",
                                    "t2.availability",
                                    "t2.selection"
                                );

                    foreach ($variant_group_id_array as $key => $value)
                    {
                        $this->db->select($sql_select);
                        $this->db->where("t2.deleted_at", NULL);
                        $this->db->where("t2.id", $value['variant_group_id']);
                        $this->db->where("t1.item_id", $_POST['item_id']);
                        $this->db->from('variant_items t1');
                        $this->db->join('variant_group t2', 't1.variant_group_id = t2.id', "left join");
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $variant_group = $sql_query->result_array();
                            $group[$key]['variant_name'] = $variant_group[$key]['group_name'];
                            $group[$key]['required'] = $variant_group[$key]['availability'];
                            $group[$key]['multiple_selection'] = $variant_group[$key]['selection'];
                            $group[$key]['variant_options'] = $variant_group;
                        }
                    }                    
                }

                $response['status'] = true;
                $response['item'] = $item;
                $response['variants'] = $group;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function fetch_data_post(){    
        $postFields['table_name'] = $_POST['table_name'];               
            
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            if($_POST['table_name'] == 'category'){

                $this->db->select('id,category_name');
                $this->db->where("status", 1);
                $this->db->where("deleted_at", NULL);
                $this->db->from('category');
                $sql_query = $this->db->get();

                if ($sql_query->num_rows() > 0){
                    $data = $sql_query->result_array();   
                    $response['status'] = true;         
                }else{
                    $data = array();
                    $response['status'] = false;
                }

                
            }else if($_POST['table_name'] == 'cuisine'){

                $this->db->select('id,cuisine_name');
                $this->db->where("is_active", 1);
                $this->db->where("deleted_at", NULL);
                $this->db->from('cuisine');
                $sql_query = $this->db->get();

                if ($sql_query->num_rows() > 0){
                    $data = $sql_query->result_array();   
                    $response['status'] = true;         
                }else{
                    $data = array();
                    $response['status'] = false;
                }

            }else{
                $data = array();
            }

            $response['data'] = $data;

        }
        else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function favorite_shop_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['shop_id'] = $_POST['shop_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $favorite_data = array(
                    'customer_id' => $_POST['customer_id'],
                    'shop_id' => $_POST['shop_id']
                );

                if($this->db->insert('favorite',$favorite_data)){
                    $response['status'] = true;
                    $response['message'] = 'Restaurant added as favorite.';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function create_email_template($template){
       $base_url = BASE_URL();
       $template = str_replace('##SITEURL##', $base_url, $template);
       $template = str_replace('##SITENAME##', $this->config->item('site_name'), $template);
       $template = str_replace('##SITEEMAIL##', $this->config->item('site_email'), $template);
       $template = str_replace('##COPYRIGHTS##', $this->config->item('copyrights'), $template);
       $template = str_replace('##EMAILTEMPLATELOGO##', $this->config->item('email_template_logo'), $template);
       return $template;
    }

    public function send_mail($to,$subject,$message){

    	$from = '"Click Lunch" <excellentwebworld@admin.com>';

    	$config['protocol'] = $this->config->item("protocol");
        $config['smtp_host'] = $this->config->item("smtp_host");
        $config['smtp_port'] = $this->config->item("smtp_port");
        $config['smtp_user'] = $this->config->item("smtp_user");
        $config['smtp_pass'] = $this->config->item("smtp_pass");
        $config['charset'] = $this->config->item("charset");
        $config['mailtype'] = $this->config->item("mailtype");
        $config['wordwrap'] = TRUE;

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject); 
        $this->email->message($message);
        if($this->email->send()){
        	return TRUE;
        }else{
        	return FALSE;
        }
        //echo $this->email->print_debugger();exit;
    }

    public function ValidatePostFields($postFields){
        $error = array();        
        foreach ($postFields as $field => $value){            
            if(!isset($field) || $value == '' || is_null($value)){                
                $error[]= ucfirst(str_replace('_', ' ',$field)) ." field is required";             
            }        
        }    
        return $error;   
    }
}