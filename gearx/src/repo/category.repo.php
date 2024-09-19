<?php
require_once DB;
require_once MODEL . 'category.model.php';

class CategoryRepository
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function getAllCategories()
  {
    try {
      $query = "SELECT * FROM categories";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $categories = [];
      foreach ($results as $row) {
        $categories[] = new Category($row);
      }

      return $categories;
    } catch (PDOException $e) {
      echo "Error fetching categories: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }
}
