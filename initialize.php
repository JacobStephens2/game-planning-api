<?php

require_once('vendor/autoload.php');

include_once('private/database/database_functions.php');
$database = db_connect();
include_once('private/database/query_functions.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('classes/databaseobject.class.php');
DatabaseObject::set_database($database);

// Classes that extend and inherit DatabaseObject
require_once('classes/game.class.php');
require_once('classes/user.class.php');

?>