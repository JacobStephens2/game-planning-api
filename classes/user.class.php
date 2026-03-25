<?php

class User extends DatabaseObject {

  static protected $table_name = 'users';
  static protected $db_columns = ['id', 'email', 'user_group', 'hashed_password'];

  public $id;
  public $email;
  public $hashed_password;
  public $user_group;

  public function __construct() {

  }

  public function createUser($email, $password) {
    $email_is_registered = self::find_by_email($email);
    if ($email_is_registered) {
      return false;
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = self::$database->prepare(
      "INSERT INTO users (email, hashed_password, user_group) VALUES (?, ?, '1')"
    );
    $stmt->bind_param("ss", $email, $hashed);
    $result = $stmt->execute();
    if ($result) {
      $this->id = self::$database->insert_id;
    }
    $stmt->close();
    return $result;
  }

  public function verify_login_credentials($email, $password) {
    $user = self::find_by_email($email);
    if (!$user) {
      return false;
    }
    if (password_verify($password, $user->hashed_password)) {
      return $user;
    }
    return false;
  }

  static public function find_by_email($email) {
    $stmt = self::$database->prepare(
      "SELECT * FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();

    if ($record) {
      return static::instantiate($record);
    }
    return false;
  }

}

?>
