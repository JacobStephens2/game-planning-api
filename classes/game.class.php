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



  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit('Database query failed.');
    }

    // results into objects
    $object_array = [];
    while ($record = $result->fetch_assoc()) {
      $object_array[] = self::instantiate($record);
    }

    $result->free();
    
    return $object_array;
  }



  static protected function instantiate($record) {
    $object = new self;
    // could manually assign values to properties
    // but automatic assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }



  public $id;
  public $title;



  static public function find_all() {
    $sql = "SELECT * FROM games_test";
    return self::find_by_sql($sql);
  }

}

?>
