<?php

function get_site_data($purpose = 'app_name') {
  global $database;

  $sql = "SELECT * FROM `app` ";
  $sql .= "WHERE purpose = '" . $purpose . "'";

  $result = $database->query($sql);
  $row = $result->fetch_assoc();
  $result->free();

  return $row['value'];
}

function get_game($time_min = 30) {
  global $database;

  $sql = "SELECT * FROM `games` ";
  $sql .= "WHERE time_min = $time_min";

  $result = Game::$database->query($sql);
  $row = $result->fetch_assoc();
  $result->free();

  return $row['title'];
}

?>
