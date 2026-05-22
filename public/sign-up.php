<?php

require_once('../initialize.php');

$json = file_get_contents('php://input');
$data = json_decode($json);

$response = new stdClass();

if (!$data || empty($data->email)) {
  http_response_code(400);
  $response->message = 'Submit an email address to register';
  echo json_encode($response);
  exit;
}

if (empty($data->password) || strlen($data->password) < 8) {
  http_response_code(400);
  $response->message = 'Password must be at least 8 characters';
  echo json_encode($response);
  exit;
}

if (!has_valid_email_format($data->email)) {
  http_response_code(400);
  $response->message = 'Please provide a valid email address';
  echo json_encode($response);
  exit;
}

$user = new User();
$result = $user->createUser($data->email, $data->password);
if ($result) {
  notify_admin_new_user($data->email);
  http_response_code(201);
  $response->message = 'Account creation succeeded';
  echo json_encode($response);
} else {
  http_response_code(409);
  $response->message = 'This email address is already associated with an account';
  echo json_encode($response);
}

function notify_admin_new_user($email) {
  $apiKey = $_ENV['MANDRILL_API_KEY'] ?? '';
  $adminEmail = $_ENV['ADMIN_EMAIL'] ?? '';
  if (!$apiKey || !$adminEmail) return;

  $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 0, 1024);
  $payload = [
    'key' => $apiKey,
    'message' => [
      'from_email' => $_ENV['MAIL_FROM_EMAIL'] ?? 'jacob@stephens.page',
      'from_name'  => $_ENV['MAIL_FROM_NAME'] ?? 'GamePlan',
      'to' => [['email' => $adminEmail, 'type' => 'to']],
      'subject' => 'GamePlan — New Account Created',
      'text' => "A new account was created on GamePlan.\n\n"
        . "Email: " . $email . "\n"
        . "Date: " . gmdate('c') . "\n"
        . "Device: " . $ua,
    ],
  ];

  $ch = curl_init('https://mandrillapp.com/api/1.0/messages/send.json');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  $resp = curl_exec($ch);
  if ($resp === false) {
    error_log('Mandrill admin notification failed: ' . curl_error($ch));
  }
  curl_close($ch);
}

?>
