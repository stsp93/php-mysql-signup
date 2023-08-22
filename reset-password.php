<?php require('./src/utility/authenticate.php') ?>
<?php require('./src/utility/CredentialsException.php') ?>
<?php
require('./src/config/db.php');
$page_title = "Reset password";
$redirect = false;


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    try {
        require('./src/utility/form-handler.php');

        $new_password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ? ");
        $stmt->execute([$new_password_hash, $user_id]);
        
        $_SESSION['success_message'] = 'New password set';
        $redirect = true;
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
    }
}

?>

<?php include('./src/shared/header.php') ?>

<body>
<?php include('./src/shared/alert-messages.php') ?>
    <div class="container">
    <h2>Choose new password</h2>
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
    <script src="./src/utility/scripts/clientValidation.js"></script>
    <?php if ($redirect) { ?>
        <script>
            setTimeout(function() {
                location.href = 'update-profile.php'
            }, 2000)
        </script>
    <?php } ?>
</body>