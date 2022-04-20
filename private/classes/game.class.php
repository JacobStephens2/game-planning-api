<?php

class Game extends DatabaseObject {

  static public function find_all() {
    $sql = "SELECT * FROM games";
    return self::$database->query($sql);
  }

}

?>
