<?php

class Game {

  //  Start of Active Record Code
  static protected $database;

  static protected $db_columns = ['id', 'title'];

  static public function set_database($database) {
    self::$database = $database;
  }
  // End of Active Record Code
 
  public function __construct($args=[]) {
    $this->title = $args['title'] ?? '';
  }

  public function create() {
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO games_test (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  // Properties which have database columns, excluding id
  public function attributes() {
    $attributes = [];
    foreach(self::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
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

  static public function find_by_id($id) {
    $sql = "SELECT * FROM games_test ";
    $sql .= "WHERE id = '" . self::$database->escape_string($id) . "'";
    $obj_array = self::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}

?>
