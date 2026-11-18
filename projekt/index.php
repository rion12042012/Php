
<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Mint Coffee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


<section class="hero">
    <div>
        <h2>Welcome to The Mint Coffee</h2>
        <p>Fresh Coffee. Sweet Moments.</p>
        <a href="create.php" class="btn">Explore Our Coffee</a>
    </div>
</section>

<header>
    <h1>✳ THE MINT COFFEE</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="view.php">Menu</a>
        <a href="reservation.php">Reservation</a>
        <a href="order.php">Order</a>
        <a href="admin.php">Admin</a>
    </nav>
</header>

<section class="hero">
    <h2>Welcome to The Mint Coffee</h2>
    <p>Good coffee. Better company.</p>
    <a href="view.php" class="btn">Explore Menu</a>
</section>

<section class="menu">
    <h2>Our Menu</h2>

    <div class="products">

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="card">

            <h3>
                <?php echo htmlspecialchars($row['name']); ?>
            </h3>

            <p>
                <?php echo htmlspecialchars($row['description']); ?>
            </p>

            <h4>
                <?php echo $row['price']; ?> €
            </h4>

            <a href="order.php?id=<?php echo $row['id']; ?>">
                Order Now
            </a>

        </div>

    <?php } ?>

    </div>
</section>

<footer>
    <p>© 2026 The Mint Coffee</p>
</footer>

</body>
</html>
