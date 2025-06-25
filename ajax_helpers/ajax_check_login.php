<?php 
require('../functions.php');
if(isset($_POST['email'])){
	$email = $_POST['email'];
}
if(isset($_POST['password'])){
	$password = $_POST['password'];
}

if ((isset($email)) AND (isset($password))) {
	$check = attempt_login_user($email, $password);
	if($check){
	 	echo '1';
	} else {
	 	echo '0';
	}
}
 
?>