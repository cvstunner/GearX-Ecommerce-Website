<?php
ob_start();
session_start();
$pageTitle = 'GearX - Sign In';
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}
require_once __DIR__ . '/../../../util/helper/init.util.php';

include CTRL . 'auth.ctrl.php';
$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);
    $query = "SELECT id, email FROM users WHERE email = ? AND password = ?";

    $stmt = $con->prepare($query);
    $stmt->execute(array($email, $hashedPass));
    $res = $stmt->fetch();
    $count = $stmt->rowCount();

    if ($count > 0) {
      $_SESSION['auth'] = [
        "user" => [
          "id" => $res['id'],
          "email" => $res['email']
        ]
      ];
      header('Location: index.php');
      exit();
    }
  } else if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $formErrors = array();

    if (isset($email)) {
      $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
      if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true)
        $formErrors[] = 'This Email Is Not Valid';
    }

    function validatePhoneNumber($number)
    {
      $pattern = "/^\d{10}$/";
      return preg_match($pattern, $number);
    }

    if (isset($phone)) {
      $filterdPhone = validatePhoneNumber($phone);

      if (!$filterdPhone)
        $formErrors[] = 'Phone number must be of 10 digits valid number';
    }

    if (isset($password) && isset($cpassword)) {
      if (empty($password))
        $formErrors[] = 'Sorry Password Cant Be Empty';

      if (sha1($password) !== sha1($cpassword))
        $formErrors[] = "Password doesn't match";
    }


    if (empty($formErrors)) {
      $exists = $authController->isUserExists($email);

      if ($exists == 0) {
        $formErrors[] = 'Sorry This User Is Exists';
      } else {
        $hashedPassword = sha1($password);
        $stmt = $con->prepare("INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([
          $fullname,
          $email,
          $phone,
          $hashedPassword
        ]);

        $succesMsg = 'User signed in successfully';
      }
    }
  }
}

?>

<div class="container login-page">
  <h1 class="text-center">
    <span class="selected" data-class="login">Sign In</span> |
    <span data-class="signup">Sign Up</span>
  </h1>

  <!-- NOTE: Sign In -->
  <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="input-container">
      <input
        class="form-control"
        type="text"
        name="email"
        autocomplete="off"
        placeholder="Email"
        required />
    </div>
    <div class="input-container">
      <input
        class="form-control"
        type="password"
        name="password"
        autocomplete="new-password"
        placeholder="Password"
        required />
    </div>
    <input class="btn btn-primary w-100 fs-5" name="signin" type="submit" value="Sign In" />
  </form>

  <!-- NOTE: SignUp -->
  <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="input-container">
      <input
        class="form-control"
        type="text"
        name="fullname"
        placeholder="Full name"
        required />
    </div>
    <div class="input-container">
      <input
        class="form-control"
        type="email"
        name="email"
        placeholder="Email"
        required />
    </div>
    <div class="input-container">
      <input
        class="form-control"
        type="phone"
        name="phone"
        placeholder="Phone"
        required />
    </div>
    <div class="input-container">
      <input
        minlength="4"
        class="form-control"
        type="password"
        name="password"
        autocomplete="new-password"
        placeholder="Password"
        required />
    </div>
    <div class="input-container">
      <input
        minlength="4"
        class="form-control"
        type="password"
        name="cpassword"
        autocomplete="new-password"
        placeholder="Confirm Password"
        required />
    </div>
    <input class="btn btn-success w-100" name="signup" type="submit" value="Sign Up" />
  </form>
  <!-- End Signup Form -->
  <div class="the-errors text-center">
    <?php

    if (!empty($formErrors)) {

      foreach ($formErrors as $error) {

        echo '<div class="msg error">' . $error . '</div>';
      }
    }

    if (isset($succesMsg)) {

      echo '<div class="msg success">' . $succesMsg . '</div>';
    }

    ?>
  </div>
</div>

<?php
include $layout . 'footer.php';
ob_end_flush();
?>
