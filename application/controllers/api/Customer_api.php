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

    public function init_get($app_version = '',$type = '', $customer_id = ''){

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

            if($response['status'] == TRUE && $customer_id != ''){
                $this->db->select('id');
                $this->db->where("id",$customer_id);
                $this->db->where("deleted_at",NULL);
                $this->db->where("status",1);
                $this->db->from("customer");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $response['status'] = true;
                }else{
                    $response['status'] = true;
                    $response['message'] = 'Customer is blocked';
                }

            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }

        $this->response($response);
    }

    public function register_old_post(){
        $postFields['fullname'] = $_POST['username'];        
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
                $response['message'] = 'Your email account is already exists. Please login instead register.';

            }else{

                $this->db->select('*');
                $this->db->where("mobile_number",$_POST['mobile_number']);
                $this->db->where("deleted_at",NULL);
                $this->db->from("customer");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $response['status'] = false;
                    $response['message'] = 'Your contact number is already exists. Please use another number.';
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
                                $this->db->where('id', $insert_id);
                                $this->db->delete('customer');

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
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }

        $this->response($response);
    }

    public function register_post(){
        $postFields['fullname'] = $_POST['username'];        
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
                $response['message'] = 'Your email account is already exists. Please login instead register.';

            }else{

                $this->db->select('*');
                $this->db->where("mobile_number",$_POST['mobile_number']);
                $this->db->where("deleted_at",NULL);
                $this->db->from("customer");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $response['status'] = false;
                    $response['message'] = 'Your contact number is already exists. Please use another number.';
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

                            $this->db->select('emat_email_subject,emat_email_message');
                            $this->db->from('email_template');
                            $this->db->where('emat_email_type', 1);
                            $this->db->where("emat_is_active", 1);
                            $sql_query = $this->db->get();
                            $return_data = $sql_query->row();

                            if (!isset($return_data) && empty($return_data)){
                                $response['status'] = false;
                                $response['message'] = 'Email template not found. Error into sending mail.';
                            }else{

                                $activation_token = bin2hex(random_bytes(20));
                                $email_var_data["activation_link"] = base_url() . 'customer-activate/'. $activation_token;

                                $from = "";
                                $to =  array($_POST['email']);
                                $subject = $return_data->emat_email_subject;

                                $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                                $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                                $mail = $this->send_mail($to, $subject, $message);

                            }

                            if($mail){

                                $update_data = array('activation_token' => $activation_token);
                                $this->db->where('id', $insert_id);
                                $this->db->update('customer', $update_data);

                                $response['status'] = true;
                                $response['message'] = 'Account activation mail is sent on your email address';

                            }else{
                                $this->db->where('id', $insert_id);
                                $this->db->delete('customer');

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
                //$this->db->where("customer_id",$customer->id);
                $this->db->where("deleted_at",NULL);
                $this->db->where("id",$customer->default_address);
                $this->db->from("delivery_address");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $default_delivery_address = $sql_query->row();
                    $response['default_delivery_address'] = $default_delivery_address;
                }

                $this->db->select('*');
                $this->db->where("id",$customer->id);
                $this->db->from("customer");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $customer_data = $sql_query->row();
                    $response['profile'] = $customer_data;
                }

                $response['status'] = true;
                

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

    public function social_login_post(){
        $postFields['social_id'] = $_POST['social_id'];  
        $postFields['social_type'] = $_POST['social_type'];  

        $postFields['fullname'] = $_POST['username'];        
        $postFields['email'] = $_POST['email'];        
        $postFields['mobile_number'] = $_POST['mobile_number']; 
        $postFields['date_of_birth'] = $_POST['date_of_birth']; 
        $postFields['gender'] = $_POST['gender']; 
        $postFields['device_token'] = $_POST['device_token']; 
        $postFields['device_type'] = $_POST['device_type']; 
        $postFields['latitude'] = $_POST['latitude'];
        $postFields['longitude'] = $_POST['longitude'];   
   
        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            $where1 = array('social_id' => intval($_POST['social_id']),'social_type' => intval($_POST['social_type']), 'deleted_at' => NULL);
            $user_exists = $this->db->get_where('customer',$where1)->row();

            if(empty($user_exists)){

                $where = array('email' => $_POST['email'], 'deleted_at' => NULL);
                $user_exists_email = $this->db->get_where('customer',$where)->row();

                if(empty($user_exists_email)){

                    $user = array( 
                            'username' => $_POST['username'], 
                            'email'=> $_POST['email'], 
                            'password' => '',
                            'status' => 1,
                            'device_token'=> $_POST['device_token'], 
                            'device_type'=> $_POST['device_type'], 
                            'mobile_number'=> $_POST['mobile_number'],
                            'gender'=> $_POST['gender'],
                            'dob'=> $_POST['date_of_birth'],
                            'social_id'=> intval($_POST['social_id']),
                            'social_type'=> intval($_POST['social_type'])
                        );

                    if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != "0" && !is_null($_POST['latitude']) && !is_null($_POST['longitude'])){

                        $google_api_key = $this->config->item("google_key");
                        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$_POST['latitude'].','.$_POST['longitude'].'&key='.$google_api_key);
                        $output = json_decode($geocodeFromLatLong);
                        $status = $output->status;

                        $address = ($status=="OK")?$output->results[1]->formatted_address:'';

                        $user['latitude'] = $_POST['latitude'];
                        $user['longitude'] = $_POST['longitude'];
                        $user['address'] = $address;
                    }

                    $this->db->insert('customer', $user);
                    $insert_id = $this->db->insert_id();
                    
                    $where = array('id' => $insert_id);
                    $user_data = $this->db->get_where('customer',$where)->row();

                    $response['status'] = true;
                    $response['profile'] = $user_data;

                }else{
                    $response['status'] = false;
                    $response['message'] = 'Email id linked with social is already registered in clicklunch.';
                }

            }else{

                if(isset($_POST['latitude']) && $_POST['latitude'] != "" && !is_null($_POST['latitude']) && isset($_POST['longitude']) && $_POST['longitude'] != "" && !is_null($_POST['longitude'])){
                    $data = array('latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']);
                    $this->db->where('id',intval($user_exists->id));
                    $this->db->update('customer',$data);
                }
                
                $where = array('id' => intval($user_exists->id));
                $user = (array)$this->db->get_where('customer',$where)->row();
                $response['status'] = true;
                $response['profile'] = $user;
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
            $data = array('device_token' => '', 'device_type' => '0', 'latitude' => '','longitude' => '' );
            $this->db->where('id',$_POST['customer_id']);
            if($this->db->update('customer',$data)){
                $response['status'] = true;
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
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


                $this->db->select('emat_email_subject,emat_email_message');
                $this->db->from('email_template');
                $this->db->where('emat_email_type', 2);
                $this->db->where("emat_is_active", 1);
                $sql_query = $this->db->get();
                $return_data = $sql_query->row();

                if (!isset($return_data) && empty($return_data)){
                    $response['status'] = false;
                    $response['message'] = 'Email template not found. Error into sending mail.';
                }else{

                    $remember_token = bin2hex(random_bytes(20));
                    $email_var_data["recovery_link"] = base_url() . 'customer-reset-password/'. $remember_token;

                    $from = "";
                    $to =  array($_POST['email']);
                    $subject = $return_data->emat_email_subject;

                    $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                    $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                    $mail = $this->send_mail($to, $subject, $message);

                }


                // $to =  array($_POST['email']);
                // $subject = $this->config->item('site_name').' - Reset Password';
                // $path = BASE_URL().'email_template/reset_password.html';
                // $template = file_get_contents($path);

                // $remember_token = bin2hex(random_bytes(20));
                // $reset_url = base_url() . 'customer-reset-password/'. $remember_token;

                // $template = str_replace('##RESETPWURL##', $reset_url, $template);
                // $template = str_replace('##USERNAME##', $user['username'], $template);

                // $template = $this->create_email_template($template);

                // $mail = $this->send_mail($to,$subject,$template);

                if($mail){

                    $update_data = array('remember_token' => $remember_token);
                    $this->db->where('id', $user['id']);
                    $this->db->update('customer', $update_data);

                    $response['status'] = true;
                    $response['message'] = 'Password recovery mail has been sent on this email address';

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

                $this->db->select('*');
                $this->db->where("customer_id",$user['id']);
                $this->db->where("deleted_at",NULL);
                $this->db->where("default_address",1);
                $this->db->from("delivery_address");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $default_delivery_address = $sql_query->row();
                    $response['default_delivery_address'] = $default_delivery_address;
                }

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

            $user_data = array($_POST['setting_name'] => $_POST['status'] );
            $this->db->where('id',$_POST['customer_id']);
            if($this->db->update('customer',$user_data)){
                $response['status'] = true;
                $response['message'] = 'Setting updated successfully';
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
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

            $user_data = array($_POST['setting_name'] => $_POST['status'] );
            $this->db->where('id',$_POST['customer_id']);
            if($this->db->update('customer',$user_data)){
                $response['status'] = true;
                $response['message'] = 'Setting updated successfully';
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
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


            $where = array('customer_id' => $_POST['customer_id'],'deleted_at' => NULL);
            $delivery_addresses = $this->db->get_where('delivery_address',$where)->result_array();

            if(!empty($delivery_addresses)){

                $this->db->select('default_address');
                $this->db->where("id",$_POST['customer_id']);
                $this->db->where("default_address !=",'');
                $this->db->from("customer");
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $default_address_data = $sql_query->row();
                    $default_address = $default_address_data->default_address;

                    foreach ($delivery_addresses as $key => $value) {
                        $delivery_addresses[$key]['default_address'] = 0;
                        if($default_address == $value['id']){
                            $delivery_addresses[$key]['default_address'] = 1;
                        }
                    }
                }

                
            }

            $response['status'] = true;
            $response['delivery_addresses'] = $delivery_addresses;
            $response['default_address'] = $default_address;

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    // public function popular_delivery_addresses_get(){

    //     $this->db->select('*');
    //     $this->db->where("deleted_at",NULL);
    //     $this->db->where("popular",1);
    //     $this->db->from("delivery_address");
    //     $sql_query = $this->db->get();
    //     if ($sql_query->num_rows() > 0){
    //         $delivery_address = $sql_query->result_array();
    //         $response['status'] = true;
    //         $response['delivery_addresses'] = $delivery_address;
    //     }else{
    //         $response['status'] = false;
    //         $response['message'] = 'No any address found';
    //     }

    //     $this->response($response);
    // }

    public function popular_delivery_addresses_post(){

        $postFields['customer_id'] = $_POST['customer_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['customer_id'],'default_address !=' => 0);
            $customer_default_address = (array)$this->db->get_where('customer',$where)->row();

            $this->db->select('*');
            $this->db->where("deleted_at",NULL);
            $this->db->where("popular",1);
            $this->db->from("delivery_address");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $delivery_address = $sql_query->result_array();

                if(isset($customer_default_address) && !empty($customer_default_address)){
                    foreach ($delivery_address as $key => $value) {
                        if($value['id'] == $customer_default_address['default_address']){
                            $delivery_address[$key]['default_address'] = '1';
                        }
                    }
                }

                $response['status'] = true;
                $response['delivery_addresses'] = $delivery_address;
            }else{
                $response['status'] = false;
                $response['message'] = 'No any address found';
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
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
                    $response['message'] = 'Server encountered an error. Please try again';
                }
            }else{
                $response['status'] = false;
                $response['message'] = 'Sorry, We could not fetch location. Please enter correct address';
            }

            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function edit_delivery_address_post(){
        $postFields['address_id'] = $_POST['address_id']; 
        $postFields['house_no'] = $_POST['house_no']; 
        $postFields['street'] = $_POST['street']; 
        $postFields['city'] = $_POST['city']; 
        $postFields['zipcode'] = $_POST['zipcode']; 
        $postFields['address_type'] = $_POST['address_type']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $delivery_address_data = array(
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

                $this->db->where('id',$_POST['address_id']);

                if($this->db->update('delivery_address',$delivery_address_data)){
                    $response['status'] = true;
                    $response['message'] = 'Delivery address updated successfully';
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. Please try again';
                }
            }else{
                $response['status'] = false;
                $response['message'] = 'Sorry, We could not fetch location. Please enter correct address';
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

            $data_array = array('default_address' => $_POST['address_id']);
            $this->db->where('id',$_POST['customer_id']);

            if($this->db->update('customer',$data_array)){
                $response['status'] = true;
                $response['message'] = 'Default delivery address added successfully';
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
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

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function validate_expirydate($expiry_date = NULL){
        $return = FALSE;

        $expiry_date_array = explode('/',$expiry_date);

        if(isset($expiry_date) && $expiry_date != '' && !is_null($expiry_date) && checkdate($expiry_date_array[0],'01',$expiry_date_array[1])){
            
            $expiry_date_obj = DateTime::createFromFormat('d/m/Y H:i:s', "01/" . $expiry_date_array[0] . "/" .  $expiry_date_array[1]." 00:00:00");
            $expiry_date_obj = new DateTime($expiry_date_obj->format("Y-m-t"));

            $my_date = date('d/m/Y');
            $today = DateTime::createFromFormat('d/m/Y H:i:s', $my_date ." 00:00:00");

            if($expiry_date_obj >= $today){
                $return = TRUE;
            }
        }
        return $return;
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

            $card_number = $_POST['card_number'];
            $card_number = str_replace(' ', '', $card_number);

            $validate_date = $this->validate_expirydate($_POST['expiry_date']);
            $validate_date = TRUE;

            $card_types = array('1' => 'visa', '2' => 'mastercard', '3' => 'amex', '4' => 'jcb', '5' => 'dinnerclub', '6' => 'discover');
            $my_card_type = $card_types[$_POST['card_type']];
            $card_type = validate_customer_card($card_number);
            if($card_type != '' && $card_type == $my_card_type){

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

            $card_number = $_POST['card_number'];
            $card_number = str_replace(' ', '', $card_number);

            $validate_date = $this->validate_expirydate($_POST['expiry_date']);
            if(validate_card($_POST['card_number']) && is_numeric($card_number) && $validate_date == TRUE){
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
            
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function home_post(){

        $cuisine_shops = array();
        if(isset($_POST['cuisine']) && $_POST['cuisine'] != "" && !isset($_POST['filter_by'])){
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
                            "takeout_delivery_status",
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

        }else if(isset($latitude) && $latitude != "" && $_POST['address_id'] != "0"){

            $distance = "(3956 * 2 * ASIN(SQRT( POWER(SIN((".$latitude." - latitude) * pi()/180 / 2), 2) +COS( ".$latitude." * pi()/180) * COS(longitude * pi()/180) * POWER(SIN(( ".$longitude." - longitude) * pi()/180 / 2), 2) ))) as distance";
            array_push($sql_select,$distance);

        }else{

        }

        // get delivery_available_mile
        $delivery_available_mile = '';
        $this->db->select('data');
        $this->db->where("name", 'delivery_available_mile');
        $this->db->from('setting');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $delivery_available_mile_data = $sql_query->row();
            $delivery_available_mile = $delivery_available_mile_data->data;
        }
        

        $this->db->select($sql_select);

        if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != "" && $delivery_available_mile != ''){
            $this->db->order_by("distance", "asc");
            $this->db->having("distance <=", $delivery_available_mile);
        }else if(isset($_POST['latitude']) && $_POST['latitude'] != "" && $_POST['address_id'] != "0"){
            $this->db->order_by("distance", "asc");
            $this->db->having("distance <=", $delivery_available_mile);
        }else{
            
        }
        
        if(!empty($cuisine_shops)){
            $this->db->where_in("id", $cuisine_shops);
        }

        if(isset($_POST['keyword']) && $_POST['keyword'] != ""){
            $this->db->where("shop_name LIKE '%".$_POST['keyword']."%'");
        }
        $this->db->where("longitude !=", '');
        $this->db->where("latitude !=", '');
        $this->db->where("deleted_at", NULL);
        $this->db->where("status", 1);
        $this->db->where("admin_verified", 1);

        if(isset($_POST['filter_by']) && $_POST['filter_by'] != ""){
            if($_POST['filter_by'] == 1){
                // delivery
                $this->db->group_start();
                $this->db->where("takeout_delivery_status", 1);
                $this->db->or_where("takeout_delivery_status", 3);
                $this->db->group_end();
            }else{
                // takout
                $this->db->group_start();
                $this->db->where("takeout_delivery_status", 2);
                $this->db->or_where("takeout_delivery_status", 3);
                $this->db->group_end();
            }
        }

        $limit = 10; // messages per page
        if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
            $start = $limit * ($_POST['page_number'] - 1);
            $this->db->limit($limit, $start);
        }else{
            $this->db->limit($limit);
        }

        $this->db->from('shop');
        $sql_query = $this->db->get();
        
        if ($sql_query->num_rows() > 0){

            $shop_data = $sql_query->result_array();
            $shop_array = array_column($shop_data, 'id');

            $sql_select = array(
                            "t2.cuisine_name",
                            "t1.shop_id"
                        );

            $this->db->select($sql_select);
            $this->db->where("t2.deleted_at", NULL);
            //$this->db->where("t2.is_active", 1);
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
                $rating = get_rating($value['id']);
                $shop_data[$key]['rating'] = number_format((float)$rating, 2, '.', '');
                
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

            if(!isset($_POST['filter_by'])){
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

                $response['banner'] = $banner_data;
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
            
            $response['tax'] = $tax;
            $response['shop'] = $shop_data;
        }else{
            $response['status'] = false;
            $response['message'] = 'No any restaurant found';
        }

        $this->response($response);
    }

    public function weekly_post(){


        $sql_select = array(
                            "id",
                            "shop_name",
                            "profile_picture",
                            "takeout_delivery_status",
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

        }else{

        }

        // get delivery_available_mile
        $delivery_available_mile = '';
        $this->db->select('data');
        $this->db->where("name", 'delivery_available_mile');
        $this->db->from('setting');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $delivery_available_mile_data = $sql_query->row();
            $delivery_available_mile = $delivery_available_mile_data->data;
        }
        

        $this->db->select($sql_select);

        if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != "" && $delivery_available_mile != ''){
            $this->db->order_by("distance", "asc");
            $this->db->having("distance <=", $delivery_available_mile);
        }else{
            
        }
        
        $this->db->where("longitude !=", '');
        $this->db->where("latitude !=", '');
        $this->db->where("deleted_at", NULL);
        $this->db->where("status", 1);
        $this->db->where("weekly_status", 1);
        $this->db->where("admin_verified", 1);

        $this->db->from('shop');
        $sql_query = $this->db->get();

        if ($sql_query->num_rows() > 0){

            $shop_data = $sql_query->result_array();
            $shop_array = array_column($shop_data, 'id');

            $sql_select = array(
                            "t2.cuisine_name",
                            "t1.shop_id"
                        );

            $this->db->select($sql_select);
            $this->db->where("t2.deleted_at", NULL);
            //$this->db->where("t2.is_active", 1);
            $this->db->where_in("t1.shop_id", $shop_array);
            $this->db->from('shop_cuisines t1');
            $this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $cuisine_data = $sql_query->result_array();                        
            }

            // Add cuisines to shop array
            foreach ($shop_data as $key => $value) {

                $rating = get_rating($value['id']);
                $shop_data[$key]['rating'] = number_format((float)$rating, 2, '.', '');
                $shop_data[$key]['cuisine'] = array();
                

                foreach ($cuisine_data as $key1 => $value1) {
                    if($value['id'] == $value1['shop_id']){
                        array_push($shop_data[$key]['cuisine'], $value1['cuisine_name']);
                    }
                }
            }

            $sql_select = array(
                            "day",
                            "from_time",
                            "to_time",
                            "full_day",
                            "is_closed",
                            "shop_id"
                        );

            $this->db->select($sql_select);
            $this->db->where_in("shop_id", $shop_array);
            //$this->db->where("day", date('l'));
            $this->db->from('shop_availibality');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $availibality_data = $sql_query->result_array();

                 // Add availibality_data to shop array
                foreach ($shop_data as $key => $value) {
                    $get = FALSE;
                    foreach ($availibality_data as $key1 => $value1) {
                        if($value['id'] == $value1['shop_id']){
                            // $shop_data[$key]['from_time'] = $value1['from_time'];
                            // $shop_data[$key]['to_time'] = $value1['to_time'];
                            $shop_data[$key]['timing'][] = $value1;
                            $get = TRUE;
                        }
                    }
                    if($get == FALSE){
                         $shop_data[$key]['timing'] = array();
                    }
                }
            }
            

            $response['status'] = true;
            $response['availibality_data'] = $availibality_data;
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
                //$this->db->where("t2.is_active", 1);
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
                
                $this->db->group_start();

                    $this->db->group_start();
                        $this->db->where('quantity >', 0);
                        $this->db->where('inventory_status', 1);
                    $this->db->group_end();

                    $this->db->or_group_start();
                         $this->db->where('inventory_status', 0);
                    $this->db->group_end();

                $this->db->group_end();

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

                $rating = get_rating($_POST['shop_id']);

                $shop_data = array(
                                'id' => $_POST['shop_id'],
                                'shop_name' => $shop['shop_name'],
                                'rating' => number_format((float)$rating, 2, '.', ''),
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
                $variant_group = array();
                $this->db->select($sql_select);
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
                    $count = 0;
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

                            $varient_data = $sql_query->result_array();
                            
                            $variant_group[$count]['variant_group_id'] = $value['variant_group_id'];
                            $variant_group[$count]['variant_group_name'] = $varient_data[0]['group_name'];
                            $variant_group[$count]['total_variant_options'] = $sql_query->num_rows();
                            $variant_group[$count]['required'] = $varient_data[0]['availability'];
                            $variant_group[$count]['multiple_selection'] = $varient_data[0]['selection'];
                            $variant_group[$count]['variant_options'] = $varient_data;
                        
                            $count++;
                        }

                    }                    
                }

                $response['status'] = true;
                $response['item'] = $item;
                $response['variants'] = $variant_group;
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function like_to_try_products_post(){
        $postFields['shop_id'] = $_POST['shop_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){
            
            $items = array();

            //$this->db->select('id,name,quantity,inventory_status,price,offer_price,item_picture'); 
            $this->db->select('*'); 
            $this->db->where("deleted_at", NULL);

            if(isset($_POST['products']) && $_POST['products'] != ''){
                $products_array = explode(',',$_POST['products']);
                $this->db->where_not_in('id',$products_array);
            }
            
            $this->db->where("is_active", 1);
            $this->db->where("recommended", 1);
            $this->db->where("shop_id",$_POST['shop_id']);
            $this->db->limit(3);
            $this->db->order_by("id", "desc");

            $this->db->group_start();

                $this->db->group_start();
                    $this->db->where('quantity >', 0);
                    $this->db->where('inventory_status', 1);
                $this->db->group_end();

                $this->db->or_group_start();
                     $this->db->where('inventory_status', 0);
                $this->db->group_end();

            $this->db->group_end();

            $this->db->from('item');
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $items = $sql_query->result_array();
                $response['status'] = true;
            }else{
                $response['status'] = false;
            }

            $response['items'] = $items;

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

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
            $this->db->group_end();

            $this->db->where('status',1);  
            $this->db->where('deleted_at',NULL);  
            $this->db->from('promocode'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $all_customer_promocode = $sql_query->result_array();
                foreach ($all_customer_promocode as $key => $value) {
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

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
            $this->db->group_end();

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $group_of_shops_promocode = $sql_query->result_array();
                foreach ($group_of_shops_promocode as $key => $value){
                    array_push($valid_promocodes, $group_of_shops_promocode[$key]);
                }
            }

            // Get customer total completed order
            $where = array('customer_id' => $_POST['customer_id'], 'order_status' => 6);
            $select = array('id');
            $table = 'orders';
            $customer_total_orders_array = get_data_by_filter($table,$select, $where);
            $customer_total_orders = count($customer_total_orders_array);

            $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $_POST['shop_id'], 'order_status' => 5);
            $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
            $customer_total_shop_orders = count($customer_total_shop_orders_array);

            $X_ordered_promocode = array();

            // Get promocode ( Number of X ordered Customers - order based) GROUP 6 (Admin - vender)
            $this->db->select('*'); 

            $this->db->group_start();
                $this->db->group_start();
                    $this->db->where('shop_id','');  
                    $this->db->where('min_no_of_orders <=', $customer_total_orders);  
                $this->db->group_end();

                $this->db->or_group_start();
                    $this->db->where('shop_id',$_POST['shop_id']);  
                    $this->db->where('min_no_of_orders <=', $customer_total_shop_orders);  
                $this->db->group_end();
            $this->db->group_end();

            
            $this->db->where('group_type',6);  

            $this->db->group_start();
                $this->db->where('from_date <=', $today);
                $this->db->where('to_date >=', $today);
            $this->db->group_end();

            
            $this->db->where('status',1);  
            $this->db->where('deleted_at',NULL);  

            $this->db->group_start();
                $this->db->where('promo_min_order_amount', '');
                $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
            $this->db->group_end();

            $this->db->from('promocode'); 
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $X_ordered_promocode = $sql_query->result_array();
                foreach ($X_ordered_promocode as $key => $value){
                    array_push($valid_promocodes, $X_ordered_promocode[$key]);
                }
            }

            // If no any ordered from any shop - promocode by admin - GROUP 1
            $new_customer_for_admin_promocode = array();
            if($customer_total_orders == 0){
                $this->db->select('*'); 

                $this->db->where('shop_id','');  
                $this->db->where('group_type',1);  

                $this->db->group_start();
                    $this->db->where('from_date <=', $today);
                    $this->db->where('to_date >=', $today);
                $this->db->group_end();

                $this->db->group_start();
                    $this->db->where('promo_min_order_amount', '');
                    $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
                $this->db->group_end();

                $this->db->where('status',1);  
                $this->db->where('deleted_at',NULL);  
                $this->db->from('promocode'); 
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $new_customer_for_admin_promocode = $sql_query->result_array();
                    foreach ($new_customer_for_admin_promocode as $key => $value){
                        array_push($valid_promocodes, $new_customer_for_admin_promocode[$key]);
                    }
                }

            }else{

                // Get customer total completed order for this shop
                $where = array('customer_id' => $_POST['customer_id'],'shop_id' => $_POST['shop_id'], 'order_status' => 6);
                $select = array('id');
                $table = 'orders';
                $customer_total_shop_orders_array = get_data_by_filter($table,$select, $where);
                $customer_total_shop_orders = count($customer_total_shop_orders_array);
                $X_shop_ordered_promocode = array();

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

                    $this->db->group_start();
                        $this->db->where('promo_min_order_amount', '');
                        $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
                    $this->db->group_end();

                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $new_customer_for_shop_promocode = $sql_query->result_array();
                        foreach ($new_customer_for_shop_promocode as $key => $value) {
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
                        foreach ($new_customer_for_shop_promocode as $key => $value){
                            array_push($valid_promocodes, $new_customer_for_shop_promocode[$key]);
                        }
                    }
                }

                if($customer_total_shop_orders > 0){

                    // GROUP 7 PROMOCODES ARE PENDING - waiting for order

                    $customer_total_shop_orders_ids = array_column($customer_total_shop_orders_array, 'id');

                    $this->db->select('item_id');  
                    $this->db->where_in('order_id',$customer_total_shop_orders_ids);  
                    $this->db->from('order_items'); 
                    $sql_query = $this->db->get();
                    $customer_total_item_orders_array = $sql_query->result_array();
                    $customer_total_ordered_items = array_column($customer_total_item_orders_array, 'item_id');
                    $customer_total_ordered_items = array_unique($customer_total_ordered_items);

                    // get promocode for this shop - have to orderd these products

                    $this->db->select('id'); 
                    $this->db->where('shop_id',$_POST['shop_id']);  
                    $this->db->where('group_type',7);  

                    $this->db->group_start();
                        $this->db->where('from_date <=', $today);
                        $this->db->where('to_date >=', $today);
                    $this->db->group_end();

                    $this->db->where('status',1);  
                    $this->db->where('deleted_at',NULL);  

                    $this->db->group_start();
                        $this->db->where('promo_min_order_amount', '');
                        $this->db->or_where('promo_min_order_amount <=', floatval($_POST['total_amount']));
                    $this->db->group_end();

                    $this->db->from('promocode'); 
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){

                        $promocode_shop_group7_array = $sql_query->result_array();
                        $promocode_shop_group7_ids = array_column($promocode_shop_group7_array, 'id');
                        
                        $this->db->select('*'); 
                        $this->db->where('shop_id',$_POST['shop_id']);  
                        $this->db->where_in('promocode_id',$promocode_shop_group7_ids);  
                        $this->db->from('promocode_products'); 
                        $sql_query = $this->db->get();
                        $promocode_haveto_ordeded_products = $sql_query->result_array();

                        $matched_ordered_products = array();
                        foreach ($promocode_haveto_ordeded_products as $key => $value) {
                            if(in_array($value['product_id'], $customer_total_ordered_items)){
                                $matched_ordered_products[] = $value;
                            }
                        }

                        if(isset($matched_ordered_products) && !empty($matched_ordered_products)){
                            foreach ($matched_ordered_products as $key => $value) {
                                $where = array('id' => $value['promocode_id']);
                                $select = array('*');
                                $table = 'promocode';
                                $promocode_valid_data = get_data_by_filter($table,$select, $where);
                                array_push($valid_promocodes, $promocode_valid_data[0]);
                            }
                        }

                    }

                }
            }

            $response['valid_promocodes'] = $valid_promocodes;
            $response['status'] = true;
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

            $today = date('Y-m-d');

            $this->db->select('*');
            $this->db->from('promocode');
            $this->db->where('promocode', $_POST['promocode']);
            $this->db->where('deleted_at',NULL);
            $this->db->where('status', 1);

            $this->db->group_start();
                $this->db->where("shop_id", $_POST['shop_id']);
                $this->db->or_where("shop_id", '');
            $this->db->group_end();

            $this->db->group_start();
                $this->db->where('from_date <=', $today);
                $this->db->where('to_date >=', $today);
            $this->db->group_end();

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $promo_data = $sql_query->row();
                $group_type = $promo_data->group_type;

                if($promo_data->promo_min_order_amount > $_POST['total_amount']){
                    $response['status'] = false;
                    $response['message'] = 'Add more items to apply this promocode';
                }else{

                    // check usage_limit
                    $this->db->select('id'); 
                    $this->db->where('customer_id',$_POST['customer_id']);  
                    $success_order_status = array('0', '1', '3', '4', '5', '6');
                    $this->db->where_in('order_status',$success_order_status);  
                    $this->db->where('promocode_id',$promo_data->id);  
                    $this->db->from('orders');
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() >= $promo_data->usage_limit){
                        $response['status'] = false;
                        $response['message'] = 'Invalid Promocode';
                    }
                    else
                    {
                        $products_array = explode(',',$_POST['products']);
                        $valid_promocodes = array();
                        $valid = FALSE;

                        switch ($group_type) {
                            case 1:

                                $this->db->select('id'); 
                                $this->db->where('customer_id',$_POST['customer_id']);  
                                $this->db->from('orders'); 
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() <= 0){
                                    $valid = TRUE;
                                }
                                    
                                break;
                            case 4:
                                $valid = TRUE;
                                break;
                            case 5:
                                if($_POST['shop_id'] == $promo_data->shop_id){
                                    $valid = TRUE;
                                }
                                break;
                            case 6:
                                $orders = $promo_data->min_no_of_orders;
                                $this->db->select('id'); 
                                $this->db->where('customer_id',$_POST['customer_id']);  
                                $this->db->where('order_status',6);  
                                $this->db->from('orders'); 
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() >= intval($orders)){
                                    $valid = TRUE;
                                }
                                break;
                            case 7:

                                $this->db->select('id'); 
                                $this->db->where('customer_id',$_POST['customer_id']);  
                                $this->db->where('shop_id',$_POST['shop_id']);  
                                $this->db->where('order_status',6);  
                                $this->db->from('orders'); 
                                $sql_query = $this->db->get();

                                if ($sql_query->num_rows() > 0){
                                    $prev_orders_data = $sql_query->result_array();
                                    $prev_orders_ids = array_column($prev_orders_data, 'id');

                                    // get ordered product
                                    $this->db->select('id'); 
                                    $this->db->where_in('order_id',$prev_orders_ids);  
                                    $this->db->where_in('item_id',$products_array);  
                                    $this->db->from('order_items'); 
                                    $sql_query = $this->db->get();
                                    if ($sql_query->num_rows() > 0){
                                        $valid = TRUE;
                                    }
                                }

                                break;
                            default:
                            $valid = FALSE;
                        }

                        if($valid == TRUE){
                            $promocode_applied_products = array();
                            $promocode_applied_products2 = array();

                            if($promo_data->promo_type == 1){
                                $this->db->select('product_id'); 
                                $this->db->where('promocode_id',$promo_data->id);  
                                $this->db->where('shop_id',$_POST['shop_id']);  
                                $this->db->from('promocode_valid_product');
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() > 0){
                                    $product_ids = $sql_query->result_array();
                                    $promocode_applied_products = array_column($product_ids, 'product_id');

                                    foreach ($promocode_applied_products as $key => $value) {
                                        
                                        if(in_array($value, $products_array)){
                                            array_push($promocode_applied_products2, $value);
                                        }
                                    }
                                    //$promocode_applied_products2 = array_intersect($products_array, $promocode_applied_products);
                                }
                            }
                            $response['promocode_id'] = $promo_data->id;
                            $response['promocode'] = $_POST['promocode'];
                            $response['valid_promocode'] = $valid;
                            $response['discount_type'] = $promo_data->discount_type;
                            $response['discount_amount'] = $promo_data->amount;
                            $response['max_discount_amount'] = $promo_data->max_disc;
                            $response['promo_type'] = $promo_data->promo_type;
                            $response['promocode_applied_products'] = $promocode_applied_products2;
                            $response['status'] = true;
                        }else{
                            $response['promocode'] = $_POST['promocode'];
                            $response['valid_promocode'] = $valid;
                            $response['status'] = false;
                        }
                    }                            
                }
            }else{
                $response['status'] = false;
                $response['message'] = 'Invalid Promocode';
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

            $varients_diff_data = array();
            if(isset($prices['varients']) && is_array($prices['varients']) && !empty($prices['varients'])){

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

            $order_data =  json_decode($_POST['order_data'], TRUE);

            $postFields['customer_id'] = $order_data['customer_id']; 
            $postFields['shop_id'] = $order_data['shop_id']; 
            $postFields['order_type'] = $order_data['order_type']; 
            $postFields['payment_mode'] = $order_data['payment_mode']; 
            $postFields['payment_card_id'] = $order_data['payment_card_id'];
            if(isset($order_data['order_type']) && (($order_data['order_type'] == 1) || ($order_data['order_type'] == 2)|| ($order_data['order_type'] == 5))){
                $postFields['delivery_address_id'] = $order_data['delivery_address_id']; 
            }else{
                $address_not_required = true;
            }
            $postFields['tax'] = $order_data['tax']; 
            $postFields['service_charge'] = $order_data['service_charge']; 
            $postFields['amount'] = $order_data['amount']; 
            $postFields['products'] = $order_data['products']; 
            $postFields['delivery_charges'] = $order_data['delivery_charges']; 

            $errorPost = $this->ValidatePostFields($postFields);

            if(empty($errorPost)){

                $this->db->select('id, device_token, email, shop_name');
                $this->db->from('shop');
                $this->db->where('id', $order_data['shop_id']);
                $this->db->where('deleted_at',NULL);
                $this->db->where('admin_verified',1);
                $this->db->where('status', 1);

                $shop_error = 'Restaurant not found';
                if(($order['order_type'] == 1) || ($order['order_type'] == 2) || ($order['order_type'] == 5)){
                    $shop_error = 'Restaurant is not providing delivery order for now.';
                    $this->db->group_start();
                        $this->db->where("takeout_delivery_status", 1);
                        $this->db->or_where("takeout_delivery_status", 3);
                    $this->db->group_end();
                }else if(($order['order_type'] == 3) || ($order['order_type'] == 4) || ($order['order_type'] == 6)){
                    $shop_error = 'Restaurant is not providing takeout order for now.';
                    $this->db->group_start();
                        $this->db->where("takeout_delivery_status", 2);
                        $this->db->or_where("takeout_delivery_status", 3);
                    $this->db->group_end();
                }

                if(($order['order_type'] == 5) || ($order['order_type'] == 6)){
                    $this->db->where("weekly_status", 1);
                    $shop_error = 'Restaurant is not providing weekly order for now.';
                }
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){

                    $shop_data = (array)$sql_query->row();

                    $this->db->select('id');
                    $this->db->from('delivery_address');
                    $this->db->where('id', $order_data['delivery_address_id']);
                    $this->db->where('deleted_at',NULL);
                    $this->db->where('latitude !=', '');
                    $this->db->where('longitude !=', '');

                    $this->db->group_start();
                        $this->db->where("customer_id", $order_data['customer_id']);
                        $this->db->or_where("popular", 1);
                    $this->db->group_end();

                    $sql_query = $this->db->get();
                    if (($sql_query->num_rows() > 0) || ($address_not_required == TRUE))
                    {

                        $this->db->select('id');
                        $this->db->from('customer_payment_card');
                        $this->db->where('id', $order_data['payment_card_id']);
                        $this->db->where('customer_id', $order_data['customer_id']);
                        $this->db->where('deleted_at',NULL);
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0){

                            $promocode_error = FALSE;
                            $promocode_data = array();
                            if(isset($order_data['promocode_id']) && $order_data['promocode_id'] != ''){

                                $this->db->select('*');
                                $this->db->from('promocode');
                                $this->db->where('id', $order_data['promocode_id']);
                                $this->db->where('deleted_at',NULL);
                                $this->db->where('status', 1);

                                $this->db->group_start();
                                    $this->db->where("shop_id", $order_data['shop_id']);
                                    $this->db->or_where("shop_id", '');
                                $this->db->group_end();

                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() > 0){
                                    $promocode_data = $sql_query->row();
                                }else{
                                    $promocode_error = TRUE;
                                }
                            }

                            if($promocode_error == FALSE){

                                $order_type_error = FALSE;
                                $date = date('Y-m-d');
                                $time = date('h:i A');

                                if(($order_data['order_type'] == 2) || ($order_data['order_type'] == 4)){
                                    if(isset($order_data['later_time']) && $order_data['later_time'] != ''){
                                        $time = $order_data['later_time'];
                                    }else{
                                        $order_type_error = TRUE;
                                    }
                                }elseif(($order_data['order_type'] == 5) || ($order_data['order_type'] == 6)) {
                                    if(isset($order_data['schedule_date']) && $order_data['schedule_date'] != '' && isset($order_data['schedule_time']) && $order_data['schedule_time'] != ''){
                                        $date = $order_data['schedule_date'];
                                        $time = $order_data['schedule_time'];
                                    }else{
                                        $order_type_error = TRUE;
                                    }
                                }else{
                                    
                                }

                                if($order_type_error == FALSE){

                                    if(($order_data['order_type'] == 1) || ($order_data['order_type'] == 3)){
                                        //avaliable in curent time
                                        $day = date('l');
                                    }else if(($order_data['order_type'] == 2) || ($order_data['order_type'] == 4)){
                                        //available in today later time
                                        $day = date('l');
                                    }else if(($order_data['order_type'] == 5) || ($order_data['order_type'] == 6)){
                                        // available in schedule date & time
                                        $my_schedule_date = DateTime::createFromFormat('Y-m-d', $order_data['schedule_date']);
                                        $day = $my_schedule_date->format('l');
                                    }else{
                                        $day = NULL;
                                    }

                                    $shop_open = FALSE;
                                    if(isset($day) && !is_null($day) && $day != ''){
                                        $this->db->select('from_time,to_time,full_day');
                                        $this->db->from('shop_availibality');
                                        $this->db->where('shop_id', $order_data['shop_id']);
                                        $this->db->where('is_closed', 0);
                                        $this->db->where('day',$day);
                                        $sql_query = $this->db->get();
                                        if ($sql_query->num_rows() > 0){
                                            $availibality_data = (array)$sql_query->row();
                                            if($availibality_data['full_day'] == 1){
                                                $shop_open = TRUE;
                                            }else{
                                                // add validation for shop timing
                                                $shop_open = TRUE;
                                            }
                                            
                                        }else{
                                            $shop_open = FALSE;
                                        }
                                    }else{
                                        $shop_open = TRUE;
                                    }

                                    if($shop_open == TRUE){

                                        $order_products_array = array();
                                        if(is_array($order_data['products']) && !empty($order_data['products'])){
                                            foreach ($order_data['products'] as $product_key => $product_value) {
                                                
                                                $this->db->select('*');
                                                $this->db->from('item');
                                                $this->db->where('id', $product_value['product_id']);
                                                $this->db->where('shop_id', $order_data['shop_id']);

                                                $this->db->group_start();
                                                    $this->db->group_start();
                                                        $this->db->where('quantity >=', intval($product_value['qty']));
                                                        $this->db->where('inventory_status', 1);
                                                    $this->db->group_end();

                                                    $this->db->or_group_start();
                                                         $this->db->where('inventory_status', 0);
                                                    $this->db->group_end();
                                                $this->db->group_end();

                                                $this->db->where('deleted_at',NULL);
                                                $this->db->where('is_active',1);
                                                $sql_query = $this->db->get();
                                                if ($sql_query->num_rows() > 0){
                                                    array_push($order_products_array, $sql_query->result_array());
                                                }
                                            }
                                        }
                                        if(count($order_products_array) == count($order_data['products'])){

                                            $order_varients_array = array();
                                            foreach ($order_data['products'] as $product_key => $product_value){
                                                if(isset($product_value['variants_id']) && is_array($product_value['variants_id']) && !empty($product_value['variants_id'])){
                                                    foreach ($product_value['variants_id'] as $variant_key => $variant_value) {
                                                        $order_varients_array[] = $variant_value;
                                                    }
                                                }
                                            }

                                            $varient_error = FALSE;
                                            if(isset($order_varients_array) && !empty($order_varients_array)){
                                                $order_varients_data_array = array();
                                                foreach ($order_varients_array as $key => $value) {
                                                    $this->db->select('*');
                                                    $this->db->from('variant_items');
                                                    $this->db->where('id', $value);
                                                    $sql_query = $this->db->get();
                                                    if ($sql_query->num_rows() > 0){

                                                    }else{
                                                        $varient_error = TRUE;
                                                        break;
                                                    }
                                                }
                                            }
                                            if($varient_error == FALSE){

                                                // if varient exists
                                                $error = '';
                                                if(($order_data['order_type'] == 2) || ($order_data['order_type'] == 4)){
                                                    if(isset($order_data['later_time']) && $order_data['later_time'] != ''){
                                                        $later_time = $order_data['later_time'];
                                                    }else{
                                                        $error = 'later_time';
                                                    }  
                                                }else{
                                                    $later_time = "";
                                                }

                                                if(isset($order_data['promocode_id']) && $order_data['promocode_id'] != "" && $order_data['promocode_id'] != "0" && !is_null($order_data['promocode_id'])){
                                                    $promocode_id = $order_data['promocode_id'];
                                                }else{
                                                    $promocode_id = '';
                                                }

                                                if(($order_data['order_type'] == 5) || ($order_data['order_type'] == 6)){
                                                    if(isset($order_data['schedule_date']) && $order_data['schedule_date'] != '' && isset($order_data['schedule_time']) && $order_data['schedule_time'] != ''){
                                                        $schedule_date = $order_data['schedule_date'];
                                                        $schedule_time = $order_data['schedule_time'];
                                                    }else{
                                                        $error = 'schedule_date & schedule_time';
                                                    }
                                                }else{
                                                    $schedule_date = '';
                                                    $schedule_time = '';
                                                }

                                                if($error == ''){

                                                    if(($order_data['order_type'] == 3) || ($order_data['order_type'] == 4) || ($order_data['order_type'] == 6))
                                                    {
                                                        $delivery_charges = 0;
                                                    }else{
                                                        $delivery_charges = $order_data['delivery_charges'];
                                                    }

                                                    $data = array( 
                                                        'customer_id' => $order_data['customer_id'], 
                                                        'shop_id'=> $order_data['shop_id'], 
                                                        'order_type'=> $order_data['order_type'], 
                                                        'later_time'=> $later_time,
                                                        'delivery_charges' => number_format((float)$delivery_charges, 2, '.', ''),
                                                        'promocode_id'=> $promocode_id,
                                                        'promo_amount'=> '',
                                                        'tax' => $order_data['tax'],
                                                        'service_charge' => $order_data['service_charge'],
                                                        'schedule_date'=> $schedule_date,
                                                        'schedule_time'=> $schedule_time,

                                                        'order_status'=> 0,
                                                        'payment_status'=> 1,
                                                        'payment_mode'=> $order_data['payment_mode'],
                                                        'transaction_id'=> '',
                                                        'created_at'=> date('Y-m-d H:i:s')
                                                    );

                                                    if($address_not_required == true){
                                                        $data['delivery_address_id'] = 0;
                                                    }else{
                                                        $data['delivery_address_id'] = $order_data['delivery_address_id'];
                                                    }

                                                    if($this->db->insert('orders', $data)){

                                                        $order_id = $this->db->insert_id();
                                                        $my_product_data = array();
                                                        $my_variant_data = array();
                                                        $sub_total = 0;

                                                        $update_quantity = array();
                                                        $reciept_data = array();
                                                        $count = 0;
                                                        foreach ($order_data['products'] as $products_key => $products_value){

                                                            $this->db->select('IF(offer_price = "", price, offer_price) as price, quantity, name'); 
                                                            $this->db->where('id',$products_value['product_id']); 
                                                            $this->db->where('shop_id',$order_data['shop_id']); 
                                                            $this->db->from('item'); 
                                                            $sql_query = $this->db->get();
                                                            if ($sql_query->num_rows() > 0){
                                                                $product_price_array = $sql_query->row();
                                                                $item_price = $product_price_array->price;
                                                                
                                                                $reciept_data['item_data'][$count]['item_name'] = $product_price_array->name;
                                                                $reciept_data['item_data'][$count]['quantity'] = $products_value['qty'];
                                                                $reciept_data['item_data'][$count]['groups'] = array();


                                                                $update_quantity[$products_value['product_id']] = $product_price_array->quantity - $products_value['qty'];
                                                            }else{
                                                                $item_price = '';
                                                            }

                                                            $product_data = 
                                                            array(
                                                                'order_id' => $order_id,
                                                                'item_id' => $products_value['product_id'],
                                                                'item_price' => $item_price,
                                                                'variants_price' => '',
                                                                'quantity' => $products_value['qty'],
                                                                'total_product_price' => ''
                                                            );

                                                            $this->db->insert('order_items', $product_data);
                                                            $product_insert_id = $this->db->insert_id();
                                                            $my_product_data[] = $product_data;

                                                            $varients_price = 0;
                                                            $product_groups = array();
                                                            if(isset($products_value['variants_id']) && !empty($products_value['variants_id'])){
                                                                foreach ($products_value['variants_id'] as $variant_key => $variant_value){

                                                                    $this->db->select('id,variant_group_id,price'); 
                                                                    $this->db->where('id',$variant_value); 
                                                                    $this->db->where('item_id',$products_value['product_id']);
                                                                    $this->db->from('variant_items'); 
                                                                    $sql_query = $this->db->get();
                                                                    if ($sql_query->num_rows() > 0){
                                                                        $variant_array = $sql_query->row();

                                                                        $variant_data = 
                                                                            array(
                                                                                'order_item_id' => $product_insert_id,
                                                                                'variant_group_id' => $variant_array->variant_group_id,
                                                                                'variant_id' => $variant_value,
                                                                                'price' => number_format((float)$variant_array->price, 2, '.', '')
                                                                            );
                                                                        $this->db->insert('order_item_variant', $variant_data);

                                                                        $varients_price +=  number_format((float)$variant_array->price, 2, '.', '');
                                                                        //$my_variant_data[] = $variant_data;

                                                                        $product_groups[] = $variant_array->variant_group_id;
                                                                    }
                                                                }

                                                                $product_groups = array_unique($product_groups);
                                                                foreach ($product_groups as $group_key => $group_value) {
                                                                    $this->db->select('name');
                                                                    $this->db->where('id',$group_value);
                                                                    $this->db->from('variant_group'); 
                                                                    $sql_query = $this->db->get();
                                                                    if ($sql_query->num_rows() > 0){
                                                                        $group_name_data = (array)$sql_query->row();
                                                                        $reciept_data['item_data'][$count]['groups'][$group_key]['group_name'] = $group_name_data['name'];

                                                                        $this->db->select('name');
                                                                        $this->db->where_in('id',$products_value['variants_id']);
                                                                        $this->db->where('variant_group_id',$group_value);
                                                                        $this->db->from('variant_items');
                                                                        $sql_query = $this->db->get();
                                                                        if ($sql_query->num_rows() > 0){
                                                                            $my_varients = $sql_query->result_array();
                                                                            $reciept_data['item_data'][$count]['groups'][$group_key]['varients'] = array_column($my_varients, 'name');
                                                                        }

                                                                    }
                                                                }
                                                            }


                                                            $total_product_price = ($item_price + $varients_price) * $products_value['qty'];

                                                            $product_data_edited = 
                                                                    array(
                                                                        'variants_price' => number_format((float)$varients_price, 2, '.', ''),
                                                                        'total_product_price' => number_format((float)$total_product_price, 2, '.', '')
                                                                    );
                                                            $this->db->where('id',$product_insert_id); 
                                                            $this->db->update('order_items', $product_data_edited);

                                                            $reciept_data['item_data'][$count]['total_product_price'] = $total_product_price;
                                                            $reciept_data['item_data'][$count]['item_price'] = $item_price + $varients_price;

                                                            $sub_total += $total_product_price;

                                                            $count++;
                                                        }

                                                        $sub_total = number_format((float)$sub_total, 2, '.', '');
                                                        $order_data_edited = array(
                                                                            'subtotal' => $sub_total
                                                                            );

                                                        $promo_discount = 0;
                                                        if(isset($promocode_data) && !empty($promocode_data)){
                                                            if($promocode_data->promo_type == 2){
                                                                
                                                                if($promocode_data->discount_type == 0){
                                                                    $promo_discount = $promocode_data->amount;
                                                                }else{
                                                                    $promo_discount = (floatval($sub_total) * floatval($promocode_data->amount)) / 100;
                                                                }
                                                            }else{
                                                                $promocode_valid_products = $this->customer_api_model->get_promocode_valid_products($promocode_data->id);
                                                                if(isset($promocode_valid_products) && !empty($promocode_valid_products)){
                                                                    $valid_products = array();
                                                                    $valid_products = array_column($promocode_valid_products, 'product_id');
                                                                    foreach ($order_data['products'] as $products_key => $products_value){
                                                                        if (in_array($products_value['product_id'], $valid_products)){
                                                                            if($promocode_data->discount_type == 0){
                                                                                // flat
                                                                                $promo_discount += $promocode_data->amount;
                                                                            }else{
                                                                                // perc
                                                                                $total_product_price = 0;
                                                                                $this->db->select('total_product_price'); 
                                                                                $this->db->where('item_id',$products_value['product_id']); 
                                                                                $this->db->where('order_id',$order_id); 
                                                                                $this->db->from('order_items');
                                                                                $sql_query = $this->db->get();
                                                                                if ($sql_query->num_rows() > 0){
                                                                                    $total_product_price_array = $sql_query->row();
                                                                                    $total_product_price = $total_product_price_array->total_product_price;
                                                                                    $promo_discount += (floatval($total_product_price) * floatval($promocode_data->amount)) / 100;
                                                                                }
                                                                            }   
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if(isset($promocode_data->max_disc) && $promocode_data->max_disc != '' ){
                                                            $promo_discount = (floatval($promocode_data->max_disc) < floatval($promo_discount))?floatval($promocode_data->max_disc):$promo_discount;
                                                        }

                                                        $sub_total2 = floatval($sub_total) - floatval($promo_discount);
                                                        $sub_total2 = number_format((float)$sub_total2, 2, '.', '');

                                                        $tax = (floatval($sub_total2) * floatval($order_data['tax'])) / 100;
                                                        $tax = number_format((float)$tax, 2, '.', '');

                                                        $service_charge = (floatval($sub_total2) * floatval($order_data['service_charge'])) / 100;
                                                        $service_charge = number_format((float)$service_charge, 2, '.', '');

                                                        $delivery_charges = number_format((float)$order_data['delivery_charges'], 2, '.', '');


                                                        $total = $sub_total2 + $tax + $service_charge + $delivery_charges;   

                                                        $order_data_edited['promo_amount'] = number_format((float)$promo_discount, 2, '.', '');
                                                        $order_data_edited['total'] = number_format((float)$total, 2, '.', '');

                                                        $order_data_edited['QR_code'] = $this->generate_qr_code('CL'.$order_id);

                                                        $this->db->where('id',$order_id);  
                                                        $this->db->update('orders', $order_data_edited);

                                                        // Decrease in quantity of product
                                                        if(isset($update_quantity) && !empty($update_quantity)){
                                                            foreach ($update_quantity as $product_id => $updated_quantity) {
                                                                $my_quantity = ($updated_quantity < 0)?'0':$updated_quantity;
                                                                $data = array('quantity' => $my_quantity);
                                                                $this->db->where('id',$product_id);  
                                                                $this->db->update('item', $data);
                                                            }
                                                        }


                                                        $device_type = 2;
                                                        $device_token = $shop_data['device_token'];
                                                        // $device_token = 'dmNrhhh4XkU:APA91bGlecM_fLypvGUtEoOTw3HhspbioIFlJzjz2JpNBPHGnwRjXGVLelKlcQ0D_E31bjFTYho47CuMBrZg9NUfqbH1JytQG1UbCstGITYmiCDnS-rDTNMBgKvxPtLKdVJw_Oe0NwfW';
                                                        $push_title = 'Order Arrived';
                                                        $message = 'Order no. CL'.$order_id.' has been arrived';
                                                        $push_data = array(
                                                            'order_id' => $order_id,
                                                            'customer_id' => $order_data['customer_id'],
                                                            'message' => $message
                                                            );
                                                        $push_type = 'order_arrived';

                                                        $result = send_push($device_type, $device_token, $push_title, $push_data, $push_type);

                                                        // Send mail to vender for order recieved
                                                        $reciept_data['subtotal'] = $sub_total2;
                                                        $reciept_data['tax'] = $tax;
                                                        $reciept_data['service_charge'] = $service_charge;
                                                        $reciept_data['delivery_charges'] = $delivery_charges;
                                                        $reciept_data['promo_amount'] = $order_data_edited['promo_amount'];
                                                        $reciept_data['total'] = $order_data_edited['total'];
                                                        $reciept_data['order_id'] = $order_id;
                                                        $reciept_data['line1'] = 'You Got New Order!';
                                                        $reciept_data['line2'] = 'Accept the order as soon as possible';

                                                        $email_data = $this->load->view('email_templates/order_receipt', $reciept_data, true);
                                                        $email_to_vender = sendmail($from = '', $to = $shop_data['email'], $subject = 'New Order Recieved', $email_data);

                                                        $this->db->select('email'); 
                                                        $this->db->where('id',$order_data['customer_id']); 
                                                        $this->db->from('customer'); 
                                                        $sql_query = $this->db->get();
                                                        if ($sql_query->num_rows() > 0){
                                                            $customer_email = (array)$sql_query->row();

                                                            $reciept_data['line1'] = 'Thank You for Your Order!';
                                                            $reciept_data['line2'] = 'Satisfy your cravings with a huge selection of restaurants.';

                                                            $email_data = $this->load->view('email_templates/order_receipt', $reciept_data, true);

                                                             $email_to_customer = sendmail($from = '', $to = $customer_email['email'], $subject = 'Your Order: CL'.$order_id.' From '.$shop_data['shop_name'].' Has been Confirmed', $email_data);
                                                        }

                                                        
                                                        $response['order'] = true;    
                                                        $response['status'] = true;    
                                                        $response['order_id'] = $order_id;    
                                                        $response['email_to_vender'] = $email_to_vender;    
                                                        $response['email_to_customer'] = $email_to_customer;    

                                                    }else{
                                                        $response['status'] = false;
                                                        $response['message'] = 'Server encountered an error. please try again';
                                                    }       
                                                    

                                                }else{
                                                    $response['status'] = false;
                                                    $response['message'] = $error.' field is required'; 
                                                }
                                            }else{
                                                $response['status'] = false;
                                                $response['message'] = 'Varients not found. Please refresh the cart.'; 
                                            }

                                        }else{
                                            $response['status'] = false;
                                            $response['message'] = 'Product not found. Please refresh the cart.'; 
                                        }
                                        
                                    }else{
                                        $response['status'] = false;
                                        $response['message'] = 'Sorry! This restaurant does not provice service for this time';
                                    }

                                }else{
                                    $response['status'] = false;
                                    $response['message'] = 'later_time or schedule_date or schedule_time not found';
                                }

                            }else{
                                $response['status'] = false;
                                $response['message'] = 'Promocode is not valid';
                            }

                        }else{
                            $response['status'] = false;
                            $response['message'] = 'Payment card does not found';
                        }

                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Delivery address does not found';
                    }

                }else{
                    $response['status'] = false;
                    $response['message'] = $shop_error;
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

    public function get_reorder_data_post(){
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['customer_id'] = $_POST['customer_id'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            $this->db->select('*');
            $this->db->from('orders');
            $this->db->where("id", $_POST['order_id']);
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $order = (array)$sql_query->row();

                // check shop is providing takeout or delievry not
                $this->db->select('id,service_charge,charges_of_minimum_mile');
                $this->db->from('shop');

                if(($order['order_type'] == 5) || ($order['order_type'] == 6)){
                    $this->db->where("weekly_status", 1);
                    $order_type = 'weekly ';
                }

                if($order['order_type'] == 1 || ($order['order_type'] == 2) || ($order['order_type'] == 5))
                {
                    $order_type .= 'delivery';
                    $this->db->group_start();
                        $this->db->where("takeout_delivery_status", 1);
                        $this->db->or_where("takeout_delivery_status", 3);
                    $this->db->group_end();
                }else if(($order['order_type'] == 3) || ($order['order_type'] == 4) || ($order['order_type'] == 6))
                {
                    $order_type .= 'takeout';
                    $this->db->group_start();
                        $this->db->where("takeout_delivery_status", 2);
                        $this->db->or_where("takeout_delivery_status", 3);
                    $this->db->group_end();
                }else{
                    $order_type .= 'service';
                }

                $this->db->where('id',$order['shop_id']);
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){

                    $shop_data = (array)$sql_query->row();
                    // get order product data
                    $this->db->select('*');
                    $this->db->from('order_items');
                    $this->db->where('order_id',$_POST['order_id']);
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $orders_item_data = $sql_query->result_array();

                        $error = FALSE;
                        $products = array();
                        foreach ($orders_item_data as $key => $value) {

                            // check product avaibility, status, quntity, cuisine, category

                            $sql_select = array(
                                            't1.id',
                                            'IF(t1.offer_price = "", t1.price, t1.offer_price) as price',
                                            't1.name',
                                            't1.item_picture',
                                            't1.is_combo'
                            );

                            $this->db->select($sql_select);
                            $this->db->from('item t1');
                            $this->db->where('t1.id',$value['item_id']);
                            $this->db->where('t1.is_active',1);
                            $this->db->where('t1.deleted_at',NULL);
                            $this->db->where('t2.is_active',1);
                            $this->db->where('t2.deleted_at',NULL);
                            $this->db->where('t3.status',1);
                            $this->db->where('t3.deleted_at',NULL);

                            $this->db->group_start();

                                $this->db->group_start();
                                    $this->db->where('t1.quantity >=', intval($value['quantity']));
                                    $this->db->where('t1.inventory_status', 1);
                                $this->db->group_end();

                                $this->db->or_group_start();
                                     $this->db->where('t1.inventory_status', 0);
                                $this->db->group_end();

                            $this->db->group_end();

                            $this->db->join('cuisine t2', 't1.cuisine_id = t2.id');
                            $this->db->join('category t3', 't1.category_id = t3.id');
                            $sql_query = $this->db->get();
                            if ($sql_query->num_rows() > 0){

                                $products[$key] = (array)$sql_query->row();
                                $products[$key]['quantity'] = $value['quantity'];

                            }else{
                                $error = TRUE;
                                $message = 'Product(s) not avalilable any more.';
                                continue;
                            }
                        }
                        if($error == TRUE){
                            $response['status'] = false;
                            $response['message'] = $message;
                        }else{

                            // get order items varients
                            $variant_ids = array();
                            foreach ($orders_item_data as $key => $value) {
                                $this->db->select('variant_id');
                                $this->db->from('order_item_variant');
                                $this->db->where_in('order_item_id',$value['id']);
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() > 0){
                                    $variants = $sql_query->result_array();
                                    $variant_ids = array_merge($variant_ids,array_column($variants, 'variant_id'));
                                    $products[$key]['variants'] = array_column($variants, 'variant_id');
                                }
                            }

                            // check if order varients exists check in database exists or not
                            if(isset($variant_ids) && !empty($variant_ids)){
                                $this->db->select('*');
                                $this->db->from('variant_items');
                                $this->db->where_in('id',$variant_ids);
                                $sql_query = $this->db->get();
                                if ($sql_query->num_rows() == count($variant_ids)){
                                    $variant_items_data = $sql_query->result_array();
                                    foreach ($variant_items_data as $key => $value) {
                                        foreach ($products as $key1 => $value1) {
                                            if($value1['id'] == $value['item_id']){
                                                $varient_price = $value['price'];
                                                $products[$key1]['price'] += $value['price'];
                                                $products[$key1]['price'] = number_format((float)$products[$key1]['price'], 2, '.', '');
                                            }
                                        }
                                    }
                                }else{
                                    $error = TRUE;
                                    $message = 'Product varient(s) not avalilable any more.';
                                }
                            }

                            if($error == TRUE){
                                $response['status'] = false;
                                $response['message'] = $message;
                            }else{

                                $order_data = array('order_type' => $order['order_type']);
                                $order_data['shop_id'] = $shop_data['id'];
                                $order_data['tax'] = $this->get_tax();
                                $order_data['delivery_charges'] = $shop_data['charges_of_minimum_mile'];
                                $order_data['service_charge'] = $shop_data['service_charge'];
                                $order_data['products'] = $products;
                                $response['order_data'] = $order_data;
                                $response['status'] = TRUE;
                                
                            } 
                        }
                        
                    }else{
                        $response['status'] = false;
                    }
                }
                else{
                    $response['status'] = false;
                    $response['message'] = 'Restaurant is not providing '.$order_type;
                }
            }else{
                $response['message'] = 'Order data not found';                  
                $response['status'] = FALSE; 
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
                        $response['status'] = true;
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

    public function order_detail_post(){
        $postFields['order_id'] = $_POST['order_id']; 
        if(empty($errorPost)){

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
                            'IF(t1.order_type=6, t1.schedule_date, "") as schedule_date',
                            'IF(t1.order_type=6, t1.schedule_time, "") as schedule_time',
                            'IF(t1.order_type=2, t1.later_time, "") as later_time',
                            't1.created_at',
                            't1.QR_code',
                            't1.rating'
            );
            $this->db->select($sql_select);

            $this->db->from('orders t1');
            $this->db->join('customer t2', 't1.customer_id = t2.id','left');
            $this->db->join('shop t3', 't1.shop_id = t3.id','left');
            $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id','left');

            $this->db->where('t1.id', $_POST['order_id']);
            //$this->db->where('t1.order_status', 4);

            // $this->db->group_start();
            //     $this->db->where('t1.order_type', 1);
            //     $this->db->or_where('t1.order_type', 2);
            // $this->db->group_end();

            $sql_query = $this->db->get();

            if ($sql_query->num_rows() > 0){
                $orders_data = (array)$sql_query->row();

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
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function search_post(){
        $postFields['keyword'] = $_POST['keyword']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            if(strlen($_POST['keyword']) > 0){

                // get delivery_available_mile
                $delivery_available_mile = '';
                $this->db->select('data');
                $this->db->where("name", 'delivery_available_mile');
                $this->db->from('setting');
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $delivery_available_mile_data = $sql_query->row();
                    $delivery_available_mile = $delivery_available_mile_data->data;
                }
                
                $sql_select = array(
                                "id",
                                "shop_name",
                                "profile_picture",
                                "takeout_delivery_status",
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

                }

                $this->db->select($sql_select);

                if(isset($_POST['latitude']) && $_POST['latitude'] != "" && isset($_POST['longitude']) && $_POST['longitude'] != "" && $delivery_available_mile != ''){
                    $this->db->order_by("distance", "asc");
                    $this->db->having("distance <=", $delivery_available_mile);
                }

                $this->db->where("longitude !=", '');
                $this->db->where("latitude !=", '');
                $this->db->where("deleted_at", NULL);
                $this->db->where("status", 1);

                $this->db->where("shop_name LIKE '%".$_POST['keyword']."%'");

                $this->db->from('shop');
                $sql_query = $this->db->get();
                $last = $this->db->last_query();
                if ($sql_query->num_rows() > 0){
                    $shop_data = $sql_query->result_array();
                    $shop_array = array_column($shop_data, 'id');

                    $sql_select = array(
                                    "t2.cuisine_name",
                                    "t1.shop_id"
                                );

                    $this->db->select($sql_select);
                    $this->db->where("t2.deleted_at", NULL);
                    //$this->db->where("t2.is_active", 1);
                    $this->db->where_in("t1.shop_id", $shop_array);
                    $this->db->from('shop_cuisines t1');
                    $this->db->join('cuisine t2', 't1.cuisine_id = t2.id', "left join");
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $cuisine_data = $sql_query->result_array();                        
                    }

                    // Add cuisines to shop array
                    foreach ($shop_data as $key => $value) {

                        $rating = get_rating($value['id']);
                        $shop_data[$key]['rating'] = number_format((float)$rating, 2, '.', '');

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
            }else{
                $response['status'] = false;
                $response['message'] = 'Please type more for search';
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function order_history_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

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

            if(isset($_POST['cuisines']) && !is_null($_POST['cuisines']) && $_POST['cuisines'] != ''){
                $cuisines = explode(',', $_POST['cuisines']);
                $this->db->join('order_items t4', 't1.id = t4.order_id','left');
                $this->db->join('item t5', 't4.item_id = t5.id','left');
                $this->db->where_in('t5.cuisine_id',$cuisines);
                $response['cuisines'] = $cuisines;
            }

            if(isset($_POST['date']) && !is_null($_POST['date']) && $_POST['date'] != ''){
                $this->db->where('DATE(t1.created_at)', $_POST['date']);
            }
            $this->db->where('t1.customer_id',$_POST['customer_id']);
            $this->db->order_by("t1.created_at", "desc");

            $limit = 10; // messages per page
            if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
                $start = $limit * ($_POST['page_number'] - 1);
                $this->db->limit($limit, $start);
            }else{
                if(isset($_POST['keyword']) && !is_null($_POST['keyword']) && $_POST['keyword'] != ''){
                    $this->db->where("t3.shop_name LIKE '%".$_POST['keyword']."%'");
                }else{
                    $this->db->limit($limit);
                }
            }

            

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $orders_data = $sql_query->result_array();

                $response['orders'] = $orders_data;
                $response['status'] = TRUE;
            }else{
                $response['message'] = 'No any order history found';                  
                $response['status'] = FALSE; 
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function weekly_order_history_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            $sql_select = array(
                            't1.id',
                            't1.total',
                            't1.order_type',
                            't1.order_status',
                            't1.favourite',
                            't3.shop_name',
                            't3.address as shop_address',
                            't3.profile_picture as shop_picture',
                            't1.created_at',
                            't1.schedule_date'
            );
            $this->db->select($sql_select);

            $this->db->from('orders t1');
            $this->db->join('shop t3', 't1.shop_id = t3.id','left');

            $this->db->where('t1.customer_id',$_POST['customer_id']);
            $this->db->order_by("t1.created_at", "desc");

            $order_status = array('0','1', '2', '3', '4', '5');
            $order_type = array('5' ,'6');
            $this->db->where_in('t1.order_type', $order_type);
            $this->db->where_in('t1.order_status', $order_status);

            $today = date('Y-m-d');
            $add_days = 6;
            $added_date = date('Y-m-d',strtotime($today) + (24*3600*$add_days));

            $this->db->where('DATE(t1.schedule_date) >=', $today);  
            $this->db->where('DATE(t1.schedule_date) <=', $added_date);  

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $orders_data = $sql_query->result_array();

                $response['orders'] = $orders_data;
                $response['status'] = TRUE;
            }else{
                $response['message'] = 'No any order history found';                  
                $response['status'] = FALSE; 
            }


        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function favourite_orders_post(){
        $postFields['customer_id'] = $_POST['customer_id']; 

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){

            $sql_select = array(
                            't1.id',
                            't1.total',
                            't1.order_type',
                            't1.order_status',
                            't3.shop_name',
                            't3.address as shop_address',
                            't3.profile_picture as shop_picture',
                            't1.created_at'
            );
            $this->db->select($sql_select);

            $this->db->from('orders t1');
            $this->db->join('shop t3', 't1.shop_id = t3.id','left');

            $this->db->where('t1.customer_id',$_POST['customer_id']);
            $this->db->where('t1.favourite',1);
            $this->db->order_by("t1.created_at", "desc");

            $limit = 10; // messages per page
            if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
                $start = $limit * ($_POST['page_number'] - 1);
                $this->db->limit($limit, $start);
            }else{
                if(isset($_POST['keyword']) && !is_null($_POST['keyword']) && $_POST['keyword'] != ''){
                    $this->db->where("t3.shop_name LIKE '%".$_POST['keyword']."%'");
                }else{
                    $this->db->limit($limit);
                }
            }
            

            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $orders_data = $sql_query->result_array();
                $response['orders'] = $orders_data;
                $response['status'] = TRUE;
            }else{
                $response['message'] = 'No any order history found';                  
                $response['status'] = FALSE; 
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function favourite_add_remove_post(){
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['favourite_status'] = $_POST['favourite'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $update_data = array('favourite' => intval($_POST['favourite']));
            $this->db->where('id', intval($_POST['order_id']));
            if($this->db->update('orders', $update_data)){
                $response['status'] = true;
                $response['message'] = 'Favourite order updated';    
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function rating_post(){
        
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['star'] = $_POST['star'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $update_data = array('rating' => number_format((float)$_POST['star'], 1, '.', '') );
            $this->db->where('id', intval($_POST['order_id']));
            if($this->db->update('orders', $update_data)){
                $response['status'] = true;
                $response['message'] = 'Thank you for rating';    
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
    }

    public function cancel_weekly_order_post(){
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['customer_id'] = $_POST['customer_id'];

        if(empty($errorPost)){

            $data = array('order_status' => 8);
            $this->db->where('id',$_POST['order_id']);
            if($this->db->update('orders',$data)){

                $this->db->select('t1.quantity as order_quantity, t2.quantity as item_quantity, t1.item_id');
                $this->db->from('order_items t1');
                $this->db->join('item t2', 't1.item_id = t2.id');
                $this->db->where("order_id", $_POST['order_id']);
                $sql_query = $this->db->get();
                if ($sql_query->num_rows() > 0){
                    $quantity_data = $sql_query->result_array();

                    foreach ($quantity_data as $key => $value) {

                        $quantity = $value['item_quantity'] + $value['order_quantity'];
                        $data = array('quantity' => $quantity);
                        $this->db->where("id", $value['item_id']);
                        $this->db->where("inventory_status", 1);
                        $this->db->update('item',$data);
                        
                    }

                }
                $response['status'] = true;
                $response['message'] = 'Order cancelled successfully';
            }else{
                $response['status'] = false;
                $response['message'] = 'Server encountered an error. please try again';
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function notifications_post(){
        $postFields['customer_id'] = $_POST['customer_id'];

        if(empty($errorPost)){

            $notification_data = array();
            $this->db->select('*');
            $this->db->from('notification');
            $this->db->where("customer_id", $_POST['customer_id']);
            $this->db->order_by("created_at", "desc");

            $limit = 10; // messages per page
            if(isset($_POST['page_number']) && $_POST['page_number'] != "" && $_POST['page_number'] != "1"){
                $start = $limit * ($_POST['page_number'] - 1);
                $this->db->limit($limit, $start);
            }else{
                $this->db->limit($limit);
            }
        
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
                $notification_data = $sql_query->result_array();
                foreach ($notification_data as $key => $value) {

                    $notification_data[$key]['profile_picture'] = '';
                    $this->db->select('t1.profile_picture');
                    $this->db->from('shop t1');
                    $this->db->join('orders t2', 't2.shop_id = t1.id');
                    $this->db->where("t2.id", $value['order_id']);
                    $sql_query = $this->db->get();
                    if ($sql_query->num_rows() > 0){
                        $shop_data = (array)$sql_query->row();
                        $notification_data[$key]['profile_picture'] = $shop_data['profile_picture'];
                    }

                }
                $response['status'] = true;
            }else{
                $response['status'] = false;
            }
            $response['notification'] = $notification_data;

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function generate_qr_code($data_string = NULL){
        $return_data = NULL;
        if(isset($data_string) && !is_null($data_string)){

            $unique_code = $data_string;
            $googleapis = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$unique_code."&choe=UTF-8";
            $file = file_get_contents($googleapis);

            $path = FCPATH . $this->config->item("qr_code_path").'/'.$unique_code.'.png';
            if(file_put_contents($path, $file)){
                $return_data = $unique_code.".png";
            }else{
                $return_data = '';
            }
            
        }
        return $return_data;
    }

    public function test_post(){
        $img_mae = $this->generate_qr_code($_POST['data']);
        $response['img_mae'] = $img_mae;
        $this->response($response);
    }

    public function get_tax(){

        $return = '';
        $this->db->select('data');
        $this->db->where("name", 'tax');
        $this->db->from('setting');
        $sql_query = $this->db->get();
        if ($sql_query->num_rows() > 0){
            $tax_data = $sql_query->row();
            $return = $tax_data->data;
        }

        return $return;
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

    public function send_push_get(){
        

            $key = $this->config->item('fcm_key');
            define('API_ACCESS_KEY', $key);
            $token = "ej1d0qJEZsU:APA91bGBLPdUqLEMJaDUYAs0o27Vu7JLLa3rStanyp2RZn8NZwEncRRNTegQvap7YfU3IwZ_3GnAM-qGbmlhX9dHb2Wzx6WXFvSB5csgCbnHcLGINEbBcskGM8NIs_DhkNNh6LBTw_BB"; 
            $push_message = 'This is test notification from dhrumi2';

            $push_data = array('message' => $push_message);
            $push_title = 'Information from Dhrumi';
            $message_type = 'Test Type';

                $fcmFields = array(
                    'priority' => 'high',
                    'to' => $token,
                    'sound' => 'default',
                    'data' => array( 
                        "title"=> $push_title,
                        "body"=> $push_message,
                        "type"=> $message_type,
                        )
                    );

            $headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
             
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
            $result = curl_exec($ch );
            curl_close( $ch ); 
            //echo $fcmFields . "\n\n";
            print_r($fcmFields);
            print_r($result);
            return $result;
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