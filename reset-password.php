<?php
require('./src/config/db.php');
$page_title = "Reset password";

function generateRandomPassword($length = 5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomPassword;
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    session_start();

    try {
        include('./src/utility/form-handler.php');

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user_id = $stmt->fetch(PDO::FETCH_ASSOC)['user_id'];

        // Simulate sending email with the new password
        $randomPassword = generateRandomPassword();
        $new_password_hash = password_hash($randomPassword, PASSWORD_BCRYPT, ['cost' => 10]);
        
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ? ");
        $stmt->execute([$new_password_hash, $user_id]);

        // mail($mail,'Password reset',"New password is $randomPassword","From: loginPage@email.com");

        $_SESSION['success_message'] = "New password is $randomPassword";
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
    }
    header('Location: login.php');
    exit();
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
        <form method="post">
            <div class="form-group">
                <label for="current_password">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary reset">Reset Password</button>
            <a href="login.php" class="btn btn-info">Back</a>
        </form>
    </div>
    <script src="./src/utility/scripts/clientValidation.js"></script>
    <script>
        $('.reset').on('click', function(e) {
            if(!confirm('Are you sure')) {
                e.preventDefault();
            }
        })
    </script>
</body>

</html>