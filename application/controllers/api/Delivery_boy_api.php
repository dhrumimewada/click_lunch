<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(1);

class Delivery_boy_api extends REST_Controller {
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
            $this->db->where("deleted_at",NULL);
            $this->db->where("status",1);
            $this->db->from("delivery_boy");
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){
            	$delivery_boy = $sql_query->row();
            	if (password_verify($_POST['password'],$delivery_boy->password)){

            		$data = array('device_token' => $_POST['device_token']);

                    if(isset($_POST['latitude']) && $_POST['latitude'] != "" && !is_null($_POST['latitude']) && isset($_POST['longitude']) && $_POST['longitude'] != "" && !is_null($_POST['longitude'])){
                        $data['latitude'] = $_POST['latitude'];
                        $data['longitude'] = $_POST['longitude'];
                    }

                $this->db->where('id',$delivery_boy->id);
                $this->db->update('delivery_boy',$data);

                $response['status'] = true;
                $response['profile'] = (array)$delivery_boy;

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
        
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id'];

        $errorPost = $this->ValidatePostFields($postFields);
        if(empty($errorPost)){
            $where = array('id' => intval($_POST['delivery_boy_id']), 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('delivery_boy',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';   
            }else{
                $data = array('device_token' => '', 'latitude' => '','longitude' => '' );
                $this->db->where('id',$_POST['delivery_boy_id']);
                if($this->db->update('delivery_boy',$data)){
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
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
        	$this->db->select('password');
	        $this->db->where("deleted_at",NULL);
	        $this->db->where("status",1);
	        $this->db->where("id",$_POST['delivery_boy_id']);
	        $this->db->from("delivery_boy");
	        $sql_query = $this->db->get();
	        if ($sql_query->num_rows() > 0){
	        	$data = $sql_query->row();
	        	if (!password_verify($_POST['current_password'], $data->password)){
	        		$response['status'] = false;
                	$response['message'] = 'Your current password is incorrect';
                	$response['password'] = $data->password;
           	 	}else{
           	 		$user_data = array('password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT) );
                	$this->db->where('id',$_POST['delivery_boy_id']);
                	if($this->db->update('delivery_boy',$user_data)){
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
            $user = (array)$this->db->get_where('delivery_boy',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $to =  array($_POST['email']);
                $subject = $this->config->item('site_name').' - Reset Password';
                $path = BASE_URL().'email_template/reset_password.html';
                $template = file_get_contents($path);

                $remember_token = bin2hex(random_bytes(20));
                $reset_url = base_url() . 'delivery-boy-reset-password/'. $remember_token;

                $template = str_replace('##RESETPWURL##', $reset_url, $template);
                $template = str_replace('##USERNAME##', $user['username'], $template);

                $template = $this->create_email_template($template);

                $mail = $this->send_mail($to,$subject,$template);

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
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 
        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){

            $where = array('id' => $_POST['delivery_boy_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('delivery_boy',$where)->row();
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
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id'];

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost))
        {
            $where = array('id' => $_POST['delivery_boy_id'],'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('delivery_boy',$where)->row();
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

                if (isset($_FILES['image']) && !empty($_FILES['image']) && strlen($_FILES['image']['name']) > 0) {

                    //save new image in folder
                    $config['upload_path'] = FCPATH . $this->config->item("delivery_boy_profile_path");
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['encrypt_name'] = false;
                    $config['file_name'] = 'delivery_boy' . '_' . time();
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
                        $this->db->where('id', intval($_POST['delivery_boy_id']));
                        $this->db->from('delivery_boy');
                        $sql_query = $this->db->get();
                        if ($sql_query->num_rows() > 0) {
                            $return_data = $sql_query->row();
                            $image_old = $return_data->image;

                            if (isset($image_old) && !empty($image_old)) {
                                if (file_exists(FCPATH . $this->config->item("delivery_boy_profile_path") . "/" . $image_old)) {
                                    unlink(FCPATH . $this->config->item("delivery_boy_profile_path") . "/" . $image_old);
                                }
                            }
                        }

                        $user_data['profile_picture'] = $image_data['file_name'];
                    }
                }



                $user_data['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id',$_POST['delivery_boy_id']);
                if($this->db->update('delivery_boy',$user_data)){

                    $where = array('id' => $_POST['delivery_boy_id'],'status' => '1', 'deleted_at' => NULL);
                    $updated_user_data = (array)$this->db->get_where('delivery_boy',$where)->row();

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

    public function create_email_template($template){
       $base_url = BASE_URL();
       $template = str_replace('##SITEURL##', $base_url, $template);
       // $template = str_replace('##SITENAME##', $this->config->item('site_name'), $template);
       // $template = str_replace('##SITEEMAIL##', $this->config->item('site_email'), $template);
       // $template = str_replace('##COPYRIGHTS##', $this->config->item('copyrights'), $template);
       // $template = str_replace('##EMAILTEMPLATELOGO##', $this->config->item('email_template_logo'), $template);
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