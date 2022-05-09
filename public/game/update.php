<?php

require('../../initialize.php');

if (isset($_GET['id'])) {
  
  $id = $_GET['id'];
  $game = Game::find_by_id($id);

  if ($game == false) {
    
    $response = new stdClass();
    $response->message = 'id ' . $_GET['id'] . ' does not match a game in the database';
    echo json_encode($response);
    
  } else {
    
    // Receiving associative array
    $args = $_POST['game'];
    $game->merge_attributes($args);
    $result = $game->save();

    if($result === true) {
      $game->message = $game->title . ' updated';
      echo json_encode($game);
    } else {
      $response = new stdClass();
      $response->message = 'Game not updated';
      echo json_encode($response);
    }

  }
  
} else {

  $response = new stdClass();
  $response->message = 'Please provide a game id';
  echo json_encode($response);

}

?>