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

function get_game() {
  global $database;

  $result = Game::find_all();
  $row = $result->fetch_assoc();
  $result->free();

  return $row['Title'];
}

?>
