<?php require('./src/utility/authenticate.php') ?>
<?php 
require('./src/config/db.php');
$page_title = "Update profile";
$redirect = false;

try {
    $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $statement->execute(([$user_id]));
    $user = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        require('./src/utility/form-handler.php');

        $statement = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ? WHERE user_id = ?");
        $statement->execute([$username, $email, $phone, $user_id]);

        $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $statement->execute(([$user_id]));
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $_SESSION['success_message'] = "Information updated successfully";
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
        <h2>Update Profile Information</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">*Username: (min 3 chars)</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($user)) echo $user['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">*Email: (valid mail)</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($user)) echo $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone: (+123 123 123 123)</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php if (isset($user)) echo $user['phone']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
            <a href="profile.php" class="btn btn-info">Back</a>
        </form>

        <hr>

        <h2>Change Password</h2>
        <a href="change-password.php" class="btn btn-primary">Change Password</a>
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