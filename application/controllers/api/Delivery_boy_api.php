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
        $postFields['device_type'] = $_POST['device_type']; 

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

                    $data = array('device_type' => $_POST['device_type'], 'device_token' => $_POST['device_token']);

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
            $data = array('device_token' => '', 'device_type' => '0', 'latitude' => '','longitude' => '' );
            $this->db->where('id',$_POST['delivery_boy_id']);
            if($this->db->update('delivery_boy',$data)){
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

    public function forgot_password_post(){
        $postFields['email'] = $_POST['email']; 

        $errorPost = $this->ValidatePostFields($postFields);

        if(empty($errorPost)){
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
                $this->db->where('email', $_POST['email']);
                $this->db->update('delivery_boy', $update_data);

                $response['status'] = true;
                $response['message'] = 'Password recovery mail has been sent on this email address';

             }else{

                $response['status'] = false;
                $response['message'] = 'Error into sending mail. please try again later';

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

        if(empty($errorPost)){

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

    public function send_custom_push_post(){
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['customer_id'] = $_POST['customer_id'];
        $postFields['message'] = $_POST['message'];

        if(empty($errorPost)){
            $where = array('id' => intval($_POST['customer_id']),'status' => '1', 'deleted_at' => NULL);
            $user = (array)$this->db->get_where('customer',$where)->row();
            if(empty($user)){
                $response['status'] = false;
                $response['message'] = 'User not found';
            }else{
                $device_type = $user['device_type'];
                $device_token = $user['device_token'];

                if($device_type != '' && $device_token != '' && (($device_type == 1) || ($device_type == 2)) ){
                    $push_title = 'New message for order: CL'.$_POST['order_id'];
                    $push_data = array(
                        'order_id' => $_POST['order_id'],
                        'message' => $_POST['message']
                    );
                    $push_type = 'order_notification';
                    $result = send_push($device_type,$device_token, $push_title, $push_data, $push_type);

                    $success_data = notification_add(6, $_POST['customer_id'], $push_title, $_POST['message'], $_POST['order_id']);

                    $response['status'] = true;
                    $response['message'] = 'Notification sent';
                }else{
                    $response['status'] = true;
                    $response['message'] = 'Customer device not found';
                }
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function order_status_update_post(){
        $postFields['order_id'] = $_POST['order_id'];
        $postFields['status'] = $_POST['status'];

        if(empty($errorPost)){

            $this->db->select('t3.shop_name, t2.device_type, t2.device_token, t1.customer_id, t1.id, t2.email');
            $this->db->from('orders t1');
            $this->db->join('customer t2', 't1.customer_id = t2.id');
            $this->db->join('shop t3', 't1.shop_id = t3.id');
            $this->db->where('t1.id', $_POST['order_id']);
            $sql_query = $this->db->get();
            if ($sql_query->num_rows() > 0){

                $customer = (array)$sql_query->row();

                $data = array('order_status' => intval($_POST['status']));
                $this->db->where('id',$_POST['order_id']);
                if($this->db->update('orders',$data)){

                    if((($customer['device_type'] == 1) || ($customer['device_type'] == 2)) && ($customer['device_token'] != '') && ($_POST['status'] == 5 || 6 || 7)){

                        if($_POST['status'] == 5){
                            $push_title = 'Order Picked Up';
                            $message = 'Your order no. CL'.$_POST['order_id'].' has been picked up';
                            $push_type = 'order_picked';
                            $notification_type = 5;
                        }else if($_POST['status'] == 6){
                            $push_title = 'Order Completed';
                            $message = 'Your order no. CL'.$_POST['order_id'].' has been delivered';
                            $push_type = 'order_completed';
                            $notification_type = 7;

                        }else if($_POST['status'] == 7){
                            $push_title = 'Order Delivery Fail';
                            $message = 'Your order no. CL'.$_POST['order_id'].' has not been delivered';
                            $push_type = 'order_delivery_fail';
                            $notification_type = 8;
                        }else{

                        }
                        
                        $push_data = array(
                                'order_id' => $_POST['order_id'],
                                'customer_id' => $customer['customer_id'],
                                'message' => $message
                                );

                        $device_type = $customer['device_type'];
                        $device_token = $customer['device_token'];

                        $result = send_push($device_type, $device_token, $push_title, $push_data, $push_type);

                        $success_data = notification_add($notification_type, $customer['customer_id'], $push_title, $message, $_POST['order_id']);

                        if($_POST['status'] == 6){
                            // send mail
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
                                $to =  array($customer['email']);
                                $subject = $return_data->emat_email_subject;

                                $email_message_string = $this->parser->parse_string($return_data->emat_email_message, $email_var_data, TRUE);
                                $message = $this->load->view("email_templates/activation_mail", array("mail_body" => $email_message_string), TRUE);
                                $mail = $this->send_mail2($to, $subject, $message);
                            }
                        }

                    }

                    $response['status'] = true;
                    $response['message'] = 'Order updated successfully';
                    $response['mail'] = $mail;
                    //$response['send_push'] = $result;
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Server encountered an error. please try again';
                }

            }else{
                $response['status'] = false;
                $response['message'] = 'Order not found';    
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);
        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function order_action_post(){
        $postFields['order_id'] = $_POST['order_id']; 
        $postFields['accept_reject'] = $_POST['accept_reject']; 
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 

        if(empty($errorPost)){

            $where = array('id' => intval($_POST['delivery_boy_id']) ,'deleted_at' => NULL, 'status' => 1);
            $delivery_boy = (array)$this->db->get_where('delivery_boy',$where)->row();
            if(empty($delivery_boy)){
                $response['status'] = false;
                $response['message'] = 'User not found';    
            }else{

                $where = array('id' => intval($_POST['order_id']) ,'order_status' => 3, 'delivery_boy_id' => intval($_POST['delivery_boy_id']));
                $order = (array)$this->db->get_where('orders',$where)->row();
                if(empty($order)){
                    $response['status'] = false;
                    $response['message'] = 'This order assigned to another delivery boy';    
                }else{

                    if($_POST['accept_reject'] == 0){

                        $order_update = array('order_status' => 1 , 'delivery_boy_id' => 0 );
                        $this->db->where("id",$_POST['order_id']);
                        if($this->db->update("orders",$order_update)){
                            $response['status'] = true;
                            $response['message'] = 'Order CL'.$_POST['order_id'].' rejected';
                        }else{
                            $response['status'] = false;
                            $response['message'] = 'Server encountered an error. please try again';
                        }

                    }else if($_POST['accept_reject'] == 1){

                        $order_update = array('order_status' => 4);
                        $this->db->where("id",$_POST['order_id']);
                        if($this->db->update("orders",$order_update)){

                            $this->db->select('t2.device_type, t2.device_token, t1.customer_id, t1.id');
                            $this->db->from('orders t1');
                            $this->db->join('customer t2', 't1.customer_id = t2.id');
                            $this->db->where('t1.id', $_POST['order_id']);
                            $this->db->where('t2.device_type !=', 0);
                            $this->db->where('t2.device_type !=', '');
                            $this->db->where('t2.device_token !=', '');
                            $sql_query = $this->db->get();
                            if ($sql_query->num_rows() > 0){
                                $customer = (array)$sql_query->row();

                                $push_title = 'Delivery Boy Assigned';
                                $message = $delivery_boy['username'].' will deliver your order. You can call on '.$delivery_boy['mobile_number'].' for live update.';
                                $push_type = 'delivery_boy_assigned';

                                 $push_data = array(
                                        'order_id' => $_POST['order_id'],
                                        'customer_id' => $customer['customer_id'],
                                        'message' => $message
                                        );

                                $device_type = $customer['device_type'];
                                $device_token = $customer['device_token'];

                                $result = send_push($device_type,$device_token, $push_title, $push_data, $push_type);

                                $success_data = notification_add(4, $customer['customer_id'], $push_title, $message, $_POST['order_id']);


                            }

                            $response['status'] = true;
                            $response['message'] = 'Order CL'.$_POST['order_id'].' accepted';
                        }else{
                            $response['status'] = false;
                            $response['message'] = 'Server encountered an error. please try again';
                        }

                    }else{
                        $response['status'] = false;
                        $response['message'] = 'Something went wrong';
                    }
                }
            }
        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function myorders_post(){
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 
        $postFields['order_type'] = $_POST['order_type']; 

        if(empty($errorPost)){

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
            $this->db->join('customer t2', 't1.customer_id = t2.id');
            $this->db->join('shop t3', 't1.shop_id = t3.id');
            $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id');

            $this->db->where('t1.delivery_boy_id', $_POST['delivery_boy_id']);

            $this->db->group_start();
            $this->db->where('t1.order_status', 4);
            $this->db->or_where('t1.order_status', 3);
            $this->db->or_where('t1.order_status', 5);
            $this->db->group_end();

            $this->db->group_start();

                $this->db->group_start();
                
                    $order_type = array('1','2');
                    $this->db->where_in('t1.order_type', $order_type);

                    if($_POST['order_type'] == 1){
                        $this->db->where('DATE(t1.created_at)', date('Y-m-d'));
                    }else{
                        $this->db->where('DATE(t1.created_at) >', date('Y-m-d'));
                    }
                $this->db->group_end();

                // $this->db->where('t1.order_type', 1);
                // $this->db->or_where('t1.order_type', 2);

                $this->db->or_group_start();
                    $this->db->where('t1.order_type', 5);

                    if($_POST['order_type'] == 1){
                        $this->db->where('DATE(t1.schedule_date)', date('Y-m-d'));
                    }else{
                        $this->db->where('DATE(t1.schedule_date) >', date('Y-m-d'));
                    }

                $this->db->group_end();

            $this->db->group_end();

            

            $sql_query = $this->db->get();
            $last_query = $this->db->last_query();
            if ($sql_query->num_rows() > 0){
                $orders_data = $sql_query->result_array();   
                 $qq = $this->db->last_query();  
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

                        $pickup_minutes = $this->config->item("pickup_minutes");
                        $delivery_minutes = $this->config->item("delivery_minutes");

                        if($value['order_type'] == 1){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $pickup_time = $my_date->add(new DateInterval('PT'.$pickup_minutes.'M'));
                            $delivery_minutes = $delivery_minutes + $pickup_minutes;
                            $delivery_time = $my_date2->add(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $delivery_time->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 2){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $created_date = $my_date->format('Y-m-d');
                            $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);
                            $later_datetime2 = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);

                            $pickup_time = $later_datetime2->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $later_datetime->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 5){

                            $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $pickup_time = $my_date->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $my_date2->format('Y-m-d H:i:s');

                        }else{

                            $orders_data[$key]['pickup_time'] = '';
                            $orders_data[$key]['delivery_time'] = '';
                        }

                    }else{
                        $orders_data[$key]['products'] = '';
                    }
                }
                $response['orders_data'] = $orders_data;                   
                $response['status'] = TRUE;                  
                //$response['qq'] = $qq;                  
            }else{
                $response['message'] = 'No any order pending';                  
                $response['status'] = FALSE; 
            }

        }else{
            $response['status'] = false;
            $response['message'] = $errorPost;
        }
        $this->response($response);

        $errorPost = $this->ValidatePostFields($postFields);
    }

    public function completed_orders_post(){
        $postFields['delivery_boy_id'] = $_POST['delivery_boy_id']; 

        if(empty($errorPost)){

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

            $this->db->where('t1.delivery_boy_id', $_POST['delivery_boy_id']);

            $this->db->where('t1.order_status', 6);

            $this->db->group_start();
                $this->db->where('t1.order_type', 1);
                $this->db->or_where('t1.order_type', 2);

                $this->db->or_group_start();
                    $this->db->where('t1.order_type', 5);
                    $this->db->where('DATE(t1.schedule_date)', date('Y-m-d'));
                $this->db->group_end();

            $this->db->group_end();

            if($_POST['order_type'] == 1){
                $this->db->where('DATE(t1.created_at)', date('Y-m-d'));
            }else{
                $this->db->where('DATE(t1.created_at) !=', date('Y-m-d'));
            }

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

                        $pickup_minutes = $this->config->item("pickup_minutes");
                        $delivery_minutes = $this->config->item("delivery_minutes");

                        if($value['order_type'] == 1){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $pickup_time = $my_date->add(new DateInterval('PT'.$pickup_minutes.'M'));
                            $delivery_time = $my_date2->add(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $delivery_time->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 2){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $created_date = $my_date->format('Y-m-d');
                            $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);
                            $later_datetime2 = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);

                            $pickup_time = $later_datetime2->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $later_datetime->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 5){

                            $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $pickup_time = $my_date->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $my_date2->format('Y-m-d H:i:s');

                        }else{

                            $orders_data[$key]['pickup_time'] = '';
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


                        $pickup_minutes = $this->config->item("pickup_minutes");
                        $delivery_minutes = $this->config->item("delivery_minutes");

                        if($value['order_type'] == 1){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $pickup_time = $my_date->add(new DateInterval('PT'.$pickup_minutes.'M'));
                            $delivery_time = $my_date2->add(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $delivery_time->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 2){

                            $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_at']);
                            $created_date = $my_date->format('Y-m-d');
                            $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);
                            $later_datetime2 = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$value['later_time']);

                            $pickup_time = $later_datetime2->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $later_datetime->format('Y-m-d H:i:s');

                        }else if($value['order_type'] == 5){

                            $my_date = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $my_date2 = DateTime::createFromFormat('Y-m-d h:i A', $value['schedule_date'].' '.$value['schedule_time']);
                            $pickup_time = $my_date->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                            $orders_data[$key]['order_date'] = $value['created_at'];
                            $orders_data[$key]['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                            $orders_data[$key]['delivery_time'] = $my_date2->format('Y-m-d H:i:s');

                        }else{

                            $orders_data[$key]['pickup_time'] = '';
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
            
            $sql_select = array(
                            't1.id',
                            't1.total',
                            't1.customer_id',
                            't2.username',
                            't1.order_type',
                            't1.order_status',
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
                            't1.rating'
                            // 'IF(t1.order_type=2, t1.schedule_date, "") as schedule_date',
                            // 'IF(t1.order_type=2, t1.schedule_time, "") as schedule_time',
                            // 'IF(t1.order_type=1, t1.created_at, "") as created_at'
            );
            $this->db->select($sql_select);

            $this->db->from('orders t1');
            $this->db->join('customer t2', 't1.customer_id = t2.id');
            $this->db->join('shop t3', 't1.shop_id = t3.id');
            $this->db->join('delivery_address t4', 't1.delivery_address_id = t4.id');

            $this->db->where('t1.id', $_POST['order_id']);

            $sql_query = $this->db->get();

            if ($sql_query->num_rows() > 0){
                $orders_data = (array)$sql_query->row();

                $pickup_minutes = $this->config->item("pickup_minutes");
                $delivery_minutes = $this->config->item("delivery_minutes");

                if($orders_data['order_type'] == 1){

                    $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $orders_data['created_at']);
                    $my_date2 = DateTime::createFromFormat('Y-m-d H:i:s', $orders_data['created_at']);
                    $pickup_time = $my_date->add(new DateInterval('PT'.$pickup_minutes.'M'));
                    $delivery_time = $my_date2->add(new DateInterval('PT'.$delivery_minutes.'M'));

                    $orders_data['order_date'] = $orders_data['created_at'];
                    $orders_data['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                    $orders_data['delivery_time'] = $delivery_time->format('Y-m-d H:i:s');

                }else if($orders_data['order_type'] == 2){

                    $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $orders_data['created_at']);
                    $created_date = $my_date->format('Y-m-d');
                    $later_datetime = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$orders_data['later_time']);
                    $later_datetime2 = DateTime::createFromFormat('Y-m-d h:i A', $created_date.' '.$orders_data['later_time']);

                    $pickup_time = $later_datetime2->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                    $orders_data['order_date'] = $orders_data['created_at'];
                    $orders_data['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                    $orders_data['delivery_time'] = $later_datetime->format('Y-m-d H:i:s');

                }else if($orders_data['order_type'] == 5){

                    $my_date = DateTime::createFromFormat('Y-m-d h:i A', $orders_data['schedule_date'].' '.$orders_data['schedule_time']);
                    $my_date2 = DateTime::createFromFormat('Y-m-d h:i A', $orders_data['schedule_date'].' '.$orders_data['schedule_time']);
                    $pickup_time = $my_date->sub(new DateInterval('PT'.$delivery_minutes.'M'));

                    $orders_data['order_date'] = $orders_data['created_at'];
                    $orders_data['pickup_time'] = $pickup_time->format('Y-m-d H:i:s');
                    $orders_data['delivery_time'] = $my_date2->format('Y-m-d H:i:s');

                }else{

                    $orders_data['pickup_time'] = '';
                    $orders_data['delivery_time'] = '';
                }
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