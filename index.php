<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

class testObject {}

$myObj = new testObject;

$myObj->name = "Data from the index.php endpoint of the Game Planning App API";
$myObj->frontEnd = "https://gameplanning.site/";
$myObj->endPointsDescription = "https://github.com/JacobStephens2/game-planning-back-end";
$myObj->endPointBaseURL = "https://api.gameplanning.site/";
$myObj->endPointsList = array(
  "https://api.gameplanning.site/database-test.php", 
  "https://api.gameplanning.site/game.php"
);

$myJSON = json_encode($myObj);

echo $myJSON;

?>
