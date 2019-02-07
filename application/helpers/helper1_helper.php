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

function get_customer_by_filter($where = array()){
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
?>
