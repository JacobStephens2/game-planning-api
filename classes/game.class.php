<?php

class Game {

  //  Start of Active Record Code
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }
  // End of Active Record Code

  public function __construct($args=[]) {
    $this->title = $args['title'] ?? '';
  }

  public function create() {
    $sql = "INSERT INTO games_test ";
    $sql .= "( title ) ";
    $sql .= "VALUES ";
    $sql .= "('" . $this->title . "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  public $title;

  static public function find_by_sql($sql) {
    return self::$database->query($sql);
    if(!$result) {
      exit('Database query failed.');
    }
    return $result;
  }
  
  static public function find_all() {
    $sql = "SELECT * FROM games_test";
    return self::find_by_sql($sql);
  }


}

?>
