<?php
require_once REPO . 'product.repo.php';

class ProductController
{

  private $productRepo;

  public function __construct()
  {
    $this->productRepo = new ProductRepo();
  }

  public function getAllProducts()
  {
    try {
      $products = $this->productRepo->getAllProducts();

      return $products;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  public function getProduct($slug)
  {
    try {
      $product = $this->productRepo->getProduct($slug);

      return $product;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return null;
    }
  }

  public function createProduct($name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture)
  {
    try {
      $this->productRepo->createProduct($name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture);

      return "Product created successfully.";
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return "Error creating product.";
    }
  }

  public function updateProduct($id, $name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture)
  {
    try {
      $this->productRepo->updateProduct($id, $name, $description, $category_id, $price, $mrp, $rating, $shipping, $picture);

      return "Product updated successfully.";
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return "Error updating product.";
    }
  }

  public function deleteProduct($id)
  {
    try {
      $this->productRepo->deleteProduct($id);

      return "Product deleted successfully.";
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return "Error deleting product.";
    }
  }
}
