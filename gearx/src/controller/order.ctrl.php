<?php
require_once REPO . 'order.repo.php';

class OrderController
{
  private $orderRepo;

  public function __construct()
  {
    $this->orderRepo = new OrderRepo();
  }

  public function createOrder($userId, $totalAmount, $address, $items)
  {
    try {
      return $this->orderRepo->createOrder($userId, $totalAmount, $address, $items);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function getOrdersByUserId($userId)
  {
    try {
      return $this->orderRepo->getOrdersByUserId($userId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  public function getOrderItems($orderId)
  {
    try {
      return $this->orderRepo->getOrderItems($orderId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }
}
