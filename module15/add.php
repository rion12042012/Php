<?php
require_once 'config.php';

if(isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $quantity = (int)$_POST['quantity'];

    $stmt = $conn->prepare(
        "INSERT INTO products (name, description, quantity)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("ssi", $name, $description, $quantity);

    if($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>Product System</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="index.php">Products</a>
    <a href="add.php">Add Product</a>
</div>

<div class="main">

    <h1>Add New Product</h1>

    <form method="POST">

        <label>Product Name</label>
        <input type="text" name="name" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Quantity</label>
        <input type="number" name="quantity" min="0" required>

        <button type="submit" name="submit">
            Add Product
        </button>

        <a href="index.php" class="btn">Back</a>

    </form>

</div>

</body>
</html>