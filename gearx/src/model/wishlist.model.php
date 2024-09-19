<?php

class WishlistModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $created_at;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->user_id = $data['user_id'] ?? null;
      $this->product_id = $data['product_id'] ?? null;
      $this->created_at = $data['created_at'] ?? null;
    }
  }

  public function __toString()
  {
    return "Wishlist Item: User ID: {$this->user_id}, Product ID: {$this->product_id}";
  }
}
