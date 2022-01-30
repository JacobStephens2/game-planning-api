<?php

header("Content-Type: application/json; charset=UTF-8");

require_once('../database/initialize.php');

$site_data = array("name"=>get_site_data());

echo json_encode($site_data);

?>
