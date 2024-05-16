<?php
include 'connection.php'; // Include your database connection file

$userID = ''; // Initialize user ID variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Open both update_process.php and index.php in new tabs/windows
            echo '<script>';
            echo 'window.open("update_process.php?user_id=' . $userID . '", "_blank");';
            echo 'window.open("index.php", "_blank");';
            echo '</script>';
        }
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="users.css">
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
        
        <!-- Redirect button for modifying user data -->
        <form action="update_process.php" method="get">
            <input type="hidden" name="user_id" value="<?php echo $userID; ?>">
            <input type="submit" value="Modify User Data">
        </form>
    </div>
</body>
</html>
