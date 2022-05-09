<?php

require('../../initialize.php');

if (isset($_POST['game'])) {
  
  $args = $_POST['game'];
  $game = new Game($args);
  $game->merge_attributes($args);
  $result = $game->save();

  if($result === true) {
    $game->message = 'Game created';
    echo json_encode($game);
  } else {
    $response = new stdClass();
    $response->message = 'Game not created';
    echo json_encode($response);
  }

} else {

    $response = new stdClass();
    $response->message = 'Please provide a game title';
    echo json_encode($response);

}

?>