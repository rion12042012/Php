<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Product not found!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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

    <h1>Edit Product</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="id"
               value="<?= $product['id'] ?>">

        <label>Product Name</label>
        <input type="text" name="name"
               value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>Description</label>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

        <label>Quantity</label>
        <input type="number" name="quantity"
               value="<?= $product['quantity'] ?>" min="0" required>

        <button type="submit">Update Product</button>

        <a href="index.php" class="btn">Back</a>

    </form>

</div>

</body>
</html>