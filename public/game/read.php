<?php

require_once('../../initialize.php');

$access_token = authenticate();

$response = new stdClass();

if (!empty($_GET['id'])) {
  $game = Game::find_by_id($_GET['id']);
  if ($game === false) {
    http_response_code(404);
    $response->message = "No game is associated with the provided id";
    echo json_encode($response);
  } elseif ($game->user_id != $access_token->user_id) {
    http_response_code(403);
    $response->message = "You do not have permission to view this game";
    echo json_encode($response);
  } else {
    echo json_encode($game);
  }
} else {
  http_response_code(400);
  $response->message = "Please provide a game's id";
  echo json_encode($response);
}

?>
