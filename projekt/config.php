
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "the_mint_coffee"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
