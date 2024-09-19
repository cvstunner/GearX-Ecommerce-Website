<?php
require_once __DIR__ . '/../util/db/db.util.php';
require_once MODEL . 'order.model.php';
require_once MODEL . 'order_item.model.php';

class OrderRepo
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function createOrder($userId, $totalAmount, $address, $items)
  {
    try {
      $this->db->beginTransaction();

      $query = "INSERT INTO orders (user_id, total_amount, address) VALUES (:user_id, :total_amount, :address)";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':total_amount', $totalAmount, PDO::PARAM_STR);
      $stmt->bindParam(':address', $address, PDO::PARAM_STR);
      $stmt->execute();
      $orderId = $this->db->lastInsertId();

      $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
      $stmt = $this->db->prepare($query);

      foreach ($items as $item) {
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $item['price'], PDO::PARAM_STR);
        $stmt->execute();
      }

      $this->db->commit();
      return $orderId;
    } catch (PDOException $e) {
      $this->db->rollBack();
      echo "Error: " . $e->getMessage();
      return false;
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function getOrdersByUserId($userId)
  {
    try {
      $query = "SELECT * FROM orders WHERE user_id = :user_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->execute();

      $orders = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orders[] = new OrderModel($row);
      }

      return $orders;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }

  public function getOrderItems($orderId)
  {
    try {
      $query = "SELECT * FROM order_items WHERE order_id = :order_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
      $stmt->execute();

      $items = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $items[] = new OrderItemModel($row);
      }

      return $items;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    } finally {
      Database::getInstance()->closeConnection();
    }
  }
}
