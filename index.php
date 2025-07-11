<?php
// === Enable Error Reporting for Debugging (Optional) ===
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// === Start Page Timer ===
$start_time = microtime(true);

// === Start Session ===
@session_start();

// === Load Functions ===
require_once('functions.php');

// === Handle Logout ===
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    unset($_SESSION['is_logged']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header("Location: login.php");
    exit();
}

// === Determine Route and Include File ===
$include_file = "";
$path = "";

if (isset($_GET['route'])) {
    $path = $_GET['route'];
} elseif (isset($_POST['route'])) {
    $path = $_POST['route'];
}

if ($path != "") {
    $include_file = "./" . $path . ".php";
    if (!file_exists($include_file)) {
        $include_file = "includes/page-parts/content-404.php";
    }
}

// === Include Header ===
include_once('includes/page-parts/header.php');

// === Check Login Session ===
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1 && isset($_SESSION['user_name'])) {

    // === Logged-in User Interface ===
    include_once('includes/page-parts/top-nav.php');
    include_once('includes/page-parts/sidebar.php');
    include_once('includes/page-parts/content-top.php');

    // === Page Content ===
    if (!empty($include_file)) {
        include($include_file);
    } else {
        include('includes/page-parts/content-default.php');
    }

    include_once('includes/page-parts/content-bottom.php');
    include_once('includes/page-parts/footer.php');

} else {
    // === Not Logged In ===

    // Handle forgot password redirect
    if (isset($_GET['fg']) && $_GET['fg'] == 1) {
        header("Location: forget_password.php");
    } else {
        header("Location: login.php");
    }
    exit();
}

// === Show Page Load Time (Optional) ===
// $end_time = microtime(true);
// $execution_time = $end_time - $start_time;
// echo "Page generated in " . round($execution_time, 4) . " seconds.";
?>
