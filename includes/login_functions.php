<?php
function get_user_name($user_id) {
// TODO: Fix this function to get user's user_name;
$sql = "SELECT user_name FROM admin_users WHERE user_id='".$user_id."'";
$user_name = DB::queryFirstField($sql);
	return $user_name;
}

function get_full_user_name($user_id ="") {
	$user_full_name = "--";
	if ($user_id <> "" AND $user_id <> 0 ) {
		$sql = "SELECT first_name, last_name FROM admin_users WHERE user_id='".$user_id."'";
		$res = DB::queryFirstRow($sql);
		if (!empty($res)) {
			$user_full_name = $res['first_name']." ".$res['last_name'];
		}
	}
	return  $user_full_name;
	
}
 
 
function attempt_login_user($email, $password) {
	// build a check here to put appropriate fields in the session
	session_destroy();
	session_start();
	$is_logged = DB::queryFirstRow("SELECT * FROM users u WHERE u.`email` LIKE '".$email."' AND u.`password`='".$password."' ");	
 
	if ($is_logged) {
	
		$_SESSION['is_logged'] = 1;
		// $_SESSION['company_name'] = DB::queryFirstField("SELECT company_name FROM companies WHERE company_id = $company_id ");
		// $_SESSION['company_logo'] = DB::queryFirstField("SELECT company_logo FROM companies WHERE company_id = $company_id ");
		// $_SESSION['company_url'] = DB::queryFirstField("SELECT website FROM companies WHERE company_id = $company_id ");
		$_SESSION['user_id'] = $is_logged['user_id'];	
		$_SESSION['user_name'] = $is_logged['name']; 
		$_SESSION['user_email'] = $is_logged['email']; 
		$_SESSION['role_id'] = getUserRoleID($is_logged['user_id']); 
		
		$cookie_name = "user_id";
		$cookie_value = $is_logged['user_id'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 15), "/"); // 86400 = 1 day //set for 15 days
		return true;

	}else{
		return false;
	}
}
	
	






?>