<?php

declare(strict_types=1);
require_once('initialize.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate() {
  $response = new stdClass();
  if (empty($_COOKIE["access_token"])) {
    $response->message = 'You are not authenticated';
    echo json_encode($response);
  } else {
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
  }
}

?>