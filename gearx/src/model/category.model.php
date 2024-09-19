<?php

class Category
{
  public $id;
  public $name;

  public function __construct($data = [])
  {
    $this->id = $data['id'] ?? null;
    $this->name = $data['name'] ?? null;
  }

  public function __toString()
  {
    return $this->name;
  }
}
