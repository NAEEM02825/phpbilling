<?php
require('../functions.php');
header('Content-Type: application/json');

$clientId = $_GET['client_id'] ?? 0;

$projects = DB::query("SELECT * FROM projects WHERE client_id = %i ORDER BY name", $clientId);
echo json_encode($projects);
?>