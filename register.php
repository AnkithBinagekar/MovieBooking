<?php
// Include the database connection file
include 'connect.php';

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$user_id = mt_rand(1, 1000);

// Prepare and execute the SQL query to insert user data
$sql = "INSERT INTO MovieBooking.USERS (user_id, username, password, email) VALUES ( :username, :password, :email)";
$statement = oci_parse($connection, $sql);

oci_bind_by_name($statement, ':username', $username);
oci_bind_by_name($statement, ':password', $password);
oci_bind_by_name($statement, ':email', $email);

$success = oci_execute($statement);

if ($success) {
    echo 'User registered successfully';
} else {
    echo 'User registration failed';
}

oci_close($connection);
?>
