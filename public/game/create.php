<?php

require('../../initialize.php');

$args = [];
$args['title'] = $_REQUEST['title'] ?? NULL;

$game = new Game($args);
$result = $game->create();

if($result === true) {
  $new_id = $game->id;
  echo $game->title . ' added ';
  echo '(id: ' . $new_id . ')';
} else {
  echo 'Game not created';
}

?>