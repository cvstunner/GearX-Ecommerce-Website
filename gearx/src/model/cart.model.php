<?php

class CartModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $quantity;
  public $created_at;
  public $updated_at;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->user_id = $data['user_id'] ?? null;
      $this->product_id = $data['product_id'] ?? null;
      $this->quantity = $data['quantity'] ?? 1;
      $this->created_at = $data['created_at'] ?? null;
      $this->updated_at = $data['updated_at'] ?? null;
    }
  }

  public function __toString()
  {
    return "Cart Item: Product ID: {$this->product_id}, Quantity: {$this->quantity}";
  }
}
