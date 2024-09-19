<?php
require_once REPO . 'wishlist.repo.php';

class WishlistController
{
  private $wishlistRepo;

  public function __construct()
  {
    $this->wishlistRepo = new WishlistRepo();
  }

  public function getWishlistByUserId($userId)
  {
    try {
      return $this->wishlistRepo->getWishlistByUserId($userId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  public function addToWishlist($userId, $productId)
  {
    try {
      return $this->wishlistRepo->addToWishlist($userId, $productId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function removeFromWishlist($userId, $productId)
  {
    try {
      return $this->wishlistRepo->removeFromWishlist($userId, $productId);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
