<?php
ob_start();
session_start();
$pageTitle = 'GearX';
include '../src/util/helper/init.util.php';
require_once CTRL . 'product.ctrl.php';

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
  $slug = htmlspecialchars($_GET['slug']); // Sanitize input

  require_once CTRL . 'product.ctrl.php';
  $productController = new ProductController();

  $product = $productController->getProduct($slug);

  if ($product) {
    include VIEW . './pages/product/product.view.php';
  } else {
    echo "Product not found!";
  }
}

$productController = new ProductController();
$products = $productController->getAllProducts();
?>

<div style="padding-top:50px;" class="container">
  <?php include VIEW . 'components/product.comp.php'; ?>
</div>

<?php
include $layout . 'footer.php';
ob_end_flush();
?>
