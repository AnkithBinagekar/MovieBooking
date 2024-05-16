<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "MovieBooking";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch movies and theaters from the database
$sqlMovies = "SELECT MOVIE_ID, TITLE FROM MOVIES";
$sqlTheaters = "SELECT THEATER_ID, NAME FROM THEATERS";
$sqlSeats = "SELECT SEAT_ID, SEAT_NUMBER FROM SEATS";
$sqlShowtimes = "SELECT SHOWTIME_ID, START_TIME FROM SHOWTIMES";

$resultMovies = $connection->query($sqlMovies);
$resultTheaters = $connection->query($sqlTheaters);
$resultSeats = $connection->query($sqlSeats);
$resultShowtimes = $connection->query($sqlShowtimes);


// Fetch data and store in arrays
$movies = [];
$theaters = [];
$seats = [];
$showtimes = [];

if ($resultMovies->num_rows > 0) {
    while ($row = $resultMovies->fetch_assoc()) {
        $movies[$row['MOVIE_ID']] = $row['TITLE'];
    }
}

if ($resultTheaters->num_rows > 0) {
    while ($row = $resultTheaters->fetch_assoc()) {
        $theaters[$row['THEATER_ID']] = $row['NAME'];
    }
}

if ($resultSeats->num_rows > 0) {
    while ($row = $resultSeats->fetch_assoc()) {
        $seats[$row['SEAT_ID']] = $row['SEAT_NUMBER'];
    }
}

if ($resultShowtimes->num_rows > 0) {
    while ($row = $resultShowtimes->fetch_assoc()) {
        $showtimes[$row['SHOWTIME_ID']] = $row['START_TIME'];
    }
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Booking System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom,#780206 ,#ffffff); 
        }

       

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            max-width: 150px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

   /* Slideshow styles */
   .slideshow-container {
            max-width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        .mySlides img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 3px;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Form styles */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select,
        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Cancel button */
        .cancel-button {
            display: block;
            width: fit-content;
            margin: 0 auto;
            text-align: center;
            color: #888;
            text-decoration: none;
            font-size: 16px;
        }

        .cancel-button:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1></h1>
        <img src="Cinemaflix -preview.png" alt="Movie Booking System" class="logo">
    </header>
    
    <!-- Rest of your content -->
</body>

<meta charset="UTF-8">
    <title>Movie Slideshow</title>
    <style>
        /* Styles for the slideshow container */
        .slideshow-container {
            max-width: 800px; /* Adjust the width as needed */
            margin: auto;
            position: relative;
        }

        /* Styles for the images */
        .mySlides img {
            width: 100%; /* Fit the image within the container */
            height: auto;
            display: block; /* Fixes alignment issue */
        }

        /* Rest of the slideshow styles remain the same */

        /* Additional CSS for the form and layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px; /* Add some padding for better layout */
        }

        /* Rest of your styles */
    </style>
</head>
<body>

<!-- Slideshow -->
<div class="slideshow-container">
    <!-- Images for the slideshow -->
    <div class="mySlides fade">
        <img src="https://staticg.sportskeeda.com/editor/2023/04/e42b8-16817914737548-1920.jpg" alt="Movie 1">
    </div>
    <div class="mySlides fade">
        <img src="https://assets-in.bmscdn.com/discovery-catalog/events/et00313411-sfmzjuvwzp-landscape.jpg" alt="Movie 2">
    </div>
    <div class="mySlides fade">
        <img src="https://lehren.com/wp-content/uploads/2023/10/12th-fail-review.jpg" alt="Movie 2">
    </div>

    <div class="mySlides fade">
        <img src="https://assets-in.bmscdn.com/iedb/movies/images/mobile/listing/medium/khichdi-2-et00368865-1698646979.jpg" alt="Movie 2">
    </div>
    <!-- Add more images as needed -->

    <!-- Navigation buttons for the slideshow -->
    
</div>
<br>

    <!-- Booking form -->
    <form action="insert_booking.php" method="post">
        <label for="movie">Select Movie:</label>
        <select id="movie" name="movie" required>
            <?php
            foreach ($movies as $movieId => $movieTitle) {
                echo "<option value=\"$movieId\">$movieTitle</option>";
            }
            ?>
        </select>

        <label for="theater">Select Theater:</label>
        <select id="theater" name="theater" required>
            <?php
            foreach ($theaters as $theaterId => $theaterName) {
                echo "<option value=\"$theaterId\">$theaterName</option>";
            }
            ?>
        </select>

        <label for="showtime">Select Showtime:</label>
        <select id="showtime" name="showtime" required>
            <?php
            foreach ($showtimes as $showtimeId => $startTime) {
                echo "<option value=\"$showtimeId\">$startTime</option>";
            }
            ?>
        </select>

        <label for="seat">Select Seat:</label>
        <select id="seat" name="seat" required>
            <?php
            foreach ($seats as $seatId => $seatNumber) {
                echo "<option value=\"$seatId\">$seatNumber</option>";
            }
            ?>
        </select>

        <label for="num_tickets">Number of Tickets:</label>
        <input type="number" id="num_tickets" name="num_tickets" required>

        <input type="submit" value="Book Now">
    </form>
    

    <!-- Special styled button for Cancel Booking -->
    <a href="cancel.html" class="cancel-button">Cancel Booking</a>
</div>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        const slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
</script>


</body>
</html>
