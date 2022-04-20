<?php

require_once('../private/initialize.php');

$site_data = array("value"=>get_site_data());

echo json_encode($site_data);

?>
