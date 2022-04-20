<?php

class User {
  
  // ----- START OF ACTIVE RECORD CODE -----
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

    static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = self::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = "SELECT * FROM users";
    return self::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = self::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static protected function instantiate($record) {
    $object = new self;
    // Could manually assign values to properties
    // but automatically assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  public function create() {
    $sql = "INSERT INTO users (";
    $sql .= "email, password ";
    $sql .= ") VALUES (";
    $sql .= "'" . $this->email . "', ";
    $sql .= "'" . $this->password . "'";
    $sql .= ")";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }
  // ----- END OF ACTIVE RECORD CODE -----

  public $id;
  public $email;
  public $password;

  public function __construct($data) {
    $this->email = $data->email;
    $this->password = $data->password;
  }

}

?>
