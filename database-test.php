<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

require_once('database/initialize.php');

$site_data = array("value"=>get_site_data());

echo json_encode($site_data);

?>
