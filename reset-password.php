<?php require('./src/utility/authenticate.php') ?>
<?php require('./src/utility/credentialsException.php') ?>
<?php
require('./src/config/db.php');
$page_title = "Reset password";
$redirect = false;


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    try {
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $password_hash = $stmt->fetch(PDO::FETCH_ASSOC)['password_hash'];


        $_SESSION['success_message'] = 'Successfully changed password';
        $new_password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 10]);

        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ? ");
        $stmt->execute([$new_password_hash, $user_id]);

        $redirect = true;
    } catch (PDOException | InvalidCredentialsException $e) {
        $_SESSION['error_message'] = $e->getMessage();
    }
}

?>

<?php include('./src/shared/header.php') ?>

<body>
<?php include('./src/shared/alert-messages.php') ?>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="rePassword">Confirm New Password:</label>
                <input type="password" class="form-control" id="rePassword" name="rePassword">
            </div>
            <button name="change-password" type="submit" class="btn btn-primary">Change Password</button>
            <a href="update-profile.php" class="btn btn-info">Back</a>
        </form>
    </div>
    <script src="./src/utility/scripts/validation.js"></script>
    <?php if ($redirect) { ?>
        <script>
            setTimeout(function() {
                location.href = 'update-profile.php'
            }, 2000)
        </script>
    <?php } ?>
</body>