<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

$a = 
  '{
    "name": "data from backend"
  }';
  
echo ($a);

?>
