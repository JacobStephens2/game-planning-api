<?php

// Require valid access token before giving access to resource

declare(strict_types=1);

error_reporting(0);

require_once('../../initialize.php');

authenticate();

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key  = $_ENV['JWT_SECRET'];

if (empty($_COOKIE["access_token"])) {
  
  $response = new stdClass();
  $response->message = 'You are not authenticated';
  echo json_encode($response);

} else {
  
  $jwt = $_COOKIE["access_token"];
  // echo a json encoded version of the decoded JWT if user authenticated
  // authenticated meaning the access token signature has been verified

  // IMPORTANT:
  // You must specify supported algorithms for your application. See
  // https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
  // for a list of spec-compliant algorithms.

  echo json_encode(JWT::decode($jwt, new Key($key, 'HS512')));

}

?>