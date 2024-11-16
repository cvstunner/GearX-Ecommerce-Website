<?php

use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
// $dotenv->load();


class Database
{
  private static $instance = null;
  private $connection;

  private $host = 'localhost';
  private $dbname = 'GearX';
  private $user = 'root';
  private $password = '';

  private function __construct()
  {
    // $this->host = getenv('DB_HOST');
    // $this->dbname = getenv('DB_NAME');
    // $this->user = getenv('DB_USER');
    // $this->password = getenv('DB_PASS');
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
      $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ];
      $this->connection = new PDO($dsn, $this->user, $this->password, $options);
    } catch (PDOException $e) {
      die('Database Connection Failed: ' . $e->getMessage());
    }
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }

  public function closeConnection()
  {
    $this->connection = null;
    self::$instance = null; // Reset the singleton instance
  }

  private function __clone() {}
  public function __wakeup() {}
}
