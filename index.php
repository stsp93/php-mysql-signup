<?php
session_start();

$page_title='Main Page';

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to the login page
    exit();
}

$username = $_SESSION['username'];
?>

<?php include('./src/shared/header.php')  ?>

<body>
    <h1>
        Hello <?=$username ?>
    </h1>
</body>

</html>