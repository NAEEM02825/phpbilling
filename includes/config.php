<?php
ini_set('display_errors',1); 
date_default_timezone_set('America/Los_Angeles'); 
 


error_reporting(E_ALL);
if(session_id() == '') {
    session_start();
}
  
// Define System CONSTANTS
define('SYSTEM_ENCODING', 'utf8' ); 
define('BR','</br>');
$now = date("Y-m-d H:i:s");

 
define('FOLDER_NAME','hiring'); 
define('ROOT_PATH', realpath(dirname(__FILE__)."/../").'/');

define('SITE_ROOT', 'https://'.$_SERVER['HTTP_HOST'].'/'.FOLDER_NAME.'/');
define('MAIN_SITE','https://'.$_SERVER['HTTP_HOST'].'/'); 
define('DB_PREFIX', '');
  

// Constants for user roles by ID
define('ROLE_ID_ADMIN', 1);
define('ROLE_ID_MANAGER', 2);
define('ROLE_ID_Agent', 3); 


$admin_role = 1;
$manager_role = 2;
$agent_role = 3;

 
	?>
