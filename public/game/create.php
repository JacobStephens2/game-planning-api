<?php

require('../../initialize.php');

$properties = [];
$properties['title'] = $_REQUEST['title'] ?? NULL;

if ($properties['title']) {
  
  $game = new Game($properties);
  $result = $game->create();

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