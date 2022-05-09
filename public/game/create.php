<?php

require('../../initialize.php');

if (isset($_POST['game'])) {
  
  $args = $_POST['game'] ?? NULL;
  $game = new Game($args);
  if ($args == null) {
  } else {
    $game->merge_attributes($args);
  }
  $result = $game->save();

  if($result === true) {
    $game->message = 'Game created';
    echo json_encode($game);
  } else {
    $game->message = 'Game not created';
    echo json_encode($game->errors);
  }

} else {

    $response = new stdClass();
    $response->message = 'Please provide a game title';
    echo json_encode($response);

}

?>