<?php

declare(strict_types=1);

require_once('../initialize.php');

use Firebase\JWT\JWT;

$json = file_get_contents('php://input');
$data = json_decode($json);

$response = new stdClass();

if (!$data || empty($data->email) || empty($data->password)) {
  http_response_code(400);
  $response->message = 'Submit credentials to log in';
  echo json_encode($response);
  exit;
}

$user = new User();
$verified_user = $user->verify_login_credentials($data->email, $data->password);

if (!$verified_user) {
  http_response_code(401);
  $response->message = 'Log in failed';
  echo json_encode($response);
  exit;
}

$response->message = 'Log in succeeded';

$secretKey  = $_ENV['JWT_SECRET'];
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+60 minutes')->getTimestamp();
$serverName = $_SERVER['SERVER_NAME'];

$payload = [
    'iat'  => $issuedAt->getTimestamp(),
    'iss'  => $serverName,
    'nbf'  => $issuedAt->getTimestamp(),
    'exp'  => $expire,
    'user_id' => $verified_user->id,
];

$jwt = JWT::encode(
    $payload,
    $_ENV['JWT_SECRET'],
    'HS512'
);

$cookie_secure = $_ENV['COOKIE_SECURE'] === 'true';

setcookie(
  "access_token",
  $jwt,
  time() + (86400 * 7),
  "/",
  $_ENV['COOKIE_DOMAIN'],
  $cookie_secure,
  true
);

$response->logged_in = 'true';
echo json_encode($response);

?>
