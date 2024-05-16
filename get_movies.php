<?php
include 'connect.php';

$sql = "SELECT MOVIE_ID, TITLE FROM MovieBooking.MOVIES";
$statement = oci_parse($connection, $sql);
oci_execute($statement);

while ($row = oci_fetch_assoc($statement)) {
    echo "<option value='" . $row['MOVIE_ID'] . "'>" . $row['TITLE'] . "</option>";
}

oci_close($connection);
?>
