<?php

class Game {

  // ----- START OF ACTIVE RECORD CODE -----
  static public $database;
  
  static public function set_database($database) {
    self::$database = $database;
  }
  // ----- END OF ACTIVE RECORD CODE -----

}