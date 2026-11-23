
<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name']);
    $email = trim($_POST['email']);
    $date = $_POST['reservation_date'];
    $time = $_POST['reservation_time'];
    $guests = filter_input(INPUT_POST, 'guests', FILTER_VALIDATE_INT);

    if ($name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)
        && $date >= date('Y-m-d') && $guests && $guests > 0 && $guests <= 20) {

        $stmt = mysqli_prepare($conn,
            "INSERT INTO reservations (customer_name,email,reservation_date,reservation_time,guests) VALUES (?,?,?,?,?)"
        );

        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $date, $time, $guests);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Your table has been reserved successfully!";
        }
    }

    if ($message === '') {
        $message = "Please check your reservation information.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reservation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container py-5">
<div class="form-card mx-auto" style="max-width:650px">

<h2 class="mb-3">☕ Reserve Your Table</h2>
<p class="text-secondary">Enjoy a wonderful moment at The Mint Coffee.</p>

<?php if($message): ?>
<div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<form method="POST">

<label class="form-label">Full Name</label>
<input type="text" name="customer_name" class="form-control mb-3" required>

<label class="form-label">Email</label>
<input type="email" name="email" class="form-control mb-3" required>

<label class="form-label">Reservation Date</label>
<input type="date" name="reservation_date" min="<?php echo date('Y-m-d'); ?>" class="form-control mb-3" required>

<label class="form-label">Reservation Time</label>
<input type="time" name="reservation_time" class="form-control mb-3" required>

<label class="form-label">Number of Guests</label>
<input type="number" name="guests" min="1" max="20" class="form-control mb-4" required>

<button class="btn-coffee">Reserve Now</button>
<a href="index.php" class="btn btn-secondary">Back Home</a>

</form>
</div>
</div>

</body>
</html>
