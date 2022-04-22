<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

require_once('../private/initialize.php');

if ($data->email == "") {
  echo json_encode('Submit credentials to log in');
} else {
  $user = new User();
  $login_result = $user->verify_login_credentials( $data->email, $data->password );
  if( $login_result ) {
    echo json_encode('Log in succeeded');
  } else {
    echo json_encode('Log in failed');
  }
}


?>