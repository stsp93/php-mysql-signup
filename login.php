<?php session_start();
require('./src/config/db.php');
require('./src/utility/CredentialsException.php');

$page_title = "Login";
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    require('./src/utility/form-handler.php');

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {

      $_SESSION['success_message'] = "Login successful!";
      $_SESSION['user_id'] = $user['user_id'];

      $redirect = true;
    } else {
      throw new InvalidCredentialsException();
    }
  } catch (Exception $e) {
    $_SESSION['error_message'] = "Login failed: " . $e->getMessage();
  }
}
?>

<?php include('./src/shared/header.php') ?>

<body>
  <?php include('./src/shared/alert-messages.php') ?>
  <div class="container">
    <h2>Login</h2>
    <form method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if (isset($_POST['email'])) echo $email; ?>">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div>
      No account ?
      <a href="register.php" class="alert-link mt-2">Register here</a>
    </div>
    <div>
      Forgotten password ?
      <a href="reset-password.php" class="link-info mt-2">Reset password</a>
    </div>
  </div>
  </div>
  </div>
  <script src="./src/utility/scripts/clientValidation.js"></script>
  <?php if ($redirect) { ?>
    <script>
      setTimeout(function() {
        location.href = 'profile.php'
      }, 2000)
    </script>
  <?php } ?>
</body>

</html>