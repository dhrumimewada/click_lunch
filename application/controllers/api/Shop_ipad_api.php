<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(1);

class Shop_ipad_api extends REST_Controller {
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


    public function login_post(){
              
        $postFields['email'] = $_POST['email'];        
        $postFields['password'] = $_POST['password']; 
        $postFields['device_token'] = $_POST['device_token']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            $this->db->select('*');
            $this->db->where("email",$_POST['email']);
            $this->db->where("password !=",'');
            $this->db->where("admin_verified",1);
            $this->db->where("deleted_at",NULL);
            $this->db->where("status",1);
            $this->db->from("shop");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $shop_details = $sql_query->row();
                if (password_verify($_POST['password'],$shop_details->password)){

                    $data = array('device_token' => $_POST['device_token']);

                    if(isset($_POST['latitude']) && $_POST['latitude'] != "" && !is_null($_POST['latitude']) && isset($_POST['longitude']) && $_POST['longitude'] != "" && !is_null($_POST['longitude'])){
                        $data['latitude'] = $_POST['latitude'];
                        $data['longitude'] = $_POST['longitude'];
                    }

                $this->db->where('id',$shop_details->id);
                $this->db->update('shop',$data);

                $response['status'] = true;
                $response['message'] = 'Login successfully.';
                $response['profile'] = (array)$shop_details;               
                $response['apple_pay_api'] = (array)$this->db->get_where('payment_settings',array('shop_id'=>$shop_details->id,'payment_type'=>1))->row();
                $timing = $this->db->get_where('shop_availibality',array('shop_id'=>$shop_details->id))->result_array();
                $timing_list = array();               
                foreach ($timing as $key => $time) 
                {
                    $timing_list[$time['day']] = $time;
                   
                }
                $response['store_timing'] = $timing_list;
               


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
        
        $postFields['shop_id'] = $_POST['shop_id'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $where = array('id' => intval($_POST['shop_id']), 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'User not found';   
            }else{
                $data = array('device_token' => '', 'latitude' => '','longitude' => '' );
                $this->db->where('id',$_POST['shop_id']);
                if($this->db->update('shop',$data)){
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
        $postFields['shop_id'] = $_POST['shop_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $this->db->select('password');
            $this->db->where("deleted_at",NULL);
            $this->db->where("status",1);
            $this->db->where("id",$_POST['shop_id']);
            $this->db->from("shop");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $data = $sql_query->row();
                if (!password_verify($_POST['current_password'], $data->password)){
                    $response['status'] = false;
                    $response['message'] = 'Your current password is incorrect';
                    $response['password'] = $data->password;
                }else{
                    $user_data = array('password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT) );
                    $this->db->where('id',$_POST['shop_id']);
                    if($this->db->update('shop',$user_data)){
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

    public function forgot_password2_post(){
        $postFields['email'] = $_POST['email']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('email' => $_POST['email'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Shop not found';
            }else{
                $to =  array($_POST['email']);
                $subject = $this->config->item('site_name').' - Reset Password';
                $path = BASE_URL().'email_template/reset_password.html';
                $template = file_get_contents($path);

                $remember_token = bin2hex(random_bytes(20));
                $reset_url = base_url() . 'vender-reset-password/'. $remember_token;

                $template = str_replace('##RESETPWURL##', $reset_url, $template);
                $template = str_replace('##USERNAME##', $shop['shop_name'], $template);

                $template = $this->create_email_template($template);

                $mail = $this->send_mail($to,$subject,$template);

                if($mail){

                    $update_data = array('remember_token' => $remember_token);
                    $this->db->where('id', $shop['id']);
                    $this->db->update('shop', $update_data);

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

    public function forgot_password_post(){
        $postFields['email'] = $_POST['email']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('email' => $_POST['email'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('delivery_boy',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $to =  array($_POST['email']);
                $subject = 'Request to reset your password';
                $path = BASE_URL().'email_template/reset_password.php';
                $template = file_get_contents($path);

                $remember_token = bin2hex(random_bytes(20));
                $reset_url = base_url() . 'delivery-boy-reset-password/'. $remember_token;

                $template = str_replace('##RESETPWURL##', $reset_url, $template);

                $template = $this->create_email_template($template);

                $mail = $this->send_mail2($to,$subject,$template);

                if($mail){

                    $update_data = array('remember_token' => $remember_token);
                    $this->db->where('id', $user['id']);
                    $this->db->update('delivery_boy', $update_data);

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
        $postFields['shop_id'] = $_POST['shop_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Shop not found';
            }else{
                $response['status'] = true;
                $response['profile'] = $shop;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function update_profile_post(){
        $postFields['shop_id'] = $_POST['shop_id'];
        $postFields['shop_name'] = $_POST['shop_name'];
        $postFields['address'] = $_POST['address'];
        $postFields['mobile_number'] = $_POST['mobile_number'];
        $postFields['email'] = $_POST['email'];

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();           
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                if($shop['email'] == $_POST['email'])
                {
                    $user_data['email'] = trim($_POST['email']);    
                }
                else
                {
                    $check_mail = $this->db->get_where('shop',array('email'=>$_POST['email']))->num_rows();   
                    if($check_mail > 0)
                    {
                        $response['status'] = false;
                        $response['message'] = 'Email is already exist.';
                        $this->response($response);
                        exit;
                    }
                    else
                    {
                        $user_data['email'] = trim($_POST['email']);           
                    }
                }
                
                $user_data['shop_name'] = ucwords(addslashes($_POST['shop_name']));
                $user_data['address'] = trim($_POST['address']);                
                $user_data['contact_no1'] = str_replace("+1 ", "",  $_POST['mobile_number']);

                $shop_name = preg_replace("/[^a-zA-Z ]/", "", strtolower($_POST["shop_name"]));
                $name_array =  explode(" ",$shop_name);
                $short_name_array = array();

                foreach($name_array as $key => $value){
                    $value1 = trim($value);
                    if($value1 != ''){
                        $short_name_array[$key] = $value1;
                    }
                }
                $short_name = implode("-",$short_name_array);
               
                $this->db->select('short_name');
                $this->db->from('shop');
                $this->db->where("short_name LIKE '$short_name%'");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $exists_data = $sql_query->num_rows();
                    $short_name = $short_name."-".$exists_data;
                }

                $user_data['short_name'] = $short_name;

                $address = urlencode($_POST['address']);

                $google_key = $this->config->item('google_key');

                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.$google_key;              
                $address_json = file_get_contents($url);            
                $json = (array)json_decode($address_json);                
                $city = "";
                $state = "";
                $country = "";
                $zip_code = "";
                foreach ($json['results'][0]->address_components as $key) 
                {
                    if($key->types[0] == 'administrative_area_level_2')
                    {
                        $city = $key->long_name;
                    }
                    if($key->types[0] == 'administrative_area_level_1')
                    {
                        $state = $key->long_name;
                    }
                    if($key->types[0] == 'country')
                    {
                        $country = $key->long_name;
                    }
                    if($key->types[0] == 'postal_code')
                    {
                        $zip_code = $key->long_name;
                    }
                }

                $user_data['latitude'] = $json['results'][0]->geometry->location->lat;
                $user_data['longitude'] = $json['results'][0]->geometry->location->lng;
                $user_data['city'] = $city;
                $user_data['state'] = $state;
                $user_data['country'] = $country;
                $user_data['zip_code'] = $zip_code; 
                $user_data['updated_at'] = date('Y-m-d H:i:s');

                if (isset($_FILES['image']) && !empty($_FILES['image']) && strlen($_FILES['image']['name']) > 0) 
                {                    //save new image in folder
                    $config['upload_path'] = FCPATH . $this->config->item("profile_path");
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['encrypt_name'] = false;
                    $config['file_name'] = 'vender' . '_' . time();
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
                        $this->db->where('id', intval($_POST['shop_id']));
                        $this->db->from('shop');
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0) {
                            $return_data = $sql_query->row();
                            $image_old = $return_data->image;

                            if (isset($image_old) && !empty($image_old)) {
                                if (file_exists(FCPATH . $this->config->item("profile_path") . "/" . $image_old)) {
                                    unlink(FCPATH . $this->config->item("profile_path") . "/" . $image_old);
                                }
                            }
                        }

                        $user_data['profile_picture'] = $image_data['file_name'];
                    }
                }

                

                $this->db->where('id',$_POST['shop_id']);
                if($this->db->update('shop',$user_data)){

                    $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
                    $updated_shop_data = (array)$this->db->get_where('shop',$where)->row();

                    $response['status'] = true;
                    $response['profile'] = $updated_shop_data;
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

    public function manage_service_post(){
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['takeout_delivery_status'] = $_POST['takeout_delivery_status'];
        $postFields['min_order'] = $_POST['min_order'];
        //$postFields['service_charge'] = $_POST['service_charge'];
        $postFields['weekly_status'] = $_POST['weekly_status'];
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Shop not found';
            }else{

                $data['takeout_delivery_status'] = $_POST['takeout_delivery_status'];
                $data['min_order'] = number_format($_POST['min_order'],2);
                //$data['service_charge'] = number_format($_POST['service_charge'],2);
                $data['weekly_status'] = $_POST['weekly_status'];
                $this->db->update('shop',$data,array('id'=>$_POST['shop_id']));

                $response['status'] = true;
                $response['message'] = 'Services updated successfully.';
                $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
                $shop = (array)$this->db->get_where('shop',$where)->row();
                $response['profile'] = $shop;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function store_time_post(){
        //$jsondata = $_POST['jsondata'];
        //print_r($_POST);exit;
        $data = json_decode($_POST['jsondata'], true);

        //print_r($data);exit;
        $postFields['shop_id'] = $data['shop_id'];        
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $data['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Shop not found';
            }else{
                if(!empty($data['Sunday']) && !empty($data['Monday']) && !empty($data['Tuesday']) && !empty($data['Thursday']) && !empty($data['Friday']) && !empty($data['Saturday']) && !empty($data['Wednesday']))
                {
                    $day_array = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

                    foreach ($day_array as $day) 
                    {
                        $update_data['is_closed'] = $data[$day]['is_closed'];
                        $update_data['full_day'] = $data[$day]['full_day'];
                        if($data[$day]['is_closed'] == 1 || $data[$day]['full_day'] == 1)
                        {
                            $update_data['from_time'] =  "";
                            $update_data['to_time'] = "";
                        }
                        else
                        {
                            $update_data['from_time'] = $data[$day]['from_time'];
                            $update_data['to_time'] = $data[$day]['to_time'];
                        }
                        if($data[$day]['is_closed'] == 1)
                        {
                            $update_data['full_day'] = 0;
                        }
                        
                        //print_r($update_data);exit;
                        $this->db->update('shop_availibality',$update_data,array('day'=>$day,'shop_id'=>$data['shop_id']));
                    }   
                }

                
                
                $time_info = $this->db->get_where('shop_availibality',array('shop_id'=>$data['shop_id']))->result_array();      
                $time_list =array();
                foreach ($time_info as $key => $time)
                {
                    $time_list[$time['day']] = $time;
                }

                $response['status'] = true;
                $response['message'] = 'Store time updated successfully.';
                $response['time_data'] = $time_list;
            
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function register_post()
    {
        $postFields['email'] = $_POST['email'];
        $postFields['shop_name'] = $_POST['shop_name'];
        $postFields['address'] = $_POST['address'];
        $postFields['mobile_number'] = $_POST['mobile_number'];
        $postFields['message'] = $_POST['message'];
        $postFields['vender_name'] = $_POST['vender_name'];            

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $shop_request_count = $this->db->get_where('shop_request',array('email'=>$_POST['email']))->num_rows();
            $shop_count = $this->db->get_where('shop',array('email'=>$_POST['email']))->num_rows();
            if($shop_count == 0 && $shop_request_count == 0)
            {
                $data['email'] = trim($_POST['email']);
                $data['shop_name'] = ucwords(addslashes($_POST['shop_name']));
                $data['address'] = trim($_POST['address']);                
                $data['contact_no1'] = str_replace("+1 ", "",  $_POST['mobile_number']);     
                $data['message'] = addslashes($_POST['message']);  
                $data['vender_name'] = ucwords(addslashes($_POST['vender_name']));
                $data['admin_verified'] = 0;

                $shop_name = preg_replace("/[^a-zA-Z ]/", "", strtolower($_POST["shop_name"]));
                $name_array =  explode(" ",$shop_name);
                $short_name_array = array();

                foreach($name_array as $key => $value){
                    $value1 = trim($value);
                    if($value1 != ''){
                        $short_name_array[$key] = $value1;
                    }
                }
                $short_name = implode("-",$short_name_array);

                $this->db->select('short_name');
                $this->db->from('shop');
                $this->db->where("short_name LIKE '$short_name%'");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $exists_data = $sql_query->num_rows();
                    $short_name = $short_name."-".$exists_data;
                }

                $data['short_name'] = $short_name;

                $address = urlencode($_POST['address']);

                $google_key = $this->config->item('google_key');

                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.$google_key;              
                $address_json = file_get_contents($url);            
                $json = (array)json_decode($address_json);                
                $city = "";
                $state = "";
                $country = "";
                $zip_code = "";
                foreach ($json['results'][0]->address_components as $key) 
                {
                    if($key->types[0] == 'administrative_area_level_2')
                    {
                        $city = $key->long_name;
                    }
                    if($key->types[0] == 'administrative_area_level_1')
                    {
                        $state = $key->long_name;
                    }
                    if($key->types[0] == 'country')
                    {
                        $country = $key->long_name;
                    }
                    if($key->types[0] == 'postal_code')
                    {
                        $zip_code = $key->long_name;
                    }
                }

                $data['latitude'] = $json['results'][0]->geometry->location->lat;
                $data['longitude'] = $json['results'][0]->geometry->location->lng;
                $data['city'] = $city;
                $data['state'] = $state;
                $data['country'] = $country;
                $data['zip_code'] = $zip_code;          
                
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = NULL;
                $data['deleted_at'] = NULL;

                //print_r($data);exit;
                $this->db->insert('shop',$data);

                $user_id = $this->db->insert_id();
                //print_r($user_id);exit;
                $shop_code = str_replace(' ', '', $_POST['shop_name']);
                $shop_code = preg_replace('/[^A-Za-z0-9\-]/', '', $shop_code);
                $shop_code = strtoupper(substr($shop_code, 0, 3)).$user_id;

                $update_data['shop_code'] = $shop_code;

                $this->db->update('shop',$update_data,array('id'=>$user_id));

                $this->db->select('emat_email_subject,emat_email_message');
                $this->db->from('email_template');
                $this->db->where('emat_email_type', 1);
                $this->db->where("emat_is_active", 1);
                $sql_query = $this->db->get();
                $return_data = $sql_query->row();

                if (!isset($return_data) && empty($return_data)){
                    $this->auth->set_error_message("Email template not found. Please try again later or contact clicklunch team.");
                    return FALSE;
                }

                $activation_token = bin2hex(random_bytes(20));
                $email_var_data["activation_link"] = base_url() . 'vender-setpassword/'. $activation_token;

                $from = "";
                $to = $this->input->post("email");
                $subject = $return_data->emat_email_subject;

                $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                $mail = $this->send_mail($to, $subject, $message);

                if(!$mail){
                    $this->db->where("id", $user_id);
                    $this->db->delete("shop");

                    $this->auth->set_error_message("Error into sending activation mail. Please try again later");
                    return FALSE;
                }else{
                    $token_array = array('activation_token' => $activation_token);
                    $this->db->where("id", $user_id);
                    $this->db->update("shop", $token_array);
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $this->auth->set_error_message("Error into registation. Please try again");
                } else {
                    $this->db->trans_commit();
                    $this->auth->set_status_message("You are successfully registered into clicklunch. You have got activation mail on your email address.");
                    $return_value = TRUE;
                }


                $response['status'] = true;
                $response['message'] = 'Register successfully, admin will cantact to you soon.';
            }
            else
            {
                $response['status'] = false;
                $response['message'] = 'Email is already exist';
            }
        }
        else
        {
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

    public function test_get(){
        $device_token = 'emCZFC1-U1o:APA91bGEAzYneQ95zUlCstxmgx3ODnj1T0jPX38bXYXCNVEc6sjGRePfEyRI3RtygjlcaxlKI_xBATXbPv-N7xJj0f1ZvWUSHSstvdfQ0rs7xIqoe9vxGOEBxCZ7A2-tW5IATF3iscE4';
        $push_title = 'New request of delivery';
        $push_data = 'Hey Delivery Boy!';
        $push_data .= 'You got new order delivery';
        $push_type = 'request';

        $abc = send_push('Android',$device_token, $push_title, $push_data, $push_type);
        echo "<pre>";
        print_r($abc);
        exit;
    }

    public function order_history_get($shop_id = "",$Page = 1)
    {
        if($shop_id != "")
        {
            if($Page == 0)
            {
                $Page = 1;
            }

            if($Page == 1)
            {
                $start = 0;
            }
            else
            {
                $start = ($Page - 1) * 10;
            }
            $limit = 10;

            $order_data = $this->db->query('SELECT orders.*,customer.username From orders join customer on customer.id = orders.customer_id where orders.shop_id = "'.$shop_id.'" and orders.order_status IN(6,7,8) ORDER By orders.id DESC LIMIT '.$start.','.$limit)->result_array();
            $i = 0;
            $order_data_list = array();
            foreach ($order_data as $row) 
            {
                $order_data_list[$i] = $row;
                if($row['order_status'] == 6)
                {
                    $order_data_list[$i]['order_of_status'] = 'delivered';
                }
                else if($row['order_status'] == 7)
                {
                    $order_data_list[$i]['order_of_status'] = 'delivery_fail';
                }
                else
                {
                    $order_data_list[$i]['order_of_status'] = 'cancel_by_customer';
                }
                $i++;
            }
            $response['status'] = true;
            $response['message'] = 'Order History';
            $response['data'] = $order_data_list;

        }
        else
        {
            $response['status'] = false;
            $response['message'] = 'Paramater missing';
        }
        $this->response($response);
    }

    public function order_action_post()
    {
        $postFields['order_id'] = $_POST['order_id']; 
        $postFields['accept_reject'] = $_POST['accept_reject']; 
        //$postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 

        if(empty($errorPost))
        {            
            if($_POST['accept_reject'] == 0)
            {
                $order_update = array('order_status' => 2 , 'delivery_boy_id' => 0 );
                $this->db->where("id",$_POST['order_id']);
                if($this->db->update("orders",$order_update))
                {
                    $response['status'] = true;
                    $response['message'] = 'Order CL'.$_POST['order_id'].' rejected';
                }
                else
                {
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }

            }
            else if($_POST['accept_reject'] == 1)
            {
                $order_update = array('order_status' => 1);
                $this->db->where("id",$_POST['order_id']);
                if($this->db->update("orders",$order_update))
                {
                    $response['status'] = true;
                    $response['message'] = 'Order CL'.$_POST['order_id'].' accepted by shop';
                }
                else
                {
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }

            }
            else
            {
                $response['status'] = false;
                $response['message'] = 'Something went wrong';
            }                
            
        }
        else
        {
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function order_action_complete_post()
    {
        $postFields['order_id'] = $_POST['order_id']; 
        $postFields['accept_reject'] = $_POST['accept_reject'];        
        $order_details = (array)$this->db->get_where('orders',array('id'=>$_POST['order_id']))->row();
        $customer = (array)$this->db->get_where('customer',array('id'=>$order_details['customer_id']))->row();
        if(empty($errorPost))
        {            
            if($_POST['accept_reject'] == 0)
            {
                $order_update = array('order_status' => 2 , 'delivery_boy_id' => 0 );
                $this->db->where("id",$_POST['order_id']);
                if($this->db->update("orders",$order_update))
                {
                    $order_data = (array)$this->db->get_where('orders',array('id'=>$_POST['order_id']))->row();
                    $order_data['message'] = 'Order CL'.$_POST['order_id'].' rejected';
                    send_push($customer['device_type'],$customer['device_token'],'Order Cancel By Shop',$order_data,'CancelByShop');
                    $response['status'] = true;
                    $response['message'] = 'Order CL'.$_POST['order_id'].' rejected';
                }
                else
                {
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }

            }
            else if($_POST['accept_reject'] == 1)
            {
                $order_update = array('order_status' => 6);
                $this->db->where("id",$_POST['order_id']);
                if($this->db->update("orders",$order_update))
                {
                    
                    $this->db->select('emat_email_subject,emat_email_message');
                    $this->db->from('email_template');
                    $this->db->where('emat_email_type', 10);
                    $this->db->where("emat_is_active", 1);
                    $sql_query = $this->db->get();
                    $return_data = $sql_query->row();

                    if (!isset($return_data) && empty($return_data)){
                    $response['status'] = false;
                    $response['message'] = 'Email template not found. Error into sending mail.';
                    }else{

                    $email_var_data["order_id"] = 'CL'.$_POST['order_id'];
                    $email_var_data["shop_name"] = $customer['shop_name'];

                    $from = "";
                    $to = array($customer['email']);
                    $subject = $return_data->emat_email_subject;

                    $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                    $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                    $mail = $this->send_mail2($to, $subject, $message);
                    }
                    $order_data = (array)$this->db->get_where('orders',array('id'=>$_POST['order_id']))->row();
                    $order_data['message'] = 'Order CL'.$_POST['order_id'].' completed by shop';
                    send_push($customer['device_type'],$customer['device_token'],'Order Completed By Shop',$order_data,'order_completed');
                    $response['status'] = true;
                    $response['message'] = 'Order CL'.$_POST['order_id'].' completed by shop';
                }
                else
                {
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }

            }
            else
            {
                $response['status'] = false;
                $response['message'] = 'Something went wrong';
            }                
            
        }
        else
        {
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function myorders_post(){
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['order_type'] = $_POST['order_type']; 

        if(empty($errorPost)){

            $where = array('id' => intval($_POST['shop_id']) ,'deleted_at' => NULL, 'status' => 1);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'shop not found';    
            }else{

                $sql_select = array(
                                't1.id',
                                't1.total',
                                't1.order_type',
                                't1.order_status',
                                't2.username',
                                'CONCAT_WS(", ", t4.house_no, t4.street, t4.city, t4.zipcode) AS delivery_address',
                                't4.latitude as address_latitude',
                                't4.longitude as address_longitude',
                                't3.shop_name',
                                't3.address as shop_address',
                                't3.latitude as shop_latitude',
                                't3.longitude as shop_longitude',
                                't3.profile_picture as shop_picture',
                                't1.later_time as later_time',
                                'IF(t1.order_type=5, t1.schedule_date, "") as schedule_date',
                                'IF(t1.order_type=5, t1.schedule_time, "") as schedule_time',
                                //'IF(t1.order_type=2, t1.later_time, "") as later_time',
                                't1.created_at'
                );
                $this->db->select($sql_select);

                $this->db->from('orders t1');
                $this->db->join('customer t2', 't1.customer_id = t2.id','left');
                $this->db->join('shop t3', 't1.shop_id = t3.id','left');
                $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

                $this->db->where('t1.shop_id', $_POST['shop_id']);
                if($_POST['order_type'] == 1)
                {
                    $wh = '(t1.order_type = 1 OR t1.order_type = 2) ';
                    $this->db->where($wh);                  
                }
                else if($_POST['order_type'] == 2)
                {
                    $wh = '(t1.order_type = 3 OR t1.order_type = 4) ';
                    $this->db->where($wh);
                }
                else if($_POST['order_type'] == 3)
                {
                    $current_date = date('Y-m-d');
                    $to_date = date('Y-m-d', strtotime("+6 days")).' 23:59:59';

                    
                    $wh = '(t1.order_type = 5 OR t1.order_type = 6) ';
                    $wh .= ' AND (t1.schedule_date between "'.$current_date.'" and "'.$to_date.'") ';
                    //echo $wh;exit;
                    $this->db->where('t1.order_type', $wh);                 
                }

                
              //  $this->db->where('t1.order_status', 4);

                // $this->db->group_start();
                //     $this->db->where('t1.order_type', 1);
                //     $this->db->or_where('t1.order_type', 2);

                //     $this->db->or_group_start();
                //         $this->db->where('t1.order_type', 5);
                //         $this->db->where('DATE(t1.schedule_date)', date('Y-m-d'));
                //     $this->db->group_end();

                // $this->db->group_end();

                // if($_POST['order_type'] == 1){
                //     $this->db->where('DATE(t1.created_at)', date('Y-m-d'));
                // }else{
                //     $this->db->where('DATE(t1.created_at) !=', date('Y-m-d'));
                // }

                $sql_query = $this->db->get();
                $last_query = $this->db->last_query();
               // print_r($last_query);exit;
                if ($sql_query->num_rows() > 0){
                    $orders_data = $sql_query->result_array();     

                    $sql_select = array(
                                    't2.name'
                    );

                   // print_r($orders_data);exit;

                    foreach ($orders_data as $key => $value) {
                        $this->db->select($sql_select);
                        $this->db->from('order_items t1');
                        $this->db->where('t1.order_id', $value['id']);
                        $this->db->join('item t2', 't1.item_id = t2.id','left');
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $products_data = $sql_query->result_array();   
                            $products = array_column($products_data, 'name');
                            $orders_data[$key]['products'] = implode(', ', $products);


                            if($value['order_type'] == 1){
                                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                                $added_time = $my_date->add(new DateInterval('PT30M'));
                                $orders_data[$key]['delivery_time'] = $added_time->format('h:i A');
                            }else if($value['order_type'] == 2){
                                $orders_data[$key]['delivery_time'] = $value['later_time'];
                            }else if($value['order_type'] == 5){
                                $orders_data[$key]['delivery_time'] = $value['schedule_time'];
                            }else{
                                $orders_data[$key]['delivery_time'] = '';
                            }

                        }else{
                            // $orders_data[$key]['products'] = '';
                        }
                    }
                    $response['orders_data'] = $orders_data;                   
                    $response['status'] = TRUE;                  
                }else{
                    $response['message'] = 'No order available';                  
                    $response['status'] = FALSE; 
                }
                //$response['last_query'] = $last_query; 
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function my_weekly_orders_post(){
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 
        $postFields['date'] = $_POST['date']; 

        if(empty($errorPost)){

            $where = array('id' => intval($_POST['delivery_boy_id']) ,'deleted_at' => NULL, 'status' => 1);
            $delivery_boy = (array)$this->db->get_where('delivery_boy',$where)->row();
            if(empty($delivery_boy)){
                $response['status'] = false;
                $response['message'] = 'User not found';    
            }else{

                $sql_select = array(
                                't1.id',
                                't1.total',
                                't1.order_type',
                                't2.username',
                                'CONCAT_WS(", ", t4.house_no, t4.street, t4.city, t4.zipcode) AS delivery_address',
                                't4.latitude as address_latitude',
                                't4.longitude as address_longitude',
                                't3.shop_name',
                                't3.address as shop_address',
                                't3.latitude as shop_latitude',
                                't3.longitude as shop_longitude',
                                't3.profile_picture as shop_picture',
                                'IF(t1.order_type=5, t1.schedule_date, "") as schedule_date',
                                'IF(t1.order_type=5, t1.schedule_time, "") as schedule_time',
                                'IF(t1.order_type=2, t1.later_time, "") as later_time',
                                't1.created_at'
                );
                $this->db->select($sql_select);

                $this->db->from('orders t1');
                $this->db->join('customer t2', 't1.customer_id = t2.id','left');
                $this->db->join('shop t3', 't1.shop_id = t3.id','left');
                $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

                $this->db->where('t1.delivery_boy_id', $_POST['delivery_boy_id']);
                $this->db->where('t1.order_status', 4);

                $this->db->group_start();

                    $this->db->group_start();
                        $this->db->where('t1.order_type', 1);
                        $this->db->where('DATE(t1.created_at)', $_POST['date']);
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->or_where('t1.order_type', 2);
                        $this->db->where('DATE(t1.created_at)', $_POST['date']);
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->where('t1.order_type', 5);
                        $this->db->where('DATE(t1.schedule_date)', $_POST['date']);
                    $this->db->group_end();

                $this->db->group_end();

                $sql_query = $this->db->get();
                $last_query = $this->db->last_query();
                if ($sql_query->num_rows() > 0){
                    $orders_data = $sql_query->result_array();     

                    $sql_select = array(
                                    't2.name'
                    );

                    foreach ($orders_data as $key => $value) {
                        $this->db->select($sql_select);
                        $this->db->from('order_items t1');
                        $this->db->where('t1.order_id', $value['id']);
                        $this->db->join('item t2', 't1.item_id = t2.id','left');
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $products_data = $sql_query->result_array();   
                            $products = array_column($products_data, 'name');
                            $orders_data[$key]['products'] = implode(', ', $products);


                            if($value['order_type'] == 1){
                                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                                $added_time = $my_date->add(new DateInterval('PT30M'));
                                $orders_data[$key]['delivery_time'] = $added_time->format('h:i A');
                            }else if($value['order_type'] == 2){
                                $orders_data[$key]['delivery_time'] = $value['later_time'];
                            }else if($value['order_type'] == 5){
                                $orders_data[$key]['delivery_time'] = $value['schedule_time'];
                            }else{
                                $orders_data[$key]['delivery_time'] = '';
                            }

                        }else{
                            $orders_data[$key]['products'] = '';
                        }
                    }
                    $response['orders_data'] = $orders_data;                   
                    $response['status'] = TRUE;                  
                }else{
                    $response['message'] = 'No any order pending';                  
                    $response['status'] = FALSE; 
                }
                //$response['last_query'] = $last_query; 
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function order_detail_post(){
        $postFields['order_id'] = $_POST['order_id']; 
        if(empty($errorPost)){
            $where = array('id' => intval($_POST['order_id']));
            $order = (array)$this->db->get_where('orders',$where)->row();
            if(empty($order)){
                $response['status'] = false;
                $response['message'] = 'Order not found';    
            }else{
                $sql_select = array(
                                't1.id',
                                't1.total',
                                't2.username',
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
                                'IF(t1.order_type=2, t1.schedule_date, "") as schedule_date',
                                'IF(t1.order_type=2, t1.schedule_time, "") as schedule_time',
                                'IF(t1.order_type=1, t1.created_at, "") as created_at'
                );
                $this->db->select($sql_select);

                $this->db->from('orders t1');
                $this->db->join('customer t2', 't1.customer_id = t2.id','left');
                $this->db->join('shop t3', 't1.shop_id = t3.id','left');
                $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

                $this->db->where('t1.id', $_POST['order_id']);
            //    $this->db->where('t1.order_status', 4);

                $this->db->group_start();
                    $this->db->where('t1.order_type', 1);
                    $this->db->or_where('t1.order_type', 2);
                $this->db->group_end();

                if(intval($_POST['order_type']) == 1){
                    $this->db->where('DATE(t1.created_at)', date("Y-m-d"));
                }else{
                    $this->db->where('DATE(t1.created_at) !=', date("Y-m-d"));
                }

                $sql_query = $this->db->get();

                if ($sql_query->num_rows() > 0){
                    $orders_data = (array)$sql_query->row();
                    $orders_data['rating'] = '3.5';

                    if($orders_data['created_at'] != ''){
                        $order_created = strtotime($orders_data['created_at']);
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $orders_data['created_at'])->format('j M, Y');
                        $time = DateTime::createFromFormat('Y-m-d H:i:s', $orders_data['created_at'])->format('h:i A');
                    }else{
                        $date = DateTime::createFromFormat('Y-m-d', $orders_data['schedule_date'])->format('j M, Y');
                        $time = $orders_data['schedule_time'];
                    }

                    $order_time = $date.' at '.$time;
                    $orders_data['order_time'] = $order_time;


                    $sql_select = array(
                                    't2.name',
                                    't1.quantity',
                                    't1.total_product_price'
                    );

                    $this->db->select($sql_select);
                    $this->db->from('order_items t1');
                    $this->db->where('t1.order_id', $orders_data['id']);
                    $this->db->join('item t2', 't1.item_id = t2.id','left');
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $orders_data['products'] = $sql_query->result_array();
                    }    
                    $response['orders_data'] = $orders_data;       
                    $response['status'] = TRUE;             
                }else{
                    $response['message'] = 'Order data not found';                  
                    $response['status'] = FALSE; 
                }
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function product_stock_post(){
        $postFields['shop_id'] = $_POST['shop_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['shop_id'],'status' => '1', 'deleted_at' => NULL);
            $shop = (array)$this->db->get_where('shop',$where)->row();
            if(empty($shop)){
                $response['status'] = false;
                $response['message'] = 'Restaurant not found';
            }else{

                $item_data = array();
                $this->db->select('*');
                $this->db->where("deleted_at", NULL);
              //  $this->db->where("is_active", 1);
                $this->db->where("shop_id", $_POST['shop_id']);
                $this->db->from('item');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $item_data = $sql_query->result_array();                        
                }               

               

                $response['status'] = true;
                $response['products'] = $item_data;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function product_status_get($product_id="")
    {       
        $product_info = (array)$this->db->get_where('item',array('id'=>$product_id))->row(); 
        if($product_id != "" && !empty($product_info))
        {
            if($product_info['is_active'] == 0)
            {
                $data['is_active'] = 1;    
            }
            else
            {
                $data['is_active'] = 0;
            }
            $this->db->update('item',$data,array('id'=>$product_id));
            $response['status'] = true;
            $response['message'] = 'Product status updated successfully';           

        }
        else
        {
            $response['status'] = false;
            $response['message'] = 'Paramater missing';
        }              
        $this->response($response);
    }

    public function dashboard_get($shop_id="")
    {    
        if($shop_id != "" )
        {
            $data['order_count'] = $this->db->get_where('orders',array('shop_id'=>$shop_id,'deleted_at'=>null))->num_rows();
            $data['product_count'] = $this->db->get_where('item',array('shop_id'=>$shop_id,'deleted_at'=>null))->num_rows();
            $data['promocode_count'] = $this->db->get_where('promocode',array('shop_id'=>$shop_id,'deleted_at'=>null,'status'=>1))->num_rows();
            $data['total_earning'] = 7854;

            $data['today_earning'] = 90;
            $data['weekly_earning'] = 654;
            $data['monthly_earning'] = 5000;
            $data['yearly_earning'] = 7854;

            $sql_select = array(
                                't1.id',
                                't1.total',
                                't1.order_type',
                                't1.order_status',
                                't2.username',
                                'CONCAT_WS(", ", t4.house_no, t4.street, t4.city, t4.zipcode) AS delivery_address',
                                't4.latitude as address_latitude',
                                't4.longitude as address_longitude',
                                't3.shop_name',
                                't3.address as shop_address',
                                't3.latitude as shop_latitude',
                                't3.longitude as shop_longitude',
                                't3.profile_picture as shop_picture',
                                'IF(t1.order_type=5, t1.schedule_date, "") as schedule_date',
                                'IF(t1.order_type=5, t1.schedule_time, "") as schedule_time',
                                'IF(t1.order_type=2, t1.later_time, "") as later_time',
                                't1.created_at'
                );
                $this->db->select($sql_select);

                $this->db->from('orders t1');
                $this->db->join('customer t2', 't1.customer_id = t2.id','left');
                $this->db->join('shop t3', 't1.shop_id = t3.id','left');
                $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

                $this->db->where('t1.shop_id', $shop_id);
                $this->db->order_by('t1.id', 'DESC');
                $this->db->limit(15, 0);
                if($_POST['order_type'] == 1)
                {
                    $wh = '(t1.order_type = 1 OR t1.order_type = 2) ';
                    $this->db->where($wh);                  
                }
                else if($_POST['order_type'] == 2)
                {
                    $wh = '(t1.order_type = 3 OR t1.order_type = 4) ';
                    $this->db->where($wh);
                }
                else if($_POST['order_type'] == 3)
                {
                    $wh = '(t1.order_type = 5 OR t1.order_type = 6) ';
                    $this->db->where('t1.order_type', $wh);                 
                }              
              

                $sql_query = $this->db->get();
                $last_query = $this->db->last_query();
               // print_r($last_query);exit;
                if ($sql_query->num_rows() > 0){
                    $orders_data = $sql_query->result_array();     

                    $sql_select = array(
                                    't2.name'
                    );

                    foreach ($orders_data as $key => $value) {
                        $this->db->select($sql_select);
                        $this->db->from('order_items t1');
                        $this->db->where('t1.order_id', $value['id']);
                        $this->db->join('item t2', 't1.item_id = t2.id','left');

                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){
                            $products_data = $sql_query->result_array();   
                            $products = array_column($products_data, 'name');
                            $orders_data[$key]['products'] = implode(', ', $products);


                            if($value['order_type'] == 1){
                                $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                                $added_time = $my_date->add(new DateInterval('PT30M'));
                                $orders_data[$key]['delivery_time'] = $added_time->format('h:i A');
                            }else if($value['order_type'] == 2){
                                $orders_data[$key]['delivery_time'] = $value['later_time'];
                            }else if($value['order_type'] == 5){
                                $orders_data[$key]['delivery_time'] = $value['schedule_time'];
                            }else{
                                $orders_data[$key]['delivery_time'] = '';
                            }

                        }else{
                             $orders_data = array();
                        }
                    }
                }
            $data['recent_order'] = $orders_data;
            
            $response['status'] = true;
            $response['message'] = 'shop dashboard data';  
            $response['data'] = $data;           

        }
        else
        {
            $response['status'] = false;
            $response['message'] = 'Paramater missing';
        }              
        $this->response($response);
    }

    public function update_payment_api_post()
    {
        $postFields['shop_id'] = $_POST['shop_id']; 
        $postFields['api_key'] = $_POST['api_key']; 
        $postFields['payment_type'] = $_POST['payment_type']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $payment_api_info = (array)$this->db->get_where('payment_settings',array('shop_id'=>$_POST['shop_id'],'payment_type'=>1))->row();
            if(!empty($payment_api_info))
            {
                $data['api_key'] = $_POST['api_key'];
                $data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->update('payment_settings',$data,array('shop_id'=>$_POST['shop_id']));
            }
            else
            {
                $data['shop_id'] = $_POST['shop_id'];
                $data['api_key'] = $_POST['api_key'];
                $data['payment_type'] = 1;
                $this->db->insert('payment_settings',$data);
            }
            $response['status'] = true;
            $response['message'] = 'Payment api updated successfully.';

        }
        else
        {
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }


    public function send_mail2($to,$subject,$message){

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