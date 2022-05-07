<?php

// Require valid access token before giving access to resource

declare(strict_types=1);

error_reporting(0);

require_once('../initialize.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key  = $_ENV['JWT_SECRET'];

$jwt = $_COOKIE["access_token"];

header('Access-Control-Allow-Credentials: true');

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */

if ( $decoded = JWT::decode($jwt, new Key($key, 'HS512')) ) {

  // echo a json encoded version of the decoded JWT if user authenticated
  // authenticated meaning the access token signature has been verified
  echo json_encode($decoded);

} else {

  echo json_encode('You are not authenticated');

}


?>
