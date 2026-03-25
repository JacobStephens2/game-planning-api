<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name;
  static protected $columns = [];
  public $errors = [];

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if (!$result) {
      http_response_code(500);
      echo json_encode(['error' => 'Database query failed']);
      exit;
    }

    $object_array = [];
    while ($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    $stmt = self::$database->prepare(
      "SELECT * FROM " . static::$table_name . " WHERE id = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();

    if ($record) {
      return static::instantiate($record);
    }
    return false;
  }

  static protected function instantiate($record) {
    $object = new static;
    foreach ($record as $property => $value) {
      if (property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  protected function validate() {
    $this->errors = [];
    return $this->errors;
  }

  protected function create() {
    $this->validate();
    if (!empty($this->errors)) { return false; }

    $attributes = $this->attributes();
    $columns = array_keys($attributes);
    $values = array_values($attributes);
    $placeholders = array_fill(0, count($values), '?');
    $types = str_repeat('s', count($values));

    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', $columns);
    $sql .= ") VALUES (";
    $sql .= join(', ', $placeholders);
    $sql .= ")";

    $stmt = self::$database->prepare($sql);
    $stmt->bind_param($types, ...$values);
    $result = $stmt->execute();
    if ($result) {
      $this->id = self::$database->insert_id;
    }
    $stmt->close();
    return $result;
  }

  protected function update() {
    $this->validate();
    if (!empty($this->errors)) { return false; }

    $attributes = $this->attributes();
    $columns = array_keys($attributes);
    $values = array_values($attributes);
    $set_clause = join(', ', array_map(fn($col) => "{$col} = ?", $columns));
    $types = str_repeat('s', count($values)) . 'i';
    $values[] = $this->id;

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= $set_clause;
    $sql .= " WHERE id = ? LIMIT 1";

    $stmt = self::$database->prepare($sql);
    $stmt->bind_param($types, ...$values);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public function save() {
    if (isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  public function merge_attributes($args=[]) {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  public function attributes() {
    $attributes = [];
    foreach (static::$db_columns as $column) {
      if ($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  public function delete() {
    $stmt = self::$database->prepare(
      "DELETE FROM " . static::$table_name . " WHERE id = ? LIMIT 1"
    );
    $stmt->bind_param("i", $this->id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

}

?>
