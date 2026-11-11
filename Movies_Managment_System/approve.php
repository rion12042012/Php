
<?php

include_once('config.php');

// Check if booking ID exists
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = (int) $_GET['id'];

    // Update booking status
    $sql = "UPDATE bookings
            SET is_approved = 1
            WHERE id = :id";

    $prep = $conn->prepare($sql);

    $prep->bindParam(':id', $id, PDO::PARAM_INT);

    if ($prep->execute()) {

        header("Location: list_movies.php");
        exit;

    } else {

        echo "Error approving booking!";
    }

} else {

    echo "Invalid booking ID!";
}

?>

 


