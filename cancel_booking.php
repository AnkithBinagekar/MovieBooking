<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-top: 20px;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }

    </style>
</head>
<body>

<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    $check_query = "SELECT * FROM bookings WHERE booking_id = '$booking_id'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $delete_query = "DELETE FROM bookings WHERE booking_id = '$booking_id'";
        $delete_result = mysqli_query($connection, $delete_query);

        echo '<h1>';
        // Display the result of the cancellation
        if ($delete_result) {
            echo "<span class='success-message'>Booking with ID $booking_id canceled successfully.</span>";
        } else {
            echo "<span class='error-message'>Failed to cancel booking with ID $booking_id.</span>";
        }
        echo '</h1>';
    } else {
        // Booking ID does not exist
        echo "<h1><span class='error-message'>Booking ID $booking_id does not exist.</span></h1>";
    }
} else {
    // No POST request received
    echo "<h1><span class='error-message'>No booking ID received for cancellation.</span></h1>";
}

mysqli_close($connection);
?>

</body>
</html>
