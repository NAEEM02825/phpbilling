<?php
header('Content-Type: application/json');
require('../functions.php');

$clients = DB::query("SELECT * FROM clients ORDER BY name");
echo json_encode($clients);
?>