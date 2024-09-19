<?php

class UserModel
{
  public $id;
  public $fullname;
  public $email;
  public $phone;
  public $password;
  public $disabled;
  public $created_at;
  public $updated_at;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->fullname = $data['fullname'] ?? null;
      $this->email = $data['email'] ?? null;
      $this->phone = $data['phone'] ?? null;
      $this->password = $data['password'] ?? null;
      $this->disabled = $data['disabled'] ?? false;
      $this->created_at = $data['created_at'] ?? null;
      $this->updated_at = $data['updated_at'] ?? null;
    }
  }

  public function __toString()
  {
    return "User: {$this->fullname}, Email: {$this->email}";
  }
}
