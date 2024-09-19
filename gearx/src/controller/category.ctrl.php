<?php

require_once REPO . 'category.repo.php';

class CategoryController
{
  private $categoryRepository;

  public function __construct()
  {
    $this->categoryRepository = new CategoryRepository();
  }

  public function getAllCategories()
  {
    return $this->categoryRepository->getAllCategories();
  }
}
