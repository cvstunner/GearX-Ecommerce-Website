<?php
require_once __DIR__ . '/../util/db/db.util.php';
require_once MODEL . 'wishlist.model.php';

class WishlistRepo
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function getWishlistByUserId($userId)
  {
    try {
      $query = "SELECT * FROM wishlist WHERE user_id = :user_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->execute();

      $wishlist = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $wishlist[] = new WishlistModel($row);
      }

      return $wishlist;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function addToWishlist($userId, $productId)
  {
    try {
      $query = "INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)";
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

  public function removeFromWishlist($userId, $productId)
  {
    try {
      $query = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
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
}
