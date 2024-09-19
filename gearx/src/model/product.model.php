<?php
class ProductModel
{
  public $id;
  public $slug;
  public $name;
  public $description;
  public $category_id;
  public $price;
  public $mrp;
  public $rating;
  public $shipping;
  public $disabled;
  public $picture;
  public $created_at;
  public $updated_at;

  public function __construct($data = [])
  {
    if ($data) {
      $this->id = $data['id'] ?? null;
      $this->slug = $data['slug'] ?? null;
      $this->name = $data['name'] ?? null;
      $this->description = $data['description'] ?? null;
      $this->category_id = $data['category_id'] ?? null;
      $this->price = $data['price'] ?? null;
      $this->mrp = $data['mrp'] ?? null;
      $this->rating = $data['rating'] ?? 0.0;
      $this->shipping = $data['shipping'] ?? true;
      $this->disabled = $data['disabled'] ?? false;
      $this->picture = $data['picture'] ?? null;
      $this->created_at = $data['created_at'] ?? null;
      $this->updated_at = $data['updated_at'] ?? null;
    }
  }

  public function __toString()
  {
    return "Product: {$this->name}, Price: {$this->price}";
  }
}
