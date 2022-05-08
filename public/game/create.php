<?php

require('../../initialize.php');

$args = [];
$args['title'] = $_REQUEST['title'] ?? NULL;

if ($args['title']) {
  
  $game = new Game($args);
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