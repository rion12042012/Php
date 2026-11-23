
<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Mint Coffee</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand" href="index.php">☕ The Mint Coffee</a>
<div class="ms-auto">
<a class="nav-link d-inline" href="index.php">Home</a>
<a class="nav-link d-inline" href="#menu">Our Menu</a>
<a class="nav-link d-inline" href="reservation.php">Reservation</a>
<a class="nav-link d-inline" href="order.php">Order</a>
<a class="nav-link d-inline" href="admin.php">Admin</a>
</div>
</div>
</nav>

<section class="hero">
<div>
<h1>Fresh Coffee,<br>Sweet Moments!</h1>
<p>Enjoy delicious coffee, refreshing drinks and wonderful desserts at The Mint Coffee.</p>
<a href="#menu" class="btn-coffee">Explore Our Menu</a>
<a href="reservation.php" class="btn-coffee">Reserve a Table</a>
</div>
</section>

<div class="container" id="menu">

<div class="section-title">
<h2>Our Special Menu ☕</h2>
<p>Fresh coffee, delicious drinks and sweet desserts.</p>
</div>

<div class="row g-4">

<?php while($row = mysqli_fetch_assoc($result)): ?>

<div class="col-lg-4 col-md-6">
<div class="product-card">

<img src="<?php echo htmlspecialchars($row['image'] ?? ''); ?>"
alt="<?php echo htmlspecialchars($row['name']); ?>">

<div class="product-info">
<small class="text-secondary">
<?php echo htmlspecialchars($row['category']); ?>
</small>

<h5 class="mt-2">
<?php echo htmlspecialchars($row['name']); ?>
</h5>

<p><?php echo htmlspecialchars($row['description']); ?></p>

<div class="d-flex justify-content-between align-items-center">
<span class="product-price">
<?php echo number_format((float)$row['price'], 2); ?> €
</span>

<a href="order.php?product_id=<?php echo (int)$row['id']; ?>"
class="btn-coffee">Order Now</a>
</div>
</div>
</div>
</div>

<?php endwhile; ?>

</div>
</div>

<footer class="footer">
<h3>☕ The Mint Coffee</h3>
<p>Fresh Coffee • Delicious Drinks • Sweet Moments</p>
<p>© 2026 The Mint Coffee. All Rights Reserved.</p>
</footer>

</body>
</html>
