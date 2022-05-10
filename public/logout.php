<?php

declare(strict_types=1);

require_once('../initialize.php');

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$response = new stdClass();
      
setcookie(
  "access_token", // name
  "", // value
  time() + (86400 * 7), // expire, 86400 = 1 day
  "", // path
  $_ENV['COOKIE_DOMAIN'], // domain
  $cookie_secure, // secure
  true // httponly
); 

$response->message = 'Logged out';

echo json_encode($response);

?>