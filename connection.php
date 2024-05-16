<?php
//echo "Welcome to the stage where we are ready to get connected to a database <br>";

$servername = "localhost";
$username = "root";
$password = "";
$database = "MovieBooking";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$connection){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else {
    //echo "Connection was successful";
}
?>
