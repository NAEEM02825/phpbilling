<?php
$start_time = microtime(true);
//if session not already started then start session

@session_start();


require_once('functions.php'); 
if (isset($_GET['logout'])){
	if ($_GET['logout'] == 1) {
		session_destroy();
		unset($_SESSION['is_logged']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);	  
	}
}

$include_file = "";
$path ="";
if (isset($_GET['route'])) {
$path = $_GET['route'];
} else {
	if (isset($_POST['route'])) {
	$path = $_POST['route'];
	}
}
if($path <> "") { // Checks if file really exists before including it
	$include_file = "./".$path.".php";
	if(!file_exists($include_file)) {
		$include_file = "includes/page-parts/content-404.php";
		
	}
		
}
 
?>
 

 
<?php include_once('includes/page-parts/header.php'); 
 ?>


<?php
if ( (isset($_SESSION['is_logged'])) AND (isset($_SESSION['user_name'])) AND  ($_SESSION['is_logged'] == 1)) {

	
?>
 
<?php include_once('includes/page-parts/top-nav.php'); ?>
<?php include_once('includes/page-parts/sidebar.php'); ?>
<?php include_once('includes/page-parts/content-top.php'); ?>
 
<?php 
	if($include_file <> "") {
	include($include_file); 
	}  else {
		include('includes/page-parts/content-default.php');  
	}
 ?>

<?php include_once('includes/page-parts/content-bottom.php'); ?> 
<?php include_once('includes/page-parts/footer.php'); ?>
<?php 
} else { //if not logged in
	 echo '<script>window.location.replace("./login.php");</script>';
	// print_r($path);die(1);
	$path = '';
	if(isset($_GET['fg']) and $_GET['fg'] ==1 ){
		$path  = 'forgot_password';
	}
	if($path == "forgot_password") {
		echo '<script>window.location.replace("./forget_password.php");</script>';
	} else {
		echo '<script>window.location.replace("./login.php");</script>';
	}
	
 include_once('includes/page-parts/content-bottom.php');
 include_once('includes/page-parts/footer.php'); 

 
 }
?>        <!-- 
<?php
// End timing the script and calculate the execution time
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "Page generated in " . round($execution_time, 4) . " seconds.";
?>
-->