<?php

require('../../initialize.php');

// Get array back from Game::find_all()
$games = Game::find_all();

foreach($games as $game) {
  echo '<li>' . $game->title . '</li>';
}

?>