<?php

class Game extends DatabaseObject {

  static protected $table_name = 'games_test';
  static protected $db_columns = ['id', 'title', 'user_id'];

  public $id;
  public $title;
 
  public function __construct($args=[]) {
    $this->title = $args['title'] ?? NULL;
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->title)) {
      $this->errors['error'] = "Title cannot be blank.";
    }

    return $this->errors;
  }

  static public function find_all_by_user_id($user_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    // escape $user_id after testing without escape
    $sql .= "WHERE user_id = '" . self::$database->escape_string($user_id) . "'";
    return static::find_by_sql($sql);
  }

}

?>
