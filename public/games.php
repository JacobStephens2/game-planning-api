<?php

declare(strict_types=1);

require_once('../initialize.php');

// Validate JWT access token sent with request 
// before responding with the game data

use Firebase\JWT\JWT;

// Generate token
$secretKey  = $_ENV['JWTSECRET'];
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
$serverName = $_SERVER['SERVER_NAME'];
// $username   = "username";                                           // Retrieved from filtered POST data

$data = [
    'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
    'iss'  => $serverName,                       // Issuer
    'nbf'  => $issuedAt->getTimestamp(),         // Not before
    'exp'  => $expire,                           // Expire
    // 'userName' => $username,                     // User name
];

echo JWT::encode(
    $data,
    $_ENV['JWTSECRET'],
    'HS512'
);

?>
