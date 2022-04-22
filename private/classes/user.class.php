<?php

class User extends DatabaseObject {
  
  static protected $table_name = 'users';
  static protected $db_columns = ['id', 'email', 'user_group', 'hashed_password'];

  public function create() {
    $sql = "INSERT INTO users (";
    $sql .= "email, password, user_group ";
    $sql .= ") VALUES (";
    $sql .= "'" . $this->email . "', ";
    $sql .= "'" . $this->password . "'";
    $sql .= "'1'";
    $sql .= ")";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  public $id;
  public $email;
  public $password;

  public function __construct($data) {
    $this->email = $data->email;
    $this->password = $data->password;
  }

  public function verify_login_credentials($email, $password) {
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE email = '$email' ";
    $sql .= "AND password = '$password'";
    return self::$database->query($sql);
  }

}

?>
