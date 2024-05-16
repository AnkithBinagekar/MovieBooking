<?php
include 'connection.php';

// Handle booking form data
// $username = $_POST['username'];
$movie_id = $_POST['movie'];
$theater_id = $_POST['theater'];
$num_tickets = $_POST['num_tickets'];

$booking_id = mt_rand(100000, 10000000);

// Perform data validation and SQL insertion
$sql = "INSERT INTO bookings (BOOKING_ID, USER_ID, SHOWTIME_ID, NUM_TICKETS)
        VALUES (
            '$booking_id',
            (SELECT USER_ID FROM users WHERE USERNAME = '$username'),
            (SELECT SHOWTIME_ID FROM showtimes WHERE MOVIE_ID = '$movie_id' AND THEATER_ID = '$theater_id'),
            '$num_tickets'
        )";

$success = mysqli_query($connection, $sql);

if (!$success) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Fetch additional booking details for display
$bookingDetails = '';
if ($success) {
    $movieQuery = "SELECT TITLE FROM movies WHERE MOVIE_ID = '$movie_id'";
    $movieResult = mysqli_query($connection, $movieQuery);
    $movie = mysqli_fetch_assoc($movieResult);

    $theaterQuery = "SELECT NAME FROM theaters WHERE THEATER_ID = '$theater_id'";
    $theaterResult = mysqli_query($connection, $theaterQuery);
    $theater = mysqli_fetch_assoc($theaterResult);

    $showtimeQuery = "SELECT START_TIME FROM showtimes WHERE MOVIE_ID = '$movie_id' AND THEATER_ID = '$theater_id'";
    $showtimeResult = mysqli_query($connection, $showtimeQuery);
    $showtime = mysqli_fetch_assoc($showtimeResult);

    $bookingDetails = "Movie: " . ($movie ? $movie['TITLE'] : 'N/A') . "<br>";
    $bookingDetails .= "Theater: " . ($theater ? $theater['NAME'] : 'N/A') . "<br>";
    $bookingDetails .= "Showtime: " . ($showtime ? $showtime['START_TIME'] : 'N/A') . "<br>";
    $bookingDetails .= "Number of Tickets: " . $num_tickets . "<br>";
}


mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Result</title>
    <style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    text-align: center;
    background-image: url('https://designmodo.com/wp-content/uploads/2017/08/gradient-1.jpg'); /* Replace 'path_to_your_image.jpg' with the actual path to your image */
    background-size: cover; /* Ensures the background image covers the entire viewport */
    background-position: center; /* Centers the background image */
}

.message-container {
    max-width: 1600px; /* Increase or decrease the value as needed */
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
}


        .success-message {
            background-color: #4caf50;
            color: #fff;
        }

        .failure-message {
            background-color: #e44d26;
            color: #fff;
        }

        .emoji {
            font-size: 2em;
            margin-bottom: 10px;
        }
       
        /* New styles for the cancel button and logo */
        .cancel-button {
    display: block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #e44d26;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 20px;
}


        .cancel-button:hover {
            background-color: #d4401f;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 10%;
            transform: translateX(-50%);
            max-width: 250px;
        }
    </style>
</head>
<body>

  <!-- Logo -->
  <img src="Cinemaflix -preview.png" alt="Logo" class="logo">
<?php
if ($success) {
    echo '<div class="message-container success-message">
            <div class="emoji">🎉</div>
            <div>Booking successful</div>
            <div>Booking ID: ' . $booking_id . '</div>
            <div>' . $bookingDetails . '</div>
        </div>';
} else {
    echo '<div class="message-container failure-message">
            <div class="emoji">😟</div>
            <div>Booking failed</div>
        </div>';
}
?>
 <a href="cancel.html" class="cancel-button">Cancel Booking</a>
</body>
</html>
