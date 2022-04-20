<?php

class User {

  // ----- START OF ACTIVE RECORD CODE -----
  // static protected $database;
  
  // static public function set_database($database) {
  //   self::$database = $database;
  // }

  // static public function create_user() {

  //   // INSERT INTO users (email, password)
  //   // VALUES ('$data->email', '$data->email')

  //   global $db;

  //   // Add user validation

  //   $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

  //   $sql = "INSERT INTO users ";
  //   $sql .= "(first_name, last_name, email, username, hashed_password, user_group) ";
  //   $sql .= "VALUES (";
  //   $sql .= "'" . db_escape($db, $user['first_name']) . "',";
  //   $sql .= "'" . db_escape($db, $user['last_name']) . "',";
  //   $sql .= "'" . db_escape($db, $user['email']) . "',";
  //   $sql .= "'" . db_escape($db, $user['username']) . "',";
  //   $sql .= "'" . db_escape($db, $hashed_password) . "',";
  //   $sql .= "'1'";
  //   $sql .= ")";
  //   $result = mysqli_query($db, $sql);
  //   echo '<p>' . $sql . '</p>';
  //   // For INSERT statements, $result is true/false
  //   if($result) {
  //     return true;
  //   } else {
  //     // INSERT failed
  //     echo mysqli_error($db);
  //     db_disconnect($db);
  //     exit;
  //   }

  //   return self::$database->query($sql);
  // }
  // ----- END OF ACTIVE RECORD CODE -----

}

?>
