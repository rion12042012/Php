
<?php

session_start();

include_once('config.php');

// Check if user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['movie_id'])) {
    header("Location: login.php");
    exit;
}

// Get user and movie IDs
$user_id = (int) $_SESSION['id'];
$movie_id = (int) $_SESSION['movie_id'];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $nr_tickets = (int) $_POST['nr_tickets'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validate data
    if ($nr_tickets <= 0 || empty($date) || empty($time)) {
        die("Please fill in all fields correctly!");
    }

    // Insert booking into database
    $sql = "INSERT INTO bookings
            (user_id, movie_id, nr_tickets, date, time)
            VALUES
            (:user_id, :movie_id, :nr_tickets, :date, :time)";

    $insertBooking = $conn->prepare($sql);

    $insertBooking->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $insertBooking->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
    $insertBooking->bindParam(':nr_tickets', $nr_tickets, PDO::PARAM_INT);
    $insertBooking->bindParam(':date', $date);
    $insertBooking->bindParam(':time', $time);

    if ($insertBooking->execute()) {

        header("Location: home.php");
        exit;

    } else {

        echo "Error creating booking!";
    }

} else {

    header("Location: home.php");
    exit;
}

?>


	
	











 ?>