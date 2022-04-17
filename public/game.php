<?php

require_once('database/initialize.php');

$data = array("value"=>get_game());

echo json_encode($data);

?>
