<?php session_start();
require_once './src/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT, ['cost' => 10] );
    $phone = $_POST['phone'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $phone]);
        $_SESSION['success_message'] = "Registration successful!";
        header('Location: index.php'); // Redirect to a success page or login page
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Registration failed: " . $e->getMessage();
    }
}
?>

<?php include('./src/shared/header.php'); ?>


<body>
    <div class="container">
      <h2>Registration Form</h2>
      <form method="post" action="register.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone number</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
  </body>
</html>
