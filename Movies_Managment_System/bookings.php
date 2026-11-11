
<?php

session_start();

include_once('config.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$is_admin = $_SESSION['is_admin'] ?? 'false';

// Get bookings based on user role

if ($is_admin == 'true' || $is_admin == 1) {

    $sql = "SELECT
                movies.movie_name,
                users.email,
                bookings.id,
                bookings.nr_tickets,
                bookings.date,
                bookings.is_approved,
                bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->execute();

    $bookings_data = $selectBookings->fetchAll(PDO::FETCH_ASSOC);

} else {

    $sql = "SELECT
                movies.movie_name,
                users.email,
                bookings.nr_tickets,
                bookings.date,
                bookings.is_approved,
                bookings.time
            FROM movies
            INNER JOIN bookings ON movies.id = bookings.movie_id
            INNER JOIN users ON users.id = bookings.user_id
            WHERE bookings.user_id = :user_id";

    $selectBookings = $conn->prepare($sql);
    $selectBookings->bindParam(':user_id', $user_id);
    $selectBookings->execute();

    $bookings_data = $selectBookings->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dashboard</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<header class="navbar navbar-dark sticky-top bg-dark p-3">

    <a class="navbar-brand" href="#">
        Welcome to dashboard
        <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
    </a>

    <a class="nav-link text-white" href="logout.php">
        Sign out
    </a>

</header>


<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->

        <nav class="col-md-3 col-lg-2 bg-light min-vh-100">

            <div class="pt-3">

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link" href="home.php">
                            Home
                        </a>
                    </li>

                    <?php if ($is_admin == 'true' || $is_admin == 1) { ?>

                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="list_movies.php">
                                Movies
                            </a>
                        </li>

                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">
                            Bookings
                        </a>
                    </li>

                </ul>

            </div>

        </nav>


        <!-- Main Content -->

        <main class="col-md-9 col-lg-10 px-md-4">

            <div class="pt-3 pb-2 mb-3 border-bottom">

                <h1 class="h2">Dashboard</h1>

            </div>


            <h2>Movie Bookings</h2>

            <div class="table-responsive">

                <table class="table table-striped table-bordered">

                    <thead>

                        <tr>

                            <th>Movie Name</th>
                            <th>User Email</th>
                            <th>Number of Tickets</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Approved</th>

                            <?php if ($is_admin == 'true' || $is_admin == 1) { ?>
                                <th>Actions</th>
                            <?php } ?>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (count($bookings_data) > 0) { ?>

                            <?php foreach ($bookings_data as $booking_data) { ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars($booking_data['movie_name']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($booking_data['email']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($booking_data['nr_tickets']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($booking_data['date']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($booking_data['time']) ?>
                                    </td>

                                    <td>

                                        <?php if ($booking_data['is_approved'] == 1 || $booking_data['is_approved'] == 'true') { ?>

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        <?php } else { ?>

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        <?php } ?>

                                    </td>


                                    <?php if ($is_admin == 'true' || $is_admin == 1) { ?>

                                        <td>

                                            <?php if ($booking_data['is_approved'] != 1 && $booking_data['is_approved'] != 'true') { ?>

                                                <a class="btn btn-success btn-sm"
                                                   href="approve.php?id=<?= (int)$booking_data['id'] ?>">
                                                    Approve
                                                </a>

                                                <a class="btn btn-danger btn-sm"
                                                   href="decline.php?id=<?= (int)$booking_data['id'] ?>"
                                                   onclick="return confirm('Decline this booking?')">
                                                    Decline
                                                </a>

                                            <?php } else { ?>

                                                <span class="text-success">
                                                    Completed
                                                </span>

                                            <?php } ?>

                                        </td>

                                    <?php } ?>

                                </tr>

                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="<?= ($is_admin == 'true' || $is_admin == 1) ? 7 : 6 ?>"
                                    class="text-center">

                                    No bookings found.

                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
