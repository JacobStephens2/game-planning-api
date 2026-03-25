<?php

class Game extends DatabaseObject {

  static protected $table_name = 'games_test';
  static protected $db_columns = ['id', 'title', 'description', 'user_id'];

  public $id;
  public $title;
  public $description;
  public $user_id;

  public function __construct($args=[]) {
    $this->title = $args['title'] ?? NULL;
    $this->description = $args['description'] ?? NULL;
    $this->user_id = $args['user_id'] ?? NULL;
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->title)) {
      $this->errors['error'] = "Title cannot be blank.";
    }

    return $this->errors;
  }

  static public function find_all_by_user_id($user_id) {
    $stmt = self::$database->prepare(
      "SELECT * FROM " . static::$table_name . " WHERE user_id = ?"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $object_array = [];
    while ($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }
    $stmt->close();
    return $object_array;
  }

}

?>
