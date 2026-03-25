<?php

require_once('../../initialize.php');

$access_token = authenticate();

$response = new stdClass();

if (empty($_GET['id'])) {
  http_response_code(400);
  $response->message = "Please provide a game's id";
  echo json_encode($response);
  exit;
}

$game = Game::find_by_id($_GET['id']);

if ($game === false) {
  http_response_code(404);
  $response->message = "No game is associated with the provided id";
  echo json_encode($response);
  exit;
}

if ($game->user_id != $access_token->user_id) {
  http_response_code(403);
  $response->message = "You do not have permission to delete this game";
  echo json_encode($response);
  exit;
}

$result = $game->delete();

if ($result === true) {
  $game->message = 'Game deleted';
  echo json_encode($game);
} else {
  http_response_code(500);
  $game->message = 'Game not deleted';
  echo json_encode($game->errors);
}

?>
