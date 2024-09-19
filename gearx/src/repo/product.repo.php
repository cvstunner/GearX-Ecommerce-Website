<?php
require_once __DIR__ . '/../util/db/db.util.php';
require_once MODEL . 'product.model.php';

class ProductRepo
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function getAllProducts()
  {
    try {
      $query = "SELECT * FROM products";
      $stmt = $this->db->query($query);
      $products = [];

      while ($row = $stmt->fetch()) {
        $products[] = new ProductModel($row);
      }

      return $products;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function getProduct($slug)
  {
    try {
      $query = "SELECT * FROM products WHERE slug = ?";
      $stmt = $this->db->prepare($query);
      $stmt->execute([$slug]);

      $result = $stmt->fetch();
      if ($result) {
        return new ProductModel($result);
      }
      return null;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return null;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function createProduct($name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture)
  {
    try {
      $query = "INSERT INTO products (name, description, category_id, price, mrp, rating, shipping, picture)
                      VALUES (:name, :description, :category_id, :price, :mrp, :rating, :shipping, :picture)";
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':category_id' => $category_id,
        ':price' => $price,
        ':mrp' => $mrp,
        ':rating' => $rating,
        ':shipping' => $shipping,
        ':picture' => $picture
      ]);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function updateProduct($id, $name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture)
  {
    try {
      $query = "UPDATE products SET 
                      name = :name, description = :description, category_id = :category_id,
                      price = :price, mrp = :mrp, rating = :rating, shipping = :shipping, picture = :picture
                      WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':category_id' => $category_id,
        ':price' => $price,
        ':mrp' => $mrp,
        ':rating' => $rating,
        ':shipping' => $shipping,
        ':picture' => $picture
      ]);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function deleteProduct($id)
  {
    try {
      $query = "DELETE FROM products WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    } finally {
      Database::getInstance()->closeConnection();
    }
  }
}
