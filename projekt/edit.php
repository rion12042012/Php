
<?php
include "config.php";

$id = (int)($_GET['id'] ?? 0);

$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Product not found!");
}

if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products
            SET name=?, description=?, price=?
            WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt, "ssdi",
        $name, $description, $price, $id
    );

    if(mysqli_stmt_execute($stmt)) {
        header("Location: view.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">

    <h2>Edit Product</h2>

    <form method="POST">

        <input type="text" name="name"
        value="<?php echo htmlspecialchars($product['name']); ?>"
        required>

        <textarea name="description"><?php
            echo htmlspecialchars($product['description']);
        ?></textarea>

        <input type="number" step="0.01" name="price"
        value="<?php echo $product['price']; ?>" required>

        <button type="submit" name="update">
            Update Product
        </button>

    </form>

    <a href="view.php">Back</a>

</div>

</body>
</html>
