<?php

declare(strict_types=1);

require_once('../initialize.php');

$response = new stdClass();

$cookie_secure = $_ENV['COOKIE_SECURE'] === 'true';

setcookie(
  "access_token",
  "",
  time() - 3600,
  "/",
  $_ENV['COOKIE_DOMAIN'],
  $cookie_secure,
  true
);

$response->message = 'Logged out';
echo json_encode($response);

?>
