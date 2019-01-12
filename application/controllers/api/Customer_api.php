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

	public function test_get()
	{
		$response['status'] = false;
		$this->response($response);
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
        $postFields['latitude'] = $_POST['latitude'];
        $postFields['longitude'] = $_POST['longitude'];   

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
	                    'device_token' => $_POST['device_token'],
	                    'latitude' => $_POST['latitude'],
	                    'longitude' => $_POST['longitude']
	                     );

                $this->db->where('id',$customer->id);
                $this->db->update('customer',$data);

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

    public function setting_post($value=''){
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

    public function add_delivery_address_post($value=''){
        $postFields['customer_id'] = $_POST['customer_id']; 
        $postFields['house_no'] = $_POST['house_no']; 
        $postFields['street'] = $_POST['street']; 
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

    public function delete_delivery_address_post($value=''){
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