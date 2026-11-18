<?php
include "config.php";

if (isset($_POST['update'])) {

    $id = (int)$_POST['id'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $sql = "UPDATE `database` SET
        first_name = ?,
        last_name = ?,
        email = ?,
        phone = ?,
        course = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $first_name,
        $last_name,
        $email,
        $phone,
        $course,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating student!";
    }
}
?>