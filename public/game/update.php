<?php

require_once('../../initialize.php');

$access_token = authenticate();

$response = new stdClass();

if (!isset($_GET['id'])) {
  http_response_code(400);
  $response->message = 'Please provide a game id';
  echo json_encode($response);
  exit;
}

$game = Game::find_by_id($_GET['id']);

if ($game === false) {
  http_response_code(404);
  $response->message = 'id ' . $_GET['id'] . ' does not match a game in the database';
  echo json_encode($response);
  exit;
}

if ($game->user_id != $access_token->user_id) {
  http_response_code(403);
  $response->message = 'You do not have permission to update this game';
  echo json_encode($response);
  exit;
}

$args = $_POST['game'];
$game->merge_attributes($args);
$result = $game->save();

if ($result === true) {
  $game->message = $game->title . ' updated';
  echo json_encode($game);
} else {
  http_response_code(422);
  $response->message = 'Game not updated';
  echo json_encode($response);
}

?>
