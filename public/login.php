<?php

declare(strict_types=1);

require_once('../initialize.php');

use Firebase\JWT\JWT;

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json);

$response = new stdClass();

if ($data->email == "") {
  $response->message = 'Submit credentials to log in';
  echo json_encode($response);
} else {
  $user = new User();
  $login_result = $user->verify_login_credentials( $data->email, $data->password );
  if( $login_result ) {

    $response->message = 'Log in succeeded';

    // Validate JWT access token sent with request 
    // before responding with the game data
    // Generate token
    $secretKey  = $_ENV['JWT_SECRET'];
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
    $serverName = $_SERVER['SERVER_NAME'];
    $email   = $data->email;                                           // Retrieved from filtered POST data

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'email' => $data->email,                     // User name
    ];

    $jwt = JWT::encode(
        $data,
        $_ENV['JWT_SECRET'],
        'HS512'
    );

    $cookie_name = "access_token";
    $cookie_value = $jwt;
      
    setcookie(
      $cookie_name, 
      $cookie_value, 
      time() + (86400 * 7), // expire, 86400 = 1 day
      "", // path
      "", // domain
      $_ENV['COOKIE_SECURE'], // secure
      true // httponly
    ); 

    echo json_encode($response);
    
  } else {
    $response->message = 'Log in failed';
    echo json_encode($response);
  }
}


?>