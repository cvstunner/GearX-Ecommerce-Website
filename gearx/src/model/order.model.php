<?php

class OrderModel
{
  public $id;
  public $user_id;
  public $status;
  public $total_amount;
  public $address;
  public $created_at;
  public $updated_at;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->user_id = $data['user_id'] ?? null;
      $this->status = $data['status'] ?? 'pending';
      $this->total_amount = $data['total_amount'] ?? null;
      $this->address = $data['address'] ?? null;
      $this->created_at = $data['created_at'] ?? null;
      $this->updated_at = $data['updated_at'] ?? null;
    }
  }

  public function __toString()
  {
    return "Order: {$this->id}, Total: {$this->total_amount}, Status: {$this->status}";
  }
}
