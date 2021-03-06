<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../initialize.php');

$response = new stdClass();

if ($data->email == "") {
  $response->message = 'Submit an email address to register';
  echo json_encode($response);
} else {
  $user = new User($data);
  $result = $user->createUser( $data->email, $data->password );
  if( $result ) {
    $response->message = 'Account creation succeeded';
    echo json_encode($response);
  } else {
    $response->message = 'This email address is already associated with an account';
    echo json_encode($response);
  }
}


?>