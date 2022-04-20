<?php

header('Access-Control-Allow-Credentials: true');

// Takes raw data from the request
// $json = file_get_contents('php://input');

// $data = json_decode($json);

// require_once('../private/initialize.php');

// $login_failure_msg = "Log in was unsuccessful.";

// $user = find_user_by_email($data->email);
// if($user) {

//   if(password_verify($password, $user['hashed_password'])) { // original
//     // password matches
//     log_in_user($user);
//     redirect_to(url_for('/index.php'));      
//   } else {
//     // username found, but password does not match
//     $errors[] = $login_failure_msg;
//   }

// } else {
//   // no username found
//   $errors[] = $login_failure_msg;
// }

// echo json_encode($data->email);

echo 'This endpoint needs some work. Good luck logging in.'

?>