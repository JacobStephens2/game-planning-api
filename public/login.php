<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../initialize.php');

$response = new stdClass();

if ($data->email == "") {
  $response->message = 'Submit credentials to log in';
  echo json_encode($response);
} else {
  $user = new User();
  $login_result = $user->verify_login_credentials( $data->email, $data->password );
  if( $login_result ) {
    $response->message = 'Log in succeeded';
    echo json_encode($response);
  } else {
    $response->message = 'Log in failed';
    echo json_encode($response);
  }
}


?>