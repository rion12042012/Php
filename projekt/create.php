
<?php
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $image = trim($_POST['image']);

    if ($name === '' || !is_numeric($price) || $price < 0) {
        $error = "Please enter valid product information.";
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO products (name, category, description, price, image) VALUES (?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sssds",
            $name, $category, $description, $price, $image
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin.php");
            exit;
        }
        $error = "Could not save product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container py-5">
<div class="form-card mx-auto" style="max-width:650px">

<h2 class="mb-4">☕ Add New Product</h2>

<?php if($error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST">

<label class="form-label">Product Name</label>
<input type="text" name="name" class="form-control mb-3" required>

<label class="form-label">Category</label>
<select name="category" class="form-select mb-3">
<option value="Coffee">Coffee</option>
<option value="Drinks">Drinks</option>
<option value="Desserts">Desserts</option>
</select>

<label class="form-label">Description</label>
<textarea name="description" class="form-control mb-3"></textarea>

<label class="form-label">Price (€)</label>
<input type="number" name="price" step="0.01" min="0" class="form-control mb-3" required>

<label class="form-label">Image URL</label>
<input type="url" name="image" class="form-control mb-4">

<button class="btn-coffee">Save Product</button>
<a href="admin.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</div>

</body>
</html>
