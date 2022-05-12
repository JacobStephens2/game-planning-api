<?php

require_once('../../initialize.php');

$access_token = authenticate();

if (isset($_POST['game'])) {
  
  $args = $_POST['game'] ?? NULL;
  $args['user_id'] = $access_token->user_id;
  $game = new Game($args);
  $game->merge_attributes($args);
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
    $response->message = 'Please provide an array of game form data';
    echo json_encode($response);

}

?>