

<?php
$conn = mysqli_connect("localhost", "root", "", "mint_coffee");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>

