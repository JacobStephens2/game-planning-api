<?php

require_once('../initialize.php');

class testObject {}

$myObj = new testObject;

$myObj->value = "Data from the index.php endpoint of the Game Planning App API";
$myObj->frontEnd = $_ENV['ORIGIN'];
$myObj->endPointsDescription = "https://github.com/JacobStephens2/game-planning-back-end";
$myObj->endPointBaseURL = $_ENV['ORIGIN'];
$myObj->endPointsList = array(
  $_ENV['ORIGIN'] . "/database-test", 
  $_ENV['ORIGIN'] . "/game",
  $_ENV['ORIGIN'] . "/games",
  $_ENV['ORIGIN'] . "/sign-up",
  $_ENV['ORIGIN'] . "/login"
);

$myJSON = json_encode($myObj);

echo $myJSON;

?>
