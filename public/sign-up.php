<?php

require_once('../initialize.php');

$json = file_get_contents('php://input');
$data = json_decode($json);

$response = new stdClass();

if (!$data || empty($data->email)) {
  http_response_code(400);
  $response->message = 'Submit an email address to register';
  echo json_encode($response);
  exit;
}

if (empty($data->password) || strlen($data->password) < 8) {
  http_response_code(400);
  $response->message = 'Password must be at least 8 characters';
  echo json_encode($response);
  exit;
}

if (!has_valid_email_format($data->email)) {
  http_response_code(400);
  $response->message = 'Please provide a valid email address';
  echo json_encode($response);
  exit;
}

$user = new User();
$result = $user->createUser($data->email, $data->password);
if ($result) {
  http_response_code(201);
  $response->message = 'Account creation succeeded';
  echo json_encode($response);
} else {
  http_response_code(409);
  $response->message = 'This email address is already associated with an account';
  echo json_encode($response);
}

?>
