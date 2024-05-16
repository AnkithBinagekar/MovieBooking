<?php
// Include your database connection file
include 'connect.php';

// Fetch theaters from the database
$queryTheaters = "SELECT NAME FROM MovieBooking.THEATERS";
$resultTheaters = oci_parse($connection, $queryTheaters);
oci_execute($resultTheaters);

$theaters = [];
while ($rowTheater = oci_fetch_assoc($resultTheaters)) {
    $theaters[] = $rowTheater['NAME'];
}

oci_free_statement($resultTheaters);
oci_close($connection);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($theaters);
?>
