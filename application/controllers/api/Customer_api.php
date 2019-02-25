<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(1);

class Customer_api extends REST_Controller {
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');  
        $this->load->model("email_template_model");
        $this->load->model("promocode_model");
        $this->load->model("api/customer_api_model");
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

                $this->db->select('*');
                $this->db->where("customer_id",$customer->id);
                $this->db->where("deleted_at",NULL);
                $this->db->where("default_address",1);
                $this->db->from("delivery_address");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $default_delivery_address = (array)$sql_query->row();
                }else{
                    $default_delivery_address = array();
                }

                $response['status'] = true;
                $response['profile'] = $customer;
                $response['default_delivery_address'] = $default_delivery_address;

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

        if(empty($errorPost)){
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

                if(isset($lat) && $lat != "" && isset($long) && $long != ""){
                    $delivery_address_data['latitude'] = $lat;
                    $delivery_address_data['longitude'] = $long;

                    if($this->db->insert('delivery_address',$delivery_address_data)){
                        $response['status'] = true;
                        $response['message'] = 'Delivery address added successfully';
                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Server encountered an error.p lease try again';
                    }
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Sorry, We could not fetch location. Please enter correct address';
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
                        $payment_cards[$key]['expiry_date'] = decrypt($value['expiry_date']);
                        $payment_cards[$key]['cvv'] = decrypt($value['cvv']);
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
                $card_number = $_POST['card_number'];
                $card_number = str_replace(' ', '', $card_number);

                if(validate_card($_POST['card_number']) && is_numeric($card_number)){
                    $user_card_type = $this->config->item("card_type")[$_POST['card_type']];
                    $real_card_type = get_card_type($_POST['card_number']);
                    if($user_card_type == $real_card_type){

                        $payment_card_data = array(
                            'customer_id' => $_POST['customer_id'],
                            'card_holder_name' => $_POST['card_holder_name'],
                            'card_number' => encrypt($card_number),
                            'display_number' => 'XXXX XXXX XXXX '.substr($card_number, -4),
                            'expiry_date' => encrypt($_POST['expiry_date']),
                            'cvv' => encrypt($_POST['cvv']),
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

                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Invalid card number';
                    }
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Invalid card number';
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

                $card_number = $_POST['card_number'];
                $card_number = str_replace(' ', '', $card_number);

                if(validate_card($_POST['card_number']) && is_numeric($card_number)){
                    $user_card_type = $this->config->item("card_type")[$_POST['card_type']];
                    $real_card_type = get_card_type($_POST['card_number']);
                    if($user_card_type == $real_card_type){

                        $payment_card_data = array(
                            'card_holder_name' => $_POST['card_holder_name'],
                            'card_number' => encrypt($card_number),
                            'display_number' => 'XXXX XXXX XXXX '.substr($card_number, -4),
                            'expiry_date' => encrypt($_POST['expiry_date']),
                            'cvv' => encrypt($_POST['cvv']),
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

                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Invalid card number';
                    }
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Invalid card number';
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
                            "delivery_time",
                            "order_by_time",
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
                $shop_data[$key]['rating'] = '4.5';
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
                            //$shop_data[$key]['rating'] = '4.5';
                        }
                    }
                }
            }

            // Get banners
            $banner_data = array();
            $this->db->select('id,banner_picture,title,sub_title');
            $this->db->where("deleted_at", NULL);
            $this->db->where("status", 1);
            $this->db->from('banner');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $banner_data = $sql_query->result_array();
            }

            // get TAX
            $tax = '';
            $this->db->select('data');
            $this->db->where("name", 'tax');
            $this->db->from('setting');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $tax_data = $sql_query->row();
                $tax = $tax_data->data;
            }

            $response['status'] = true;
            $response['banner'] = $banner_data;
            $response['tax'] = $tax;
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

                $availibality = array();
                $this->db->select('from_time,to_time,full_day,is_closed');
                $this->db->where("shop_id",$_POST['shop_id']);
                $this->db->where("day",date('l'));
                $this->db->where("shop_id", $_POST['shop_id']);
                $this->db->from('shop_availibality');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $availibality = $sql_query->result_array();
                }

                $shop_data = array(
                                'id' => $_POST['shop_id'],
                                'shop_name' => $shop['shop_name'],
                                'zip_code' => $shop['zip_code'],
                                'city' => $shop['city'],
                                'state' => $shop['state'],
                                'country' => $shop['country'],
                                'delivery_time' => $shop['delivery_time'],
                                'order_by_time' => $shop['order_by_time'],
                                'delivery_charges' => $shop['charges_of_minimum_mile'],
                                'service_charge' => $shop['service_charge']
                                );

                $picture = array('profile_picture' => $shop['profile_picture']);
                $picture2 = array('profile_picture' => $shop['profile_picture']);
                $shop_pictures_data = array();
                array_push($shop_pictures_data, $picture);
                array_push($shop_pictures_data, $picture2);

                $response['status'] = true;
                $response['shop'] = $shop_data;
                $response['shop_pictures'] = $shop_pictures_data;
                $response['shop_hours'] = $availibality;
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
                                    "t2.id as group_id",
                                    "t2.name as group_name",
                                    "t1.id as variant_id",
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
                            $group[$key]['variant_group_id'] = $variant_group[$key]['group_id'];
                            $group[$key]['variant_group_name'] = $variant_group[$key]['group_name'];
                            $group[$key]['total_variant_options'] = $sql_query->num_rows();
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

    public function fetch_promocode_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['total_amount'] = $_POST['total_amount']; 
        $postFields['products'] = $_POST['products']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
                $shop = (array)$this->db->get_where('shop',$where)->row();
                if(empty($shop)){
                    $response['status'] = false;
                    $response['message'] = 'Restaurant not found';
                }else{
                    $today = date('Y-m-d');
                    $products_array = explode(',',$_POST['products']);
                    $valid_promocodes = array();

                    // Get All customer promocode - GROUP 4
                    $this->db->select('*'); 

                    $this->db->group_start();
                        $this->db->where('shop_id',$_POST['shop_id']);  
                        $this->db->where('group_type',4);  
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->where('shop_id','');  
                        $this->db->where('group_type',4);  
                    $this->db->group_end();

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $all_customer_promocode = $sql_query->result_array();
                        foreach ($all_customer_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($all_customer_promocode[$key]);
                            }else{
                                // if product based promocode added by shop
                                if(($value['shop_id'] != '') && ($value['promo_type'] == 1)){
                                    $this->db->select('product_id'); 
                                    $this->db->where('promocode_id',$value['id']);  
                                    $this->db->where_in('product_id',$products_array);  
                                    $this->db->from('promocode_valid_product'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() <= 0){
                                        unset($all_customer_promocode[$key]);
                                    }
                                }
                            }
                        }
                        foreach ($all_customer_promocode as $key => $value){
                            array_push($valid_promocodes, $all_customer_promocode[$key]);
                        }
                    }

                    // Get promocode ( added by admin for group of shops) GROUP 5
                    $this->db->select('t2.*'); 
                    $this->db->where('t1.shop_id',$_POST['shop_id']);  
                    $this->db->where('t2.group_type',5);  
                    $this->db->from('promocode_shops t1');
                    $this->db->join('promocode t2', 't1.promocode_id = t2.id', "right join");

                    $this->db->group_start();
                        $this->db->where('t2.from_date <=', $today);
                        $this->db->where('t2.to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('t2.status',1);  
                    $this->db->where('t2.shop_id','');  
                    $this->db->where('t2.deleted_at',NULL);  

                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $group_of_shops_promocode = $sql_query->result_array();
                        foreach ($group_of_shops_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($group_of_shops_promocode[$key]);
                            }
                        }
                        foreach ($group_of_shops_promocode as $key => $value){
                            array_push($valid_promocodes, $group_of_shops_promocode[$key]);
                        }
                    }

                    // Get customer total completed order
                    $where = array('customer_id' => $_POST['customer_id'], 'order_status' => 1);
                    $select = array('id');
                    $table = 'orders';
                    $customer_total_orders_array = get_data_by_filter($table,$select, $where);
                    $customer_total_orders = count($customer_total_orders_array);
                    $X_ordered_promocode = array();

                    // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (Admin)
                    $this->db->select('*'); 
                    $this->db->where('shop_id','');  
                    $this->db->where('group_type',6);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('min_no_of_orders <=', $customer_total_orders);  
                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $X_ordered_promocode = $sql_query->result_array();
                        foreach ($X_ordered_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($X_ordered_promocode[$key]);
                            }
                        }
                        foreach ($X_ordered_promocode as $key => $value){
                            array_push($valid_promocodes, $X_ordered_promocode[$key]);
                        }
                    }

                    // If no any ordered from any shop - promocode by admin - GROUP 1
                    $new_customer_for_admin_promocode = array();
                    if($customer_total_orders <= 0){
                        $this->db->select('*'); 
                        $this->db->where('shop_id','');  
                        $this->db->where('group_type',1);  

                        $this->db->group_start();
                            $this->db->where('from_date <=', $today);
                            $this->db->where('to_date >=', $today);
                        $this->db->group_end();

                        $this->db->where('status',1);  
                        $this->db->where('deleted_at',NULL);  
                        $this->db->from('promocode'); 
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $new_customer_for_admin_promocode = $sql_query->result_array();
                            foreach ($new_customer_for_admin_promocode as $key => $value) {
                                if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                    unset($new_customer_for_admin_promocode[$key]);
                                }
                            }
                            foreach ($new_customer_for_admin_promocode as $key => $value){
                                array_push($valid_promocodes, $new_customer_for_admin_promocode[$key]);
                            }
                        }
                    }

                    // Get customer total completed order for this shop
                    $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $_POST['shop_id'], 'order_status' => 1);
                    $select = array('id');
                    $table = 'orders';
                    $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
                    $customer_total_shop_orders = count($customer_total_shop_orders_array);
                    $X_shop_ordered_promocode = array();

                    // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (shop)
                    $this->db->select('*'); 
                    $this->db->where('shop_id',$_POST['shop_id']);  
                    $this->db->where('group_type',6);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('min_no_of_orders <=', $customer_total_shop_orders);  
                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $X_shop_ordered_promocode = $sql_query->result_array();

                        foreach ($X_shop_ordered_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($X_shop_ordered_promocode[$key]);
                            }else{

                                // if product based promocode
                                if($value['promo_type'] == 1){
                                    $this->db->select('product_id'); 
                                    $this->db->where('promocode_id',$value['id']);  
                                    $this->db->where_in('product_id',$products_array);  
                                    $this->db->from('promocode_valid_product'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() <= 0){
                                        unset($X_shop_ordered_promocode[$key]);
                                    }
                                }
                            }
                        }
                        foreach ($X_shop_ordered_promocode as $key => $value){
                            array_push($valid_promocodes, $X_shop_ordered_promocode[$key]);
                        }
                    }

                    // If no any ordered from this shop - promocode by shop - GROUP 1
                    $new_customer_for_shop_promocode = array();
                    if($customer_total_shop_orders <= 0){
                        $this->db->select('*'); 
                        $this->db->where('shop_id',$_POST['shop_id']);  
                        $this->db->where('group_type',1);  

                        $this->db->group_start();
                            $this->db->where('from_date <=', $today);
                            $this->db->where('to_date >=', $today);
                        $this->db->group_end();

                        $this->db->where('status',1);  
                        $this->db->where('deleted_at',NULL);  
                        $this->db->from('promocode'); 
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $new_customer_for_shop_promocode = $sql_query->result_array();
                            foreach ($new_customer_for_shop_promocode as $key => $value) {
                                if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                    unset($new_customer_for_shop_promocode[$key]);
                                }else{

                                    // if product based promocode
                                    if($value['promo_type'] == 1){
                                        $this->db->select('product_id'); 
                                        $this->db->where('promocode_id',$value['id']);  
                                        $this->db->where_in('product_id',$products_array);  
                                        $this->db->from('promocode_valid_product'); 
                                        $sql_query = $this->db->get();
                                        if ($sql_query->num_rows() <= 0){
                                            unset($new_customer_for_shop_promocode[$key]);
                                        }
                                    }

                                }
                            }
                            foreach ($new_customer_for_shop_promocode as $key => $value){
                                array_push($valid_promocodes, $new_customer_for_shop_promocode[$key]);
                            }
                        }
                    }

                    // GROUP 7 PROMOCODES ARE PENDING - waiting for order

                    //$response['promocode_all_customer'] = $all_customer_promocode;
                    //$response['group_of_shops_promocode'] = $group_of_shops_promocode;
                    $response['valid_promocodes'] = $valid_promocodes;
                    $response['status'] = true;
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function validate_promocode_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['total_amount'] = $_POST['total_amount']; 
        $postFields['products'] = $_POST['products']; 
        $postFields['promocode'] = $_POST['promocode']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
                $shop = (array)$this->db->get_where('shop',$where)->row();
                if(empty($shop)){
                    $response['status'] = false;
                    $response['message'] = 'Restaurant not found';
                }else{
                    $today = date('Y-m-d');
                    $products_array = explode(',',$_POST['products']);
                    $valid_promocodes = array();

                    // Get All customer promocode - GROUP 4
                    $this->db->select('*'); 

                    $this->db->group_start();
                        $this->db->where('shop_id',$_POST['shop_id']);  
                        $this->db->where('group_type',4);  
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->where('shop_id','');  
                        $this->db->where('group_type',4);  
                    $this->db->group_end();

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $all_customer_promocode = $sql_query->result_array();
                        foreach ($all_customer_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($all_customer_promocode[$key]);
                            }else{
                                // if product based promocode added by shop
                                if(($value['shop_id'] != '') && ($value['promo_type'] == 1)){
                                    $this->db->select('product_id'); 
                                    $this->db->where('promocode_id',$value['id']);  
                                    $this->db->where_in('product_id',$products_array);  
                                    $this->db->from('promocode_valid_product'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() <= 0){
                                        unset($all_customer_promocode[$key]);
                                    }
                                }
                            }
                        }
                        foreach ($all_customer_promocode as $key => $value){
                            array_push($valid_promocodes, $all_customer_promocode[$key]);
                        }
                    }

                    // Get promocode ( added by admin for group of shops) GROUP 5
                    $this->db->select('t2.*'); 
                    $this->db->where('t1.shop_id',$_POST['shop_id']);  
                    $this->db->where('t2.group_type',5);  
                    $this->db->from('promocode_shops t1');
                    $this->db->join('promocode t2', 't1.promocode_id = t2.id', "right join");

                    $this->db->group_start();
                        $this->db->where('t2.from_date <=', $today);
                        $this->db->where('t2.to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('t2.status',1);  
                    $this->db->where('t2.shop_id','');  
                    $this->db->where('t2.deleted_at',NULL);  

                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $group_of_shops_promocode = $sql_query->result_array();
                        foreach ($group_of_shops_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($group_of_shops_promocode[$key]);
                            }
                        }
                        foreach ($group_of_shops_promocode as $key => $value){
                            array_push($valid_promocodes, $group_of_shops_promocode[$key]);
                        }
                    }

                    // Get customer total completed order
                    $where = array('customer_id' => $_POST['customer_id'], 'order_status' => 1);
                    $select = array('id');
                    $table = 'orders';
                    $customer_total_orders_array = get_data_by_filter($table,$select, $where);
                    $customer_total_orders = count($customer_total_orders_array);
                    $X_ordered_promocode = array();

                    // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (Admin)
                    $this->db->select('*'); 
                    $this->db->where('shop_id','');  
                    $this->db->where('group_type',6);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('min_no_of_orders <=', $customer_total_orders);  
                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $X_ordered_promocode = $sql_query->result_array();
                        foreach ($X_ordered_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($X_ordered_promocode[$key]);
                            }
                        }
                        foreach ($X_ordered_promocode as $key => $value){
                            array_push($valid_promocodes, $X_ordered_promocode[$key]);
                        }
                    }

                    // If no any ordered from any shop - promocode by admin - GROUP 1
                    $new_customer_for_admin_promocode = array();
                    if($customer_total_orders <= 0){
                        $this->db->select('*'); 
                        $this->db->where('shop_id','');  
                        $this->db->where('group_type',1);  

                        $this->db->group_start();
                            $this->db->where('from_date <=', $today);
                            $this->db->where('to_date >=', $today);
                        $this->db->group_end();

                        $this->db->where('status',1);  
                        $this->db->where('deleted_at',NULL);  
                        $this->db->from('promocode'); 
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $new_customer_for_admin_promocode = $sql_query->result_array();
                            foreach ($new_customer_for_admin_promocode as $key => $value) {
                                if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                    unset($new_customer_for_admin_promocode[$key]);
                                }
                            }
                            foreach ($new_customer_for_admin_promocode as $key => $value){
                                array_push($valid_promocodes, $new_customer_for_admin_promocode[$key]);
                            }
                        }
                    }

                    // Get customer total completed order for this shop
                    $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $_POST['shop_id'], 'order_status' => 1);
                    $select = array('id');
                    $table = 'orders';
                    $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
                    $customer_total_shop_orders = count($customer_total_shop_orders_array);
                    $X_shop_ordered_promocode = array();

                    // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (shop)
                    $this->db->select('*'); 
                    $this->db->where('shop_id',$_POST['shop_id']);  
                    $this->db->where('group_type',6);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('min_no_of_orders <=', $customer_total_shop_orders);  
                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  
                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $X_shop_ordered_promocode = $sql_query->result_array();

                        foreach ($X_shop_ordered_promocode as $key => $value) {
                            if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                unset($X_shop_ordered_promocode[$key]);
                            }else{

                                // if product based promocode
                                if($value['promo_type'] == 1){
                                    $this->db->select('product_id'); 
                                    $this->db->where('promocode_id',$value['id']);  
                                    $this->db->where_in('product_id',$products_array);  
                                    $this->db->from('promocode_valid_product'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() <= 0){
                                        unset($X_shop_ordered_promocode[$key]);
                                    }
                                }
                            }
                        }
                        foreach ($X_shop_ordered_promocode as $key => $value){
                            array_push($valid_promocodes, $X_shop_ordered_promocode[$key]);
                        }
                    }

                    // If no any ordered from this shop - promocode by shop - GROUP 1
                    $new_customer_for_shop_promocode = array();
                    if($customer_total_shop_orders <= 0){
                        $this->db->select('*'); 
                        $this->db->where('shop_id',$_POST['shop_id']);  
                        $this->db->where('group_type',1);  

                        $this->db->group_start();
                            $this->db->where('from_date <=', $today);
                            $this->db->where('to_date >=', $today);
                        $this->db->group_end();

                        $this->db->where('status',1);  
                        $this->db->where('deleted_at',NULL);  
                        $this->db->from('promocode'); 
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $new_customer_for_shop_promocode = $sql_query->result_array();
                            foreach ($new_customer_for_shop_promocode as $key => $value) {
                                if(($value['promo_min_order_amount'] != '') && ($value['promo_min_order_amount'] > $_POST['total_amount'])){
                                    unset($new_customer_for_shop_promocode[$key]);
                                }else{

                                    // if product based promocode
                                    if($value['promo_type'] == 1){
                                        $this->db->select('product_id'); 
                                        $this->db->where('promocode_id',$value['id']);  
                                        $this->db->where_in('product_id',$products_array);  
                                        $this->db->from('promocode_valid_product'); 
                                        $sql_query = $this->db->get();
                                        if ($sql_query->num_rows() <= 0){
                                            unset($new_customer_for_shop_promocode[$key]);
                                        }
                                    }

                                }
                            }
                            foreach ($new_customer_for_shop_promocode as $key => $value){
                                array_push($valid_promocodes, $new_customer_for_shop_promocode[$key]);
                            }
                        }
                    }

                    // GROUP 7 PROMOCODES ARE PENDING - waiting for order

                    $valid = FALSE;
                    $discount_type = '';
                    $discount_amount = '';
                    $promo_type = '';
                    $valid_product = array();
                    $vali_promocode = strtoupper($_POST['promocode']);
                    foreach ($valid_promocodes as $key => $value) {
                        if($vali_promocode == $value['promocode']){
                            $valid = TRUE;
                            $discount_type = $value['discount_type'];
                            $discount_amount = $value['amount'];
                            $promo_type = $value['promo_type'];
                            $promo_id = $value['id'];
                            if($value['promo_type'] == 1){
                                $this->db->select('product_id');
                                $this->db->where("shop_id",$value['shop_id']);
                                $this->db->from("promocode_valid_product");
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() > 0){
                                    $valid_products = $sql_query->result_array();
                                    foreach ($products_array as $key => $value) {
                                        $valid_product[] = $value;
                                    }
                                }
                            }
                            break;
                        }
                    }
                    $response['promocode_id'] = $promo_id;
                    $response['promocode'] = $_POST['promocode'];
                    $response['valid_promocode'] = $valid;
                    $response['discount_type'] = $discount_type;
                    $response['discount_amount'] = $discount_amount;
                    $response['promo_type'] = $promo_type;
                    $response['valid_products'] = $valid_product;
                    //$response['valid_promocodes'] = $valid_promocodes;
                    $response['status'] = true;
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function validate_prices_post(){
        $postFields['prices'] =  $_POST['prices'];
        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $prices =  json_decode($_POST['prices'],true);
            $product_array = array_column($prices['products'], 'id');

            $item_data_array = array();
            $this->db->select('id,IF(offer_price = "", price, offer_price) as price'); 
            $this->db->where_in('id',$product_array); 
            $this->db->where('deleted_at',NULL); 
            $this->db->where('is_active',1); 
            $this->db->from('item'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $item_data_array = $sql_query->result_array();
                $product_data = array();
                foreach ($prices['products'] as $key => $value) {
                    $product_data[$value['id']] = $value['price'];
                }
                $original_data = array();
                foreach ($item_data_array as $key => $value) {
                    $original_data[$value['id']] = $value['price'];
                }
                $product_diff_data = array_diff($original_data,$product_data);
            }

            $varients_array = array_column($prices['varients'], 'id');

            $varients_data_array = array();
            $this->db->select('id,price'); 
            $this->db->where_in('id',$varients_array); 
            $this->db->from('variant_items'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $varients_data_array = $sql_query->result_array();

                $varient_data = array();
                foreach ($prices['varients'] as $key => $value) {
                    $varient_data[$value['id']] = number_format((float)$value['price'], 2, '.', ''); 
                }
                $varient_original_data = array();
                foreach ($varients_data_array as $key => $value) {
                    $varient_original_data[$value['id']] = number_format((float)$value['price'], 2, '.', ''); 
                }
                $varients_diff_data = array_diff($varient_original_data,$varient_data);
            }

            if(empty($product_diff_data) && empty($varients_diff_data)){
                $response['status'] = true;
            }else{
                $response['status'] = false;
            }

            $response['product_original_data'] = $product_diff_data;
            $response['varients_original_data'] = $varients_diff_data;
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function place_order_post(){
       
        $postFields['order_data'] = $_POST['order_data']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $order_data =  json_decode($_POST['order_data'],true);

            $postFields['customer_id'] = $order_data['customer_id']; 
            $postFields['shop_id'] = $order_data['shop_id']; 
            $postFields['order_type'] = $order_data['order_type']; 
            $postFields['payment_mode'] = $order_data['payment_mode']; 
            $postFields['payment_card_id'] = $order_data['payment_card_id']; 
            $postFields['delivery_address_id'] = $order_data['delivery_address_id']; 
            $postFields['products'] = $order_data['products']; 

            $errorPost = $this->ValidatePostFields($postFields);
            if(empty($errorPost)){
                $where = array('id' => $order_data['customer_id'],'status' => '1', 'deleted_at' => NULL);
                $user = (array)$this->db->get_where('customer',$where)->row();
                if(empty($user)){
                    $response['status'] = false;
                    $response['message'] = 'User not found';
                }else{
                    $where = array('id' => $order_data['shop_id'],'status' => '1', 'deleted_at' => NULL);
                    $shop = (array)$this->db->get_where('shop',$where)->row();
                    if(empty($shop)){
                        $response['status'] = false;
                        $response['message'] = 'Restaurant not found';
                    }else{
                        $where = array('id' => $order_data['payment_card_id'],'deleted_at' => NULL);
                        $customer_payment_card = (array)$this->db->get_where('customer_payment_card',$where)->row();
                        if(empty($customer_payment_card)){
                            $response['status'] = false;
                            $response['message'] = 'Payment card does not exists';
                        }else{
                            $where = array('id' => $order_data['delivery_address_id'],'deleted_at' => NULL);
                            $delivery_address = (array)$this->db->get_where('delivery_address',$where)->row();
                            if(empty($delivery_address)){
                                $response['status'] = false;
                                $response['message'] = 'Delivery address does not exists';
                            }else{
                                $product_array = array_column($order_data['products'], 'product_id');
                                $this->db->select('id,IF(offer_price = "", price, offer_price) as price'); 
                                $this->db->where_in('id',$product_array); 
                                $this->db->where('shop_id',$order_data['shop_id']); 
                                $this->db->from('item'); 
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() == count($product_array)){

                                    $product_data_array = $sql_query->result_array();

                                    // check group exists
                                    $groups = array();
                                    $group_variants_array = array();
                                    foreach ($order_data['products'] as $product_key => $product_value) {
                                        foreach ($product_value['variant_group'] as $group_key => $group_value) {
                                            array_push($groups, $group_value['group_id']);
                                            foreach ($group_value['variants'] as $variant_key => $variant_value) {
                                                array_push($group_variants_array, $variant_value['variant_id']);
                                            }
                                        }
                                    }
                                    $groups = array_unique($groups);
                                    $group_variants_array = array_unique($group_variants_array);

                                    $this->db->select('id'); 
                                    $this->db->where_in('id',$groups); 
                                    $this->db->where('shop_id',$order_data['shop_id']); 
                                    $this->db->where('deleted_at',NULL); 
                                    $this->db->from('variant_group'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() == count($groups)){

                                        // check varient exists
                                        $this->db->select('id,price'); 
                                        $this->db->where_in('id',$group_variants_array); 
                                        $this->db->from('variant_items'); 
                                        $sql_query = $this->db->get();
                                        if ($sql_query->num_rows() == count($group_variants_array)){

                                            $variants_array = $sql_query->result_array();

                                            // if varient exists
                                            if(($order_data['order_type'] == 2) || ($order_data['order_type'] == 4)){
                                                $later_time = $order_data['later_time'];
                                            }else{
                                                $later_time = "";
                                            }

                                            $promocode_id = '';
                                            if(isset($order_data['promocode_id']) && $order_data['promocode_id'] != "" && $order_data['promocode_id'] != "0" && !is_null($order_data['promocode_id'])){

                                                $promocode_id = $order_data['promocode_id'];
                                                $promocode_basic_data = $this->promocode_model->get_promocode($promocode_id);
                                                $discounted_products = array();

                                               
                                                if($promocode_basic_data->promo_type == 1){
                                                    $promocode_valid_products = $this->customer_api_model->get_promocode_valid_products($promocode_id);

                                                    if(isset($promocode_valid_products) && !empty($promocode_valid_products)){
                                                        foreach ($promocode_valid_products as $key => $value) {
                                                            if (in_array($value['product_id'], $product_array)){
                                                                array_push($discounted_products, $value['product_id']);
                                                            }
                                                        }
                                                    }
                                                }

                                                if(isset($discounted_products) && !empty($discounted_products)){
                                                    foreach ($discounted_products as $key => $value) {
                                                        foreach ($product_data_array as $product_key => $product_value) {
                                                            if($product_value['id'] == $value){
                                                                if($promocode_basic_data->discount_type == 0){
                                                                    $disc_amount = floatval($product_value['price']) - floatval($promocode_basic_data->amount);
                                                                    $discounted_price = floatval($product_value['price']) - $disc_amount;
                                                                    $product_data_array[$product_key]['price'] = number_format((float)$discounted_price, 2, '.', '');
                                                                }else{
                                                                    $disc_amount = (floatval($product_value['price']) / 100) * floatval($promocode_basic_data->amount);
                                                                    $discounted_price = floatval($product_value['price']) - floatval($disc_amount);
                                                                    $product_data_array[$product_key]['price'] = number_format((float)$discounted_price, 2, '.', '');
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                            }

                                            $subtotal_amount = 0;
                                            foreach ($product_data_array as $key => $value) {
                                                $subtotal_amount += $value['price'];
                                            }
                                            foreach ($variants_array as $key => $value) {
                                                $subtotal_amount += $value['price'];
                                            }

                                            $tax_amount = ($order_data['tax'] > 0)?(floatval($subtotal_amount) / 100) * floatval($order_data['tax']):0;
                                            $service_charge_amount = ($order_data['service_charge'] > 0)?(floatval($subtotal_amount) / 100) * floatval($order_data['service_charge']):0;
                                            $delivery_charges_amount = ($order_data['delivery_charges'] > 0)?(floatval($subtotal_amount) / 100) * floatval($order_data['delivery_charges']):0;
                                            $total_amount += $subtotal_amount + $tax_amount + $service_charge_amount + $delivery_charges_amount;

                                            $order = array( 
                                                'customer_id' => $order_data['customer_id'], 
                                                'shop_id'=> $order_data['shop_id'], 
                                                'order_type'=> $order_data['order_type'], 
                                                'later_time'=> $later_time,
                                                'tax' => $order_data['tax'],
                                                'service_charge' => $order_data['service_charge'],
                                                'subtotal' => number_format((float)$subtotal_amount, 2, '.', ''),
                                                'total' => number_format((float)$total_amount, 2, '.', ''),
                                                'delivery_charges' => number_format((float)$order_data['delivery_charges'], 2, '.', ''),
                                                'promocode_id'=> $promocode_id,
                                                'order_status'=> 1,
                                                'payment_status'=> 1,
                                                'payment_mode'=> $order_data['payment_mode'],
                                                'transaction_id'=> '',
                                                'delivery_address_id'=> $order_data['delivery_address_id']
                                            );

                                            if($this->db->insert('orders', $order)){
                                                $order_id = $this->db->insert_id();
                                                $order['id'] = $order_id;

                                                $products_price_array = $this->customer_api_model->get_products_price($product_array);

                                                foreach ($order_data['products'] as $products_key => $products_value) {

                                                    $data = array(
                                                        'order_id' => $order_id,
                                                        'item_id' => $products_value['product_id'],
                                                        'quantity' => $products_value['qty'],
                                                        'price' => $products_price_array[$products_value['product_id']]
                                                    );

                                                    $this->db->insert('order_items', $data);
                                                    $insert_id = $this->db->insert_id();

                                                    $variant_data = array();
                                                    foreach ($variants_array as $key => $value) {
                                                        $variant_data[$value['id']] = $value['price'];
                                                    }
                                                    foreach ($products_value['variant_group'] as $group_key => $group_value) {
                                                        $group_id = $group_value['group_id'];
                                                        foreach ($group_value['variants'] as $variants_key => $variants_value) {

                                                            $variants_data = array(
                                                                'order_item_id' => $insert_id,
                                                                'variant_group_id' => $group_id,
                                                                'variant_id' => $variants_value['variant_id'],
                                                                'price' => $variant_data[$variants_value['variant_id']]
                                                            );

                                                            $this->db->insert('order_item_variant', $variants_data);
                                                        }
                                                    }
                                                }
                                                $response['status'] = true;
                                                $response['order'] = $order;
                                                //$response['discounted_products'] = $discounted_products;
                                                // $response['product_data_array'] = $product_data_array;
                                                // $response['variants_array'] = $variants_array;

                                            }else{
                                                $response['status'] = false;
                                                $response['message'] = 'Server encountered an error. please try again';
                                            }


                                        }else{
                                            $response['status'] = false;
                                            $response['message'] = 'Varient of group not found. Please refresh the cart.'; 
                                        }  
                                    }else{
                                        $response['status'] = false;
                                        $response['message'] = 'Product group not found. Please refresh the cart.'; 
                                    }

                                }else{
                                    $response['status'] = false;
                                    $response['message'] = 'Product not found. Please refresh the cart.'; 
                                }
                            }
                        }
                    }
                }
            }else{
                $response['status'] = false;
                $response['message'] = $errorPost;
            }

            

            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function place_order_post2(){
       
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['order_type'] = $_POST['order_type']; 
        $postFields['payment_mode'] = $_POST['payment_mode']; 
        $postFields['payment_card_id'] = $_POST['payment_card_id']; 
        $postFields['delivery_address_id'] = $_POST['delivery_address_id']; 
        $postFields['products'] = $_POST['products']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{

                $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
                $shop = (array)$this->db->get_where('shop',$where)->row();
                if(empty($shop)){
                    $response['status'] = false;
                    $response['message'] = 'Restaurant not found';
                }else{

                    $where = array('id' => $_POST['payment_card_id'],'deleted_at' => NULL);
                    $customer_payment_card = (array)$this->db->get_where('customer_payment_card',$where)->row();
                    if(empty($customer_payment_card)){
                        $response['status'] = false;
                        $response['message'] = 'Payment card does not exists';
                    }else{

                        $where = array('id' => $_POST['delivery_address_id'],'customer_id' => $_POST['customer_id'],'deleted_at' => NULL);
                        $delivery_address = (array)$this->db->get_where('delivery_address',$where)->row();
                        if(empty($delivery_address)){
                            $response['status'] = false;
                            $response['message'] = 'Delivery address does not exists';
                        }else{

                            //$products = explode(',',$_POST['products']);
                            $product_array = array_column($_POST['products'], 'product_id');
                            $this->db->select('*'); 
                            $this->db->where_in('id',$product_array); 
                            $this->db->where('shop_id',$_POST['shop_id']); 
                            $this->db->from('item'); 
                            $sql_query = $this->db->get();
                            if ($sql_query->num_rows() > 0){

                                // add order

                                if($_POST['order_type'] == 2 || 4){
                                    $later_time = $_POST['later_time'];
                                }else{
                                    $later_time = '';
                                }

                                $promocode_id = '';
                                if(isset($_POST['promocode_id']) && $_POST['promocode_id'] != "" && $_POST['promocode_id'] != "0" && !is_null($_POST['promocode_id'])){
                                    $promocode_id = $_POST['promocode_id'];
                                }

                                 $order = array( 
                                        'customer_id' => $_POST['customer_id'], 
                                        'shop_id'=> $_POST['shop_id'], 
                                        'order_type'=> $_POST['order_type'], 
                                        'later_time'=> $later_time,
                                        'promocode_id'=> $promocode_id,
                                        'order_status'=> 1,
                                        'payment_status'=> 1,
                                        'payment_mode'=> $_POST['payment_mode'],
                                        'transaction_id'=> '123333',
                                        'delivery_address_id'=> $_POST['delivery_address_id']
                                    );

                                if($this->db->insert('orders', $order)){
                                    $order['id'] = $this->db->insert_id();
                                    $response['order'] = $order;
                                    $response['status'] = true;
                                }else{
                                    $response['status'] = false;
                                    $response['message'] = 'Server encountered an error. please try again';
                                }

                            }else{
                                $response['status'] = false;
                                $response['message'] = 'Selected product does not exists';
                            }

                        }

                    }
                    
                }
            }
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function fetch_delivery_charge_post(){
        $postFields['delivery_address_id'] = $_POST['delivery_address_id']; 
        $postFields['shop_id'] = $_POST['shop_id']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Restaurant not found';
            }else{
                $where = array('id' => $_POST['delivery_address_id'],'deleted_at' => NULL);
                $address = (array)$this->db->get_where('delivery_address',$where)->row();
                if(empty($address)){
                    $response['status'] = false;
                    $response['message'] = 'Delivery address does not exists';
                }else{
                    $google_key = $this->config->item("google_key");
                    $distance_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$shop['latitude'].",".$shop['longitude']."&destinations=".$address['latitude'].",".$address['longitude']."&key=".$google_key;        
                    $distance = (array)json_decode(file_get_contents($distance_url));
                    $km = $distance['rows'][0]->elements[0]->distance->value;

                    if($km != '0'){
                        $mile = $km / 1609.34;
                    }else{
                        $mile = 0;
                    }
                    $mile =  number_format((float)$mile, 2, '.', '');

                    $delivery_avalilable_mile = $this->config->item("delivery_avalilable_mile");
                    if($mile <= $delivery_avalilable_mile){
                        if($mile > $shop['minimum_mile']){
                            $charges = $mile * $shop['delivery_charges_per_mile'];
                            $charges = number_format((float)$charges, 2, '.', '');
                        }else{
                            $charges = $shop['charges_of_minimum_mile'];
                        }
                        $response['charges'] = $charges;
                        $response['mile'] = $mile . ' mile far this restaurant';
                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Delivery is not available on this location';
                        $response['mile'] = $mile . ' mile far this restaurant';
                    }

                    
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