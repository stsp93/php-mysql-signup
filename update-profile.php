<?php session_start() ?>

<?php include('./src/shared/header.php') ?>
<body>
    <div class="container">
        <h2>Update Profile Information</h2>
        <form action="update_info.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="John Doe">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="john@example.com">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="123-456-7890">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
            <a href="profile.php" type="submit" class="btn btn-info">Back</a>
        </form>
        
        <hr>
        
        <h2>Reset Password</h2>
        <form action="reset_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>
</html>