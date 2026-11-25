
<?php
include 'config.php';

// Merr nga një produkt për secilën kategori
$menuProducts = [];

$categories = [
    'Matcha' => '🍵 Matcha',
    'Coffee' => '☕ Coffee',
    'Cake' => '🍰 Cakes'
];

foreach ($categories as $category => $title) {

    if ($category == 'Cake') {
        $stmt = mysqli_prepare($conn,
            "SELECT * FROM products
             WHERE category IN ('Cake', 'Dessert')
             ORDER BY id DESC LIMIT 1"
        );
        mysqli_stmt_execute($stmt);
    } else {
        $stmt = mysqli_prepare($conn,
            "SELECT * FROM products
             WHERE category = ?
             ORDER BY id DESC LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "s", $category);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $row['menu_title'] = $title;
        $menuProducts[] = $row;
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>The Mint Coffee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<style>

body {
    background: #f8f4ef;
    color: #49372c;
}

/* HERO */

.hero {
    min-height: 480px;
    background:
    linear-gradient(rgba(40,25,17,.65),rgba(40,25,17,.65)),
    url('https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=1600');
    background-position: center;
    background-size: cover;
    display: flex;
    align-items: center;
    color: white;
    padding: 60px;
    border-radius: 0 0 35px 35px;
}

.hero h1 {
    font-size: 52px;
    font-weight: 800;
}

.hero p {
    color: #eee0d1;
    max-width: 550px;
}

/* MENU */

.menu-section {
    padding-bottom: 60px;
}

.section-title {
    text-align: center;
    margin: 55px 0 35px;
}

.section-title h2 {
    font-weight: 800;
    font-size: 35px;
}

.section-title p {
    color: #998779;
}

.product-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 5px 20px rgba(70,45,25,.08);
    transition: .3s;
}

.product-card:hover {
    transform: translateY(-8px);
}

.product-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    display: block;
}

.product-info {
    padding: 22px;
}

.product-info h5 {
    font-weight: 700;
    color: #49372c;
    margin-top: 10px;
}

.product-info p {
    color: #998779;
    min-height: 40px;
}

.product-price {
    color: #a46e45;
    font-weight: 800;
    font-size: 20px;
}

.empty-menu {
    text-align: center;
    padding: 30px;
    color: #998779;
}

/* RESPONSIVE */

@media(max-width:768px) {

    .hero {
        padding: 30px 20px;
        min-height: 350px;
    }

    .hero h1 {
        font-size: 32px;
    }

    .product-card img {
        height: 220px;
    }

    .navbar .ms-auto {
        width: 100%;
        margin-top: 10px;
    }
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="index.php">
☕ The Mint Coffee
</a>

<div class="ms-auto">

<a class="nav-link d-inline" href="index.php">Home</a>

<a class="nav-link d-inline" href="#menu">Our Menu</a>

<a class="nav-link d-inline" href="reservation.php">Reservation</a>

<a class="nav-link d-inline" href="order.php">Order</a>

</div>

</div>
</nav>


<!-- HERO SECTION -->

<section class="hero">

<div>

<h1>
Fresh Coffee,<br>
Sweet Moments!
</h1>

<p>
Enjoy delicious coffee, refreshing matcha and wonderful cakes at The Mint Coffee.
</p>

<a href="#menu" class="btn-coffee">
Explore Our Menu
</a>

<a href="reservation.php" class="btn-coffee">
Reserve a Table
</a>

</div>

</section>


<!-- SPECIAL MENU -->

<div class="container menu-section" id="menu">

<div class="section-title">

<h2>Our Special Menu ☕</h2>

<p>
Discover our delicious Matcha, Coffee and Homemade Cakes.
</p>

</div>

<div class="row g-4">

<?php if (count($menuProducts) > 0): ?>

<?php foreach ($menuProducts as $row): ?>

<div class="col-lg-4 col-md-6">

<div class="product-card">

<img
src="<?= htmlspecialchars($row['image']) ?>"
alt="<?= htmlspecialchars($row['name']) ?>"
>

<div class="product-info">

<small class="text-secondary">
<?= htmlspecialchars($row['menu_title']) ?>
</small>

<h5>
<?= htmlspecialchars($row['name']) ?>
</h5>

<p>
<?= htmlspecialchars($row['description']) ?>
</p>

<div class="d-flex justify-content-between align-items-center">

<span class="product-price">
<?= number_format((float)$row['price'], 2) ?> €
</span>

<a
href="order.php?product_id=<?= (int)$row['id'] ?>"
class="btn-coffee">
Order Now
</a>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12">
<p class="empty-menu">No products available yet.</p>
</div>

<?php endif; ?>

</div>

</div>


<!-- FOOTER -->

<footer class="footer">

<h3>☕ The Mint Coffee</h3>

<p>Fresh Coffee • Delicious Drinks • Sweet Moments</p>

<p>© 2026 The Mint Coffee. All Rights Reserved.</p>

</footer>

</body>
</html>
