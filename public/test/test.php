<?php

require_once('../../initialize.php');

authenticate();

$json = file_get_contents('php://input');

$data = json_decode($json);

$user = new User();
$verified_user = $user->verify_login_credentials( $data->email, $data->password );

echo '<pre>';
print_r($verified_user->id);
echo '</pre>';
