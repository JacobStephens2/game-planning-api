<?php

class Game {

  // ----- START OF ACTIVE RECORD CODE -----
  static protected $database;
  
  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_all() {
    $sql = "SELECT * FROM games";
    return self::$database->query($sql);
  }
  // ----- END OF ACTIVE RECORD CODE -----

}