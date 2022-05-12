<?php

require_once('../../initialize.php');

authenticate();

$response = new stdClass();

// Check if an id was provided
if (!empty($_REQUEST['id'])) {
  
  // Check if the game exists
  $game = Game::find_by_id($_REQUEST['id']);
  if ($game === false) {
  
    $response->message = "No game is associated with the provided id";
    echo json_encode($response);
  
  } else {

      // Delete the game if it exists
      $result = $game->delete();

    if($result === true) {
      $game->message = 'Game deleted';
      echo json_encode($game);
    } else {
      $game->message = 'Game not deleted';
      echo json_encode($game->errors);
    }

  }
} else {
  $response->message = "Please provide a game's id";
  echo json_encode($response);
}

?>