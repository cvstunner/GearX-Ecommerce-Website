<?php
require_once REPO . 'auth.repo.php';

class AuthController
{
  private $authRepo;

  public function __construct()
  {
    $this->authRepo = new AuthRepo();
  }

  public function isUserExists($email)
  {
    try {
      $exists = $this->authRepo->isUserExists($email);
      if ($exists == -1) {
        throw new Exception("Internal Server Error");
      }

      return $exists;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function register($fullname, $email, $phone, $password)
  {
    try {
      // Check if user already exists
      $existingUser = $this->authRepo->getUserByEmail($email);
      if ($existingUser) {
        throw new Exception("User with this email already exists.");
      }

      // Register user
      $userId = $this->authRepo->registerUser($fullname, $email, $phone, $password);
      if (!$userId) {
        throw new Exception("Failed to register user.");
      }

      return $userId;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function login($email, $password)
  {
    try {
      $user = $this->authRepo->getUserByEmail($email);
      if (!$user) {
        throw new Exception("Invalid email or password.");
      }

      if (!password_verify($password, $user->password)) {
        throw new Exception("Invalid email or password.");
      }

      return $user;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return null;
    }
  }
}
