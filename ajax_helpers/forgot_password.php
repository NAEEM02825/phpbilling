<?php 
require('../functions.php');
if(isset($_REQUEST['email'])){
$sql = DB::Query("SELECT * FROM admin_users where user_email = '".$_REQUEST['email']."'");
	if(!empty($sql)){
		$to = $_REQUEST['email'];
		$subject = 'Forget Password';
		$message = 'Your New Password is Here:'.$sql[0]['password'];
		$headers = 'From: superadmin@debtalyticspro.com'       . "\r\n" .
					 'Reply-To: superadmin@debtalyticspro.com' . "\r\n" .
					 'X-Mailer: PHP/' . phpversion();

		if(@mail($to, $subject, $message, $headers)){
			echo "Your Password Send to your Registered Email";
		}else{
			echo "Email Not Send";
		}
	}else{
		echo "Email Not Found";
	}
}

?>