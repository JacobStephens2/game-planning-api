<?php

include_once('database/database_functions.php');
$database = db_connect();
include_once('database/query_functions.php');

require_once('classes/game.class.php');
require_once('classes/user.class.php');

Game::set_database($database);
User::set_database($database);

?>
