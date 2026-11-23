
<?php
include 'config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid product ID.");
}

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$product) {
    die("Product not found.");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $image = trim($_POST['image']);

    if ($name === '' || !is_numeric($price) || $price < 0) {
        $error = "Please enter valid information.";
    } else {
        $stmt = mysqli_prepare($conn,
            "UPDATE products SET name=?, category=?, description=?, price=?, image=? WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, "sssdsi",
            $name, $category, $description, $price, $image, $id
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin.php");
            exit;
        }
        $error = "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container py-5">
<div class="form-card mx-auto" style="max-width:650px">

<h2 class="mb-4">Edit Product</h2>

<?php if($error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST">

<label class="form-label">Product Name</label>
<input name="name" class="form-control mb-3" value="<?php echo htmlspecialchars($product['name']); ?>" required>

<label class="form-label">Category</label>
<select name="category" class="form-select mb-3">
<?php foreach(['Coffee','Drinks','Desserts'] as $category): ?>
<option value="<?php echo $category; ?>" <?php echo $product['category'] === $category ? 'selected' : ''; ?>>
<?php echo $category; ?>
</option>
<?php endforeach; ?>
</select>

<label class="form-label">Description</label>
<textarea name="description" class="form-control mb-3"><?php echo htmlspecialchars($product['description']); ?></textarea>

<label class="form-label">Price</label>
<input type="number" name="price" step="0.01" min="0" class="form-control mb-3" value="<?php echo htmlspecialchars($product['price']); ?>" required>

<label class="form-label">Image URL</label>
<input type="url" name="image" class="form-control mb-4" value="<?php echo htmlspecialchars($product['image']); ?>">

<button class="btn-coffee">Update Product</button>
<a href="admin.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</div>

</body>
</html>
