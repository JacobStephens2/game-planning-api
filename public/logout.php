<?php

declare(strict_types=1);

require_once('../initialize.php');

// Takes raw data from the request
$json = file_get_contents('php://input');

$response = new stdClass();

$cookie_secure = $_ENV['COOKIE_SECURE'] === 'true';

setcookie(
  "access_token", // name
  "", // value
  time() - 3600, // expire in the past to clear
  "", // path
  $_ENV['COOKIE_DOMAIN'], // domain
  $cookie_secure, // secure
  true // httponly
); 

$response->message = 'Logged out';

echo json_encode($response);

?>