<?php
function get_msg() {
	$CI = &get_instance();
	$get_messages_array = NULL;
	$get_messages_array = $CI->auth->get_messages_array();
	$str = "";
	/*if (isset($get_messages_array) && !empty($get_messages_array) && is_array($get_messages_array) && count($get_messages_array) > 0) {
		foreach ($get_messages_array as $key => $value) {
			if ($key == 'status' && strlen($value) > 0) {
				$str .= '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$value.'</div>';
			} elseif ($key == 'errors' && strlen($value) > 0) {
				$str .= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$value.'</div>';
			}
		}
	}*/

	$get_messages_array = NULL;
	$get_messages_array = $CI->session->flashdata();
	if (isset($get_messages_array) && !empty($get_messages_array) && is_array($get_messages_array) && count($get_messages_array) > 0) {
		foreach ($get_messages_array as $key => $value) {
			if ($key == 'status' && strlen($value) > 0) {
				$str .= '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$value.'</div>';
			} elseif ($key == 'errors' && strlen($value) > 0) {
				$str .= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$value.'</div>';
			}
		}
	}

	return $str;
}

function sendmail($from=NULL, $to = NULL, $subject = NULL, $message = NULL){
	$CI = &get_instance();


	$config['protocol'] = $CI->config->item("protocol");
    $config['smtp_host'] = $CI->config->item("smtp_host");
    $config['smtp_port'] = $CI->config->item("smtp_port");
    $config['smtp_user'] = $CI->config->item("smtp_user");
    $config['smtp_pass'] = $CI->config->item("smtp_pass");
    $config['charset'] = $CI->config->item("charset");
    $config['mailtype'] = $CI->config->item("mailtype");

    $from = $CI->config->item("from");

	$CI->load->library('email', $config);
	$CI->email->set_newline("\r\n");
	$CI->email->from($from, "Click Lunch"); // change it to yours
	$CI->email->to($to);// change it to yours
	$CI->email->subject($subject);
	$CI->email->message($message);
	if($CI->email->send()){
	  return TRUE;
	}
	else{
		//$error = show_error($CI->email->print_debugger());
		return FALSE;
	}
}

function encrypt($string){
    $CI = &get_instance();
    $key = $CI->config->item('custom_encryption_key');
    $result = '';
    for($i=0, $k= strlen($string); $i<$k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}


function decrypt($string) {
	$CI = &get_instance();
    $key = $CI->config->item('custom_encryption_key');
    $result = '';
    $string = base64_decode($string);
    for($i=0,$k=strlen($string); $i< $k ; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    $result = str_replace('Cardnumber:','',$result);
    return str_replace(' ','',$result);
}

function get_cuisine($id=NULL){
	$CI = &get_instance();
	$return_data = array();
	$CI->db->select('id,cuisine_name,cuisine_picture,created_at');
	$CI->db->from('cuisine');
	if (isset($id) && !is_null($id)) {
		$CI->db->where('id', $id);
	}
	$CI->db->where("deleted_at", NULL);
	$CI->db->where("is_active", 1);
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0) {
		if (isset($id) && !is_null($id)) {
			$return_data = $sql_query->row();
		}else{
			$return_data = $sql_query->result_array();
		}
		
	}
	return $return_data;
}

function get_user_type($email=NULL){

	if($email== NULL){
		return FALSE;
	}

	$CI = &get_instance();
	$CI->db->select('id');
	$CI->db->from('shop');
	$CI->db->where("deleted_at", NULL);
	$CI->db->where("email", $email);
	$CI->db->where("status", 1);
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		return 'vender';
	}else{
		$CI->db->select('id');
		$CI->db->from('employee');
		$CI->db->where("deleted_at", NULL);
		$CI->db->where("email", $email);
		$CI->db->where("status", 1);
		$sql_query2 = $CI->db->get();
		if ($sql_query2->num_rows() > 0){
			return 'employee';
		}
	}
	return FALSE;
}
function get_loggedin_detail($id = NULL){

	$return_data = FALSE;
	$CI = &get_instance();
	if($CI->auth->is_admin()){
		$table = 'admin';
	}elseif($CI->auth->is_vender()){
		$table = 'shop';
	}elseif ($CI->auth->is_employee()){
		$table = 'employee';
	}elseif ($CI->auth->is_dispatcher()){
		$table = 'delivery_dispatcher';
	}elseif ($CI->auth->is_customer()){
		$table = 'customer';
	}else{
		return $return_data;
	}

	
	$CI->db->select('*');
	$CI->db->from($table);
	$CI->db->where("deleted_at", NULL);
	$CI->db->where("id", $id);
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		$return_data = $sql_query->row();
	}
	return $return_data;
	
}

function is_allowed($role_id = NULL, $module_name = NULL){
	$return_value = FALSE;

	$CI = &get_instance();
	$CI->db->select($module_name);
	$CI->db->from('role');
	$CI->db->where("id", $role_id);
	$CI->db->where($module_name, 1);
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		$return_data = $sql_query->row();
		$return_value = $return_data->$module_name;
	}
	
	return $return_value;
}

function get_customer_by_shop($shops = array()){
	$return_data = array();

	$CI = &get_instance();
	$CI->db->select('email');
	$CI->db->from('customer');
	if (isset($where) && !empty($where)) {
		$CI->db->where($where);
	}
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		$return_data = $sql_query->result_array();
	}
	
	return $return_data;
}

function get_data_by_filter($table_name = NULL, $select = array(), $where= array()){
	$return_data = array();

	$CI = &get_instance();
	$CI->db->select($select);
	$CI->db->from($table_name);
	if (isset($where) && !empty($where)) {
		$CI->db->where($where);
	}
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		$return_data = $sql_query->result_array();
	}
	return $return_data;
}

function validate_card($number = NULL){
	$return_value = FALSE;

	if($number != '' && isset($number)){

		$number=preg_replace('/\D/', '', $number);
	    $number_length=strlen($number);
	    $parity=$number_length % 2;

	    $total = 0;
	    for($i= 0; $i<$number_length; $i++){
	        $digit=$number[$i];
	        if ($i % 2 == $parity){
	        	$digit*=2;
	          	if($digit > 9){
	            	$digit -= 9;
	          	}
	        }
	        $total+=$digit;
	    }
	    $return_value = ($total % 10 == 0) ? TRUE : FALSE;
	}

	return $return_value;
}

function validate_customer_card($card_number = NULL){

	if (isset($card_number) && $card_number != ''){
		global $type;

	    $cardtype = array(
	        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
	        "mastercard" => "/^5[1-5][0-9]{14}$/",
	        "amex"       => "/^3[47][0-9]{13}$/",
	        "jcb"       => "/^(?:2131|1800|35\d{3})\d{11}$/",
	        "dinnerclub"       => "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/",
	        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
	    );

	    if (preg_match($cardtype['visa'],$card_number))
	    {
		$type= "visa";
	        return 'visa';
		
	    }
	    else if (preg_match($cardtype['mastercard'],$card_number))
	    {
		$type= "mastercard";
	        return 'mastercard';
	    }
	    else if (preg_match($cardtype['dinnerclub'],$card_number))
	    {
		$type= "dinnerclub";
	        return 'dinnerclub';
	    }
	    else if (preg_match($cardtype['jcb'],$card_number))
	    {
		$type= "jcb";
	        return 'jcb';
	    }
	    else if (preg_match($cardtype['amex'],$card_number))
	    {
		$type= "amex";
	        return 'amex';
		
	    }
	    else if (preg_match($cardtype['discover'],$card_number))
	    {
		$type= "discover";
	        return 'discover';
	    }
	    else
	    {
	        return "FALSE";
	    } 
	}

}

function validate_expiry_date($expiry_date = NULL){
	$expiry_date_array = explode('/',$expiry_date);

	if(isset($expiry_date) && $expiry_date != '' && !is_null($expiry_date) && checkdate($expiry_date_array[0],'01',$expiry_date_array[1])){
        
        $expiry_date_obj = DateTime::createFromFormat('d/m/Y H:i:s', "01/" . $expiry_date_array[0] . "/" .  $expiry_date_array[1]." 00:00:00");
        $expiry_date_obj = new DateTime($expiry_date_obj->format("Y/m/t"));

        $my_date = date('d/m/Y');
        $today = DateTime::createFromFormat('d/m/Y H:i:s', $my_date ." 00:00:00");

        if($expiry_date_obj >= $today){
            return TRUE;
        }else{
			return FALSE;
        }
    }else{
		return FALSE;
    }
}

function validate_card_number($card_number = NULL, $card_type = NULL) {

	$valid = validate_card($card_number);
	if($valid == FALSE){
		return FALSE;
	}else{
		$card_types = array('1' => 'visa', '2' => 'mastercard', '3' => 'amex', '4' => 'dinnerclub', '5' => 'discover', '6' => 'jcb');
		$my_card_type = $card_types[$card_type];
		$card_type = validate_customer_card($card_number);
		if($card_type != '' && $card_type == $my_card_type){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

function get_card_type($str, $format = 'string'){
    if (empty($str)){
        return false;
    }

    $matchingPatterns = [
        'Visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
        'Mastercard' => '/^5[1-5][0-9]{14}$/',
        'American Express' => '/^3[47][0-9]{13}$/',
        'Diners Club' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
        'Discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
        'JCB' => '/^(?:2131|1800|35\d{3})\d{11}$/',
        'Other' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
    ];

    $ctr = 1;
    $type = 'Other';
    foreach ($matchingPatterns as $key => $pattern) {
        if (preg_match($pattern, $str)) {
             $type = $key ;
             break;
        }
        $ctr++;
    }
    return $type;
}

function send_push($device_type = '',$device_token = '', $push_title = '', $push_data = array(), $push_type = ''){
  		
  		$CI = &get_instance();
        $key = $CI->config->item('fcm_key');
        define('API_ACCESS_KEY', $key);

        if($device_type == 2){

            //$push_data = array('message' => $push_message);

            $fcmFields = array(
                'priority' => 'high',
                'to' => $device_token,
                'sound' => 'default',
                'notification' => array( 
                    "title"=> $push_title,
                    "body"=> $push_data,
                    "type"=> $push_type
                    )
                );

        }else{

            //$push_data = 'You got new order delivery from shop_name to adddress';

            $fcmFields = array(
                'priority' => 'high',
                'to' => $device_token,
                'sound' => 'default',
                'data' => array( 
                    "title"=> $push_title,
                    "body"=> $push_data,
                    "type"=> $push_type
                    )
                );
        }

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
        return $result;
}

function send_push_multiple_android($android_data = array(), $push_title = NULL, $push_message = NULL,$push_type =NULL){

  	$fcmFields = array(
	            'priority' => 'high',
	            'registration_ids' => $android_data,
	            'sound' => 'default',
	            'data' => array( 
	                "title"=> $push_title,
	                "body"=> $push_message,
	                "type"=> $push_type
	                )
	            );

  	$CI = &get_instance();
    $key = $CI->config->item('fcm_key');
    define('API_ACCESS_KEY', $key);

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
    //print_r($result);
    return $result;
}

function send_push_multiple_ios($ios_data = array(), $push_title = NULL, $push_message = NULL,$push_type =NULL){

  	$push_data = array('message' => $push_message);

            $fcmFields = array(
                'priority' => 'high',
                'registration_ids' => $ios_data,
                'sound' => 'default',
                'notification' => array( 
                    "title"=> $push_title,
                    "body"=> $push_message,
                    "data"=> $push_data,
                    "type"=> $push_type
                    )
                );

  	$CI = &get_instance();
    $key = $CI->config->item('fcm_key');
    define('API_ACCESS_KEY', $key);

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
    //print_r($result);
    return $result;
}

function notification_add($notification_type = NULL, $customer_id = NULL, $notification_title = NULL, $notification_message = NULL, $order_id = 0){
	$CI = &get_instance();
	if(isset($customer_id)){
		$data = array(
					'notification_type' => intval($notification_type),
					'customer_id' => intval($customer_id),
					'notification_title' => $notification_title,
					'notification_message' => $notification_message,
					'order_id' => $order_id
				);

		if($CI->db->insert("notification", $data)){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}else{
		return FALSE;
	}
	
}

function get_rating($shop_id = NULL){
	$rate = 0.00;
	$CI = &get_instance();
	$CI->db->select('rating');
	$CI->db->from('orders');
	$CI->db->where("shop_id", $shop_id);
	$CI->db->where("rating !=", 0);
	$sql_query = $CI->db->get();
	if ($sql_query->num_rows() > 0){
		$total_rows = $sql_query->num_rows();
		$ratings_data = $sql_query->result_array();
		$rate_total = 0.00;
		foreach ($ratings_data as $key => $value) {
			$rate_total += floatval($value['rating']);
		}
		if($rate_total > 0){
			$rate = $rate_total / $total_rows;
		}
	}
	return $rate;
}

if(!function_exists('is_empty')){
	function is_empty($data){
		if(empty($data)){
			return true;
		}
	}
}

?>
