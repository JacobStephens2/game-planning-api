<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../private/initialize.php');

if ($data->email == "") {
  echo json_encode('Include an email address to register');
} else {
  $user = new User($data);
  $result = $user->create();
  if($result === true) {
    echo json_encode('User created');
  } else {
    echo json_encode('Failed to create user (result evaluated false)');
  }
}


?>