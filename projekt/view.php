
<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Our Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>THE MINT COFFEE</h1>
    <a href="index.php">Home</a>
</header>

<h2 class="heading">Our Products</h2>

<a href="create.php" class="btn">Add New Product</a>

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

        <a href="edit.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>

        <a href="delete.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure you want to delete this product?')">
            Delete
        </a>

    </div>

<?php } ?>

</div>

</body>
</html>
