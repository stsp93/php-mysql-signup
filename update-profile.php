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
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];

    try {
        $statement = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ? WHERE user_id = ?");
        $statement->execute([$newUsername, $newEmail, $newPhone, $user_id]);

        $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $statement->execute(([$user_id]));
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $_SESSION['success_message'] = 'Information updated successfuly';
        $redirect = true;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = $e;
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
        <h2>Update Profile Information</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($user)) echo $user['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($user)) echo $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php if (isset($user)) echo $user['phone']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
            <a href="profile.php" type="submit" class="btn btn-info">Back</a>
        </form>

        <hr>

        <h2>Chenge Password</h2>
        <a href="change-password.php" class="btn btn-primary">Change Password</a>

    </div>
    <script src="./src/utility/scripts/validation.js"></script>
    <?php if ($redirect) { ?>
        <script>
            setTimeout(function() {
                location.href = 'profile.php'
            }, 2000)
        </script>
    <?php } ?>
</body>

</html>