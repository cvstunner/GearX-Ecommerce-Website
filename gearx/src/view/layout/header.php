<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title><?php getTitle() ?></title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href=" https://cdn.jsdelivr.net/npm/selectboxit@3.8.2/src/stylesheets/jquery.selectBoxIt.min.css " rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $css ?>var.css" />
  <link rel="stylesheet" href="<?php echo $css ?>fonts.css" />
  <link rel="stylesheet" href="<?php echo $css ?>global.css" />
  <link rel="stylesheet" href="<?php echo $css ?>header.css" />
  <link rel="stylesheet" href="<?php echo $css ?>products.css" />
  <link rel="stylesheet" href="<?php echo $css ?>index.css" />
</head>

<body class="postion-relative">
  <header class="bg-black">
    <div id="sec-nav" class="d-flex align-items-center">
      <div class="container-sm px-3 h-100 d-flex align-items-center">
        <div class="me-auto">
          <?php
          if (isset($_SESSION['auth']["user"])) {
          ?>
            <div class="d-flex" style="max-width: max-content;">
              <div class="p-0 border-1 border-secondary d-flex align-items-center">
                <i class="fa fa-user" style="margin-top: 2px;"></i>
              </div>
              <div class="dropdown">
                <button class="btn btn-outline-transparant border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $auth["user"]["email"] ?>
                </button>
                <ul class="dropdown-menu overflow-hidden">
                  <li><a class="dropdown-item py-2 px-4" href="profile.php">My Profile</a></li>
                  <li><a class="dropdown-item py-2 px-4" href="newad.php">New Item</a></li>
                  <li><a class="dropdown-item py-2 px-4" href="myItems.php">My Items</a></li>
                  <li><a class="dropdown-item py-2 px-4" href="logout.php">Logout</a></li>
                </ul>
              </div>
            </div>

          <?php

          } else {
          ?>
            <a href="signin">
              <span class="pull-right">Login/Signup</span>
            </a>
          <?php }
          if ($_SERVER['REQUEST_URI'] === '/signin') {
            include VIEW . 'pages/auth/signin.php';
            exit;
          } ?>
        </div>
        <div class="h-100 flex-nowrap">
          <div class="row flex-nowrap h-100 w-100 text-center ms-2">
            <div class="col-6 d-flex align-items-center justify-content-center px-3 col-md-3">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook text-dark"></i>
              </a>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center px-3 col-md-3">
              <a href="#" class="social-icon">
                <i class="fab fa-instagram text-dark"></i>
              </a>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center px-3 col-md-3">
              <a href="#" class="social-icon">
                <i class="fab fa-twitter text-dark"></i>
              </a>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center px-3 col-md-3">
              <a href="#" class="social-icon">
                <i class="fab fa-whatsapp text-dark"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav id="primary-nav" class="navbar navbar-expand-lg">
      <div class="container d-flex">
        <div>
          <a class="navbar-brand d-flex" href="index.php"><img src="<?php echo $icons ?>/brand-logo.png" height="55px" /></a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item px-1"><a class="nav-link active"><span>Home</span></a></li>
            <?php
            require_once CTRL . 'category.ctrl.php';
            require_once MODEL . 'category.model.php';

            $categoryController = new CategoryController();
            $categories = $categoryController->getAllCategories();

            foreach ($categories as $category) {
              echo '<li class="nav-item px-1">
            <a class="nav-link" href="categories.php?pageid=' . $category->id . '">
                <span>' . $category->name . '</span>
            </a>
          </li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
