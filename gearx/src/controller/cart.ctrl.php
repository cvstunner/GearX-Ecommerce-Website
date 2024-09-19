<?php
require_once REPO . 'cart.repo.php';

class CartController
{
  private $cartRepo;

  public function __construct()
  {
    $this->cartRepo = new CartRepo();
  }

  public function getCartByUserId($userId)
  {
    try {
      return $this->cartRepo->getCartByUserId($userId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  public function addToCart($userId, $productId, $quantity = 1)
  {
    try {
      return $this->cartRepo->addToCart($userId, $productId, $quantity);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function removeFromCart($userId, $productId)
  {
    try {
      return $this->cartRepo->removeFromCart($userId, $productId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function updateCartQuantity($userId, $productId, $quantity)
  {
    try {
      return $this->cartRepo->updateCartQuantity($userId, $productId, $quantity);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
