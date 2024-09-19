<?php

class OrderItemModel
{
  public $id;
  public $order_id;
  public $product_id;
  public $quantity;
  public $price;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->order_id = $data['order_id'] ?? null;
      $this->product_id = $data['product_id'] ?? null;
      $this->quantity = $data['quantity'] ?? 1;
      $this->price = $data['price'] ?? null;
    }
  }

  public function __toString()
  {
    return "Order Item: Product ID: {$this->product_id}, Quantity: {$this->quantity}, Price: {$this->price}";
  }
}
