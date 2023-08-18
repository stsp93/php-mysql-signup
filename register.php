<?php session_start();
require('./src/config/db.php');

$page_title='Register';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 10]);
  $phone = $_POST['phone'];

  try {
    $statement = $pdo->prepare("INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)");
    $statement->execute([$username, $email, $password, $phone]);
    $_SESSION['success_message'] = "Registration successful!";
  } catch (PDOException $e) {
    $_SESSION['error_message'] = "Registration failed: " . $e->getMessage();
  }
}
?>

<?php include('./src/shared/header.php'); ?>


<body>
<?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-primary" role="alert"> '.
        $_SESSION['success_message'] . ' <a href="/'.basename(__DIR__). '/login.php'.'" class="alert-link">Login here</a></div>';
        unset($_SESSION['success_message']);
    }elseif (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
  <div class="container">
    <h2>Register</h2>
    <form method="post" action="register.php">
      <div class="mb-3">
        <label for="username" class="form-label">Username* (min 3 chars)</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address* (valid email)</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone number</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password* (min 3 chars)</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <div class="mb-3">
        <label for="rePassword" class="form-label">Repeat*</label>
        <input type="password" class="form-control" id="rePassword" name="rePassword" placeholder="Repeat password">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div>
      Already registered ?
      <a href="<?='/'.basename(__DIR__). '/login.php'?>" class="alert-link mt-2">Login here</a></div>
    </div>
  </div>

  <script src="./src/utility/validation.js"></script>
</body>

</html>