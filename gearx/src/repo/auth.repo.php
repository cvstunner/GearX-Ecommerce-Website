<?php
require_once __DIR__ . '/../util/db/db.util.php';
require_once MODEL . 'user.model.php';

class AuthRepo
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function isUserExists($email)
  {
    global $con;

    try {
      $statement = $con->prepare("SELECT email FROM users WHERE email = ?");
      $statement->execute([$email]);
      $count = $statement->rowCount();

      if ($count > 0)
        return 0;
      else
        return 1;
    } catch (PDOException $e) {
      error_log("Database error: " . $e->getMessage());
      return -1;
    }
  }
  public function registerUser($fullname, $email, $phone, $password)
  {
    try {
      $query = "INSERT INTO users (fullname, email, phone, password) VALUES (:fullname, :email, :phone, :password)";
      $stmt = $this->db->prepare($query);
      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

      $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

      $stmt->execute();
      return $this->db->lastInsertId();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function getUserByEmail($email)
  {
    try {
      $query = "SELECT * FROM users WHERE email = :email AND disabled = 0";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user ? new UserModel($user) : null;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return null;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }
}
