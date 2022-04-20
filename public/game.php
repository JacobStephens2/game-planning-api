<?php

require_once('../private/initialize.php');

$data = array("value"=>get_game());

echo json_encode($data);

?>
