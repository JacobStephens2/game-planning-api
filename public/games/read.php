<?php

require_once('../../initialize.php');

$access_token = authenticate();

// Game::find_all() returns an array
echo json_encode(Game::find_all_by_user_id($access_token->user_id));

?>