<?php require('./src/utility/authenticate.php') ?>
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


try {
    $randomPassword = generateRandomPassword();
    $new_password_hash = password_hash($randomPassword, PASSWORD_BCRYPT, ['cost' => 10]);

    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ? ");
    $stmt->execute([$new_password_hash, $user_id]);

    $_SESSION['success_message'] = "New password is $randomPassword";
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
}
header('Location: update-profile.php');

?>