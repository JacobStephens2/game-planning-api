<?php

include_once('functions.php');
include_once('database_functions.php');
$database = db_connect();
include_once('query_functions.php');

require_once('classes/game.class.php');

Game::set_database($database);

?>
