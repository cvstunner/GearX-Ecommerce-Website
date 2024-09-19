<?php
require_once __DIR__ . '/../util/db/db.util.php';
require_once MODEL . 'cart.model.php';

class CartRepo
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function getCartByUserId($userId)
  {
    try {
      $query = "SELECT * FROM cart WHERE user_id = :user_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->execute();

      $cartItems = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cartItems[] = new CartModel($row);
      }

      return $cartItems;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function addToCart($userId, $productId, $quantity = 1)
  {
    try {
      $query = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $query = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($query);
      } else {
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $this->db->prepare($query);
      }

      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function removeFromCart($userId, $productId)
  {
    try {
      $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function updateCartQuantity($userId, $productId, $quantity)
  {
    try {
      $query = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }
}
