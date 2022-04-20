<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../private/initialize.php');

if ($data->email == "") {
  echo json_encode('Include an email address to log in');
} else {
  $user = new User($data);
  $result = $user->verify_login_credentials($data);
  if($result === true) {
    echo json_encode('Log in successful');
  } else {
    echo json_encode('Failed to log in (result evaluated false)');
  }
}


?>