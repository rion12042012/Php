
<?php
include "config.php";

$message = "";

if(isset($_POST['reserve'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = (int)$_POST['people'];

    $sql = "INSERT INTO reservations
    (name, phone, date, time, people)
    VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt, "ssssi",
        $name, $phone, $date, $time, $people
    );

    if(mysqli_stmt_execute($stmt)) {
        $message = "Reservation successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">

    <h2>Reserve Your Table</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <input type="text" name="name"
        placeholder="Your Name" required>

        <input type="text" name="phone"
        placeholder="Phone Number" required>

        <label>Reservation Date</label>
        <input type="date" name="date"
        min="<?php echo date('Y-m-d'); ?>" required>

        <label>Reservation Time</label>
        <input type="time" name="time" required>

        <input type="number" name="people"
        placeholder="Number of People"
        min="1" max="20" required>

        <button type="submit" name="reserve">
            Reserve Now
        </button>

    </form>

    <a href="index.php">Back Home</a>

</div>

</body>
</html>
