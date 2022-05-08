<?php

require('../../initialize.php');

// Receiving associative array
$args = $_POST['game'];

if ($args['title']) {
  
  $game = new Game($args);
  $game->merge_attributes($args);
  $result = $game->save();
  
  // echo $game->checkForID();

  if($result === true) {
    $game->message = 'Game updated';
    echo json_encode($game);
  } else {
    $response = new stdClass();
    $response->message = 'Game not updated';
    echo json_encode($response);
  }

} else {

    $response = new stdClass();
    $response->message = 'Please provide a game id';
    echo json_encode($response);

}

?>