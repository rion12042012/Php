<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int)$_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $quantity = (int)$_POST['quantity'];

    $stmt = $conn->prepare(
        "UPDATE products
         SET name = ?, description = ?, quantity = ?
         WHERE id = ?"
    );

    $stmt->bind_param(
        "ssii",
        $name,
        $description,
        $quantity,
        $id
    );

    $stmt->execute();

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;
?>