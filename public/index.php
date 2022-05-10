<?php

require_once('../initialize.php');

class testObject {}

$myObj = new testObject;

$myObj->value = "Data from the index.php endpoint of the Game Planning App API";
$myObj->frontEnd = $_ENV['REQUEST_ORIGIN'];
$myObj->endPointsDescription = "https://github.com/JacobStephens2/game-planning-back-end";
$myObj->endPointBaseURL = $_ENV['ORIGIN'];
$myObj->endPointsList = array(
  $_ENV['ORIGIN'] . "/test/database", 
  $_ENV['ORIGIN'] . "/sign-up",
  $_ENV['ORIGIN'] . "/login",
  $_ENV['ORIGIN'] . "/logout",
  $_ENV['ORIGIN'] . "/game/create",
  $_ENV['ORIGIN'] . "/games/read",
  $_ENV['ORIGIN'] . "/game/read",
  $_ENV['ORIGIN'] . "/game/update",
  $_ENV['ORIGIN'] . "/game/delete"
);

$myJSON = json_encode($myObj);

echo $myJSON;

?>
