<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../private/initialize.php');

if ($data->email == "") {
  echo json_encode('Submit an email address to register');
} else {
  $user = new User($data);
  $result = $user->create( $data->email, $data->password );
  if( $result ) {
    echo json_encode('User created');
  } else {
    echo json_encode('The email address is registered to another account');
  }
}


?>