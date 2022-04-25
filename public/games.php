<?php

declare(strict_types=1);

require_once('../initialize.php');

// Validate JWT access token sent with request 
// before responding with the game data

use Firebase\JWT\JWT;

// extract credentials from the request

if ($hasValidCredentials) {

}

// Provide data

$data = get_game();

echo json_encode($data);

?>
