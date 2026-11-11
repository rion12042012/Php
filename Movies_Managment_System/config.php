
<?php

// Database connection variables

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "mms";

try {

    // Connect to MySQL using PDO

    $conn = new PDO(
        "mysql:host=$server;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    // Set PDO error mode

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    // Fetch database results as associative arrays

    $conn->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}

?>
