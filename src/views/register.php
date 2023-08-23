<?php session_start();
require('./src/config/db.php');

$page_title = 'Register';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
  require('./src/utility/form-handler.php');

  $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);


    $statement = $pdo->prepare("INSERT INTO users (username, email, password_hash, phone) VALUES (?, ?, ?, ?)");
    $statement->execute([$username,$email,$password_hash,$phone]);
    $_SESSION['success_message'] = "Registration successful!";
  } catch (Exception $e) {
    $_SESSION['error_message'] = "Registration failed: " . $e->getMessage();
  }
}
?>

<?php include('./src/shared/header.php'); ?>
<body>
  <?php
  $loginAnchor = ' <a href="login" class="alert-link">Login here</a></div>';
  include('./src/shared/alert-messages.php');
  ?>
  <div class="container">
    <h2>Register</h2>
    <form method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username* (min 3 chars)</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="<?php if (isset($_POST['username'])) echo $username; ?>">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address* (valid email)</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if (isset($_POST['email'])) echo $email; ?>">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone number (+359 --- --- ---)</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php if (isset($_POST['phone'])) echo $phone; ?>">
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
      <a href="login" class="alert-link mt-2">Login here</a>
    </div>
  </div>
  </div>
  <script src="./src/utility/scripts/clientValidation.js"></script>
</body>

</html>