<?php

require_once('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('validation_functions.php');
require_once('authenticate.php');

include_once('database/database_functions.php');
$database = db_connect();
include_once('database/query_functions.php');

require_once('classes/dbobject.class.php');
DBObject::set_database($database);

// Classes that extend DBObject
require_once('classes/game.class.php');

require_once('classes/databaseobject.class.php');
DatabaseObject::set_database($database);

// Classes that extend and inherit DatabaseObject
require_once('classes/user.class.php');

?>