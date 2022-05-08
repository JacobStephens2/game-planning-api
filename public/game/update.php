<?php

require('../../initialize.php');

$args = [];
$args['id'] = $_REQUEST['id'] ?? NULL;
$args['title'] = $_REQUEST['title'] ?? NULL;

if ($args['id']) {
  
  $game = new Game($args);
  $game->merge_attributes($args);
  $result = $game->update();

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