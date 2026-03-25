<?php

function get_site_data($purpose = 'app_name') {
  global $database;

  $stmt = $database->prepare("SELECT * FROM `app` WHERE purpose = ?");
  $stmt->bind_param("s", $purpose);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();

  return $row['value'];
}

?>
