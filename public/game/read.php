<?php

require('../../initialize.php');

$response = new stdClass();

if (!empty($_REQUEST['id'])) {
  $game = Game::find_by_id($_REQUEST['id']);
  if ($game === false) {
    $response->message = "No game is associated with the provided id";
    echo json_encode($response);
  } else {
    echo json_encode($game);
  }
} else {
  $response->message = "Please provide a game's id";
  echo json_encode($response);
}

?>