<?php
include 'connection.php'; // Include your database connection file

$userID = ''; // Initialize user ID variable

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['user_id'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Inserting data into the users table
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // Fetch the user ID after successful registration
        $userIDQuery = "SELECT user_id FROM users WHERE username = '$username'";
        $userIDResult = mysqli_query($connection, $userIDQuery);
        if ($userIDResult && mysqli_num_rows($userIDResult) > 0) {
            $row = mysqli_fetch_assoc($userIDResult);
            $userID = $row['user_id'];
        }
    } else {
        echo "Registration failed. Please try again.";
    }
}

// Handle form submission to update user password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $prevPassword = $_POST['prev_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    // Fetch the user details based on the user ID
    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
// Handle form submission to update user password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    // ... (existing code remains unchanged)

    $updateResult = false; // Initialize $updateResult variable

    if ($userData['password'] === $prevPassword && $newPassword === $confirmNewPassword) {
        // Update user password in the database
        $updateQuery = "UPDATE users SET password='$newPassword' WHERE user_id=$userId";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            echo '<script>alert("Password updated successfully!");</script>';
        } else {
            echo '<script>alert("Failed to update password. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Previous password is incorrect or new passwords do not match.");</script>';
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="update.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Cinemaflix -preview.png" alt="Movie Booking Logo">
        </div>
    </header>

    <!-- Form to register new user -->
    <div class="form-container">
        <?php if ($userID !== '') { ?>
            <p>Your User ID: <?php echo $userID; ?></p>
        <?php } ?>
        
        <!-- User Registration Form -->
        <?php if ($userID === '') { ?>
            <h2>Register</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <input type="submit" value="Register">
            </form>
        <?php } ?>
        
        <!-- Password Modification Form -->
        <?php if ($userID !== '') { ?>
            <h2>Change Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="user_id" value="<?php echo $userID; ?>">

                <label for="prev_password">Previous Password:</label>
                <input type="password" id="prev_password" name="prev_password" required>
                <br>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <br>

                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password" required>
                <br>

                <input type="submit" value="Update Password">
            </form>
        <?php } ?>
    </div>
</body>
</html>
