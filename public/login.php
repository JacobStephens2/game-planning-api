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
  $result = array("value"=>$user->verify_login_credentials($data->email, $data->password));
  if( $result->num_rows >= 1 ) {
    echo json_encode('Log in successful');
  } else {
    echo json_encode(print_r($result));
  }
}


?>