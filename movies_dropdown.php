<?php
// Include your database connection file
include 'connect.php';

// Fetch movies from the database
$queryMovies = "SELECT TITLE FROM MovieBooking.MOVIES";
$resultMovies = oci_parse($connection, $queryMovies);
oci_execute($resultMovies);

$movies = [];
while ($rowMovie = oci_fetch_assoc($resultMovies)) {
    $movies[] = $rowMovie['TITLE'];
}

oci_free_statement($resultMovies);
oci_close($connection);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($movies);
?>
