<?php
require_once 'config.php';

$total = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];

$stock = $conn->query("SELECT SUM(quantity) AS total FROM products")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

    <h1>Dashboard</h1>
    <p>Welcome to Product Management System</p>

    <div class="cards">

        <div class="card">
            <h3>Total Products</h3>
            <h2><?= $total ?></h2>
        </div>

        <div class="card">
            <h3>Total Quantity</h3>
            <h2><?= $stock ?></h2>
        </div>

    </div>

</div>

</body>
</html>