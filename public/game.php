<?php

require_once('../initialize.php');

$data = array("value"=>get_game());

echo json_encode($data);

?>
