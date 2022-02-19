<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

require_once('database/initialize.php');

$data = array("value"=>get_game());

echo json_encode($data);

?>
