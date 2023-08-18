<?php
session_start();
require('./src/config/db.php');

$page_title = 'Main Page';

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to the login page
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}
?>

<?php include('./src/shared/header.php')  ?>

<body>
    <div class="container">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
        <h2>Profile Information</h2>
        <p>Name: John Doe</p>
        <p>Email: john@example.com</p>
        <p>Phone: 123-456-7890</p>
        <a href="update-profile.php" class="btn btn-primary">Update Info</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>

</html>