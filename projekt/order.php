
<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $customer = trim($_POST['customer_name']);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($product_id && $customer !== '' && $quantity && $quantity > 0 && $quantity <= 100) {

        $stmt = mysqli_prepare($conn, "SELECT price FROM products WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($product) {
            $total = $product['price'] * $quantity;

            $stmt = mysqli_prepare($conn,
                "INSERT INTO orders (product_id, customer_name, quantity, total) VALUES (?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "isid",
                $product_id, $customer, $quantity, $total
            );

            if (mysqli_stmt_execute($stmt)) {
                $message = "Your order was placed successfully!";
            }
        }
    }

    if ($message === '') {
        $message = "Please check your order details.";
    }
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Place an Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container py-5">
<div class="form-card mx-auto" style="max-width:600px">

<h2 class="mb-4">☕ Place Your Order</h2>

<?php if($message): ?>
<div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<form method="POST">

<label class="form-label">Your Name</label>
<input type="text" name="customer_name" class="form-control mb-3" required>

<label class="form-label">Choose Product</label>
<select name="product_id" class="form-select mb-3" required>
<option value="">Select a product</option>
<?php while($p = mysqli_fetch_assoc($products)): ?>
<option value="<?php echo $p['id']; ?>"
<?php echo isset($_GET['product_id']) && (int)$_GET['product_id'] === (int)$p['id'] ? 'selected' : ''; ?>>
<?php echo htmlspecialchars($p['name']); ?> -
<?php echo number_format((float)$p['price'], 2); ?> €
</option>
<?php endwhile; ?>
</select>

<label class="form-label">Quantity</label>
<input type="number" name="quantity" min="1" max="100" value="1" class="form-control mb-4" required>

<button class="btn-coffee">Confirm Order</button>

<a href="index.php" class="btn btn-secondary">Back</a>

</form>
</div>
</div>

</body>
</html>
