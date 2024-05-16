<?php
include 'connect.php';

$mod_username = $_POST['mod_username'];
$new_password = $_POST['new_password'];
$new_email = $_POST['new_email'];

$sql = "UPDATE MovieBooking.USERS SET PASSWORD = :new_password, EMAIL = :new_email WHERE USERNAME = :username";
$statement = oci_parse($connection, $sql);

oci_bind_by_name($statement, ':new_password', $new_password);
oci_bind_by_name($statement, ':new_email', $new_email);
oci_bind_by_name($statement, ':username', $mod_username);

$success = oci_execute($statement);

if ($success) {
    // Modification successful
    echo 'Modification successful';
} else {
    // Modification failed
    echo 'Modification failed';
}

oci_close($connection);
?>
