
<?php
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container py-5">
<div class="table-card">

<div class="d-flex justify-content-between mb-4">
<h2>All Products</h2>
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
<th>Description</th>
<th>Price</th>
</tr>
</thead>
<tbody>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><img src="<?php echo htmlspecialchars($row['image']); ?>" width="60" alt=""></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['category']); ?></td>
<td><?php echo htmlspecialchars($row['description']); ?></td>
<td><?php echo number_format((float)$row['price'], 2); ?> €</td>
</tr>
<?php endwhile; ?>

</tbody>
</table>
</div>

<a href="admin.php" class="btn-coffee">Back to Dashboard</a>
</div>
</div>

</body>
</html>
