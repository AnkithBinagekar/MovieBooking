<?php
include 'connect.php';

$sql = "SELECT THEATER_ID, NAME FROM MovieBooking.THEATERS";
$statement = oci_parse($connection, $sql);
oci_execute($statement);

while ($row = oci_fetch_assoc($statement)) {
    echo "<option value='" . $row['THEATER_ID'] . "'>" . $row['NAME'] . "</option>";
}

oci_close($connection);
?>
