<?php session_start();
require('./src/config/db.php');
require('./src/utility/credentialsException.php');

$page_title = 'Login';
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  try {
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([$username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password, $user['password_hash'])) {
      
      $_SESSION['success_message'] = "Login successful!";
      $_SESSION['user_id'] = $user['user_id'];
      
      $redirect = true;
    } else {
      throw new InvalidCredentialsException();
    }

  } catch (PDOException | InvalidCredentialsException $e) {
    $_SESSION['error_message'] = "Login failed: " . $e->getMessage();
  }
}
?>

<?php include('./src/shared/header.php') ?>

<body>
  <?php
  if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-primary" role="alert"> ' .
      $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
  } elseif (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
  }
  ?>
  <div class="container">
    <h2>Login</h2>
    <form method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="<?php if(isset($_POST['username'])) echo $username; ?>">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div>
      No account ?
      <a href="register.php" class="alert-link mt-2">Register here</a></div>
    </div>
  </div>
  <script src="./src/utility/scripts/validation.js"></script>
  <?php if($redirect) { ?>
    <script>
      setTimeout(function() {
        location.href = 'profile.php'
      }, 2000)
    </script>
    <?php } ?>
</body>

</html>