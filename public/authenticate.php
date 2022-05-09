<?php

// Require valid access token before giving access to resource

declare(strict_types=1);

// error_reporting(0);

require_once('../initialize.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$response = new stdClass();

if (empty($_COOKIE["access_token"])) {
  
  $response->message = 'You are not authenticated';
  echo json_encode($response);
  
} else {
  
  // echo a json encoded version of the decoded JWT if user authenticated
  // authenticated meaning the access token signature has been verified
  
  // IMPORTANT:
  // You must specify supported algorithms for your application. See
  // https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
  // for a list of spec-compliant algorithms.
  
  // echo json_encode(JWT::decode($jwt, new Key($key, 'HS512')));
  try {
    $jwt = $_COOKIE["access_token"];
    $key  = $_ENV['JWT_SECRET'];
    $decodedJWT = JWT::decode($jwt, new Key($key, 'HS512'));
  } catch (Exception $e) {
    $response->message = 'You have not been authenticated';
    $response->exception = 'Caught exception: ' . $e->getMessage();
    echo json_encode($response);
    exit;
  }

  echo 'Hello';

  // $decodedJWT->email;
}

?>