<?php

require_once('../initialize.php');

class testObject {}

$overview = new testObject;

$overview->value = "Data from the index.php endpoint of the Game Planning App API";
$overview->frontEnd = $_ENV['REQUEST_ORIGIN'];
$overview->repository = "https://github.com/JacobStephens2/game-planning-back-end";
$overview->endPointBaseURL = $_ENV['ORIGIN'];
$overview->endPointsList = array(
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

echo json_encode($overview);

?>
