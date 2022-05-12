<?php

class Game extends DBObject {

  static protected $table_name = 'games_test';
  static protected $db_columns = ['id', 'title'];

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

}

?>
