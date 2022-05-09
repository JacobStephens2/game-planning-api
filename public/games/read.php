<?php

require('../../initialize.php');

authenticate();

// Game::find_all() returns an array
echo json_encode(Game::find_all());

?>