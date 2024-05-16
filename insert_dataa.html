<?php
include 'connect.php';

// Handle user registration form data
$new_username = $_POST['new_username'];
$new_password = $_POST['new_password'];
$new_email = $_POST['new_email'];

// Perform data validation and SQL insertion
$sql = "INSERT INTO MovieBooking.USERS (USERNAME, PASSWORD, EMAIL)
        VALUES (:new_username, :new_password, :new_email)";

$statement = oci_parse($connection, $sql);

oci_bind_by_name($statement, ':new_username', $new_username);
oci_bind_by_name($statement, ':new_password', $new_password);
oci_bind_by_name($statement, ':new_email', $new_email);

$success = oci_execute($statement);

if ($success) {
    echo 'User registration successful';
} else {
    echo 'User registration failed';
}

oci_close($connection);
?>
