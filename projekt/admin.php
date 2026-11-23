
<?php
include 'config.php';

$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM products"))['n'];
$orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM orders"))['n'];
$reservations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM reservations"))['n'];

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-sidebar">
<h3>☕ Mint Admin</h3>
<a href="admin.php" class="active">🏠 Dashboard</a>
<a href="index.php">🌐 Home</a>
<a href="create.php">➕ Add Product</a>
<a href="view.php">📦 View Products</a>
<a href="order.php">🛒 Orders</a>
<a href="reservation.php">📅 Reservations</a>
</div>

<div class="admin-content">

<h2 class="fw-bold">Dashboard</h2>
<p class="text-secondary">Welcome to The Mint Coffee Administration.</p>

<div class="row g-4 mt-2 mb-4">

<div class="col-md-4">
<div class="stat-card">
<h6>Total Products</h6>
<h2><?php echo $total; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h6>Total Orders</h6>
<h2><?php echo $orders; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h6>Reservations</h6>
<h2><?php echo $reservations; ?></h2>
</div>
</div>

</div>

<div class="table-card">
<div class="d-flex justify-content-between mb-3">
<h4>Products</h4>
<a href="create.php" class="btn-coffee">+ Add Product</a>
</div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td>
<img src="<?php echo htmlspecialchars($row['image']); ?>"
width="55" height="45" style="object-fit:cover;border-radius:8px;">
</td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['category']); ?></td>
<td><?php echo number_format((float)$row['price'], 2); ?> €</td>
<td>
<a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit btn-sm">Edit</a>

<form action="delete.php" method="POST" class="d-inline"
onsubmit="return confirm('Delete this product?')">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<button class="btn btn-delete btn-sm">Delete</button>
</form>
</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>
</div>
</div>

</div>
</body>
</html>
