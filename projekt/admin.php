
<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

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
<title>Mint Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    background: #f4f6f1;
    font-family: Arial, sans-serif;
}

.admin-sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    background: #173d32;
    padding: 25px 15px;
    color: white;
}

.admin-sidebar h3 {
    margin-bottom: 35px;
}

.admin-sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 13px;
    margin-bottom: 8px;
    border-radius: 8px;
}

.admin-sidebar a:hover,
.admin-sidebar a.active {
    background: #3c7059;
}

.admin-content {
    margin-left: 250px;
    padding: 35px;
}

.stat-card, .table-card, .editor-card {
    background: white;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 3px 15px rgba(0,0,0,.05);
    margin-bottom: 25px;
}

.stat-card h2 {
    color: #285b46;
    font-weight: bold;
}

.btn-coffee {
    background: #285b46;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    border: none;
}

.btn-coffee:hover {
    background: #173d32;
    color: white;
}

.section-title {
    color: #173d32;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-control {
    margin-bottom: 15px;
}

@media(max-width:768px) {
    .admin-sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .admin-content {
        margin-left: 0;
        padding: 15px;
    }
}
</style>
</head>

<body>

<div class="admin-sidebar">

<h3>☕ Mint Admin</h3>

<a href="#dashboard" class="active">🏠 Dashboard</a>
<a href="#products">📦 Manage Products</a>
<a href="create.php">➕ Add Product</a>
<a href="#menu">☕ Menu Settings</a>
<a href="#design">🎨 Website Design</a>
<a href="#images">🖼️ Website Images</a>
<a href="order.php">🛒 Orders</a>
<a href="reservation.php">📅 Reservations</a>
<a href="index.php">🌐 View Website</a>
<a href="logout.php">🚪 Logout</a>

</div>

<div class="admin-content">

<section id="dashboard">

<h2 class="fw-bold">Dashboard</h2>
<p class="text-secondary">Welcome to The Mint Coffee Administration.</p>

<div class="row g-4 mt-2">

<div class="col-md-4">
<div class="stat-card">
<h6>Total Products</h6>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h6>Total Orders</h6>
<h2><?= $orders ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="stat-card">
<h6>Reservations</h6>
<h2><?= $reservations ?></h2>
</div>
</div>

</div>
</section>

<section id="products" class="table-card">

<h4 class="section-title">📦 Manage Products</h4>

<a href="create.php" class="btn-coffee">+ Add Product</a>

<div class="table-responsive mt-4">

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
<td><?= $row['id'] ?></td>

<td>
<img src="<?= htmlspecialchars($row['image']) ?>"
width="55" height="45"
style="object-fit:cover;border-radius:8px;">
</td>

<td><?= htmlspecialchars($row['name']) ?></td>

<td><?= htmlspecialchars($row['category']) ?></td>

<td><?= number_format((float)$row['price'],2) ?> €</td>

<td>
<a href="edit.php?id=<?= $row['id'] ?>"
class="btn btn-success btn-sm">Edit</a>

<form action="delete.php" method="POST" class="d-inline"
onsubmit="return confirm('Delete this product?')">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<button class="btn btn-danger btn-sm">Delete</button>
</form>
</td>
</tr>

<?php endwhile; ?>

</tbody>
</table>
</div>
</section>

<section id="menu" class="editor-card">

<h4 class="section-title">☕ Menu Settings</h4>

<p>Manage the coffee shop menu and products.</p>

<a href="view.php" class="btn-coffee">Manage Menu Products</a>

<a href="create.php" class="btn-coffee">Add Menu Item</a>

</section>

<section id="design" class="editor-card">

<h4 class="section-title">🎨 Website Design</h4>

<p>Choose the website colors.</p>

<form action="save_design.php" method="POST">

<label>Primary Color</label>
<input type="color" name="primary_color"
value="#285b46" class="form-control form-control-color">

<label>Background Color</label>
<input type="color" name="background_color"
value="#f4f6f1" class="form-control form-control-color">

<label>Text Color</label>
<input type="color" name="text_color"
value="#173d32" class="form-control form-control-color">

<button class="btn-coffee mt-3">Save Design</button>

</form>

</section>

<section id="images" class="editor-card">

<h4 class="section-title">🖼️ Website Images</h4>

<p>Manage product images from the product editor.</p>

<a href="view.php" class="btn-coffee">Manage Images</a>

</section>

</div>
</body>
</html>

</html>

